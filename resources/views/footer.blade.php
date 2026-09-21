<footer class="footer-bar">
    <span>© {{ date('Y') }}
        <a href="http://monitoring.majuselarasinstrumindo.com/" class="hover:underline">
            MS-Monitoring
        </a>
    </span>
    <span class="footer-right" id="clock">
        {{ date('l, d-m-Y | H:i:s') }}
    </span>
</footer>
<script>
    function updateClock() {
        const now = new Date();

        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        const months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        const dayName = days[now.getDay()];
        const day = String(now.getDate()).padStart(2, '0');
        const monthName = months[now.getMonth()];
        const year = now.getFullYear();

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        document.getElementById('clock').textContent =
            `${dayName}, ${day} ${monthName} ${year} | ${hours}:${minutes}:${seconds}`;
    }

    setInterval(updateClock, 1000);
    updateClock();

    // Scroll behavior for footer
    let lastScrollTop = 0;
    const footer = document.querySelector('.footer-bar');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > lastScrollTop && scrollTop > 50) footer.classList.add('footer-hidden');
        else footer.classList.remove('footer-hidden');
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
    }, false);
</script>
