<?php
/**
 * Image Gallery Component.
 *
 * Renders a responsive image gallery with lightbox functionality
 *
 * @param array $images Array of image data with 'src', 'alt', 'title', 'caption'
 * @param string $id Gallery ID
 * @param string $layout Gallery layout (grid, masonry, carousel)
 * @param int $columns Number of columns for grid layout
 * @param bool $lightbox Whether to enable lightbox
 * @param bool $lazyLoad Whether to enable lazy loading
 * @param string $aspectRatio Aspect ratio for images (16:9, 4:3, 1:1, auto)
 * @param bool $showCaptions Whether to show image captions
 * @param bool $showThumbnails Whether to show thumbnail navigation
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 */

// Default values
$images = $images ?? [];
$id = $id ?? 'gallery_' . uniqid();
$layout = $layout ?? 'grid';
$columns = $columns ?? 3;
$lightbox = $lightbox ?? true;
$lazyLoad = $lazyLoad ?? true;
$aspectRatio = $aspectRatio ?? '16:9';
$showCaptions = $showCaptions ?? true;
$showThumbnails = $showThumbnails ?? false;
$class = $class ?? '';
$attributes = $attributes ?? [];

// Layout classes
$layoutClasses = [
    'grid' => 'gallery-grid',
    'masonry' => 'gallery-masonry',
    'carousel' => 'gallery-carousel',
];

// Aspect ratio classes
$aspectRatioClasses = [
    '16:9' => 'aspect-ratio-16-9',
    '4:3' => 'aspect-ratio-4-3',
    '1:1' => 'aspect-ratio-1-1',
    'auto' => 'aspect-ratio-auto',
];

// Build attributes
$galleryAttributes = array_merge([
    'id' => $id,
    'class' => 'image-gallery ' . $layoutClasses[$layout] . ' ' . $aspectRatioClasses[$aspectRatio] . ' ' . $class,
    'data-lightbox' => $lightbox ? 'true' : 'false',
    'data-lazy-load' => $lazyLoad ? 'true' : 'false',
], $attributes);

// Convert attributes array to string
$galleryAttributesString = '';
foreach ($galleryAttributes as $key => $val) {
    if (is_bool($val)) {
        if ($val) {
            $galleryAttributesString .= ' ' . $key;
        }
    } else {
        $galleryAttributesString .= ' ' . $key . '="' . esc($val) . '"';
    }
}
?>

<div<?= $galleryAttributesString ?>>
    <?php if ($layout === 'grid'): ?>
        <div class="gallery-grid-container" style="--columns: <?= $columns ?>;">
            <?php foreach ($images as $index => $image): ?>
                <div class="gallery-item">
                    <div class="gallery-image-wrapper">
                        <?php if ($lazyLoad): ?>
                            <img data-src="<?= esc($image['src']) ?>"
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                                 alt="<?= esc($image['alt'] ?? '') ?>"
                                 title="<?= esc($image['title'] ?? '') ?>"
                                 class="gallery-image lazy-load"
                                 loading="lazy">
                        <?php else: ?>
                            <img src="<?= esc($image['src']) ?>"
                                 alt="<?= esc($image['alt'] ?? '') ?>"
                                 title="<?= esc($image['title'] ?? '') ?>"
                                 class="gallery-image">
                        <?php endif; ?>
                        
                        <?php if ($lightbox): ?>
                            <div class="gallery-overlay">
                                <button class="gallery-zoom-btn" data-index="<?= $index ?>">
                                    <i class="ti ti-zoom-in"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($showCaptions && !empty($image['caption'])): ?>
                        <div class="gallery-caption">
                            <?= esc($image['caption']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.image-gallery {
    width: 100%;
}

/* Grid Layout */
.gallery-grid-container {
    display: grid;
    grid-template-columns: repeat(var(--columns), 1fr);
    gap: 1rem;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 0.5rem;
    background-color: #f8f9fa;
}

.gallery-image-wrapper {
    position: relative;
    overflow: hidden;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-image:hover {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-zoom-btn {
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    width: 3rem;
    height: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-zoom-btn:hover {
    background: #fff;
    transform: scale(1.1);
}

.gallery-caption {
    padding: 0.75rem;
    background: #fff;
    font-size: 0.875rem;
    color: #6c757d;
}

/* Aspect Ratios */
.aspect-ratio-16-9 .gallery-image-wrapper {
    aspect-ratio: 16 / 9;
}

.aspect-ratio-4-3 .gallery-image-wrapper {
    aspect-ratio: 4 / 3;
}

.aspect-ratio-1-1 .gallery-image-wrapper {
    aspect-ratio: 1 / 1;
}

.aspect-ratio-auto .gallery-image-wrapper {
    aspect-ratio: auto;
}

/* Responsive */
@media (max-width: 768px) {
    .gallery-grid-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .gallery-grid-container {
        grid-template-columns: 1fr;
    }
}

/* Dark theme support */
[data-pc-theme="dark"] .gallery-item {
    background-color: #2a2a2a;
}

[data-pc-theme="dark"] .gallery-caption {
    background: #2a2a2a;
    color: #e9ecef;
}

/* Animation */
.gallery-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gallery-item:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

/* Accessibility */
.gallery-zoom-btn:focus {
    outline: 2px solid #0d6efd;
    outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleries = document.querySelectorAll('.image-gallery');
    
    galleries.forEach(gallery => {
        const lightboxEnabled = gallery.getAttribute('data-lightbox') === 'true';
        const lazyLoadEnabled = gallery.getAttribute('data-lazy-load') === 'true';
        
        // Initialize lazy loading
        if (lazyLoadEnabled) {
            initLazyLoading(gallery);
        }
        
        // Initialize lightbox
        if (lightboxEnabled) {
            initLightbox(gallery);
        }
    });
    
    function initLazyLoading(gallery) {
        const lazyImages = gallery.querySelectorAll('.lazy-load');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.getAttribute('data-src');
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });
            
            lazyImages.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback for older browsers
            lazyImages.forEach(img => {
                img.src = img.getAttribute('data-src');
                img.classList.add('loaded');
            });
        }
    }
    
    function initLightbox(gallery) {
        const images = Array.from(gallery.querySelectorAll('.gallery-image')).map(img => ({
            src: img.src || img.getAttribute('data-src'),
            alt: img.alt,
            caption: img.closest('.gallery-item').querySelector('.gallery-caption')?.textContent || ''
        }));
        
        let currentIndex = 0;
        
        // Open lightbox
        gallery.addEventListener('click', (e) => {
            const zoomBtn = e.target.closest('.gallery-zoom-btn');
            if (zoomBtn) {
                currentIndex = parseInt(zoomBtn.getAttribute('data-index'));
                openLightbox();
            }
        });
        
        function openLightbox() {
            // Simple lightbox implementation
            const lightbox = document.createElement('div');
            lightbox.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                cursor: pointer;
            `;
            
            const img = document.createElement('img');
            img.src = images[currentIndex].src;
            img.alt = images[currentIndex].alt;
            img.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
            `;
            
            lightbox.appendChild(img);
            document.body.appendChild(lightbox);
            
            // Close on click
            lightbox.addEventListener('click', () => {
                document.body.removeChild(lightbox);
            });
        }
    }
});
</script>
