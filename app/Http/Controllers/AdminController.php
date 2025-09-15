<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Post;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with statistics and applicant list
     */
    public function index()
    {
        $stats = [
            'total_applicants' => Applicant::count(),
            'recent_applicants' => Applicant::where('created_at', '>=', now()->subDays(7))->count(),
            'total_posts' => Post::count(),
        ];
        
        $applicants = Applicant::latest()->paginate(10);
        
        return view('admin', compact('stats', 'applicants'));
    }

    /**
     * Show the specified applicant
     */
    public function show($id)
    {
        $applicant = Applicant::findOrFail($id);
        return response()->json($applicant);
    }

    /**
     * Remove the specified applicant from storage
     */
    public function destroy($id)
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();
        
        return redirect()->route('admin')->with('success', 'ลบข้อมูลผู้สมัครเรียบร้อยแล้ว');
    }

    /**
     * Export applicants data
     */
    public function export()
    {
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