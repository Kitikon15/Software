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
                </nav>
            </div>
        </aside>
        
        <main class="flex-1 flex items-start justify-center p-6 mt-16">

            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-auto overflow-hidden">
                
                <div class="bg-blue-100 text-center py-4 px-6 border-b-2 border-blue-200">
                    <h1 class="text-xl text-blue-800 font-semibold">ลืมรหัสผ่าน/ขอรหัสผ่านใหม่</h1>
                </div>

                <div class="flex items-center justify-center p-8">
                    
                    <div class="flex-shrink-0 mr-8">
                        <img src="https://images.icon-icons.com/317/PNG/512/key-icon_34404.png" alt="Forgot Password" class="w-32 h-auto">
                    </div>

                    <div class="w-full">
                        <form class="space-y-4">
                            <div>
                                <label for="citizenId" class="block text-sm font-medium text-gray-700">เลขบัตรประชาชน</label>
                                <input type="text" id="citizenId" name="citizenId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="flex items-center space-x-2">
                                <label class="block text-sm font-medium text-gray-700">วัน เดือน ปีเกิด</label>
                                <select class="mt-1 block w-1/3 rounded-md border-gray-300 shadow-sm">
                                    <option value="">วัน</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                                <select class="mt-1 block w-1/3 rounded-md border-gray-300 shadow-sm">
                                    <option value="">เดือน</option>
                                    <option value="01">มกราคม</option>
                                    <option value="02">กุมภาพันธ์</option>
                                    <option value="03">มีนาคม</option>
                                    <option value="04">เมษายน</option>
                                    <option value="05">พฤษภาคม</option>
                                    <option value="06">มิถุนายน</option>
                                    <option value="07">กรกฎาคม</option>
                                    <option value="08">สิงหาคม</option>
                                    <option value="09">กันยายน</option>
                                    <option value="10">ตุลาคม</option>
                                    <option value="11">พฤศจิกายน</option>
                                    <option value="12">ธันวาคม</option>
                                </select>
                                <select class="mt-1 block w-1/3 rounded-md border-gray-300 shadow-sm">
                                    <option value="">ปีเกิด</option>
                                    <script>
                                        const yearSelect = document.querySelector('select:last-of-type');
                                        const currentYear = new Date().getFullYear();
                                        for (let i = currentYear; i >= 1950; i--) {
                                            const option = document.createElement('option');
                                            option.value = i;
                                            option.textContent = i;
                                            yearSelect.appendChild(option);
                                        }
                                    </script>
                                </select>
                            </div>
                            
                             <div class="pt-4 text-right">
                                <a href="{{ url('/login') }}" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    PROCESS
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>