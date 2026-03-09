// ===== DOCUMENT READY =====
document.addEventListener('DOMContentLoaded', function() {
    initNavbar();
    initMobileMenu();
    initScrollTop();
    initCounters();
    initSmoothScroll();
    initFormValidation();
    initScrollAnimations();
});

// ===== NAVBAR SCROLL EFFECT =====
function initNavbar() {
    const navbar = document.getElementById('navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

// ===== MOBILE MENU TOGGLE =====
function initMobileMenu() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    
    // Toggle menu
    mobileMenuBtn.addEventListener('click', function() {
        const icon = this.querySelector('i');
        
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('active');
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('active');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
    
    // Close menu when clicking nav link
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('active');
            const icon = mobileMenuBtn.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        });
    });
}

// ===== SCROLL TO TOP BUTTON =====
function initScrollTop() {
    const scrollTopBtn = document.getElementById('scroll-top');
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.remove('hidden');
        } else {
            scrollTopBtn.classList.add('hidden');
        }
    });
    
    // Scroll to top when clicked
    scrollTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// ===== COUNTER ANIMATION =====
function initCounters() {
    const counters = document.querySelectorAll('.counter');
    const speed = 200; // Animation speed
    let hasAnimated = false;
    
    const animateCounters = () => {
        if (hasAnimated) return;
        
        const statsSection = document.querySelector('.stat-item').closest('section');
        const sectionTop = statsSection.offsetTop;
        const sectionHeight = statsSection.offsetHeight;
        const scrollPosition = window.scrollY + window.innerHeight;
        
        if (scrollPosition > sectionTop + (sectionHeight / 3)) {
            hasAnimated = true;
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / speed;
                let current = 0;
                
                const updateCounter = () => {
                    current += increment;
                    
                    if (current < target) {
                        counter.textContent = Math.ceil(current);
                        setTimeout(updateCounter, 10);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
            });
        }
    };
    
    window.addEventListener('scroll', animateCounters);
}

// ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
function initSmoothScroll() {
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Skip if href is just "#"
            if (href === '#') return;
            
            e.preventDefault();
            
            const targetId = href.substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                const offsetTop = targetElement.offsetTop - 80; // Account for fixed navbar
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// ===== FORM VALIDATION & SUBMISSION =====
function initFormValidation() {
    const form = document.getElementById('form-container');
    
    if (!form) return;
    
    // NIK validation (16 digits)
    const nikInput = document.getElementById('nik');
    if (nikInput) {
        nikInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 16);
        });
    }
    
    // Phone number validation
    const hpInput = document.getElementById('hp');
    if (hpInput) {
        hpInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 13);
        });
    }
}

// ===== FORM SUBMISSION =====
function submitForm() {
    const nama = document.getElementById('nama').value.trim();
    const nik = document.getElementById('nik').value.trim();
    const email = document.getElementById('email').value.trim();
    const hp = document.getElementById('hp').value.trim();
    const jurusan = document.getElementById('jurusan').value;
    
    // Validation
    if (!nama) {
        showAlert('Nama lengkap harus diisi!', 'error');
        return;
    }
    
    if (!nik || nik.length !== 16) {
        showAlert('NIK harus 16 digit!', 'error');
        return;
    }
    
    if (!email || !validateEmail(email)) {
        showAlert('Email tidak valid!', 'error');
        return;
    }
    
    if (!hp || hp.length < 10) {
        showAlert('Nomor WhatsApp tidak valid!', 'error');
        return;
    }
    
    if (!jurusan) {
        showAlert('Pilih jurusan terlebih dahulu!', 'error');
        return;
    }
    
    // Show loading
    const submitBtn = event.target;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
    submitBtn.disabled = true;
    
    // Simulate form submission (replace with actual API call)
    setTimeout(() => {
        // Hide form and show success message
        document.querySelector('#form-container > div:first-child').style.display = 'none';
        document.getElementById('success-message').classList.remove('hidden');
        
        // Reset button
        submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim Pendaftaran';
        submitBtn.disabled = false;
        
        // Show success notification
        showAlert('Pendaftaran berhasil dikirim!', 'success');
        
        // Reset form after 3 seconds
        setTimeout(() => {
            resetForm();
        }, 3000);
    }, 2000);
}

// ===== EMAIL VALIDATION =====
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// ===== ALERT NOTIFICATION =====
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-24 right-4 max-w-sm p-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 
        'bg-blue-500'
    } text-white`;
    
    alertDiv.innerHTML = `
        <div class="flex items-center space-x-3">
            <i class="fas ${
                type === 'success' ? 'fa-check-circle' : 
                type === 'error' ? 'fa-exclamation-circle' : 
                'fa-info-circle'
            } text-2xl"></i>
            <p class="font-semibold">${message}</p>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Slide in animation
    setTimeout(() => {
        alertDiv.style.transform = 'translateX(0)';
    }, 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        alertDiv.style.transform = 'translateX(400px)';
        setTimeout(() => {
            alertDiv.remove();
        }, 300);
    }, 3000);
}

// ===== RESET FORM =====
function resetForm() {
    document.getElementById('nama').value = '';
    document.getElementById('nik').value = '';
    document.getElementById('email').value = '';
    document.getElementById('hp').value = '';
    document.getElementById('jurusan').value = '';
    document.getElementById('dokumen').value = '';
    
    document.querySelector('#form-container > div:first-child').style.display = 'block';
    document.getElementById('success-message').classList.add('hidden');
}

// ===== SCROLL ANIMATIONS =====
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions); 
    
    // Observe all sections
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        observer.observe(section);
    });
}

// ===== LAZY LOAD IMAGES =====
function lazyLoadImages() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// ===== PRELOADER (Optional) =====
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 300);
    }
});

// ===== DETECT USER SCROLL DIRECTION =====
let lastScrollTop = 0;
window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    if (scrollTop > lastScrollTop) {
        // Scrolling down
        document.body.setAttribute('data-scroll-direction', 'down');
    } else {
        // Scrolling up
        document.body.setAttribute('data-scroll-direction', 'up');
    }
    
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
}, false);

// ===== HANDLE WINDOW RESIZE =====
let resizeTimer;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        // Actions to perform after resize ends
        const mobileMenu = document.getElementById('mobile-menu');
        if (window.innerWidth > 768 && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            const icon = document.getElementById('mobile-menu-btn').querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }, 250);
});

// ===== KEYBOARD ACCESSIBILITY =====
document.addEventListener('keydown', function(e) {
    // ESC key closes mobile menu
    if (e.key === 'Escape') {
        const mobileMenu = document.getElementById('mobile-menu');
        if (!mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            const icon = document.getElementById('mobile-menu-btn').querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }
});

// ===== COPY TO CLIPBOARD FUNCTION =====
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showAlert('Berhasil disalin ke clipboard!', 'success');
    }).catch(() => {
        showAlert('Gagal menyalin ke clipboard!', 'error');
    });
}

// ===== SHARE FUNCTION (Social Media) =====
function shareToSocial(platform) {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    
    let shareUrl;
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
            break;
        case 'whatsapp':
            shareUrl = `https://wa.me/?text=${title}%20${url}`;
            break;
        case 'telegram':
            shareUrl = `https://t.me/share/url?url=${url}&text=${title}`;
            break;
        default:
            return;
    }
    
    window.open(shareUrl, '_blank', 'width=600,height=400');
}

// ===== PRINT PAGE FUNCTION =====
function printPage() {
    window.print();
}

// ===== TOGGLE DARK MODE (Optional) =====
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDark);
}

// ===== CHECK SAVED DARK MODE PREFERENCE =====
if (localStorage.getItem('darkMode') === 'true') {
    document.body.classList.add('dark-mode');
}

// ===== EXPORT FUNCTIONS FOR GLOBAL USE =====
window.submitForm = submitForm;
window.copyToClipboard = copyToClipboard;
window.shareToSocial = shareToSocial;
window.printPage = printPage;
window.toggleDarkMode = toggleDarkMode;

// ===== CONSOLE MESSAGE =====
console.log('%c🎓 SMK Teknologi Nusantara', 'color: #059669; font-size: 24px; font-weight: bold;');
console.log('%cWebsite dikembangkan dengan ❤️', 'color: #10b981; font-size: 14px;');