let currentStep = 1;
        
// Initialize - Set step 1 as active on page load
document.addEventListener('DOMContentLoaded', function() {
    updateProgress(1);
});

// Next Step Function
function nextStep(step) {
    // Validate current step
    if (!validateStep(currentStep)) {
        return;
    }
    
    // Hide current step
    document.getElementById(`step-${currentStep}`).classList.add('hidden');
    
    // Show next step
    document.getElementById(`step-${step}`).classList.remove('hidden');
    
    // Update progress indicators
    updateProgress(step);
    
    // If step 4, populate summary
    if (step === 4) {
        populateSummary();
    }
    
    currentStep = step;
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Previous Step Function
function prevStep(step) {
    // Hide current step
    document.getElementById(`step-${currentStep}`).classList.add('hidden');
    
    // Show previous step
    document.getElementById(`step-${step}`).classList.remove('hidden');
    
    updateProgress(step);
    currentStep = step;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Update Progress Indicators
function updateProgress(step) {
    for (let i = 1; i <= 4; i++) {
        const indicator = document.getElementById(`step-${i}-indicator`);
        const text = document.getElementById(`step-${i}-text`);
        const line = document.getElementById(`line-${i}`);
        
        if (i <= step) {
            // Step yang aktif atau sudah selesai (hijau)
            indicator.classList.remove('bg-gray-300', 'text-gray-600');
            indicator.classList.add('bg-primary', 'text-white');
            
            // Jika step sebelumnya, kasih checkmark
            if (i < step) {
                indicator.innerHTML = '<i class="fas fa-check"></i>';
            } else {
                // Jika step aktif, tampilkan nomor
                indicator.textContent = i;
            }
            
            if (text) {
                text.classList.remove('text-gray-400');
                text.classList.add('text-primary');
            }
            
            if (line) {
                line.classList.remove('bg-gray-300');
                line.classList.add('bg-primary');
            }
        } else {
            indicator.classList.remove('bg-primary', 'text-white');
            indicator.classList.add('bg-gray-300', 'text-gray-600');
            indicator.textContent = i;
            if (text) {
                text.classList.remove('text-primary');
                text.classList.add('text-gray-400');
            }
            if (line) {
                line.classList.remove('bg-primary');
                line.classList.add('bg-gray-300');
            }
        }
    }
}

// Validate Step
function validateStep(step) {
    const stepElement = document.getElementById(`step-${step}`);
    const inputs = stepElement.querySelectorAll('input[required], select[required], textarea[required]');
    
    for (let input of inputs) {
        if (!input.value) {
            input.classList.add('border-red-500');
            input.focus();
            showAlert('error', 'Mohon lengkapi semua field yang wajib diisi!');
            return false;
        }
        input.classList.remove('border-red-500');
    }
    
    // Validate NIK (16 digits)
    if (step === 1) {
        //
    }
    
    if (step === 2) {
        const nikAyah = document.getElementById('nik_ayah').value;
        const nikIbu = document.getElementById('nik_ibu').value;
        if (nikAyah.length !== 16) {
            showAlert('error', 'NIK Ayah harus 16 digit!');
            return false;
        }
        if (nikIbu.length !== 16) {
            showAlert('error', 'NIK Ibu harus 16 digit!');
            return false;
        }
    }
    
    return true;
}

// Populate Summary
function populateSummary() {
    // Data Diri
    const dataDiri = `
        <div><strong>Nama:</strong> ${document.getElementById('nama_lengkap').value}</div>
        <div><strong>Tempat Lahir:</strong> ${document.getElementById('tempat_lahir').value}</div>
        <div><strong>Tanggal Lahir:</strong> ${formatDate(document.getElementById('tanggal_lahir').value)}</div>
        <div><strong>Jenis Kelamin:</strong> ${document.getElementById('jenis_kelamin').value === 'L' ? 'Laki-laki' : 'Perempuan'}</div>
        <div><strong>Agama:</strong> ${document.getElementById('agama').value}</div>
        <div><strong>No. HP:</strong> ${document.getElementById('no_hp').value}</div>
        <div><strong>Email:</strong> ${document.getElementById('email').value}</div>
        <div><strong>Asal Sekolah:</strong> ${document.getElementById('asal_sekolah').value}</div>
        <div class="md:col-span-2"><strong>Alamat:</strong> ${document.getElementById('alamat').value}</div>
        <div><strong>Jurusan:</strong> ${document.getElementById('jurusan').selectedOptions[0].text}</div>
    `;
    document.getElementById('summary-data-diri').innerHTML = dataDiri;
    
    // Data Orang Tua
    const dataOrtu = `
        <div class="md:col-span-2"><strong class="text-primary">Data Ayah:</strong></div>
        <div><strong>Nama Ayah:</strong> ${document.getElementById('nama_ayah').value}</div>
        <div><strong>NIK Ayah:</strong> ${document.getElementById('nik_ayah').value}</div>
        <div><strong>Pekerjaan:</strong> ${document.getElementById('pekerjaan_ayah').value}</div>
        <div><strong>No. HP:</strong> ${document.getElementById('no_hp_ayah').value}</div>
        
        <div class="md:col-span-2 mt-4"><strong class="text-primary">Data Ibu:</strong></div>
        <div><strong>Nama Ibu:</strong> ${document.getElementById('nama_ibu').value}</div>
        <div><strong>NIK Ibu:</strong> ${document.getElementById('nik_ibu').value}</div>
        <div><strong>Pekerjaan:</strong> ${document.getElementById('pekerjaan_ibu').value}</div>
        <div><strong>No. HP:</strong> ${document.getElementById('no_hp_ibu').value}</div>
        
        <div class="md:col-span-2 mt-4"><strong>Penghasilan/Bulan:</strong> ${document.getElementById('penghasilan').value}</div>
    `;
    document.getElementById('summary-ortu').innerHTML = dataOrtu;
    
    // Dokumen
    const dokumen = `
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle text-green-500"></i>
            <span>Ijazah: ${document.getElementById('ijazah').files[0].name}</span>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle text-green-500"></i>
            <span>Kartu Keluarga: ${document.getElementById('kk').files[0].name}</span>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle text-green-500"></i>
            <span>Akta Kelahiran: ${document.getElementById('akta').files[0].name}</span>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle text-green-500"></i>
            <span>Pas Foto: ${document.getElementById('foto').files[0].name}</span>
        </div>
    `;
    document.getElementById('summary-dokumen').innerHTML = dokumen;
}

// Format Date
function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}

// Preview File
function previewFile(input, previewId) {
    const preview = document.getElementById(previewId);
    const file = input.files[0];
    
    if (file) {
        const fileSize = (file.size / 1024 / 1024).toFixed(2); // MB
        if (fileSize > 2) {
            showAlert('error', 'Ukuran file maksimal 2MB!');
            input.value = '';
            preview.innerHTML = '';
            return;
        }
        
        preview.innerHTML = `
            <div class="flex items-center space-x-3 text-sm bg-green-50 p-3 rounded-lg">
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
                <div class="flex-1">
                    <p class="font-semibold text-gray-800">${file.name}</p>
                    <p class="text-gray-600">${fileSize} MB</p>
                </div>
            </div>
        `;
    }
}

// Form Submit
document.getElementById('registration-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Check pernyataan
    if (!document.getElementById('pernyataan').checked) {
        showAlert('error', 'Anda harus menyetujui pernyataan terlebih dahulu!');
        return;
    }
    
    // Show loading
    const submitBtn = document.getElementById('submit-btn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
    
    // Submit form dengan AJAX
    const formData = new FormData(this);
    
    fetch('{{ route("daftar.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update nomor pendaftaran
            document.getElementById('no-pendaftaran').textContent = data.no_pendaftaran;
            
            // Show success modal
            document.getElementById('success-modal').classList.remove('hidden');
        }
        
        // Reset button
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim Pendaftaran';
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'Terjadi kesalahan saat mengirim data!');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim Pendaftaran';
    });
});

// Alert Function
function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-24 right-4 max-w-sm p-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } text-white`;
    
    alertDiv.innerHTML = `
        <div class="flex items-center space-x-3">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} text-2xl"></i>
            <p class="font-semibold">${message}</p>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.style.transform = 'translateX(400px)';
        setTimeout(() => alertDiv.remove(), 300);
    }, 3000);
}

document.getElementById('nik_ayah').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').slice(0, 16);
});

document.getElementById('nik_ibu').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').slice(0, 16);
});

document.getElementById('no_hp').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').slice(0, 13);
});

document.getElementById('no_hp_ayah').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').slice(0, 13);
});

document.getElementById('no_hp_ibu').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').slice(0, 13);
});