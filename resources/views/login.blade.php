<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบงานรับสมัคร</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .text-outline {
            color: white;
            text-shadow:
                -1px -1px 0 #808080,
                1px -1px 0 #808080,
                -1px 1px 0 #808080,
                1px 1px 0 #808080;
        }
        .key-icon {
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            color: #d1d5db; /* Gray shade */
            transform: scaleX(-1);
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-b from-teal-400 to-teal-500">
    <header class="bg-cover bg-center shadow-sm" style="background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20231019/pngtree-vibrant-corrugated-paper-texture-in-shades-of-red-and-yellow-image_13690479.png');">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="https://www.npru.ac.th/2019/img/Npru-logo.png" alt="NPRU Logo" class="h-20 w-auto">
                <div>
                    <h1 class="text-2xl font-bold text-black">มหาวิทยาลัยราชภัฏนครปฐม</h1>
                    <p class="text-2xl font-bold text-outline">Nakhon Pathom Rajabhat University</p>
                </div>
            </div>
            <div class="text-4xl font-bold text-black">Admission</div>
        </div>
    </header>

    <div class="flex min-h-screen">

        <aside class="w-64 bg-gray-700">
            <div class="p-4">
                <h2 class="text-white font-bold mb-4">เมนูหลัก</h2>
                <nav class="space-y-2">
                    <a href="{{ url('/admission') }}" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">หน้าเริ่มต้น</a>
                    <a href="{{ url('/system') }}" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">ลงทะเบียน/สมัคร</a>
                </nav>
            </div>
        </aside>
        <main class="flex-1 flex items-start justify-center p-6 mt-16">

            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-auto overflow-hidden">

                <div class="bg-blue-100 text-center py-4 px-6 border-b-2 border-blue-200">
                    <h1 class="text-xl text-blue-800 font-semibold">เข้าสู่ระบบ</h1>
                    <p class="text-sm text-blue-600 mt-1">สำหรับผู้ที่ลงทะเบียนแล้วเท่านั้น</p>
                    <p class="text-xs text-red-600 mt-2">**หากยังไม่ได้ลงทะเบียน กรุณาลงทะเบียนก่อนเข้าสู่ระบบ**</p>
                </div>
                
                <!-- Display Success/Error Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="flex flex-col md:flex-row items-center justify-center p-8">

                    <div class="flex-shrink-0 md:mr-8 mb-6 md:mb-0">
                        <svg class="key-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.65,10.65L5.7,17.6c-0.2,0.2-0.2,0.5,0,0.7l0.7,0.7c0.2,0.2,0.5,0.2,0.7,0L14,12.05L12.65,10.65 M21.75,7.35l-1.4-1.4c-0.2-0.2-0.5-0.2-0.7,0l-6.2,6.2l-1.4-1.4l6.2-6.2c0.2-0.2,0.2-0.5,0-0.7l-0.7-0.7c-0.2-0.2-0.5-0.2-0.7,0l-6.2,6.2l-1.4-1.4l6.2-6.2c0.2-0.2,0.2-0.5,0-0.7l-0.7-0.7c-0.2-0.2-0.5-0.2-0.7,0l-6.2,6.2L4.5,9.45l-1.4,1.4l1.4,1.4L10,18.5L8.6,19.9l-1.4-1.4L5.8,19.9l1.4,1.4c0.2,0.2,0.2,0.5,0,0.7l-0.7,0.7c-0.2,0.2-0.5,0.2-0.7,0l-1.4-1.4c-0.2-0.2-0.2-0.5,0-0.7l1.4-1.4l-1.4-1.4l-1.4,1.4c-0.2,0.2-0.5,0.2-0.7,0l-0.7-0.7c-0.2-0.2-0.2-0.5,0-0.7l1.4-1.4l-1.4-1.4l-1.4,1.4c-0.2,0.2-0.5,0.2-0.7,0l-0.7-0.7c-0.2-0.2-0.2-0.5,0-0.7l1.4-1.4l-1.4-1.4L0.8,5.4l1.4-1.4l1.4,1.4L6.9,3.3l1.4,1.4l-1.4,1.4l1.4,1.4l1.4-1.4l1.4,1.4L18.6,5.4l1.4,1.4l1.75,1.75l-1.4,1.4L19.3,9.45l1.4,1.4l1.4-1.4L21.75,7.35z"></path>
                        </svg>
                    </div>

                    <div class="w-full">
                        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="id_number" class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์</label>
                                <input type="text" id="id_number" name="id_number" value="{{ old('id_number') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                       placeholder="กรอกเบอร์โทรศัพท์ของคุณ" required>
                                <p class="text-xs text-gray-500 mt-1">ใช้เบอร์โทรศัพท์ที่ลงทะเบียน</p>
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">รหัสผ่าน</label>
                                <input type="password" id="password" name="password" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                       placeholder="เลข 4 หลักท้ายของเบอร์โทร" required>
                                <p class="text-xs text-gray-500 mt-1">รหัสผ่านคือเลข 4 หลักท้ายของเบอร์โทรศัพท์</p>
                            </div>
                            <div class="pt-4">
                                <button type="submit" 
                                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    เข้าระบบ
                                </button>
                            </div>
                        </form>

                        <div class="mt-4 text-center text-sm space-y-2">
                            <div class="bg-yellow-50 border border-yellow-200 rounded p-3 mb-3">
                                <p class="text-yellow-800 text-xs font-semibold">หากยังไม่มีบัญชี:</p>
                                <a href="{{ url('/system') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">คลิกที่นี่เพื่อลงทะเบียนก่อน</a>
                            </div>
                            <a href="{{ url('/test-credentials') }}" class="text-green-600 hover:text-green-500 block text-xs">ดูข้อมูลทดสอบการเข้าสู่ระบบ</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>