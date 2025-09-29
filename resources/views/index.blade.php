
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>วิศวกรรมซอฟต์แวร์ - SCI NPRU</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            line-height: 1.6;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-title img {
            height: 50px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 1.3em;
            font-weight: 600;
            color: #2c3e50;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .right-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .font-size-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9em;
            color: #666;
        }

        .font-size-controls span {
            font-size: 1.2em;
            cursor: pointer;
            padding: 5px 8px;
            border-radius: 4px;
            transition: all 0.3s ease;
            color: #3498db;
        }

        .font-size-controls span:hover {
            background: #3498db;
            color: white;
            transform: scale(1.1);
        }

        .lang-flag {
            font-size: 1.2em;
            padding: 8px 12px;
            background: #e74c3c;
            color: white;
            border-radius: 6px;
            font-weight: bold;
        }

        .apply-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .banner-container {
            text-align: center;
            padding: 30px 20px;
        }

        .banner {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: block;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .banner:hover {
            transform: scale(1.02);
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .content-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .box {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .box h2 {
            margin: 0 0 20px 0;
            font-weight: 700;
            font-size: 1.5em;
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95em;
        }

        .info-table td {
            padding: 12px 8px;
            vertical-align: top;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-table td:first-child {
            width: 140px;
            font-weight: 600;
            color: #34495e;
        }

        .info-table td:last-child {
            color: #555;
        }

        .download-btn {
            margin-top: 25px;
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .career-list {
            list-style: none;
            padding: 0;
        }

        .career-list li {
            padding: 8px 0;
            position: relative;
            padding-left: 25px;
            color: #555;
        }

        .career-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #27ae60;
            font-weight: bold;
        }

        .slider {
            width: 100%;
            max-width: 1200px;
            margin: 40px auto;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .slides {
            display: flex;
            transition: transform 1s ease;
        }

        .slide {
            min-width: 100%;
        }

        .slide img {
            width: 100%;
            display: block;
        }

        .section {
            max-width: 1400px;
            margin: 60px auto;
            padding: 0 20px;
            text-align: center;
        }

        .section h2 {
            font-size: 2em;
            margin-bottom: 40px;
            color: #2c3e50;
            position: relative;
            display: inline-block;
        }

        .section h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .section-alumni {
            max-width: 800px;
            margin: 60px auto;
            padding: 0 20px;
            text-align: center;
        }

        .section h2 {
            font-size: 2em;
            margin-bottom: 40px;
            color: #2c3e50;
            position: relative;
            display: inline-block;
        }

        .section h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .teacher-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .teacher-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .teacher-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .teacher-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 4px solid #3498db;
            transition: all 0.3s ease;
        }

        .teacher-card:hover img {
            transform: scale(1.1);
        }

        .teacher-card p {
            font-size: 0.9em;
            color: #555;
            line-height: 1.5;
        }

        .lab-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .lab-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .lab-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .lab-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .lab-card:hover img {
            transform: scale(1.1);
        }

        .lab-card-content {
            padding: 20px;
        }

        .lab-card h3 {
            font-size: 1em;
            margin: 0;
            color: #2c3e50;
            font-weight: 600;
            line-height: 1.4;
        }

        .video-container {
            position: relative;
            width: 100%;
            max-width: 1500px;
            /* ✅ กำหนดให้ไม่กว้างเกินไป */
            aspect-ratio: 16 / 9;
            /* ✅ แนวนอนมาตรฐาน */
            margin: 40px auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }

            .right-section {
                flex-wrap: wrap;
                justify-content: center;
            }

            .content-row {
                grid-template-columns: 1fr;
            }

            .teacher-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 20px;
            }

            .lab-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .section h2 {
                font-size: 1.5em;
            }

            .video-container iframe {
                height: 250px;
            }
        }

        @media (max-width: 280px) {
            .teacher-grid {
                grid-template-columns: 60px 60px;
            }

            .lab-grid {
                grid-template-columns: 60px 60px;
            }
        }

        footer a:hover {
            transform: scale(1.05);
        }

        footer nav a:hover {
            color: #007bff !important;
        }

        @media (max-width: 768px) {
            footer>div:nth-child(2) {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
            }

            footer>div:nth-child(3) {
                flex-direction: column !important;
                text-align: center !important;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-title">
            <img src="https://sc.npru.ac.th/sc_major/assets/images/app/logo.jpg" alt="SCI NPRU Logo" />
            <div class="title">คณะวิทยาศาสตร์และเทคโนโลยี</div>
        </div>
        <div class="right-section">
            <div class="font-size-controls">
                ขนาดอักษร: <span onclick="adjustFontSize('small')">ก</span><span onclick="adjustFontSize('medium')">ก</span><span onclick="adjustFontSize('large')">ก</span>
            </div>
            <div class="lang-flag">TH</div>
                <a href="{{ url('/admission') }}"
                    style="background-color: #4285f4; color: white; padding: 12px 30px; border-radius: 6px; font-size: 16px; text-decoration: none; display: inline-block; transition: background-color 0.3s ease;">
                    สมัครเรียน
                </a>
                <a href="{{ route('admin.login') }}"
                    style="background-color: #dc3545; color: white; padding: 12px 20px; border-radius: 6px; font-size: 14px; text-decoration: none; display: inline-block; transition: background-color 0.3s ease;">
                    Admin
                </a>
            </button>
        </div>
    </div>

    <div class="banner-container">
        <a href="https://pgm.npru.ac.th/se" target="_blank" rel="noopener noreferrer">
            <img src="https://sc.npru.ac.th/sc_major/assets/images/major_cover/1693382011_2c0ee9d91d20a0202d5f.jpg" alt="วิศวกรรมซอฟต์แวร์" class="banner" />
        </a>
    </div>

    <div class="content-wrapper">
        <div class="content-row">
            <div class="box">
                <h2><i class="fas fa-info-circle"></i> ข้อมูลทั่วไป</h2>
                <table class="info-table">
                    <tr>
                        <td>ชื่อปริญญา</td>
                        <td>วิทยาศาสตรบัณฑิต (วิศวกรรมซอฟต์แวร์) วท.บ.</td>
                    </tr>
                    <tr>
                        <td>ชื่อปริญญาอังกฤษ</td>
                        <td>Bachelor of Science (Software Engineering) B.Sc.</td>
                    </tr>
                    <tr>
                        <td>วิชาเอก</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>รูปแบบหลักสูตร</td>
                        <td>ระดับปริญญาตรี หลักสูตร 4 ปี</td>
                    </tr>
                    <tr>
                        <td>หน่วยกิต</td>
                        <td>ไม่น้อยกว่า 128 หน่วยกิต</td>
                    </tr>
                    <tr>
                        <td>ภาษาที่ใช้</td>
                        <td>ไทย/Thai/泰สุ (Tàiyǔ)</td>
                    </tr>
                    <tr>
                        <td>ค่าเรียน</td>
                        <td>11,400 บาท/เทอม</td>
                    </tr>
                    <tr>
                        <td>เพิ่มเติม</td>
                        <td>หลักสูตรปรับปรุง พ.ศ.2564</td>
                    </tr>
                </table>
                <a href="#" class="download-btn">
                    <i class="fas fa-download"></i> ดาวน์โหลดรายละเอียด
                </a>
            </div>

            <div class="box">
                <h2><i class="fas fa-briefcase"></i> อาชีพหลังสำเร็จการศึกษา</h2>
                <ul class="career-list">
                    <li>เจ้าหน้าที่ตรวจสอบคุณภาพซอฟต์แวร์</li>
                    <li>โปรแกรมเมอร์</li>
                    <li>วิศวกรซอฟต์แวร์</li>
                    <li>นักทดสอบระบบ</li>
                </ul>
            </div>
        </div>

        <div class="slider">
            <div class="slides">
                <div class="slide">
                    <a href="https://pgm.npru.ac.th/se" target="_blank">
                        <img src="https://sc.npru.ac.th/sc_major/assets/images/major_banner/1706695485_b727e1eb5ce5b9663f9d.jpg" alt="slide 1" />
                    </a>
                </div>
                <div class="slide">
                    <a href="https://pgm.npru.ac.th/se" target="_blank">
                        <img src="https://sc.npru.ac.th/sc_major/assets/images/major_banner/1716485181_0bfa33ce1d136a430a0a.png" alt="slide 2" />
                    </a>
                </div>
                <div class="slide">
                    <a href="https://pgm.npru.ac.th/se" target="_blank">
                        <img src="https://sc.npru.ac.th/sc_major/assets/images/major_banner/1706669700_7778ac4e41f62ef3b31c.jpg" alt="slide 3" />
                    </a>
                </div>
            </div>
        </div>

        <div class="section">
            <h2><i class="fas fa-chalkboard-teacher"></i> อาจารย์ประจำหลักสูตร</h2>
            <div class="teacher-grid">
                <div class="teacher-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/lecturer/1706694016_43d4f45dca2d4f9011a4.jpg" alt="ผศ.ดร.อุษณีย์ ภักดีศระกุลวงศ์" />
                    <p><strong>ผศ.ดร.อุษณีย์ ภักดีศระกุลวงศ์</strong><br>ประธาน สาขาวิชา</p>
                </div>
                <div class="teacher-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/lecturer/1706693986_c5a3e8541b6f087048fa.jpg" alt="ผศ.ดร. วรเชษฐ์ อุทิassa" />
                    <p><strong>ผศ.ดร. วรเชษฐ์ อุทิassa</strong><br>รองประธานสาขา (ประธานสาขา)</p>
                </div>
                <div class="teacher-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/lecturer/1706694064_e094c4d933ac0ed7cd03.jpg" alt="ผศ.สมเกียรติ ซ่อนเหลื่อม" />
                    <p><strong>ผศ.สมเกียรติ ซ่อนเหลื่อม</strong><br>รองประธานฯ ฝ่ายนโยบายและแผน</p>
                </div>
                <div class="teacher-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/lecturer/1716485261_38d6e57b8d63fe377d25.jpg" alt="ผศ.นฤพล สุวรรณวิจิตร" />
                    <p><strong>ผศ.นฤพล สุวรรณวิจิตร</strong><br>รองประธานฯ ฝ่ายประกันคุณภาพฯ</p>
                </div>
                <div class="teacher-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/lecturer/1706694139_d6a2ba899f7470f5fd45.png" alt="อาจารย์ ดร.สุพิลาภ์ จันทร์เรือง" />
                    <p><strong>อาจารย์ ดร.สุพิลาภ์ จันทร์เรือง</strong><br>รองประธานฯ ฝ่ายกิจการนักศึกษา</p>
                </div>
            </div>

            <h2><i class="fas fa-user-tie"></i> อาจารย์พิเศษและนักวิจัย</h2>
            <div class="teacher-grid">
                <div class="teacher-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/lecturer/1706697016_17296e0d4cca0c92558f.jpg" alt="อาจารย์สมหมาย กรังพานิช" />
                    <p><strong>อาจารย์สมหมาย กรังพานิช</strong><br>กรรมการผู้จัดการ บริษัท ที เอ็น ที โซลูชั่น จำกัด</p>
                </div>
            </div>
        </div>

        <div class="section">
            <h2><i class="fas fa-flask"></i> ห้องปฏิบัติการ</h2>
            <div class="lab-grid">
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/laboratory/1706695830_4cfc50904539177efe52.jpg" alt="อาคารปฏิบัติการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏนครปฐม" />
                    <div class="lab-card-content">
                        <h3>อาคารปฏิบัติการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏนครปฐม</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/laboratory/1706696144_9c9da38b4de6b2f98859.jpg" alt="ห้องปฏิบัติการคอมพิวเตอร์ C408" />
                    <div class="lab-card-content">
                        <h3>ห้องปฏิบัติการคอมพิวเตอร์ C408</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/laboratory/1706696156_5feb9ba120f4489dd75b.jpg" alt="ห้องปฏิบัติการคอมพิวเตอร์ C409" />
                    <div class="lab-card-content">
                        <h3>ห้องปฏิบัติการคอมพิวเตอร์ C409</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/laboratory/1706696068_17458c1c1b0af86cf5b1.jpg" alt="อาคารปฏิบัติการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏนครปฐม" />
                    <div class="lab-card-content">
                        <h3>อาคารปฏิบัติการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏนครปฐม</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2><i class="fas fa-video"></i> วิดีโอแนะนำสาขา</h2>
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/jXyZb58_eMo" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>

        <div class="section">
            <h2><i class="fas fa-star"></i> กิจกรรมเด่น</h2>
            <div class="lab-grid">
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/activity/1717372516_c7f4c286dd3fea87e017.jpg" alt="พักผ่อนหย่อนใจ" />
                    <div class="lab-card-content">
                        <h3>พักผ่อนหย่อนใจ</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/activity/1717372783_1bebfdb263427d406bf4.jpg" alt="ทานไอติมคลายร้อน" />
                    <div class="lab-card-content">
                        <h3>ทานไอติมคลายร้อน</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/activity/1718085446_fe7aac7f8c0b2b2a7dcb.jpg" alt="ตรวจประกันคุณภาพการศึกษาภายใน ระดับหลักสูตร 2566" />
                    <div class="lab-card-content">
                        <h3>ตรวจประกันคุณภาพการศึกษาภายใน ระดับหลักสูตร 2566</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/activity/1718085289_aad2e4743b4d5a1323d8.jpg" alt="เตรียมความพร้อม 2567" />
                    <div class="lab-card-content">
                        <h3>เตรียมความพร้อม 2567</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2><i class="fas fa-trophy"></i> ผลงานนักศึกษา</h2>
            <div class="lab-grid">
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/working/1706703910_f7b7ef037305b57dec1a.png" alt="เอกชัย และศักดิ์กริน 2565" />
                    <div class="lab-card-content">
                        <h3>เอกชัย และศักดิ์กริน 2565</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/working/1706695980_b1a0de835162fffb433f.jpg" alt="งานประชุมวิชาการระดับชาติ ครั้งที่ 15 มหาวิยทาลัยราชภัฏนครปฐม" />
                    <div class="lab-card-content">
                        <h3>งานประชุมวิชาการระดับชาติ ครั้งที่ 15 มหาวิยทาลัยราชภัฏนครปฐม</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/working/1706703942_7bb521a333709de8a562.png" alt="นับเนยและกฤษณะ 2566" />
                    <div class="lab-card-content">
                        <h3>นับเนยและกฤษณะ 2566</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/working/1706703920_10cfa7f0e24d4277853b.png" alt="ดาวปี 2563" />
                    <div class="lab-card-content">
                        <h3>ดาวปี 2563</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-alumni">
            <h2><i class="fas fa-users"></i> ศิษย์เก่า</h2>
            <div class="lab-grid">
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/activity/1718085646_22810071087faddb8e90.png" alt="วิทยากรโครงการเสริมสร้างสมรรถนะนักเรียนที่มีศักยภาพปฏิบัติดีด้านวิศวกรรมซอฟต์แวร์ กิจกรรมที่ 4 อบรมขั้นที่ 1-4 การ" />
                    <div class="lab-card-content">
                        <h3>วิทยากรโครงการเสริมสร้างสมรรถนะนักเรียนที่มีศักยภาพปฏิบัติดี</h3>
                    </div>
                </div>
                <div class="lab-card">
                    <img src="https://sc.npru.ac.th/sc_major/assets/images/activity/1706696727_979a1db33b2534678fe5.jpg" alt="ศิษย์เก่าเข้าร่วมโครงการปฐมนิเทศ" />
                    <div class="lab-card-content">
                        <h3>ศิษย์เก่าเข้าร่วมโครงการปฐมนิเทศ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; margin-top: 60px;">
        <div style="background-color: #e9ecef; padding: 30px 0; text-align: center;">
            <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                <a href="#" style="width: 60px; height: 60px; border-radius: 50%; background-color: #4267B2; display: flex; align-items: center; justify-content: center; text-decoration: none; color: white; font-size: 24px; transition: transform 0.3s ease;">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" style="width: 60px; height: 60px; border-radius: 50%; background-color: #FF0000; display: flex; align-items: center; justify-content: center; text-decoration: none; color: white; font-size: 24px; transition: transform 0.3s ease;">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" style="width: 60px; height: 60px; border-radius: 50%; background-color: #333; display: flex; align-items: center; justify-content: center; text-decoration: none; color: white; font-size: 24px; transition: transform 0.3s ease;">
                    <i class="fab fa-github"></i>
                </a>
                <a href="#" style="width: 60px; height: 60px; border-radius: 50%; background-color: #17a2b8; display: flex; align-items: center; justify-content: center; text-decoration: none; color: white; font-size: 24px; transition: transform 0.3s ease;">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>
        <div style="max-width: 1400px; margin: 0 auto; padding: 40px 20px; display: grid; grid-template-columns: 250px 1fr; gap: 40px; align-items: start;">
            <div>
                <nav style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="#" style="display: flex; align-items: center; color: #6c757d; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.05); transition: color 0.3s ease;">
                        <span style="color: #007bff; margin-right: 8px;">◆</span> หน้าหลัก
                    </a>
                    <a href="#" style="display: flex; align-items: center; color: #6c757d; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.05); transition: color 0.3s ease;">
                        <span style="color: #007bff; margin-right: 8px;">◆</span> เว็บไซต์คณะ
                    </a>
                    <a href="#" style="display: flex; align-items: center; color: #6c757d; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.05); transition: color 0.3s ease;">
                        <span style="color: #007bff; margin-right: 8px;">◆</span> เว็บไซต์มหาวิทยาลัย
                    </a>
                    <a href="#" style="display: flex; align-items: center; color: #6c757d; text-decoration: none; font-size: 14px; padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.05); transition: color 0.3s ease;">
                        <span style="color: #007bff; margin-right: 8px;">◆</span> ส่วนอำนวยการระบบ
                    </a>
                </nav>
            </div>
            <div style="text-align: center; padding: 60px 20px;">
                <h2 style="font-size: 24px; color: #333; margin-bottom: 15px; font-weight: normal;">
                    มุ่งสู่อนาคตของชุมชน...
                </h2>
                <p style="color: #6c757d; margin-bottom: 30px; font-size: 16px;">
                    เลือกสาขาที่ชอบ สำนวยชีวิตใช่
                </p>
                <a href="{{ url('/admission') }}"
                    style="background-color: #4285f4; color: white; padding: 12px 30px; border-radius: 6px; font-size: 16px; text-decoration: none; display: inline-block; transition: background-color 0.3s ease;">
                    สมัครเรียน
                </a>
            </div>

            <!-- Copyright Footer -->
            <div style="background-color: white; padding: 20px; border-top: 1px solid #e9ecef; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <div style="font-size: 12px; color: #6c757d;">
                    © 2024 Faculty of Science and Technology ◆ Nakhon Pathom Rajabhat University<br>
                    Powered by Shaoransoft Developer
                </div>
                <div style="display: flex; gap: 8px;">
                    <a href="#" style="width: 24px; height: 24px; background-color: #4267B2; border-radius: 3px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-size: 12px;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" style="width: 24px; height: 24px; background-color: #333; border-radius: 3px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-size: 12px;">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
    </footer>

    <script>
        let currentIndex = 0;
        const slides = document.querySelector('.slides');
        const totalSlides = document.querySelectorAll('.slide').length;

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            slides.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        function adjustFontSize(size) {
            const body = document.body;
            body.classList.remove('font-small', 'font-medium', 'font-large');

            switch (size) {
                case 'small':
                    body.style.fontSize = '14px';
                    break;
                case 'medium':
                    body.style.fontSize = '16px';
                    break;
                case 'large':
                    body.style.fontSize = '18px';
                    break;
            }
        }

        // Auto-slide functionality
        setInterval(nextSlide, 4000);

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
