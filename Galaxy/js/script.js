    document.addEventListener("DOMContentLoaded", () => {
    // Form validation
    const form = document.getElementById("fanForm");
    form.addEventListener("submit", (e) => {
        const name = document.getElementById("name").value.trim();
        const gender = document.querySelector('input[name="gender"]:checked');
        const fandomLevel = document.getElementById("fandom_level").value;

        if (!name || !gender || !fandomLevel) {
            e.preventDefault();
            alert("Please fill out all required fields!");
        }
    });

    // Star animation
    function createStars() {
        const stars = document.getElementById('stars');
        const count = 200;

        for (let i = 0; i < count; i++) {
            const star = document.createElement('div');
            star.classList.add('star');
            star.style.left = `${Math.random() * 100}%`;
            star.style.top = `${Math.random() * 100}%`;
            star.style.animationDuration = `${Math.random() * 3 + 2}s`;
            stars.appendChild(star);
        }
    }

    createStars();

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 150);
        }, 5000);
    });
    });
