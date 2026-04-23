document.addEventListener("DOMContentLoaded", function() {
    
    // --- [PERBAIKAN PENTING] ---
    // Jadikan ini baris PERTAMA.
    // Tampilkan halaman (Fade In) SEGERA, sebelum script lain (auto-scroll)
    // berjalan. Ini mencegah "Blank Putih" jika script lain error.
    document.body.classList.add('loaded');


    // --- Fungsi Auto Scroll Universal ---
    function setupAutoScroll(containerId, cardSelector, speed = 3000) {
        const scrollContainer = document.getElementById(containerId);

        // [PENTING] Cek jika container TIDAK ADA di halaman ini, 
        // jangan jalankan sisa script-nya (agar tidak error)
        if (!scrollContainer) {
            // console.log(`Container #${containerId} tidak ditemukan di halaman ini.`);
            return; // Berhenti di sini
        }

        let autoScroll;

        const startScrolling = () => {
            autoScroll = setInterval(() => {
                const card = scrollContainer.querySelector(cardSelector);
                
                if (card) {
                    const cardWidth = card.offsetWidth + 16; 
                    const maxScrollLeft = scrollContainer.scrollWidth - scrollContainer.clientWidth;

                    if (scrollContainer.scrollLeft >= maxScrollLeft - 10) {
                        scrollContainer.scrollTo({
                            left: 0,
                            behavior: 'smooth'
                        });
                    } else {
                        scrollContainer.scrollBy({
                            left: cardWidth,
                            behavior: 'smooth'
                        });
                    }
                }
            }, speed);
        };

        // Hentikan scroll saat disentuh/dihover
        scrollContainer.addEventListener('touchstart', () => clearInterval(autoScroll));
        scrollContainer.addEventListener('mouseenter', () => clearInterval(autoScroll));

        // Lanjutkan scroll saat dilepas
        scrollContainer.addEventListener('touchend', startScrolling);
        scrollContainer.addEventListener('mouseleave', startScrolling);

        // Jalankan pertama kali
        startScrolling();
    }

    // --- Panggilan Auto Scroll (Sekarang dimatikan sesuai permintaan user) ---
    // setupAutoScroll('categoryScroll', '.col-10', 3000); 
    // setupAutoScroll('recommendationScroll', '.col-10', 3500); 
    // setupAutoScroll('hotelScroll', '.col-10', 4000);
    // setupAutoScroll('testiScroll', '.col-10', 5000);
    // setupAutoScroll('blogScroll', '.col-10', 4500);
    // setupAutoScroll('whyScroll', '.col-10', 3500); 


    // --- Animasi Pindah Halaman (Fade Out) ---
    const links = document.querySelectorAll('a');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetUrl = this.href;
            
            // Cek link internal
            if (targetUrl.includes(window.location.origin) && 
                !targetUrl.includes('#') && 
                this.target !== '_blank') {
                
                e.preventDefault(); 
                document.body.classList.remove('loaded'); // Bikin transparan

                // Tunggu 500ms, baru pindah
                setTimeout(() => {
                    window.location.href = targetUrl;
                }, 500); 
            }
        });
    });

});