 document.addEventListener('DOMContentLoaded', () => {
        const mainEl = document.getElementById('mainCarousel');
        const previewImg = document.getElementById('previewImg');
        const items = mainEl.querySelectorAll('.carousel-item');

        const getActiveIndex = () => {
            const activeItem = mainEl.querySelector('.carousel-item.active');
            return Array.from(items).indexOf(activeItem);
        };

        const updatePreview = () => {
            const activeIndex = getActiveIndex();
            const prevIndex = (activeIndex - 1 + items.length) % items.length;
            const newSrc = items[prevIndex].querySelector('img').src;

            // Preload new image
            const loader = new Image();
            loader.src = newSrc;

            loader.onload = () => {
                // Reset to top (off-screen) with low opacity
                previewImg.style.transition = 'none'; // Instant reset
                previewImg.style.transform = 'translateY(-100%)';
                previewImg.style.opacity = '1';

                // Force reflow to apply reset
                previewImg.offsetHeight;

                // Set new source
                previewImg.src = newSrc;

                // Enable transition and animate in
                previewImg.style.transition = 'transform 0.6s ease-in-out, opacity 0.6s ease-in-out';
                previewImg.style.transform = 'translateY(0)';
                previewImg.style.opacity = '1';
            };

            // If image already cached, run immediately
            if (loader.complete) {
                // Same reset + animate sequence
                previewImg.style.transition = 'none';
                previewImg.style.transform = 'translateY(-100%)';
                previewImg.style.opacity = '1';
                previewImg.offsetHeight;
                previewImg.src = newSrc;
                previewImg.style.transition = 'transform 0.6s ease-in-out, opacity 0.8s ease-in-out';
                previewImg.style.transform = 'translateY(0)';
                previewImg.style.opacity = '1';
            }
        };

        // Update + animate after every transition (next, prev, auto-cycle)
        mainEl.addEventListener('slid.bs.carousel', updatePreview);
    });