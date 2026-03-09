
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registration-form');
    const steps = Array.from(document.querySelectorAll('.form-step'));
    const indicators = Array.from(document.querySelectorAll('.step-item'));
    const successMessage = document.getElementById('success-message');
    const submitButton = document.getElementById('submit-btn');

    let currentStep = 0;

    function populateConfirmation() {
        document.getElementById('konfirmasi-nama_lengkap').textContent = form.querySelector('[name="nama_lengkap"]').value || '-';
        const tempatLahir = form.querySelector('[name="tempat_lahir"]').value;
        const tanggalLahir = form.querySelector('[name="tanggal_lahir"]').value;
        document.getElementById('konfirmasi-ttl').textContent = (tempatLahir && tanggalLahir) ? `${tempatLahir}, ${tanggalLahir}` : '-';
        const jenisKelaminSelect = form.querySelector('[name="jenis_kelamin"]');
        document.getElementById('konfirmasi-jenis_kelamin').textContent = jenisKelaminSelect.value === 'L' ? 'Laki-laki' : (jenisKelaminSelect.value === 'P' ? 'Perempuan' : '-');
        document.getElementById('konfirmasi-agama').textContent = form.querySelector('[name="agama"]').value || '-';
        document.getElementById('konfirmasi-alamat').textContent = form.querySelector('[name="alamat"]').value || '-';
        document.getElementById('konfirmasi-no_hp').textContent = form.querySelector('[name="no_hp"]').value || '-';
        document.getElementById('konfirmasi-email').textContent = form.querySelector('[name="email"]').value || '-';
        
        document.getElementById('konfirmasi-nomor_kk').textContent = form.querySelector('[name="nomor_kk"]').value || '-';
        document.getElementById('konfirmasi-nama_ayah').textContent = form.querySelector('[name="nama_ayah"]').value || '-';
        document.getElementById('konfirmasi-nama_ibu').textContent = form.querySelector('[name="nama_ibu"]').value || '-';
        document.getElementById('konfirmasi-no_hp_ortu').textContent = form.querySelector('[name="no_hp_ortu"]').value || '-';

        document.getElementById('konfirmasi-asal_sekolah').textContent = form.querySelector('[name="asal_sekolah"]').value || '-';
        const jurusanSelect = form.querySelector('[name="jurusan"]');
        document.getElementById('konfirmasi-jurusan').textContent = jurusanSelect.selectedIndex > 0 ? jurusanSelect.options[jurusanSelect.selectedIndex].text : '-';
        const ijazahFile = form.querySelector('[name="ijazah"]').files[0];
        document.getElementById('konfirmasi-ijazah').textContent = ijazahFile ? ijazahFile.name : 'Belum diunggah';
    }

    window.nextStep = () => {
        if (validateStep(currentStep)) {
            if (currentStep < steps.length - 1) {
                 if (currentStep === 2) { 
                    populateConfirmation();
                }
                steps[currentStep].classList.add('hidden');
                currentStep++;
                steps[currentStep].classList.remove('hidden');
                updateIndicators();
            }
        }
    };

    window.prevStep = () => {
        if (currentStep > 0) {
            steps[currentStep].classList.add('hidden');
            currentStep--;
            steps[currentStep].classList.remove('hidden');
            updateIndicators();
        }
    };

    function validateStep(stepIndex) {
        clearValidationErrors();
        const currentStepDiv = steps[stepIndex];
        const inputs = currentStepDiv.querySelectorAll('input[required], select[required], textarea[required]');
        let allValid = true;

        inputs.forEach(input => {
            let isValid = true;
            if (input.type === 'checkbox') {
                isValid = input.checked;
            } else if (input.type === 'file') {
                isValid = input.files.length > 0;
            } else {
                isValid = input.value.trim() !== '';
            }

            if (!isValid) {
                allValid = false;
                input.classList.add('border-red-500');
                const errorEl = document.createElement('p');
                errorEl.className = 'error-message text-red-500 text-sm mt-1';
                errorEl.textContent = 'Kolom ini wajib diisi.';
                if (!input.parentNode.querySelector('.error-message')) {
                    input.parentNode.appendChild(errorEl);
                }
            }
        });
        return allValid;
    }
    
    function clearValidationErrors() {
        form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
        form.querySelectorAll('.error-message').forEach(el => el.remove());
    }
    
    // *** FUNGSI BARU UNTUK MENAMPILKAN ALERT ERROR ***
    function showExplicitErrors(errors) {
        let errorMessages = 'Pendaftaran Gagal! Mohon perbaiki kesalahan berikut:\n\n';
        for (const key in errors) {
            errorMessages += `- ${errors[key][0]}\n`;
        }
        alert(errorMessages);

        // Tetap tandai field yang error
         for (const key in errors) {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) {
                input.classList.add('border-red-500');
            }
        }

        // Pindah ke step di mana error pertama ditemukan
        const firstErrorKey = Object.keys(errors)[0];
        const errorInput = form.querySelector(`[name="${firstErrorKey}"]`);
        const errorStep = errorInput ? errorInput.closest('.form-step') : null;
        if (errorStep) {
            const errorStepIndex = steps.findIndex(s => s.id === errorStep.id);
            if (errorStepIndex !== -1 && errorStepIndex !== currentStep) {
                steps[currentStep].classList.add('hidden');
                currentStep = errorStepIndex;
                steps[currentStep].classList.remove('hidden');
                updateIndicators();
            }
        }
    }

    function updateIndicators() {
        indicators.forEach((indicator, index) => {
            const circle = indicator.querySelector('.step-circle');
            const line = indicator.querySelector('.step-line');

            indicator.classList.remove('active', 'completed');
            
            if (index < currentStep) {
                indicator.classList.add('completed');
                circle.innerHTML = '<i class="fas fa-check"></i>';
                 if(line) line.classList.replace('bg-slate-600', 'bg-green-500');
            } else if (index === currentStep) {
                indicator.classList.add('active');
                circle.innerText = index + 1;
                 if(line) line.classList.remove('bg-green-500');
                 if(line) line.classList.add('bg-slate-600');
            } else {
                circle.innerText = index + 1;
                if(line) line.classList.remove('bg-green-500');
                if(line) line.classList.add('bg-slate-600');
            }
        });
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const pernyataanCheckbox = document.getElementById('pernyataan');
        if (!pernyataanCheckbox.checked) {
            alert('Anda harus menyetujui pernyataan untuk melanjutkan.');
            pernyataanCheckbox.focus();
            return;
        }

        const originalButtonText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
        clearValidationErrors();

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (response.ok || response.status === 422) {
                return response.json();
            }
            throw new Error('Server Error: ' + response.status);
        })
        .then(data => {
            if (data.errors) {
                // *** GUNAKAN FUNGSI ALERT BARU ***
                showExplicitErrors(data.errors);
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            } else if (data.success) {
                document.getElementById('nomor-pendaftaran').textContent = data.no_pendaftaran;
                form.classList.add('hidden');
                successMessage.classList.remove('hidden');
                document.querySelector('.lg\:w-2\/3').scrollIntoView({ behavior: 'smooth' });
            } else {
                throw new Error(data.message || 'Terjadi kesalahan tidak dikenal.');
            }
        })
        .catch(error => {
            console.error('Submission error:', error);
            alert('Gagal mengirim data. Periksa koneksi Anda dan coba lagi.');
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        });
    });

    updateIndicators();
});
