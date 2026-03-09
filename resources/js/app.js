import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import './dashboard.js';
import { Spinner } from 'spin.js';

// Konfigurasi untuk spinner
const spinnerOpts = {
  lines: 12, 
  length: 15, 
  width: 7, 
  radius: 25, 
  scale: 1.0,
  corners: 1, 
  color: '#ffffff', 
  fadeColor: 'transparent',
  animation: 'spinner-line-fade-quick',
  rotate: 0, 
  direction: 1, 
  speed: 1, 
  zIndex: 2e9, // z-index sangat tinggi
  className: 'spinner',
  top: '50%', 
  left: '50%', 
  shadow: '0 0 1px transparent', 
  position: 'fixed' // Menggunakan fixed agar selalu di tengah viewport
};

let spinner = null;
let overlay = null;
let spinnerTimeout = null;

function showSpinner() {
    // Jika spinner sudah ada, jangan lakukan apa-apa
    if (overlay) return;

    // Buat overlay
    overlay = document.createElement('div');
    overlay.id = 'spinner-overlay';
    document.body.appendChild(overlay);

    // Buat spinner dan pasang ke overlay
    spinner = new Spinner(spinnerOpts).spin(overlay);

    // Gaya overlay langsung dari JS untuk memastikan prioritas
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    overlay.style.zIndex = '9998';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
}

function hideSpinner() {
    clearTimeout(spinnerTimeout); // Hapus timeout jika ada
    if (spinner) {
        spinner.stop();
        spinner = null;
    }
    if (overlay) {
        // Gunakan sedikit transisi untuk menghilangkannya
        overlay.style.transition = 'opacity 0.2s ease-out';
        overlay.style.opacity = '0';
        setTimeout(() => {
            if(overlay && overlay.parentNode) {
                overlay.parentNode.removeChild(overlay);
            }
            overlay = null;
        }, 200);
    }
}

// --- EVENT LISTENERS --- //

const handleInteraction = (e) => {
    let targetElement = e.target;

    // Cek untuk form submission
    const form = targetElement.closest('form');
    if (e.type === 'submit' && form) {
        showSpinner();
        return;
    }

    // Cek untuk klik link
    const anchor = targetElement.closest('a');
    if (e.type === 'click' && anchor && anchor.href) {
        const href = anchor.getAttribute('href');
        const target = anchor.getAttribute('target');

        // Abaikan jika link #, javascript:, atau buka tab baru
        if (href[0] === '#' || href.startsWith('javascript:') || target === '_blank') {
            return;
        }

        showSpinner();
    }
};

document.addEventListener('click', handleInteraction);
document.addEventListener('submit', handleInteraction);

// Sembunyikan spinner saat halaman selesai dimuat
window.addEventListener('load', hideSpinner);

// Sembunyikan juga jika halaman dimuat dari Back/Forward cache (bfcache)
window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
        hideSpinner();
    }
});
