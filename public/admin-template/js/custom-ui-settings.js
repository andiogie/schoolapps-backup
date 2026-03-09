document.addEventListener("DOMContentLoaded", function() {

    // --- SAVE ORIGINAL THEME FUNCTIONS ---
    const original = {
        darkMode: window.darkMode,
        navbarFixed: window.navbarFixed,
        sidebarColor: window.sidebarColor,
        sidebarType: window.sidebarType
    };

    // --- WRAP FUNCTIONS TO ADD LOCALSTORAGE PERSISTENCE ---

    // 1. Dark Mode
    window.darkMode = (toggleSwitch) => {
        if (original.darkMode) original.darkMode(toggleSwitch);
        localStorage.setItem('dark-mode', toggleSwitch.checked);
    };

    // 2. Navbar Fixed
    window.navbarFixed = (el) => {
        if (original.navbarFixed) original.navbarFixed(el);
        localStorage.setItem('navbar-fixed', el.checked);
    };

    // 3. Sidebar Color
    window.sidebarColor = (el) => {
        if (original.sidebarColor) original.sidebarColor(el);
        localStorage.setItem('sidebar-color', el.getAttribute('data-color'));
    };

    // 4. Sidenav Type
    window.sidebarType = (el) => {
        if (original.sidebarType) original.sidebarType(el);
        localStorage.setItem('sidenav-type', el.getAttribute('data-class'));
    };


    // --- RESTORE SETTINGS ON PAGE LOAD ---
    try {
        // 1. Restore Dark Mode
        const darkModeSaved = localStorage.getItem('dark-mode') === 'true';
        const darkVersionSwitch = document.getElementById('dark-version');
        if (darkVersionSwitch) {
            if (darkModeSaved != darkVersionSwitch.checked) {
                 darkVersionSwitch.checked = darkModeSaved;
                 if (original.darkMode) original.darkMode(darkVersionSwitch);
            }
        }

        // 2. Restore Navbar Fixed
        const navbarFixedSaved = localStorage.getItem('navbar-fixed') === 'true';
        const navbarFixedSwitch = document.getElementById('navbarFixed');
        if (navbarFixedSwitch && navbarFixedSaved != navbarFixedSwitch.checked) {
            navbarFixedSwitch.checked = true;
            if (original.navbarFixed) original.navbarFixed(navbarFixedSwitch);
        }

        // 3. Restore Sidebar Color
        const sidebarColorSaved = localStorage.getItem('sidebar-color');
        if (sidebarColorSaved) {
            const colorButton = document.querySelector(".switch-trigger.background-color span[data-color='" + sidebarColorSaved + "']");
            if (colorButton && original.sidebarColor) original.sidebarColor(colorButton);
        }

        // 4. Restore Sidenav Type
        const sidenavTypeSaved = localStorage.getItem('sidenav-type');
        if (sidenavTypeSaved) {
            const typeButton = document.querySelector(".d-flex button[data-class='" + sidenavTypeSaved + "']");
            if (typeButton && original.sidebarType) original.sidebarType(typeButton);
        }

    } catch (e) {
        console.error("Error restoring UI settings from localStorage", e);
    }

    // --- SCROLLBAR INIT ---
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        };
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
});