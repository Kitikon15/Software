<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผู้สมัคร - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        .form-input:focus {
            outline: none;
            ring: 3px solid #3b82f6;
            border-color: #3b82f6;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, #9333ea 0%, #7e22ce 100%); /* Purple gradient */
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%); /* Dark gray gradient */
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #9333ea 0%, #7e22ce 100%); /* Purple gradient */
            color: white;
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%); /* Dark gray gradient */
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .page-header {
            background: linear-gradient(135deg, #9333ea 0%, #7e22ce 100%); /* Purple gradient */
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="page-header shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="https://www.npru.ac.th/2019/img/Npru-logo.png" alt="NPRU Logo" class="h-12 w-auto">
                <div>
                    <h1 class="text-xl font-bold text-white">Admin Dashboard</h1>
                    <p class="text-sm text-blue-100">ระบบจัดการข้อมูลผู้สมัคร</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 hover:bg-gray-800 text-white px-4 py-2 rounded-lg flex items-center transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> กลับหน้า Admin
                </a>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">เพิ่มผู้สมัครใหม่</h2>
                <p class="text-gray-600">กรุณากรอกข้อมูลที่มีเครื่องหมาย <span class="text-red-600">*</span> ให้ครบถ้วน</p>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-danger mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-xl mr-2"></i>
                        <h3 class="font-bold">ข้อผิดพลาดในการกรอกข้อมูล:</h3>
                    </div>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.applicant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-lg font-medium text-gray-800 mb-2">ชื่อ <span class="text-red-600">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input" placeholder="กรอกชื่อ-นามสกุล" required>
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-lg font-medium text-gray-800 mb-2">อีเมล <span class="text-red-600">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="กรอกอีเมล" required>
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-lg font-medium text-gray-800 mb-2">เบอร์โทรศัพท์ <span class="text-red-600">*</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="กรอกเบอร์โทรศัพท์" required>
                        @error('phone')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="birth_date" class="block text-lg font-medium text-gray-800 mb-2">วันเกิด <span class="text-red-600">*</span></label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" class="form-input" required>
                        @error('birth_date')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="profile_image" class="block text-lg font-medium text-gray-800 mb-2">รูปโปรไฟล์</label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-input">
                        <p class="mt-2 text-sm text-gray-500">ไฟล์ JPG, PNG หรือ GIF ขนาดไม่เกิน 2MB</p>
                        @error('profile_image')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-center space-x-4 pt-6">
                        <a href="{{ route('admin') }}" class="btn btn-secondary flex items-center">
                            <i class="fas fa-times mr-2"></i> ยกเลิก
                        </a>
                        <button type="submit" class="btn btn-primary flex items-center">
                            <i class="fas fa-user-plus mr-2"></i> เพิ่มผู้สมัคร
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>