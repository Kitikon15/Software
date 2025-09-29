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
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
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
        .large-profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            border: 2px dashed #d1d5db;
            margin: 0 auto 15px;
        }
        .large-profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .image-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            display: none;
            margin: 10px auto;
        }
        .image-preview img {
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
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 mb-2">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="sidebar-text">แดชบอร์ด</span>
                </a>
                <a href="{{ route('admin') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg bg-purple-600 hover:bg-gray-800 text-white mb-2">
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
                        <h1 class="text-xl font-bold text-gray-900">จัดการผู้สมัคร</h1>
                    </div>
                    <div class="flex items-center space-x-4">
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

                <!-- Applicants Management -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900">
                            <i class="fas fa-users mr-2"></i>รายชื่อผู้สมัคร
                        </h2>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.applicant.create') }}" class="bg-purple-600 hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center transition duration-200 ease-in-out transform hover:scale-105">
                                <i class="fas fa-plus-circle mr-2"></i> เพิ่มผู้สมัคร
                            </a>
                            <a href="{{ route('admin.export') }}" class="bg-purple-600 hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center transition duration-200 ease-in-out transform hover:scale-105">
                                <i class="fas fa-download mr-2"></i> Export CSV
                            </a>
                            <button onclick="refreshData()" class="bg-purple-600 hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center transition duration-200 ease-in-out transform hover:scale-105">
                                <i class="fas fa-sync-alt mr-2"></i> รีเฟรช
                            </button>
                        </div>
                    </div>

                    @if($applicants->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">รูปภาพ</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ชื่อ</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">อีเมล</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">เบอร์โทร</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">วันเกิด</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">วันที่สมัคร</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($applicants as $applicant)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($applicant->profile_image)
                                                    <div class="profile-image-container">
                                                        <img src="{{ asset('storage/profile_images/' . $applicant->profile_image) }}" alt="{{ $applicant->name }}">
                                                    </div>
                                                @else
                                                    <div class="profile-image-container">
                                                        <i class="fas fa-user text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $applicant->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $applicant->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $applicant->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $applicant->phone }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($applicant->birth_date)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $applicant->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                                <button data-applicant-id="{{ $applicant->id }}" 
                                                        class="view-btn bg-purple-100 hover:bg-gray-800 text-purple-700 hover:text-white px-3 py-1 rounded-lg text-sm font-medium flex items-center transition duration-200 ease-in-out transform hover:scale-105">
                                                    <i class="fas fa-eye mr-1"></i> ดู
                                                </button>
                                                <a href="{{ route('admin.applicant.edit', $applicant->id) }}" 
                                                   class="bg-purple-100 hover:bg-gray-800 text-purple-700 hover:text-white px-3 py-1 rounded-lg text-sm font-medium flex items-center transition duration-200 ease-in-out transform hover:scale-105">
                                                    <i class="fas fa-edit mr-1"></i> แก้ไข
                                                </a>
                                                <button data-applicant-id="{{ $applicant->id }}" 
                                                        data-applicant-name="{{ $applicant->name }}"
                                                        class="edit-image-btn bg-purple-100 hover:bg-gray-800 text-purple-700 hover:text-white px-3 py-1 rounded-lg text-sm font-medium flex items-center transition duration-200 ease-in-out transform hover:scale-105">
                                                    <i class="fas fa-image mr-1"></i> แก้ไขรูป
                                                </button>
                                                <button data-applicant-id="{{ $applicant->id }}" 
                                                        data-applicant-name="{{ $applicant->name }}"
                                                        class="delete-btn bg-purple-100 hover:bg-gray-800 text-purple-700 hover:text-white px-3 py-1 rounded-lg text-sm font-medium flex items-center transition duration-200 ease-in-out transform hover:scale-105">
                                                    <i class="fas fa-trash mr-1"></i> ลบ
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $applicants->links() }}
                        </div>
                    @else
                        <div class="px-6 py-12 text-center">
                            <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">ยังไม่มีผู้สมัคร</h3>
                            <p class="text-gray-500">เมื่อมีผู้สมัครใหม่ ข้อมูลจะแสดงที่นี่</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- View Applicant Modal -->
    <div id="viewModal" class="modal">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">ข้อมูลผู้สมัคร</h3>
            </div>
            <div id="modalContent" class="px-6 py-4">
                <!-- Content will be loaded here -->
            </div>
            <div class="px-6 py-4 border-t border-gray-200 text-right">
                <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">
                    ปิด
                </button>
            </div>
        </div>
    </div>

    <!-- Image Edit Modal -->
    <div id="imageEditModal" class="modal">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">แก้ไขรูปภาพผู้สมัคร</h3>
            </div>
            <form id="imageEditForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="px-6 py-4">
                    <input type="hidden" id="applicantId" name="applicant_id">
                    
                    <!-- Current Image Preview -->
                    <div class="mb-4 text-center">
                        <label class="block text-sm font-medium text-gray-700 mb-2">รูปภาพปัจจุบัน</label>
                        <div class="large-profile-image">
                            <img id="currentImage" src="" alt="Current Profile Image" onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                        </div>
                    </div>
                    
                    <!-- New Image Upload -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">เลือกรูปภาพใหม่</label>
                        <div class="flex items-center">
                            <input type="file" id="profileImage" name="profile_image" accept="image/*" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">ไฟล์ JPG, PNG หรือ GIF ขนาดไม่เกิน 2MB</p>
                    </div>
                    
                    <!-- Image Preview -->
                    <div class="image-preview" id="imagePreview">
                        <img id="previewImage" src="" alt="Preview">
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-2">
                    <button type="button" onclick="closeImageEditModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">
                        ยกเลิก
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                        บันทึก
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-red-600">ยืนยันการลบ</h3>
            </div>
            <div class="px-6 py-4">
                <p class="text-gray-700">คุณต้องการลบข้อมูลของ <strong id="deleteApplicantName"></strong> หรือไม่?</p>
                <p class="text-sm text-red-600 mt-2">การลบนี้ไม่สามารถย้อนกลับได้</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-2">
                <button onclick="closeDeleteModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">
                    ยกเลิก
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                        ลบ
                    </button>
                </form>
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
        
        // Handle image preview
        document.getElementById('profileImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Handle form submission
        document.getElementById('imageEditForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const applicantId = document.getElementById('applicantId').value;
            
            fetch(`/admin/applicant/${applicantId}/update-image`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('เกิดข้อผิดพลาดในการอัปเดตรูปภาพ');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการอัปเดตรูปภาพ');
            });
        });

        // Event listeners for view and delete buttons
        document.addEventListener('DOMContentLoaded', function() {
            // View applicant buttons
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-applicant-id');
                    viewApplicant(id);
                });
            });

            // Edit image buttons
            document.querySelectorAll('.edit-image-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-applicant-id');
                    const name = this.getAttribute('data-applicant-name');
                    editApplicantImage(id, name);
                });
            });

            // Delete applicant buttons
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-applicant-id');
                    const name = this.getAttribute('data-applicant-name');
                    deleteApplicant(id, name);
                });
            });
        });

        function viewApplicant(id) {
            fetch(`/admin/applicant/${id}`)
                .then(response => response.json())
                .then(data => {
                    let imageHtml = '';
                    if (data.profile_image) {
                        imageHtml = `<div class="large-profile-image mb-3">
                                        <img src="/storage/profile_images/${data.profile_image}" alt="${data.name}" onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                                     </div>`;
                    } else {
                        imageHtml = `<div class="large-profile-image mb-3">
                                        <i class="fas fa-user text-gray-400 text-3xl"></i>
                                     </div>`;
                    }
                    
                    document.getElementById('modalContent').innerHTML = `
                        <div class="space-y-3">
                            ${imageHtml}
                            <div><strong>ID:</strong> ${data.id}</div>
                            <div><strong>ชื่อ:</strong> ${data.name}</div>
                            <div><strong>อีเมล:</strong> ${data.email}</div>
                            <div><strong>เบอร์โทร:</strong> ${data.phone}</div>
                            <div><strong>วันเกิด:</strong> ${new Date(data.birth_date).toLocaleDateString('th-TH')}</div>
                            <div><strong>วันที่สมัคร:</strong> ${new Date(data.created_at).toLocaleDateString('th-TH')} ${new Date(data.created_at).toLocaleTimeString('th-TH')}</div>
                        </div>
                    `;
                    document.getElementById('viewModal').classList.add('show');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
                });
        }

        function editApplicantImage(id, name) {
            document.getElementById('applicantId').value = id;
            document.getElementById('imageEditForm').action = `/admin/applicant/${id}/update-image`;
            
            // Set current image
            fetch(`/admin/applicant/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.profile_image) {
                        document.getElementById('currentImage').src = `/storage/profile_images/${data.profile_image}`;
                    } else {
                        document.getElementById('currentImage').src = 'https://via.placeholder.com/100x100?text=No+Image';
                    }
                });
            
            // Clear preview
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('profileImage').value = '';
            
            document.getElementById('imageEditModal').classList.add('show');
        }

        function deleteApplicant(id, name) {
            document.getElementById('deleteApplicantName').textContent = name;
            document.getElementById('deleteForm').action = `/admin/applicant/${id}`;
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('viewModal').classList.remove('show');
        }

        function closeImageEditModal() {
            document.getElementById('imageEditModal').classList.remove('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
        }

        function refreshData() {
            window.location.reload();
        }

        // Close modals when clicking outside
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('show');
            }
        });
    </script>
</body>
</html>