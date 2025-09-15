<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการเข้าสู่ระบบทดสอบ</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-b from-teal-400 to-teal-500 py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-2xl font-bold text-blue-800 mb-6 text-center">ข้อมูลการเข้าสู่ระบบทดสอบ</h1>
            
            <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            <strong>หมายเหตุ:</strong> นี่เป็นข้อมูลสำหรับการทดสอบระบบเท่านั้น ในระบบจริงจะต้องมีการรักษาความปลอดภัยที่เหมาะสม
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">ขั้นตอนการเข้าสู่ระบบ:</h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                    <li>ไปที่หน้า <a href="{{ route('login') }}" class="text-blue-600 hover:underline">เข้าสู่ระบบ</a></li>
                    <li>ใช้เบอร์โทรศัพท์จากตารางด้านล่างในช่อง "เลขบัตรประชาชน"</li>
                    <li>ใช้ตัวเลข 4 หลักท้ายของเบอร์โทรศัพท์เป็นรหัสผ่าน</li>
                    <li>กดปุ่ม "เข้าระบบ"</li>
                </ol>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ชื่อผู้ใช้</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">เลขบัตรประชาชน (เบอร์โทร)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">รหัสผ่าน</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($credentials as $cred)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $cred['name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-mono">{{ $cred['id_number'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-mono">{{ $cred['password'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button data-id="{{ $cred['id_number'] }}" data-password="{{ $cred['password'] }}" 
                                        class="copy-btn text-blue-600 hover:text-blue-900">
                                    คัดลอก
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 text-center space-x-4">
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg inline-block transition-colors">
                    ไปหน้าเข้าสู่ระบบ
                </a>
                <a href="{{ url('/') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg inline-block transition-colors">
                    กลับหน้าหลัก
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.copy-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const idNumber = this.getAttribute('data-id');
                    const password = this.getAttribute('data-password');
                    copyCredentials(idNumber, password);
                });
            });
        });
        
        function copyCredentials(idNumber, password) {
            // Copy to clipboard
            const text = `ID: ${idNumber}\nPassword: ${password}`;
            navigator.clipboard.writeText(text).then(function() {
                alert('คัดลอกข้อมูลการเข้าสู่ระบบแล้ว!');
            }).catch(function() {
                // Fallback for browsers that don't support clipboard API
                const textArea = document.createElement('textarea');
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                alert('คัดลอกข้อมูลการเข้าสู่ระบบแล้ว!');
            });
        }
    </script>
</body>
</html>