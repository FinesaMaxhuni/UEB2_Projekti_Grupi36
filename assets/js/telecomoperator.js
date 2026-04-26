document.addEventListener('DOMContentLoaded', () => {
  const slides = Array.from(document.querySelectorAll('.carousel-slide'));
  const dots = Array.from(document.querySelectorAll('.carousel-dots .dot'));
  const slideInterval = 4000;
  let currentSlide = 0;
  let autoRotate = null;

  function showSlide(index) {
    if (!slides.length || !dots.length) return;

    currentSlide = (index + slides.length) % slides.length;

    slides.forEach((slide, slideIndex) => {
      slide.classList.toggle('active', slideIndex === currentSlide);
    });

    dots.forEach((dot, dotIndex) => {
      dot.classList.toggle('active', dotIndex === currentSlide);
    });
  }

  function startCarousel() {
    if (slides.length < 2 || dots.length < 2) return;

    clearInterval(autoRotate);
    autoRotate = setInterval(() => {
      showSlide(currentSlide + 1);
    }, slideInterval);
  }

  dots.forEach((dot, index) => {
    dot.type = 'button';
    dot.addEventListener('click', () => {
      showSlide(index);
      startCarousel();
    });
  });

  showSlide(0);
  startCarousel();

  const statsSection = document.querySelector('.about-stats');

  if (statsSection) {
    const statsObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.querySelectorAll('.stat-number').forEach(stat => {
            animateCounter(stat, parseInt(stat.getAttribute('data-target'), 10));
          });
          statsObserver.unobserve(entry.target);
        }
      });
    }, {threshold: 0.5, rootMargin: '0px'});

    statsObserver.observe(statsSection);
  }
});

function animateCounter(element, target, duration = 2000) {
  const increment = target / (duration / 16);
  let current = 0;
  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      element.textContent = target.toLocaleString('en-US');
      clearInterval(timer);
    } else {
      element.textContent = Math.floor(current).toLocaleString('en-US');
    }
  }, 16);
}
