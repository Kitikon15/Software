<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การสมัครสำเร็จ</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-b from-teal-400 to-teal-500 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-3xl font-bold text-green-600 mb-4">สมัครเรียบร้อยแล้ว!</h1>
        <p class="text-gray-700 mb-6">ขอบคุณที่ให้ความสนใจ เราได้รับข้อมูลการสมัครของคุณแล้ว</p>
        <a href="{{ url('/') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            กลับหน้าแรก
        </a>
    </div>
</body>
</html>