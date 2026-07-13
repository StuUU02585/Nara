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
