<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Middleware to check if admin is logged in
     */
    public function __construct()
    {
        // You can add middleware here to protect all admin routes
        // For now, we'll check in each method
    }
    
    /**
     * Check if admin is logged in
     */
    private function checkAdminAuth()
    {
        if (!Session::has('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'กรุณาเข้าสู่ระบบผู้ดูแลก่อน');
        }
        return null;
    }

    /**
     * Display the admin dashboard with statistics and applicant list
     */
    public function index()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        $stats = [
            'total_applicants' => Applicant::count(),
            'recent_applicants' => Applicant::where('created_at', '>=', now()->subDays(7))->count(),
            'total_posts' => Post::count(),
        ];
        
        // Get data for daily applicants chart (last 7 days)
        $dailyApplicants = $this->getDailyApplicantsData();
        
        // Get data for monthly applicants chart
        $monthlyApplicants = $this->getMonthlyApplicantsData();
        
        // Get recent applicants for activity feed
        $recentApplicants = Applicant::latest()->take(5)->get();
        
        $applicants = Applicant::latest()->paginate(10);
        
        return view('admin.admin', compact('stats', 'applicants', 'dailyApplicants', 'monthlyApplicants', 'recentApplicants'));
    }
    
    /**
     * Display the admin dashboard overview
     */
    public function dashboard()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        $stats = [
            'total_applicants' => Applicant::count(),
            'recent_applicants' => Applicant::where('created_at', '>=', now()->subDays(7))->count(),
            'total_posts' => Post::count(),
        ];
        
        // Get data for daily applicants chart (last 7 days)
        $dailyApplicants = $this->getDailyApplicantsData();
        
        // Get data for monthly applicants chart
        $monthlyApplicants = $this->getMonthlyApplicantsData();
        
        // Get recent applicants for activity feed
        $recentApplicants = Applicant::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'dailyApplicants', 'monthlyApplicants', 'recentApplicants'));
    }

    /**
     * Show the form for creating a new applicant
     */
    public function create()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        return view('admin.applicant_create');
    }

    /**
     * Store a newly created applicant in storage
     */
    public function store(Request $request)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:applicants|max:255',
            'phone' => 'required|unique:applicants|max:20',
            'birth_date' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'กรุณากรอกชื่อ',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.unique' => 'อีเมลนี้มีในระบบแล้ว',
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'phone.unique' => 'เบอร์โทรศัพท์นี้มีในระบบแล้ว',
            'birth_date.required' => 'กรุณาเลือกวันเกิด',
            'birth_date.date' => 'รูปแบบวันที่ไม่ถูกต้อง',
            'profile_image.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ',
            'profile_image.max' => 'ขนาดรูปภาพต้องไม่เกิน 2MB',
        ]);

        try {
            $applicant = new Applicant;
            $applicant->name = $request->name;
            $applicant->email = $request->email;
            $applicant->phone = $request->phone;
            $applicant->birth_date = $request->birth_date;
            
            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time() . '_' . $applicant->name . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/profile_images', $imageName);
                $applicant->profile_image = $imageName;
            }
            
            $applicant->save();

            return redirect()->route('admin')->with('success', 'เพิ่มข้อมูลผู้สมัครเรียบร้อยแล้ว!');
        } catch (\Exception $e) {
            return back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified applicant
     */
    public function edit($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        $applicant = Applicant::findOrFail($id);
        return view('admin.applicant_edit', compact('applicant'));
    }

    /**
     * Update the specified applicant in storage
     */
    public function update(Request $request, $id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        $applicant = Applicant::findOrFail($id);
        
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:applicants,email,'.$applicant->id.'|max:255',
            'phone' => 'required|unique:applicants,phone,'.$applicant->id.'|max:20',
            'birth_date' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'กรุณากรอกชื่อ',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.unique' => 'อีเมลนี้มีในระบบแล้ว',
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'phone.unique' => 'เบอร์โทรศัพท์นี้มีในระบบแล้ว',
            'birth_date.required' => 'กรุณาเลือกวันเกิด',
            'birth_date.date' => 'รูปแบบวันที่ไม่ถูกต้อง',
            'profile_image.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ',
            'profile_image.max' => 'ขนาดรูปภาพต้องไม่เกิน 2MB',
        ]);

        try {
            $applicant->name = $request->name;
            $applicant->email = $request->email;
            $applicant->phone = $request->phone;
            $applicant->birth_date = $request->birth_date;
            
            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete old image if exists
                if ($applicant->profile_image) {
                    Storage::delete('public/profile_images/' . $applicant->profile_image);
                }
                
                $image = $request->file('profile_image');
                $imageName = time() . '_' . $applicant->name . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/profile_images', $imageName);
                $applicant->profile_image = $imageName;
            }
            
            $applicant->save();

            return redirect()->route('admin')->with('success', 'อัปเดตข้อมูลผู้สมัครเรียบร้อยแล้ว!');
        } catch (\Exception $e) {
            return back()->with('error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Get daily applicants data for the last 7 days
     */
    private function getDailyApplicantsData()
    {
        $dates = [];
        $counts = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates[] = $date->format('d/m');
            $counts[] = Applicant::whereDate('created_at', $date)->count();
        }
        
        return [
            'labels' => $dates,
            'data' => $counts
        ];
    }
    
    /**
     * Get monthly applicants data
     */
    private function getMonthlyApplicantsData()
    {
        $months = [];
        $counts = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->locale('th')->shortMonthName . ' ' . $month->year;
            $counts[] = Applicant::whereYear('created_at', $month->year)
                                ->whereMonth('created_at', $month->month)
                                ->count();
        }
        
        return [
            'labels' => $months,
            'data' => $counts
        ];
    }

    /**
     * Show the specified applicant
     */
    public function show($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        $applicant = Applicant::findOrFail($id);
        return response()->json($applicant);
    }

    /**
     * Update the specified applicant's image
     */
    public function updateImage(Request $request, $id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $applicant = Applicant::findOrFail($id);
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($applicant->profile_image) {
                Storage::delete('public/profile_images/' . $applicant->profile_image);
            }
            
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $applicant->name . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_images', $imageName);
            $applicant->profile_image = $imageName;
            $applicant->save();
        }
        
        return redirect()->route('admin')->with('success', 'อัปเดตรูปภาพเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified applicant from storage
     */
    public function destroy($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        $applicant = Applicant::findOrFail($id);
        
        // Delete profile image if exists
        if ($applicant->profile_image) {
            Storage::delete('public/profile_images/' . $applicant->profile_image);
        }
        
        $applicant->delete();
        
        return redirect()->route('admin')->with('success', 'ลบข้อมูลผู้สมัครเรียบร้อยแล้ว');
    }

    /**
     * Export applicants data
     */
    public function export()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) {
            return $authCheck;
        }
        
        $applicants = Applicant::all();
        
        $filename = 'applicants_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($applicants) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Birth Date', 'Created At']);
            
            // Add data rows
            foreach ($applicants as $applicant) {
                fputcsv($file, [
                    $applicant->id,
                    $applicant->name,
                    $applicant->email,
                    $applicant->phone,
                    $applicant->birth_date,
                    $applicant->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}