document.addEventListener("DOMContentLoaded", function() {
    const splashScreen = document.getElementById('splash-screen');
    const closeBtn = document.getElementById('close-btn');

    closeBtn.addEventListener('click', function() {
        splashScreen.style.display = 'none';
    });
});

