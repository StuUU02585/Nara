(function () {
    var sliders = document.querySelectorAll('[data-slider]');

    sliders.forEach(function (slider) {
        var track = slider.querySelector('.slider-track');
        var slides = slider.querySelectorAll('.slider-slide');
        var dots = slider.querySelectorAll('[data-slider-dot]');
        var prev = slider.querySelector('[data-slider-prev]');
        var next = slider.querySelector('[data-slider-next]');
        var index = 0;
        var timer = null;

        function showSlide(nextIndex) {
            if (!slides.length) {
                return;
            }

            index = (nextIndex + slides.length) % slides.length;
            track.style.transform = 'translateX(-' + (index * 100) + '%)';

            slides.forEach(function (slide, slideIndex) {
                slide.classList.toggle('is-active', slideIndex === index);
            });

            dots.forEach(function (dot, dotIndex) {
                dot.classList.toggle('is-active', dotIndex === index);
            });
        }

        function start() {
            stop();
            timer = window.setInterval(function () {
                showSlide(index + 1);
            }, 5200);
        }

        function stop() {
            if (timer) {
                window.clearInterval(timer);
                timer = null;
            }
        }

        if (prev) {
            prev.addEventListener('click', function () {
                showSlide(index - 1);
                start();
            });
        }

        if (next) {
            next.addEventListener('click', function () {
                showSlide(index + 1);
                start();
            });
        }

        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                showSlide(parseInt(dot.getAttribute('data-slider-dot'), 10));
                start();
            });
        });

        slider.addEventListener('mouseenter', stop);
        slider.addEventListener('mouseleave', start);
        showSlide(0);
        start();
    });
})();

(function () {
    var tabList = document.querySelector('[data-participant-tabs]');

    if (!tabList) {
        return;
    }

    var tabs = Array.prototype.slice.call(tabList.querySelectorAll('[data-participant-tab]'));
    var panels = Array.prototype.slice.call(document.querySelectorAll('[data-participant-panel]'));

    function showPanel(panelName, updateHash) {
        var exists = panels.some(function (panel) {
            return panel.getAttribute('data-participant-panel') === panelName;
        });

        if (!exists) {
            panelName = 'konsultasi';
        }

        tabs.forEach(function (tab) {
            var active = tab.getAttribute('data-participant-tab') === panelName;
            tab.classList.toggle('is-active', active);
            tab.setAttribute('aria-selected', active ? 'true' : 'false');
            tab.setAttribute('tabindex', active ? '0' : '-1');
        });

        panels.forEach(function (panel) {
            panel.hidden = panel.getAttribute('data-participant-panel') !== panelName;
        });

        if (updateHash && window.history && window.history.replaceState) {
            window.history.replaceState(null, '', '#' + panelName);
        }
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function (event) {
            event.preventDefault();
            showPanel(tab.getAttribute('data-participant-tab'), true);
        });
    });

    showPanel(window.location.hash.replace('#', '') || 'konsultasi', false);
})();

(function () {
    var categorySelects = document.querySelectorAll('select[name="category_id"]');

    categorySelects.forEach(function (select) {
        function syncSlug() {
            var selected = select.options[select.selectedIndex];
            var slugInput = select.parentElement.querySelector('input[name="category_slug"]');

            if (slugInput && selected && selected.getAttribute('data-slug')) {
                slugInput.value = selected.getAttribute('data-slug');
            }
        }

        select.addEventListener('change', syncSlug);
        syncSlug();
    });
})();

(function () {
    var modal = document.querySelector('[data-flyer-modal]');

    if (!modal) {
        return;
    }

    var image = modal.querySelector('[data-flyer-modal-image]');
    var title = modal.querySelector('[data-flyer-modal-title]');
    var closeButtons = modal.querySelectorAll('[data-flyer-close]');
    var lastTrigger = null;

    function openModal(trigger) {
        lastTrigger = trigger;
        image.src = trigger.getAttribute('data-flyer-src') || '';
        image.alt = trigger.getAttribute('data-flyer-title') || 'Preview flyer';
        if (title) {
            title.textContent = trigger.getAttribute('data-flyer-title') || 'Preview Flyer';
        }
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('flyer-modal-open');
    }

    function closeModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('flyer-modal-open');
        image.src = '';

        if (lastTrigger) {
            lastTrigger.focus();
        }
    }

    document.querySelectorAll('[data-flyer-src]').forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            openModal(trigger);
        });
    });

    closeButtons.forEach(function (button) {
        button.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) {
            closeModal();
        }
    });
})();

(function () {
    var endpointMeta = document.querySelector('meta[name="poster-traffic-url"]');
    var csrfMeta = document.querySelector('meta[name="csrf-token"]');

    if (!endpointMeta || !csrfMeta) {
        return;
    }

    var endpoint = endpointMeta.getAttribute('content');
    var csrfToken = csrfMeta.getAttribute('content');

    document.querySelectorAll('[data-poster-track]').forEach(function (poster) {
        poster.addEventListener('click', function () {
            var payload = new FormData();
            payload.append('_csrf', csrfToken);
            payload.append('poster_type', poster.getAttribute('data-poster-type') || '');
            payload.append('poster_key', poster.getAttribute('data-poster-key') || '');
            payload.append('poster_name', poster.getAttribute('data-poster-name') || '');
            payload.append('page_path', window.location.pathname);

            if (navigator.sendBeacon && navigator.sendBeacon(endpoint, payload)) {
                return;
            }

            window.fetch(endpoint, {
                method: 'POST',
                body: payload,
                credentials: 'same-origin',
                keepalive: true,
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            }).catch(function () {
                // Traffic logging must never interrupt the visitor's action.
            });
        });
    });
})();


/* ===================================================
   MODIFIKASI SLIDER PROGRAM UNGGULAN - FIXED 4 BARIS
   =================================================== */
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua container slider program yang ada di halaman
    const containers = document.querySelectorAll('.program-slider-container');

    containers.forEach(container => {
        const wrapper = container.querySelector(".program-slider-wrapper");
        const prevBtn = container.querySelector(".program-nav-btn.prev-btn");
        const nextBtn = container.querySelector(".program-nav-btn.next-btn");

        if (wrapper && prevBtn && nextBtn) {
            
            // 1. Hitung jumlah card di dalam wrapper saat ini
            const cardCount = wrapper.querySelectorAll(".program-cards .card").length;

            // Jika card berjumlah 4 atau kurang dari 4, hide tombol di desktop
            if (cardCount <= 4) {
                container.classList.add("hide-arrows");
            } else {
                container.classList.remove("hide-arrows");
            }

            // 2. Fungsi hitung jarak slide dinamis sesuai lebar card + gap (18px)
            function getScrollAmount() {
                const firstCard = wrapper.querySelector(".card");
                if (firstCard) {
                    return firstCard.offsetWidth + 18; 
                }
                return wrapper.offsetWidth / 2; 
            }

            // Event Tombol KANAN (Next)
            nextBtn.addEventListener("click", function () {
                wrapper.scrollLeft += getScrollAmount();
            });

            // Event Tombol KIRI (Prev)
            prevBtn.addEventListener("click", function () {
                wrapper.scrollLeft -= getScrollAmount();
            });
            
            // 3. Logika efek opasitas tombol saat di-scroll mentok
            wrapper.addEventListener("scroll", function () {
                const maxScrollLeft = wrapper.scrollWidth - wrapper.clientWidth;
                
                // Cek batas kiri
                if (wrapper.scrollLeft <= 5) {
                    prevBtn.style.opacity = "0.3";
                    prevBtn.style.pointerEvents = "none";
                } else {
                    prevBtn.style.opacity = "1";
                    prevBtn.style.pointerEvents = "auto";
                }

                // Cek batas kanan
                if (wrapper.scrollLeft >= maxScrollLeft - 5) {
                    nextBtn.style.opacity = "0.3";
                    nextBtn.style.pointerEvents = "none";
                } else {
                    nextBtn.style.opacity = "1";
                    nextBtn.style.pointerEvents = "auto";
                }
            });
            
            // Jalankan trigger scroll awal untuk menentukan opacity pertama kali
            wrapper.dispatchEvent(new Event("scroll"));
        }
    });
});



/* ===================================================
   MODIFIKASI SLIDER JADWAL TRAINING (NARA-HR) - SINKRONISASI ARROWS
   =================================================== */
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua container slider training yang ada di halaman
    const containers = document.querySelectorAll('.training-slider-container');

    containers.forEach(container => {
        const wrapper = container.querySelector(".training-slider-wrapper");
        const prevBtn = container.querySelector(".training-nav-btn.prev-btn");
        const nextBtn = container.querySelector(".training-nav-btn.next-btn");

        if (wrapper && prevBtn && nextBtn) {
            
            // 1. Hitung jumlah flyer card yang ada di dalam slider saat ini
            const cardCount = wrapper.querySelectorAll(".training-flyer-card").length;

            // Jika flyer 4 atau kurang dari 4, suntikkan class hide-arrows
            if (cardCount <= 4) {
                container.classList.add("hide-arrows");
            } else {
                container.classList.remove("hide-arrows");
            }

            // 2. Fungsi hitung geser dinamis per satu card + gap secara akurat
            const getScrollAmount = () => {
                const card = wrapper.querySelector(".training-flyer-card");
                if (!card) return 0;
                
                const computedStyle = window.getComputedStyle(wrapper);
                const gap = parseFloat(computedStyle.gap) || 0;
                
                return card.offsetWidth + gap;
            };

            // Event Tombol Kanan (Next)
            nextBtn.addEventListener("click", function (e) {
                e.preventDefault();
                wrapper.scrollBy({
                    left: getScrollAmount(),
                    behavior: "smooth"
                });
            });

            // Event Tombol Kiri (Prev)
            prevBtn.addEventListener("click", function (e) {
                e.preventDefault();
                wrapper.scrollBy({
                    left: -getScrollAmount(),
                    behavior: "smooth"
                });
            });
        }
    });
});


//3D Animasi
document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".carousel-3d-track");
    const cards = document.querySelectorAll(".carousel-3d-track .card");
    const container = document.querySelector(".carousel-3d-container");

    const totalCards = cards.length;
    if (totalCards === 0) return;

    // Hitung sudut pembagian lingkaran (360 derajat / jumlah item)
    const angle = 360 / totalCards;
    const cardWidth = 280; 
    
    // Hitung radius (jarak dorong dari tengah ke luar lingkaran)
    // Ditambah 120px ekstra biar jarak bentangan ke samping lebar mirip contoh.png
    const radius = Math.round(cardWidth / (2 * Math.tan(Math.PI / totalCards))) + 120; 

    // Terapkan posisi melingkar ke masing-masing card secara presisi
    cards.forEach((card, index) => {
        card.style.transform = `rotateY(${index * angle}deg) translateZ(${radius}px)`;
    });

    let currentIndex = 0;
    let autoplayTimer;

    // Fungsi memutar track carousel
    const rotateCarousel = () => {
        const rotationAngle = currentIndex * -angle;
        track.style.transform = `rotateY(${rotationAngle}deg)`;
    };

    const nextSlide = () => {
        currentIndex++;
        rotateCarousel();
    };

    // Fungsi menjalankan Autoplay
    const startAutoplay = () => {
        autoplayTimer = setInterval(nextSlide, 3000); // Berputar smooth tiap 3 detik
    };

    const stopAutoplay = () => {
        clearInterval(autoplayTimer);
    };

    // Jalankan pertama kali saat dokumen siap
    startAutoplay();

    // Fitur hover: berhenti saat dilihat dekat, lanjut saat kursor keluar
    if (container) {
        container.addEventListener("mouseenter", stopAutoplay);
        container.addEventListener("mouseleave", startAutoplay);
    }
});


// Scroll Bar Up & Down
document.addEventListener("DOMContentLoaded", () => {
    const topbar = document.querySelector(".topbar");
    let lastScrollY = window.scrollY;

    window.addEventListener("scroll", () => {
        const currentScrollY = window.scrollY;

        // Jika scroll ke bawah dan sudah melewati tinggi navbar, sembunyikan
        if (currentScrollY > lastScrollY && currentScrollY > 106) {
            topbar.classList.add("nav-hidden");
        } else {
            // Jika scroll ke atas, munculkan lagi
            topbar.classList.remove("nav-hidden");
        }

        // Efek tambahan pas halaman udah bergeser dari paling atas
        if (currentScrollY > 20) {
            topbar.classList.add("is-scrolled");
        } else {
            topbar.classList.remove("is-scrolled");
        }

        lastScrollY = currentScrollY;
    });
});

//Menu halaman sertifikasi 
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua container slider yang ada di halaman
    const sliders = document.querySelectorAll('.certification-slider-container');

    sliders.forEach(slider => {
        const wrapper = slider.querySelector('.certification-slider-wrapper');
        const prevBtn = slider.querySelector('.prev-btn');
        const nextBtn = slider.querySelector('.next-btn');
        
        // Hitung ada berapa banyak card aktif di dalam container ini
        const cardCount = slider.querySelectorAll('.certification-program-card').length;
        
        // 1. Logika sembunyikan tombol jika data flyer berisikan 4 atau kurang dari 4
        if (cardCount <= 4) {
            slider.classList.add('hide-arrows');
        } else {
            slider.classList.remove('hide-arrows');
        }

        // 2. Pasang fungsionalitas scroll (tetap dipasang karena di layar tablet tombol bakal kepake)
        if (prevBtn && nextBtn && wrapper) {
            nextBtn.addEventListener('click', () => {
                // Geser dinamis seukuran lebar container wrapper saat ini
                wrapper.scrollBy({ left: wrapper.clientWidth, behavior: 'smooth' });
            });
            
            prevBtn.addEventListener('click', () => {
                // Geser balik ke kiri
                wrapper.scrollBy({ left: -wrapper.clientWidth, behavior: 'smooth' });
            });
        }
    });
});


// di menu sertifikasi mini course
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua container slider training (In-House dan Short Training)
    const trainingSliders = document.querySelectorAll('.training-slider-container');

    trainingSliders.forEach(slider => {
        const wrapper = slider.querySelector(".training-slider-wrapper");
        const prevBtn = slider.querySelector(".training-nav-btn.prev-btn");
        const nextBtn = slider.querySelector(".training-nav-btn.next-btn");

        // Jalankan event hanya jika element-element navigasi di-render oleh PHP
        if (wrapper) {
            
            // Fungsi hitung jarak geser dinamis per satu card + gap secara akurat
            const getScrollAmount = () => {
                const card = wrapper.querySelector(".training-flyer-card");
                if (!card) return wrapper.clientWidth; // Fallback seukuran container jika card belum render
                
                const computedStyle = window.getComputedStyle(wrapper);
                const gap = parseFloat(computedStyle.gap) || 0;
                
                return card.offsetWidth + gap;
            };

            // Event klik tombol Kanan (Next) jika ada
            if (nextBtn) {
                nextBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    wrapper.scrollBy({
                        left: getScrollAmount(),
                        behavior: "smooth"
                    });
                });
            }

            // Event klik tombol Kiri (Prev) jika ada
            if (prevBtn) {
                prevBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    wrapper.scrollBy({
                        left: -getScrollAmount(),
                        behavior: "smooth"
                    });
                });
            }
        }
    });
});

// 3d animasi di menu trainers 
document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".carousel-3d-track");
    const cards = document.querySelectorAll(".carousel-3d-track .card");
    const container = document.querySelector(".carousel-3d-container");

    const totalCards = cards.length;
    if (totalCards === 0 || !track) return;

    const angle = 360 / totalCards;
    const cardWidth = 250; 
    
    const isMobile = window.innerWidth < 768;

    // Radius bentangan aman
    let radius = Math.round(cardWidth / (2 * Math.tan(Math.PI / totalCards))) + (isMobile ? 120 : 80);

    const updateCardTransforms = () => {
        cards.forEach((card, index) => {
            card.style.transform = `rotateY(${index * angle}deg) translateZ(${radius}px)`;
        });
    };
    updateCardTransforms();

    let currentIndex = 0;
    let autoplayTimer;

    const rotateCarousel = () => {
        const rotationAngle = currentIndex * -angle;
        track.style.transform = `rotateY(${rotationAngle}deg)`;

        const currentIsMobile = window.innerWidth < 768;

        cards.forEach((card, index) => {
            const normalizedIndex = (index - (currentIndex % totalCards) + totalCards) % totalCards;
            
            if (currentIsMobile) {
                // --- JALUR KHUSUS MOBILE (OPTIMAL & SMOOTH) ---
                // Bersihkan kelas lama dulu
                card.classList.remove('is-active', 'is-neighbor');
                
                if (normalizedIndex === 0) {
                    card.classList.add('is-active');
                    card.style.zIndex = "10";
                    card.style.pointerEvents = "auto";
                } else if (normalizedIndex === 1 || normalizedIndex === totalCards - 1) {
                    card.classList.add('is-neighbor');
                    card.style.zIndex = "5";
                    card.style.pointerEvents = "none";
                } else {
                    card.style.zIndex = "1";
                    card.style.pointerEvents = "none";
                }
            } else {
                // --- JALUR DESKTOP (TIDAK BERUBAH, TETEP SMOOTH SEPERTI KEMARIN) ---
                if (normalizedIndex === 0) {
                    card.style.opacity = "1";
                    card.style.zIndex = "10";
                    card.style.pointerEvents = "auto";
                } else if (normalizedIndex === 1 || normalizedIndex === totalCards - 1) {
                    card.style.opacity = "0.7";
                    card.style.zIndex = "5";
                    card.style.pointerEvents = "none";
                } else {
                    card.style.opacity = "0.2";
                    card.style.zIndex = "1";
                    card.style.pointerEvents = "none";
                }
            }
        });
    };

    const nextSlide = () => {
        currentIndex++;
        rotateCarousel();
    };

    const startAutoplay = () => {
        clearInterval(autoplayTimer); 
        autoplayTimer = setInterval(nextSlide, 3000); 
    };

    const stopAutoplay = () => {
        clearInterval(autoplayTimer);
    };

    rotateCarousel();
    startAutoplay();

    if (container) {
        container.addEventListener("mouseenter", stopAutoplay);
        container.addEventListener("mouseleave", startAutoplay);
        
        container.addEventListener("touchstart", stopAutoplay, { passive: true });
        container.addEventListener("touchend", () => {
            setTimeout(startAutoplay, 1000);
        }, { passive: true });
    }

    window.addEventListener("resize", () => {
        const currentMobile = window.innerWidth < 768;
        radius = Math.round(cardWidth / (2 * Math.tan(Math.PI / totalCards))) + (currentMobile ? 120 : 80);
        updateCardTransforms();
        rotateCarousel();
    });
});

// Animasi Manfaat di menu training
document.addEventListener("DOMContentLoaded", () => {
    // 1. Cari semua grid manfaat yang ada di halaman (bisa 1, 2, atau lebih)
    const benefitGrids = document.querySelectorAll(".short-benefit-grid");
    
    if (benefitGrids.length === 0) return;

    // 2. Loop setiap grid agar masing-masing punya dunianya sendiri-sendiri
    benefitGrids.forEach((grid) => {
        const benefitCards = grid.querySelectorAll("article");
        if (benefitCards.length === 0) return;

        let currentActiveIndex = 0;
        const totalDuration = 25000; // Total 5 detik untuk satu putaran penuh per section
        const intervalTime = totalDuration / benefitCards.length; // 1250ms per kartu

        const playLoopingAnimation = () => {
            // Hapus kelas aktif HANYA pada kartu di dalam grid ini saja
            benefitCards.forEach(card => {
                card.classList.remove("is-active");
            });

            // Berikan kelas aktif ke kartu yang dapet giliran di grid ini
            benefitCards[currentActiveIndex].classList.add("is-active");

            // Naikkan index giliran
            currentActiveIndex = (currentActiveIndex + 1) % benefitCards.length;
        };

        // Jalankan inisialisasi awal untuk grid ini
        playLoopingAnimation();

        // Set interval looping khusus untuk grid ini secara mandiri (berbarengan)
        setInterval(playLoopingAnimation, intervalTime);
    });
});

// Animasi Manfaat Sertifikasi 
document.addEventListener("DOMContentLoaded", () => {
    // 1. Cari semua grid manfaat sertifikasi yang ada di halaman
    const certGrids = document.querySelectorAll(".certification-benefit-grid");
    
    if (certGrids.length === 0) return;

    // 2. Loop setiap grid agar masing-masing berjalan mandiri secara bersamaan
    certGrids.forEach((grid) => {
        const certCards = grid.querySelectorAll("article");
        if (certCards.length === 0) return;

        let currentActiveIndex = 0;
        const totalDuration = 25000; // Putaran penuh 5 detik
        const intervalTime = totalDuration / certCards.length; // 1250ms per kartu bergilir

        const playLoopingAnimation = () => {
            // Hapus kelas aktif HANYA pada kartu di dalam grid ini saja
            certCards.forEach(card => {
                card.classList.remove("is-active");
            });

            // Berikan kelas aktif ke kartu yang dapet giliran di grid ini
            certCards[currentActiveIndex].classList.add("is-active");

            // Naikkan index giliran (01 -> 02 -> 03 -> 04 -> balik ke 01)
            currentActiveIndex = (currentActiveIndex + 1) % certCards.length;
        };

        // Jalankan awal
        playLoopingAnimation();

        // Loop selamanya secara sinkron dan berbarengan antar section
        setInterval(playLoopingAnimation, intervalTime);
    });
});