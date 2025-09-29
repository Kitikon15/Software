
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission - NPRU</title>
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
                <nav class="space-y-2">
                    <a href="{{ url('/system') }}" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">ลงทะเบียนการไว้ระบบ</a>
                    <a href="{{ url('/login')}}" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">เข้าสู่ระบบ</a>
                    <a href="{{ route('admin.login') }}" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">ระบบจัดการ (Admin)</a>
                    <a href="#" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">สาขาและจำนวนที่รับสมัคร</a>
                    <a href="#" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">ตอบคำถาม</a>
                    <a href="#" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">รายงานการสมัคร</a>
                    <a href="#" class="block text-white hover:bg-gray-600 px-3 py-2 rounded">ขั้นตอนการสมัคร</a>
                </nav>
            </div>
        </aside>

        <main class="flex-1 p-6">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">ข่าวประชาสัมพันธ์</h2>

                <div class="space-y-8">
                    <div class="border-b pb-6">
                        <h3 class="text-lg font-semibold text-blue-600 mb-4">
                            <span class="underline">1. รับสมัครนักศึกษาระดับปริญญาตรี ภาคปกติ ปีการศึกษา 2569 (รอบที่ 1)</span>
                            <span class="text-red-600">(ด่วนที่สุด)</span>
                        </h3>
                        <div class="rounded-lg p-6 text-white relative overflow-hidden">
                            <div>
                                <img src="https://news.npru.ac.th/userfiles/ACADEMIC/%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3%2069/ban%2069%20%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3%E0%B9%80%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%99%201.png"
                                    alt="NPRU Admission 69"
                                    class="w-full h-auto rounded">
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            ประกาศโดย: <span class="text-blue-600">academic.new </span> วันที่ประกาศ: 5 สิงหาคม 2568
                        </div>
                    </div>
                    <div class="border-b pb-6">
                        <h3 class="text-lg font-semibold text-blue-600 mb-4">
                            <span class="underline">2. รับสมัครนักศึกษาระดับปริญญาตรี ภาคศ.พป. ปีการศึกษา 2569 (รอบที่ 1)</span>
                        </h3>
                        <h3 class="text-lg font-semibold text-blue-600 mb-4"></h3>
                        <div class="rounded-lg p-6 text-white relative overflow-hidden">
                            <div>
                                <img src="https://news.npru.ac.th/userfiles/ACADEMIC/%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3%2069/ban%2069%20%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3%E0%B9%80%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%99%20%282%29.png"
                                    alt="NPRU Admission 69"
                                    class="w-full h-auto rounded">
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            ประกาศโดย: <span class="text-blue-600">academic.new </span>วันที่ประกาศ 8 สิงหาคม 2568
                        </div>
                    </div>
                    <div class="border-b pb-6">
                        <h3 class="text-lg font-semibold text-blue-600 mb-4">
                            <span class="underline">3. รับสมัครนักศึกษาระดับปริญญาพิเศษศึกษา ภาคปกติ ประจำภาคเรียนที่ 2 ปีการศึกษา 2568</span>
                        </h3>
                        <h3 class="text-lg font-semibold text-blue-600 mb-4"></h3>
                        <div class="rounded-lg p-6 text-white relative overflow-hidden">
                            <div>
                                <img src="https://news.npru.ac.th/userfiles/ACADEMIC/%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3%20%E0%B8%9B%E0%B8%B558/%E0%B8%AA%E0%B8%B3%E0%B9%80%E0%B8%99%E0%B8%B2%E0%B8%82%E0%B8%AD%E0%B8%87%20%E0%B8%AA%E0%B8%B3%E0%B9%80%E0%B8%99%E0%B8%B2%E0%B8%82%E0%B8%AD%E0%B8%87%20ban%20%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3%E0%B9%80%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%99%20%281%29.png"
                                    alt="NPRU Admission 69"
                                    class="w-full h-auto rounded">
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            ประกาศโดย: <span class="text-blue-600">academic.new </span>วันที่ประกาศ 12 มีนาคม 2568
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <a href="{{ url('/') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg inline-block transition-colors">
                        ← กลับหน้าหลัก
                    </a>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
