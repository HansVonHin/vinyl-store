// Navbar and profile menu toggle
let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () => {
   navbar.classList.toggle('active');
   profile.classList.remove('active');
};

document.querySelector('#user-btn').onclick = () => {
   profile.classList.toggle('active');
   navbar.classList.remove('active');
};

window.onscroll = () => {
   navbar.classList.remove('active');
   profile.classList.remove('active');
};

// Ensure the profile menu is hidden initially
document.addEventListener("DOMContentLoaded", function() {
   profile.classList.remove('active');
});

// Image gallery for quick view
let mainImage = document.querySelector('.quick-view .box .row .image-container .main-image img');
let subImages = document.querySelectorAll('.quick-view .box .row .image-container .sub-image img');

subImages.forEach(image => {
   image.onclick = () => {
      let src = image.getAttribute('src');
      mainImage.src = src;
   };
});

// Initialize Swiper for reviews slider
var swiper = new Swiper(".reviews-slider", {
   loop: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
   breakpoints: {
      0: {
         slidesPerView: 1,
      },
      768: {
         slidesPerView: 2,
      },
      991: {
         slidesPerView: 3,
      },
   },
});

// JavaScript to hide the logo on scroll
let logoSection = document.querySelector('.top-section');
let lastScrollTop = 0;

window.addEventListener('scroll', () => {
    let scrollTop = window.scrollY || document.documentElement.scrollTop;
    
    if (scrollTop > lastScrollTop && scrollTop > 100) {
        // Scrolling down and past 100px, hide the logo
        logoSection.classList.add('hidden');
    } else if (scrollTop < lastScrollTop || scrollTop <= 100) {
        // Scrolling up or near the top of the page, show the logo
        logoSection.classList.remove('hidden');
    }
    
    lastScrollTop = scrollTop;
});
