han one slide
    }
});

// Product Slider
function moveSlide(button, direction) {
    const sliderContainer = button.closest('.slider');
    const slides = sliderContainer.querySelector('.slides');
    const totalSlides = sliderContainer.querySelectorAll('.slide').length;
    const slidesPerPage = 4;
    let currentSlide = sliderContainer.getAttribute('data-current-slide') || 0;
    currentSlide = parseInt(currentSlide);
    const maxSlide = Math.ceil(totalSlides / slidesPerPage) - 1;

    currentSlide = (currentSlide + direction + maxSlide + 1) % (maxSlide + 1);
    sliderContainer.setAttribute('data-current-slide', currentSlide);
    slides.style.transform = `translateX(-${currentSlide * 100}%)`;
}
</script>

<?php
include_once 'layouts/footer.php';
?>