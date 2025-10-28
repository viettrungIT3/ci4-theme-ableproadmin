<?php
/**
 * Carousel Component.
 *
 * Renders a responsive carousel with slides, indicators, and controls
 *
 * @param array $slides Array of slide data with 'image', 'title', 'content', 'link'
 * @param string $id Carousel ID
 * @param bool $indicators Whether to show slide indicators
 * @param bool $controls Whether to show navigation controls
 * @param bool $autoplay Whether to enable autoplay
 * @param int $interval Autoplay interval in milliseconds
 * @param bool $pauseOnHover Whether to pause on hover
 * @param string $variant Carousel variant (default, fade, slide)
 * @param string $height Carousel height (auto, fixed, fullscreen)
 * @param string $class Additional CSS classes
 * @param array $attributes Additional HTML attributes
 */

// Default values
$slides = $slides ?? [];
$id = $id ?? 'carousel_' . uniqid();
$indicators = $indicators ?? true;
$controls = $controls ?? true;
$autoplay = $autoplay ?? false;
$interval = $interval ?? 5000;
$pauseOnHover = $pauseOnHover ?? true;
$variant = $variant ?? 'default';
$height = $height ?? 'auto';
$class = $class ?? '';
$attributes = $attributes ?? [];

// Height classes
$heightClasses = [
    'auto' => '',
    'fixed' => 'carousel-fixed-height',
    'fullscreen' => 'carousel-fullscreen',
];

// Variant classes
$variantClasses = [
    'default' => '',
    'fade' => 'carousel-fade',
    'slide' => '',
];

// Build attributes
$carouselAttributes = array_merge([
    'id' => $id,
    'class' => 'carousel slide ' . $variantClasses[$variant] . ' ' . $heightClasses[$height] . ' ' . $class,
    'data-bs-ride' => $autoplay ? 'carousel' : 'false',
    'data-bs-interval' => $autoplay ? $interval : 'false',
    'data-bs-pause' => $pauseOnHover ? 'hover' : 'false',
], $attributes);

// Convert attributes array to string
$carouselAttributesString = '';
foreach ($carouselAttributes as $key => $val) {
    if (is_bool($val)) {
        if ($val) {
            $carouselAttributesString .= ' ' . $key;
        }
    } else {
        $carouselAttributesString .= ' ' . $key . '="' . esc($val) . '"';
    }
}
?>

<div<?= $carouselAttributesString ?>>
    <?php if ($indicators && count($slides) > 1): ?>
        <div class="carousel-indicators">
            <?php foreach ($slides as $index => $slide): ?>
                <button type="button"
                        data-bs-target="#<?= esc($id) ?>"
                        data-bs-slide-to="<?= $index ?>"
                        <?= $index === 0 ? 'class="active" aria-current="true"' : '' ?>
                        aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="carousel-inner">
        <?php foreach ($slides as $index => $slide): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <?php if (!empty($slide['image'])): ?>
                    <img src="<?= esc($slide['image']) ?>"
                         class="d-block w-100"
                         alt="<?= esc($slide['title'] ?? 'Slide ' . ($index + 1)) ?>">
                <?php endif; ?>
                
                <?php if (!empty($slide['title']) || !empty($slide['content'])): ?>
                    <div class="carousel-caption d-none d-md-block">
                        <?php if (!empty($slide['title'])): ?>
                            <h5><?= esc($slide['title']) ?></h5>
                        <?php endif; ?>
                        <?php if (!empty($slide['content'])): ?>
                            <p><?= esc($slide['content']) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($slide['link'])): ?>
                            <a href="<?= esc($slide['link']['url']) ?>" 
                               class="btn <?= esc($slide['link']['class'] ?? 'btn-primary') ?>">
                                <?= esc($slide['link']['text'] ?? 'Learn More') ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($controls && count($slides) > 1): ?>
        <button class="carousel-control-prev" type="button" data-bs-target="#<?= esc($id) ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#<?= esc($id) ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    <?php endif; ?>
</div>

<style>
.carousel {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carousel-inner {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carousel-item {
    position: relative;
    display: none;
    float: left;
    width: 100%;
    margin-right: -100%;
    backface-visibility: hidden;
    transition: transform 0.6s ease-in-out;
}

.carousel-item.active,
.carousel-item-next,
.carousel-item-prev {
    display: block;
}

.carousel-item-next:not(.carousel-item-start),
.active.carousel-item-end {
    transform: translateX(100%);
}

.carousel-item-prev:not(.carousel-item-end),
.active.carousel-item-start {
    transform: translateX(-100%);
}

.carousel-fade .carousel-item {
    opacity: 0;
    transition-property: opacity;
    transform: none;
}

.carousel-fade .carousel-item.active,
.carousel-fade .carousel-item-next.carousel-item-start,
.carousel-fade .carousel-item-prev.carousel-item-end {
    z-index: 1;
    opacity: 1;
}

.carousel-fade .active.carousel-item-start,
.carousel-fade .active.carousel-item-end {
    z-index: 0;
    opacity: 0;
    transition: opacity 0s 0.6s;
}

.carousel-indicators {
    position: absolute;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 2;
    display: flex;
    justify-content: center;
    padding: 0;
    margin-right: 15%;
    margin-bottom: 1rem;
    margin-left: 15%;
    list-style: none;
}

.carousel-indicators [data-bs-target] {
    box-sizing: content-box;
    flex: 0 1 auto;
    width: 30px;
    height: 3px;
    padding: 0;
    margin-right: 3px;
    margin-left: 3px;
    text-indent: -999px;
    cursor: pointer;
    background-color: #fff;
    background-clip: padding-box;
    border: 0;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    opacity: 0.5;
    transition: opacity 0.6s ease;
}

.carousel-indicators .active {
    opacity: 1;
}

.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 0;
    bottom: 0;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 15%;
    padding: 0;
    color: #fff;
    text-align: center;
    background: none;
    border: 0;
    opacity: 0.5;
    transition: opacity 0.15s ease;
}

.carousel-control-prev:hover,
.carousel-control-prev:focus,
.carousel-control-next:hover,
.carousel-control-next:focus {
    color: #fff;
    text-decoration: none;
    outline: 0;
    opacity: 0.9;
}

.carousel-control-prev {
    left: 0;
}

.carousel-control-next {
    right: 0;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    background-repeat: no-repeat;
    background-position: 50%;
    background-size: 100% 100%;
}

.carousel-control-prev-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
}

.carousel-control-next-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

.carousel-caption {
    position: absolute;
    right: 15%;
    bottom: 1.25rem;
    left: 15%;
    padding-top: 1.25rem;
    padding-bottom: 1.25rem;
    color: #fff;
    text-align: center;
}

.carousel-caption h5 {
    margin-bottom: 0.5rem;
    font-size: 1.25rem;
    font-weight: 500;
}

.carousel-caption p {
    margin-bottom: 1rem;
    font-size: 1rem;
    opacity: 0.9;
}

/* Height variations */
.carousel-fixed-height {
    height: 400px;
}

.carousel-fixed-height .carousel-inner,
.carousel-fixed-height .carousel-item {
    height: 100%;
}

.carousel-fixed-height .carousel-item img {
    height: 100%;
    object-fit: cover;
}

.carousel-fullscreen {
    height: 100vh;
}

.carousel-fullscreen .carousel-inner,
.carousel-fullscreen .carousel-item {
    height: 100%;
}

.carousel-fullscreen .carousel-item img {
    height: 100%;
    object-fit: cover;
}

/* Responsive */
@media (max-width: 768px) {
    .carousel-caption {
        right: 10%;
        left: 10%;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
    
    .carousel-caption h5 {
        font-size: 1rem;
    }
    
    .carousel-caption p {
        font-size: 0.875rem;
    }
    
    .carousel-indicators {
        margin-right: 10%;
        margin-left: 10%;
    }
    
    .carousel-indicators [data-bs-target] {
        width: 20px;
        height: 2px;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 10%;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 1.5rem;
        height: 1.5rem;
    }
}

/* Dark theme support */
[data-pc-theme="dark"] .carousel-indicators [data-bs-target] {
    background-color: rgba(255, 255, 255, 0.5);
}

[data-pc-theme="dark"] .carousel-indicators .active {
    background-color: #fff;
}

[data-pc-theme="dark"] .carousel-control-prev,
[data-pc-theme="dark"] .carousel-control-next {
    color: #fff;
}

/* Animation improvements */
.carousel-item {
    transition: transform 0.6s ease-in-out;
}

.carousel-fade .carousel-item {
    transition: opacity 0.6s ease-in-out;
}

/* Accessibility */
.carousel-control-prev:focus,
.carousel-control-next:focus {
    outline: 2px solid #0d6efd;
    outline-offset: 2px;
}

.carousel-indicators [data-bs-target]:focus {
    outline: 2px solid #0d6efd;
    outline-offset: 2px;
}

/* Touch support */
.carousel {
    touch-action: pan-y;
}

.carousel-inner {
    touch-action: pan-y;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('.carousel');
    
    carousels.forEach(carousel => {
        const autoplay = carousel.getAttribute('data-bs-ride') === 'carousel';
        const interval = parseInt(carousel.getAttribute('data-bs-interval')) || 5000;
        const pauseOnHover = carousel.getAttribute('data-bs-pause') === 'hover';
        
        let autoplayInterval;
        let isPaused = false;
        
        // Initialize carousel
        initCarousel();
        
        function initCarousel() {
            const items = carousel.querySelectorAll('.carousel-item');
            const indicators = carousel.querySelectorAll('.carousel-indicators [data-bs-target]');
            const prevBtn = carousel.querySelector('.carousel-control-prev');
            const nextBtn = carousel.querySelector('.carousel-control-next');
            
            let currentIndex = 0;
            const totalItems = items.length;
            
            if (totalItems === 0) return;
            
            // Show first item
            showSlide(0);
            
            // Indicator click handlers
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentIndex = index;
                    showSlide(currentIndex);
                    resetAutoplay();
                });
            });
            
            // Previous button handler
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                    showSlide(currentIndex);
                    resetAutoplay();
                });
            }
            
            // Next button handler
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % totalItems;
                    showSlide(currentIndex);
                    resetAutoplay();
                });
            }
            
            // Keyboard navigation
            carousel.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                    showSlide(currentIndex);
                    resetAutoplay();
                } else if (e.key === 'ArrowRight') {
                    currentIndex = (currentIndex + 1) % totalItems;
                    showSlide(currentIndex);
                    resetAutoplay();
                }
            });
            
            // Touch/swipe support
            let startX = 0;
            let endX = 0;
            
            carousel.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });
            
            carousel.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            });
            
            function handleSwipe() {
                const threshold = 50;
                const diff = startX - endX;
                
                if (Math.abs(diff) > threshold) {
                    if (diff > 0) {
                        // Swipe left - next slide
                        currentIndex = (currentIndex + 1) % totalItems;
                    } else {
                        // Swipe right - previous slide
                        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                    }
                    showSlide(currentIndex);
                    resetAutoplay();
                }
            }
            
            // Pause on hover
            if (pauseOnHover) {
                carousel.addEventListener('mouseenter', pauseAutoplay);
                carousel.addEventListener('mouseleave', resumeAutoplay);
            }
            
            // Start autoplay
            if (autoplay) {
                startAutoplay();
            }
            
            function showSlide(index) {
                // Hide all items
                items.forEach(item => item.classList.remove('active'));
                indicators.forEach(indicator => indicator.classList.remove('active'));
                
                // Show current item
                if (items[index]) {
                    items[index].classList.add('active');
                }
                if (indicators[index]) {
                    indicators[index].classList.add('active');
                    indicators[index].setAttribute('aria-current', 'true');
                }
                
                // Update aria attributes
                items.forEach((item, i) => {
                    item.setAttribute('aria-hidden', i === index ? 'false' : 'true');
                });
            }
            
            function startAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                }
                
                autoplayInterval = setInterval(() => {
                    if (!isPaused) {
                        currentIndex = (currentIndex + 1) % totalItems;
                        showSlide(currentIndex);
                    }
                }, interval);
            }
            
            function pauseAutoplay() {
                isPaused = true;
            }
            
            function resumeAutoplay() {
                isPaused = false;
            }
            
            function resetAutoplay() {
                if (autoplay) {
                    startAutoplay();
                }
            }
            
            // Make carousel focusable
            carousel.setAttribute('tabindex', '0');
        }
    });
});
</script>
