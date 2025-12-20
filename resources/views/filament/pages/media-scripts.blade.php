@push('scripts')
<script>
    let currentImagePath = '';

    function openImageModal(imagePath) {
        currentImagePath = imagePath;
        document.getElementById('modalImage').src = imagePath;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    function copyImagePath() {
        navigator.clipboard.writeText(currentImagePath).then(() => {
            alert('Image path copied to clipboard!');
        });
    }

    function deleteImage() {
        if (confirm('Are you sure you want to delete this image?')) {
            fetch('{{ route("delete-image") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    imagePath: currentImagePath
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Image deleted successfully!');
                    closeImageModal();
                    location.reload();
                } else {
                    alert('Error deleting image: ' + data.message);
                }
            })
            .catch(error => {
                alert('Error deleting image: ' + error);
            });
        }
    }

    function openUploadModal() {
        document.getElementById('uploadModal').classList.remove('hidden');
    }

    function closeUploadModal() {
        document.getElementById('uploadModal').classList.add('hidden');
        document.getElementById('fileInput').value = '';
        document.getElementById('uploadProgress').classList.add('hidden');
    }

    function handleFileSelect(e) {
        const files = e.target.files;
        const uploadButton = document.getElementById('uploadButton');
        const selectedFilesDiv = document.getElementById('selectedFiles');
        
        if (files.length === 0) {
            uploadButton.disabled = true;
            selectedFilesDiv.innerHTML = '';
            return;
        }

        uploadButton.disabled = false;
        
        // Display selected files
        let filesHTML = '<div class="bg-gray-50 p-3 rounded-lg"><p class="font-semibold text-sm mb-2">Selected Files:</p>';
        let totalSize = 0;
        
        for (let i = 0; i < files.length; i++) {
            const size = (files[i].size / 1024 / 1024).toFixed(2);
            totalSize += files[i].size;
            filesHTML += `<div class="flex items-center justify-between text-sm py-1">
                <span class="text-gray-700">${files[i].name}</span>
                <span class="text-gray-500">${size} MB</span>
            </div>`;
        }
        
        filesHTML += `<div class="mt-2 pt-2 border-t border-gray-200">
            <span class="text-sm font-semibold">Total: ${(totalSize / 1024 / 1024).toFixed(2)} MB (${files.length} file${files.length > 1 ? 's' : ''})</span>
        </div></div>`;
        
        selectedFilesDiv.innerHTML = filesHTML;
    }

    function uploadMedia() {
        const fileInput = document.getElementById('fileInput');
        const files = fileInput.files;

        if (files.length === 0) {
            alert('Please select at least one file');
            return;
        }

        const formData = new FormData();
        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        document.getElementById('uploadProgress').classList.remove('hidden');
        document.getElementById('uploadButton').disabled = true;

        const xhr = new XMLHttpRequest();

        // Track upload progress
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                document.getElementById('progressBar').style.width = percentComplete + '%';
                document.getElementById('progressText').textContent = Math.round(percentComplete) + '%';
            }
        });

        xhr.addEventListener('load', function() {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                if (data.success) {
                    document.getElementById('progressBar').style.width = '100%';
                    document.getElementById('progressText').textContent = '100%';
                    setTimeout(() => {
                        alert('Images uploaded successfully!');
                        closeUploadModal();
                        location.reload();
                    }, 500);
                } else {
                    alert('Error uploading images: ' + data.message);
                    document.getElementById('uploadProgress').classList.add('hidden');
                    document.getElementById('uploadButton').disabled = false;
                }
            } else {
                alert('Error uploading images');
                document.getElementById('uploadProgress').classList.add('hidden');
                document.getElementById('uploadButton').disabled = false;
            }
        });

        xhr.addEventListener('error', function() {
            alert('Error uploading images');
            document.getElementById('uploadProgress').classList.add('hidden');
            document.getElementById('uploadButton').disabled = false;
        });

        xhr.open('POST', '{{ route("upload-media") }}');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.send(formData);
    }

    // Close modal when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        const imageModal = document.getElementById('imageModal');
        const uploadModal = document.getElementById('uploadModal');
        
        if (imageModal) {
            imageModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeImageModal();
                }
            });
        }
        
        if (uploadModal) {
            uploadModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeUploadModal();
                }
            });
        }
    });
</script>
@endpush
