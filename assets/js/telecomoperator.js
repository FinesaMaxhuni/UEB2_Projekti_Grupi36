// Carousel Auto-Rotation
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');
const dots = document.querySelectorAll('.carousel-dots .dot');
const slideInterval = 8000;

function showSlide(index) {
  slides.forEach(slide => slide.classList.remove('active'));
  dots.forEach(dot => dot.classList.remove('active'));
  slides[index].classList.add('active');
  dots[index].classList.add('active');
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

let autoRotate = setInterval(nextSlide, slideInterval);

// Manual navigation
dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    currentSlide = index;
    showSlide(currentSlide);
    clearInterval(autoRotate);
    autoRotate = setInterval(nextSlide, slideInterval);
  });
});

// Pause on hover
const carousel = document.querySelector('.offers-carousel');
carousel.addEventListener('mouseenter', () => clearInterval(autoRotate));
carousel.addEventListener('mouseleave', () => autoRotate = setInterval(nextSlide, slideInterval));

// Animated Counter for Stats
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

// Stats animation observer
const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.querySelectorAll('.stat-number').forEach(stat => {
        animateCounter(stat, parseInt(stat.getAttribute('data-target')));
      });
      statsObserver.unobserve(entry.target);
    }
  });
}, {threshold: 0.5, rootMargin: '0px'});

const statsSection = document.querySelector('.about-stats');
if (statsSection) statsObserver.observe(statsSection);
