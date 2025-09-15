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
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-b from-teal-400 to-teal-500">
    <header class="bg-cover bg-center shadow-sm" style="background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20231019/pngtree-vibrant-corrugated-paper-texture-in-shades-of-red-and-yellow-image_13690479.png');">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="https://www.npru.ac.th/2019/img/Npru-logo.png"
                    alt="NPRU Logo" class="h-20 w-auto">
                <div>
                    <h1 class="text-2xl font-bold text-black-900">มหาวิทยาลัยราชภัฏนครปฐม</h1>
                    <p class="text-2xl font-bold text-outline">Nakhon Pathom Rajabhat University</p>
                </div>
            </div>
            <div class="text-4xl font-bold text-black-600">Admission</div>
        </div>
    </header>
    <div class="flex">
        <aside class="w-64 bg-gray-700 min-h-screen">
            <div class="p-4">
                <h2 class="text-white font-bold mb-4">เมนูหลัก</h2>
                
                @if(Session::has('applicant_logged_in'))
                    <div class="bg-green-600 text-white p-3 rounded mb-4">
                        <p class="text-sm">ยินดีต้อนรับ</p>
                        <p class="font-semibold">{{ Session::get('applicant_name', 'ผู้ใช้') }}</p>
                    </div>
                @endif
                
                <nav class="space-y-2">
                    <a href="{{ url('/admission') }}" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">ถอยกลับ</a>
                    @if(Session::has('applicant_logged_in'))
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left text-white hover:bg-gray-600 px-3 py-2 rounded">ออกจากระบบ</button>
                        </form>
                    @else
                        <a href="{{ url('/login') }}" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">เข้าสู่ระบบ</a>
                    @endif
                </nav>
            </div>
        </aside>
        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
                @if(Session::has('applicant_logged_in'))
                    <h2 class="text-orange-600 font-bold text-xl mb-4">ยินดีต้อนรับ คุณ {{ Session::get('applicant_name') }}</h2>
                    <p class="mb-4 text-gray-700">คุณได้เข้าสู่ระบบเรียบร้อยแล้ว สามารถดูข้อมูลของคุณได้</p>
                    
                    @if(isset($applicant))
                        <div class="bg-blue-50 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-semibold text-blue-800 mb-3">ข้อมูลของคุณ</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div><strong>ชื่อ:</strong> {{ $applicant->name }}</div>
                                <div><strong>อีเมล:</strong> {{ $applicant->email }}</div>
                                <div><strong>เบอร์โทร:</strong> {{ $applicant->phone }}</div>
                                <div><strong>วันเกิด:</strong> {{ \Carbon\Carbon::parse($applicant->birth_date)->format('d/m/Y') }}</div>
                                <div><strong>วันที่ลงทะเบียน:</strong> {{ $applicant->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <p class="text-green-600 font-semibold">ข้อมูลการสมัครของคุณถูกบันทึกเรียบร้อยแล้ว</p>
                        </div>
                    @endif
                @else
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-blue-800 font-semibold text-sm">ข้อมูลสำคัญ: คุณต้องลงทะเบียนเพื่อเข้าสู่ระบบในภายหลัง</span>
                        </div>
                        <p class="text-blue-700 text-xs mt-2">หลังจากลงทะเบียนสำเร็จ คุณจะสามารถเข้าสู่ระบบได้โดยใช้เบอร์โทรศัพท์และเลข 4 หลักท้าย</p>
                    </div>
                    
                    <h2 class="text-orange-600 font-bold text-xl mb-4">ลงทะเบียนผู้สมัคร</h2>
                    <p class="mb-4 text-gray-700">กรุณากรอกข้อมูลที่มีเครื่องหมาย <span class="text-red-600">*</span> ให้ครบถ้วนแล้วกดปุ่มลงทะเบียน</p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/register-applicant') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col md:flex-row md:items-center">
                        <label class="w-full md:w-1/3 font-semibold mb-2 md:mb-0" for="name">ชื่อผู้สมัคร <span class="text-red-600">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full md:w-2/3 border border-gray-300 rounded px-2 py-1" required>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center">
                        <label class="w-full md:w-1/3 font-semibold mb-2 md:mb-0" for="email">อีเมล <span class="text-red-600">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full md:w-2/3 border border-gray-300 rounded px-2 py-1" required>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center">
                        <label class="w-full md:w-1/3 font-semibold mb-2 md:mb-0" for="phone">เบอร์โทรศัพท์ <span class="text-red-600">*</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full md:w-2/3 border border-gray-300 rounded px-2 py-1" required>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center">
                        <label class="w-full md:w-1/3 font-semibold mb-2 md:mb-0" for="birth_date">วันเกิด <span class="text-red-600">*</span></label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" class="w-full md:w-2/3 border border-gray-300 rounded px-2 py-1" required>
                    </div>
                         
                    <div class="text-center pt-4">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded">
                            ลงทะเบียน
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </main>
    </div>
</body>
</html>