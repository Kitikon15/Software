<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Applicant;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        // If already logged in, redirect to system page
        if (Session::has('applicant_logged_in')) {
            return redirect()->route('system');
        }
        
        return view('login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'id_number' => 'required|string',
            'password' => 'required|string',
        ], [
            'id_number.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
        ]);

        // Check if applicant exists with this phone number
        $applicant = Applicant::where('phone', $request->id_number)->first();
        
        if (!$applicant) {
            return back()->withErrors([
                'login' => 'ไม่พบข้อมูลผู้ใช้นี้ในระบบ กรุณาลงทะเบียนก่อนเข้าสู่ระบบ'
            ])->withInput();
        }
        
        // For demo purposes, password is last 4 digits of phone number
        $expectedPassword = substr($applicant->phone, -4);
        
        if ($request->password !== $expectedPassword) {
            return back()->withErrors([
                'login' => 'รหัสผ่านไม่ถูกต้อง (ใช้เลข 4 หลักท้ายของเบอร์โทรศัพท์)'
            ])->withInput();
        }
        
        // Store login session
        Session::put('applicant_logged_in', true);
        Session::put('applicant_id', $applicant->id);
        Session::put('applicant_name', $applicant->name);
        
        return redirect()->route('system')->with('success', 'เข้าสู่ระบบเรียบร้อยแล้ว');
    }

    /**
     * Show the admin login form
     */
    public function showAdminLogin()
    {
        // If already logged in as admin, redirect to admin dashboard
        if (Session::has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    /**
     * Handle admin login request
     */
    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'กรุณากรอกชื่อผู้ใช้',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
        ]);

        // Updated credentials as requested
        $validUsername = 'kitikon15';
        $validPassword = 'kit15';
        
        if ($request->username !== $validUsername || $request->password !== $validPassword) {
            return back()->withErrors([
                'login' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'
            ])->withInput();
        }
        
        // Store admin login session
        Session::put('admin_logged_in', true);
        Session::put('admin_name', 'Administrator');
        
        return redirect()->route('admin.dashboard')->with('success', 'เข้าสู่ระบบผู้ดูแลเรียบร้อยแล้ว');
    }

    /**
     * Handle logout request
     */
    public function logout()
    {
        Session::forget(['applicant_logged_in', 'applicant_id', 'applicant_name']);
        return redirect()->route('login')->with('success', 'ออกจากระบบเรียบร้อยแล้ว');
    }

    /**
     * Handle admin logout request
     */
    public function adminLogout()
    {
        Session::forget(['admin_logged_in', 'admin_name']);
        return redirect()->route('admin.login')->with('success', 'ออกจากระบบผู้ดูแลเรียบร้อยแล้ว');
    }

    /**
     * Show the system page (protected)
     */
    public function showSystem()
    {
        // Check if user is logged in
        if (!Session::has('applicant_logged_in')) {
            return redirect()->route('login')->with('error', 'กรุณาเข้าสู่ระบบก่อน');
        }
        
        $applicant = null;
        if (Session::has('applicant_id')) {
            $applicant = Applicant::find(Session::get('applicant_id'));
        }
        
        return view('system', compact('applicant'));
    }

    /**
     * Demo method to create test credentials
     */
    public function createTestCredentials()
    {
        // This is for demo purposes only
        $applicants = Applicant::all();
        $credentials = [];
        
        foreach ($applicants as $applicant) {
            $credentials[] = [
                'name' => $applicant->name,
                'id_number' => $applicant->phone, // Using phone as ID number
                'password' => substr($applicant->phone, -4), // Last 4 digits as password
            ];
        }
        
        return view('test_credentials', compact('credentials'));
    }
}