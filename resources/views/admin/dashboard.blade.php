<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - ระบบงานรับสมัคร</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .sidebar.collapsed .logo-text {
            display: none;
        }
        .sidebar.collapsed .sidebar-item span {
            display: none;
        }
        .main-content {
            transition: all 0.3s ease;
        }
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
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        .profile-image-container {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
        }
        .profile-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar bg-gray-800 text-white w-64 flex-shrink-0">
            <div class="p-4 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <img src="https://www.npru.ac.th/2019/img/Npru-logo.png" alt="NPRU Logo" class="h-10 w-auto">
                    <span class="logo-text font-bold text-lg">Admin Panel</span>
                </div>
            </div>
            <nav class="p-4">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg bg-purple-600 hover:bg-gray-800 text-white mb-2">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="sidebar-text">แดชบอร์ด</span>
                </a>
                <a href="{{ route('admin') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 mb-2">
                    <i class="fas fa-users"></i>
                    <span class="sidebar-text">จัดการผู้สมัคร</span>
                </a>
                <a href="{{ route('admin.applicant.create') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 mb-2">
                    <i class="fas fa-user-plus"></i>
                    <span class="sidebar-text">เพิ่มผู้สมัคร</span>
                </a>
                <a href="{{ route('admin.export') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 mb-2">
                    <i class="fas fa-download"></i>
                    <span class="sidebar-text">Export ข้อมูล</span>
                </a>
                <a href="{{ url('/') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700">
                    <i class="fas fa-home"></i>
                    <span class="sidebar-text">หน้าหลัก</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="container mx-auto px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button id="toggleSidebar" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-xl font-bold text-gray-900">แดชบอร์ดผู้ดูแลระบบ</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.applicant.create') }}" class="bg-purple-600 hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center transition duration-200 ease-in-out transform hover:scale-105">
                            <i class="fas fa-user-plus mr-2"></i> เพิ่มผู้สมัคร
                        </a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 flex items-center">
                                <i class="fas fa-sign-out-alt mr-1"></i> ออกจากระบบ
                            </button>
                        </form>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">ผู้ดูแลระบบ</p>
                            <p class="text-xs text-gray-500">เข้าสู่ระบบแล้ว</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                            A
                        </div>
                    </div>
                </div>
            </header>

            <!-- Hidden data elements for JavaScript -->
            <div id="chart-data" style="display: none;">
                <span id="daily-labels" data-value="{{ json_encode($dailyApplicants['labels']) }}"></span>
                <span id="daily-data" data-value="{{ json_encode($dailyApplicants['data']) }}"></span>
                <span id="monthly-labels" data-value="{{ json_encode($monthlyApplicants['labels']) }}"></span>
                <span id="monthly-data" data-value="{{ json_encode($monthlyApplicants['data']) }}"></span>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto p-6">
                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    </div>
                @endif

                <!-- Dashboard Overview -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">สถิติโดยรวม</h2>
                    
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                    <i class="fas fa-users text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">ผู้สมัครทั้งหมด</h3>
                                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_applicants'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600">
                                    <i class="fas fa-user-plus text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">สมัครใหม่ (7 วัน)</h3>
                                    <p class="text-3xl font-bold text-green-600">{{ $stats['recent_applicants'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                    <i class="fas fa-file-alt text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">โพสต์ทั้งหมด</h3>
                                    <p class="text-3xl font-bold text-purple-600">{{ $stats['total_posts'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                    <i class="fas fa-chart-line text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">อัตราการเติบโต</h3>
                                    <p class="text-3xl font-bold text-yellow-600">
                                        @if($stats['total_applicants'] > 0)
                                            {{ round(($stats['recent_applicants'] / $stats['total_applicants']) * 100, 1) }}%
                                        @else
                                            0%
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <!-- Applicants by Day Chart -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">ผู้สมัครในช่วง 7 วันที่ผ่านมา</h3>
                            <div class="chart-container">
                                <canvas id="applicantsChart"></canvas>
                            </div>
                        </div>

                        <!-- Applicants by Month Chart -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">ผู้สมัครในแต่ละเดือน</h3>
                            <div class="chart-container">
                                <canvas id="monthlyChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">กิจกรรมล่าสุด</h3>
                        </div>
                        <div class="p-6">
                            @if($recentApplicants->count() > 0)
                                <div class="space-y-4">
                                    @foreach($recentApplicants as $applicant)
                                        <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                                            <div class="flex-shrink-0">
                                                @if($applicant->profile_image)
                                                    <div class="profile-image-container">
                                                        <img src="{{ asset('storage/profile_images/' . $applicant->profile_image) }}" alt="{{ $applicant->name }}">
                                                    </div>
                                                @else
                                                    <div class="profile-image-container">
                                                        <i class="fas fa-user text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $applicant->name }}</h4>
                                                <p class="text-sm text-gray-500">{{ $applicant->email }}</p>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $applicant->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-user-clock text-4xl text-gray-300 mb-2"></i>
                                    <p class="text-gray-500">ยังไม่มีกิจกรรมล่าสุด</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        // Get chart data from hidden elements
        var dailyLabels = JSON.parse(document.getElementById('daily-labels').getAttribute('data-value'));
        var dailyData = JSON.parse(document.getElementById('daily-data').getAttribute('data-value'));
        var monthlyLabels = JSON.parse(document.getElementById('monthly-labels').getAttribute('data-value'));
        var monthlyData = JSON.parse(document.getElementById('monthly-data').getAttribute('data-value'));
        
        // Daily Applicants Chart
        const ctx1 = document.getElementById('applicantsChart').getContext('2d');
        const applicantsChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: 'จำนวนผู้สมัคร',
                    data: dailyData,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Monthly Applicants Chart
        const ctx2 = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'จำนวนผู้สมัคร',
                    data: monthlyData,
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgb(16, 185, 129)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
