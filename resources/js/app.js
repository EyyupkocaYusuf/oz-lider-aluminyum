const sliders = document.querySelectorAll('[data-about-slider]');

sliders.forEach((slider) => {
    const slides = [...slider.querySelectorAll('[data-about-slide]')];
    const dots = [...slider.querySelectorAll('[data-about-slider-dot]')];

    if (slides.length <= 1) {
        return;
    }

    let activeIndex = 0;
    let timer = null;

    const showSlide = (nextIndex) => {
        slides[activeIndex].classList.remove('is-active');
        if (dots[activeIndex]) {
            dots[activeIndex].classList.remove('is-active');
        }

        activeIndex = nextIndex;

        slides[activeIndex].classList.add('is-active');
        if (dots[activeIndex]) {
            dots[activeIndex].classList.add('is-active');
        }
    };

    const startAutoPlay = () => {
        window.clearInterval(timer);
        timer = window.setInterval(() => {
            showSlide((activeIndex + 1) % slides.length);
        }, 2000);
    };

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            startAutoPlay();
        });
    });

    startAutoPlay();
});

document.querySelectorAll('[data-image-upload]').forEach((zone) => {
    const input = zone.querySelector('input[type="file"]');
    const preview = zone.querySelector('[data-image-preview]');

    if (!input || !preview) {
        return;
    }

    const renderPreview = (file) => {
        if (!file || !file.type.startsWith('image/')) {
            return;
        }

        const reader = new FileReader();

        reader.onload = (event) => {
            preview.innerHTML = `
                <img src="${event.target.result}" alt="Önizleme" data-image-preview-img>
                <p class="admin-upload-zone__sub">Yeni görsel seçmek için tıklayın veya sürükleyin</p>
            `;
        };

        reader.readAsDataURL(file);
    };

    input.addEventListener('change', () => {
        renderPreview(input.files?.[0]);
    });

    zone.addEventListener('dragover', (event) => {
        event.preventDefault();
        zone.classList.add('is-dragover');
    });

    zone.addEventListener('dragleave', () => {
        zone.classList.remove('is-dragover');
    });

    zone.addEventListener('drop', (event) => {
        event.preventDefault();
        zone.classList.remove('is-dragover');

        const file = event.dataTransfer?.files?.[0];

        if (!file) {
            return;
        }

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        input.files = dataTransfer.files;
        renderPreview(file);
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const flash = window.__SITE_FLASH__;
    const host = document.getElementById('site-toast-host');

    if (!flash || !host) {
        return;
    }

    const showToast = (message, type = 'success') => {
        if (!message) {
            return;
        }

        const icon = type === 'error'
            ? `<svg viewBox="0 0 24 24" fill="none"><path d="M12 3.2 21.5 20.2H2.5L12 3.2Z" fill="#ef4444"/><path d="M12 9v5.2" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/><circle cx="12" cy="17.2" r="1.15" fill="#fff"/></svg>`
            : `<svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#22c55e"/><path d="M8 12.5 10.8 15.2 16.2 9.5" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

        const toast = document.createElement('div');
        toast.className = `admin-toast admin-toast--${type}`;
        toast.innerHTML = `
            <span class="admin-toast__icon" aria-hidden="true">${icon}</span>
            <span class="admin-toast__text">${String(message)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')}</span>
        `;
        host.appendChild(toast);
        requestAnimationFrame(() => toast.classList.add('is-visible'));
        window.setTimeout(() => {
            toast.classList.remove('is-visible');
            window.setTimeout(() => toast.remove(), 280);
        }, 4000);
    };

    showToast(flash.success, 'success');
    showToast(flash.error, 'error');
});
