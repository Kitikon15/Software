<!-- Image Edit Modal -->
<div id="imageEditModal" class="modal">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
            <h3 class="text-lg font-bold text-gray-900">แก้ไขรูปภาพผู้สมัคร</h3>
        </div>
        <form id="imageEditForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-6 py-6">
                <input type="hidden" id="applicantId" name="applicant_id">
                
                <!-- Current Image Preview -->
                <div class="mb-6 text-center">
                    <label class="block text-sm font-bold text-gray-800 mb-3">รูปภาพปัจจุบัน</label>
                    <div class="profile-image-container mx-auto">
                        <img id="currentImage" src="" alt="Current Profile Image" onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                    </div>
                </div>
                
                <!-- New Image Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-800 mb-3">เลือกรูปภาพใหม่</label>
                    <div class="flex items-center">
                        <input type="file" id="profileImage" name="profile_image" accept="image/*" class="block w-full text-sm text-gray-600
                            file:mr-4 file:py-3 file:px-5
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-purple-50 file:text-purple-700
                            hover:file:bg-gray-200
                            file:cursor-pointer file:transition file:duration-200">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">ไฟล์ JPG, PNG หรือ GIF ขนาดไม่เกิน 2MB</p>
                </div>
                
                <!-- Image Preview -->
                <div class="image-preview mx-auto" id="imagePreview">
                    <img id="previewImage" src="" alt="Preview" class="rounded-full">
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-xl flex justify-end space-x-3">
                <button type="button" onclick="closeImageEditModal()" class="bg-gray-500 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg font-medium transition duration-200 transform hover:scale-105">
                    ยกเลิก
                </button>
                <button type="submit" class="bg-purple-600 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg font-medium transition duration-200 transform hover:scale-105">
                    บันทึก
                </button>
            </div>
        </form>
    </div>
</div>

<script>
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
</script>