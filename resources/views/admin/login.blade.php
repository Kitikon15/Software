<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ระบบงานรับสมัคร</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .admin-login-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            overflow: hidden;
        }
        .input-field:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }
        .btn-login {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        }
        .logo-container {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
    </style>
</head>
<body class="admin-login-bg min-h-screen flex items-center justify-center p-4">
    <div class="login-card w-full max-w-md">
        <div class="logo-container text-center py-8">
            <div class="flex justify-center mb-4">
                <img src="https://www.npru.ac.th/2019/img/Npru-logo.png" alt="NPRU Logo" class="h-16 w-auto">
            </div>
            <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            <p class="text-blue-100 mt-1">ระบบจัดการข้อมูลผู้สมัคร</p>
        </div>

        <div class="p-8">
            <div class="text-center mb-8">
                <div class="mx-auto bg-gray-200 rounded-full p-3 w-16 h-16 flex items-center justify-center mb-4">
                    <i class="fas fa-user-shield text-2xl text-gray-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">เข้าสู่ระบบผู้ดูแล</h2>
                <p class="text-gray-600 mt-2">กรุณากรอกข้อมูลเพื่อเข้าสู่ระบบ Admin</p>
            </div>

            <!-- Display Success/Error Messages -->
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-indigo-600"></i>ชื่อผู้ใช้
                    </label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" 
                           class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="กรอกชื่อผู้ใช้ของคุณ" required>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-indigo-600"></i>รหัสผ่าน
                    </label>
                    <input type="password" id="password" name="password" 
                           class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="กรอกรหัสผ่านของคุณ" required>
                </div>
                
                <div class="flex items-center">
                    <input id="remember_me" name="remember_me" type="checkbox" 
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                        จดจำการเข้าสู่ระบบ
                    </label>
                </div>
                
                <div>
                    <button type="submit" class="btn-login w-full py-3 px-4 rounded-lg text-white font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-sign-in-alt mr-2"></i>เข้าสู่ระบบ
                    </button>
                </div>
            </form>

            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
                <p class="text-sm text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i><strong>ข้อมูลเข้าสู่ระบบสำหรับทดสอบ:</strong><br>
                    ชื่อผู้ใช้: <code class="bg-blue-100 px-2 py-1 rounded">kitikon15</code><br>
                    รหัสผ่าน: <code class="bg-blue-100 px-2 py-1 rounded">kit15</code>
                </p>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-1"></i>กลับไปหน้าหลัก
                </a>
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500">
                        ระบบงานรับสมัคร NPRU &copy; 2025
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>