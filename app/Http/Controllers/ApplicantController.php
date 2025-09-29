<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Applicant; // ตรวจสอบให้แน่ใจว่าคุณสร้าง Model ชื่อ Applicant แล้ว

class ApplicantController extends Controller
{
    /**
     * Store a newly created applicant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. กำหนดกฎการตรวจสอบข้อมูล (Validation Rules)
        $validator = Validator::make($request->all(), [
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

        // 2. ตรวจสอบว่าข้อมูลไม่ผ่าน Validation หรือไม่
        if ($validator->fails()) {
            return redirect()->route('system')
                ->withErrors($validator)
                ->withInput();
        }

        // 3. ถ้าข้อมูลถูกต้อง ให้สร้างและบันทึกข้อมูลลงฐานข้อมูล
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

            // อัตโนมัติเข้าสู่ระบบหลังจากลงทะเบียนสำเร็จ
            Session::put('applicant_logged_in', true);
            Session::put('applicant_id', $applicant->id);
            Session::put('applicant_name', $applicant->name);

            // 4. หลังจากลงทะเบียนและเข้าสู่ระบบสำเร็จ ให้ Redirect ไปยังหน้า system เพื่อแสดงข้อมูลที่ลงทะเบียน
            return redirect()->route('system')->with('success', 'ลงทะเบียนและเข้าสู่ระบบเรียบร้อยแล้ว!');
        } catch (\Exception $e) {
            // กรณีเกิดข้อผิดพลาดในการบันทึกข้อมูล
            return back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage())->withInput();
        }
    }
}