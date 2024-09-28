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

subImages.forEach(images => {
   image.onclick = () => {
      let src = image.getAttribute('src');
      mainImage.src = src;
   };
});

// Initialize Swiper for reviews slider
var swiper = new Swiper(".reviews-slider", {
   loop: true,
   spaceBetween: 20,
   autoplay: {
      delay: 3000, // 3 seconds delay between slides
      disableOnInteraction: false,
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

// Initialize Swiper for Promotional Deals
var promoSwiper = new Swiper(".home-slider", {
   loop: true,
   spaceBetween: 20,
   autoplay: {
      delay: 3000, // Adjust the delay as needed
      disableOnInteraction: false, // Keeps autoplay active after user interaction
   },
});

// Dropdown Menu Toggle for Categories Page
document.addEventListener('DOMContentLoaded', function() {
   const dropdownToggle = document.querySelector('.dropdown-toggle');
   const dropdownMenu = document.querySelector('.dropdown-menu');

   dropdownToggle.addEventListener('click', function(e) {
       e.preventDefault();
       dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
   });

   // Optionally close the dropdown if clicking outside of it
   document.addEventListener('click', function(e) {
       if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
           dropdownMenu.style.display = 'none';
       }
   });
});


    // Optional: Close the dropdown if clicking outside
    document.addEventListener('click', function(event) {
        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });

// Select the header and flex elements
const header = document.querySelector('.header');
const flex = document.querySelector('.flex');

// Variable to store the last scroll position
let lastScrollTop = 0;

window.addEventListener('scroll', () => {
   let scrollTop = window.scrollY || document.documentElement.scrollTop;

   if (scrollTop > lastScrollTop && scrollTop > 250) {
       // Scrolling down and past 250px, hide the header
       header.classList.add('hidden');
       flex.classList.add('visible');
   } else if (scrollTop < lastScrollTop && scrollTop <= 250) {
       // Scrolling up or near the top of the page, show the header
       header.classList.remove('hidden');
       flex.classList.remove('visible');
   }

   lastScrollTop = scrollTop;
});

document.addEventListener('DOMContentLoaded', () => {
   const categoryLinks = document.querySelectorAll('.category-link');

   categoryLinks.forEach(link => {
       link.addEventListener('click', (event) => {
           event.preventDefault();

           // Toggle the active class for the clicked link
           link.classList.toggle('active');

           // Get the corresponding sub-category list
           const subCategoryList = link.nextElementSibling;

           // Toggle the display of the sub-category list
           if (subCategoryList) {
               subCategoryList.style.display = subCategoryList.style.display === 'block' ? 'none' : 'block';
           }
       });
   });
});

document.addEventListener('DOMContentLoaded', () => {
   // Example: Implement sorting functionality
   const sortOptions = document.querySelectorAll('.genre-sidebar ul li a');
   sortOptions.forEach(option => {
       option.addEventListener('click', (e) => {
           e.preventDefault();
           const sortType = option.getAttribute('href').split('sort=')[1];
           sortProducts(sortType);
       });
   });

   function sortProducts(sortType) {
       // Implement sorting logic here based on the selected sortType
       console.log(`Sorting by: ${sortType}`);
   }
});

// Category sidebar slide-down on click animation
document.querySelectorAll('.category-link').forEach(link => {
   link.addEventListener('click', function(event) {
      event.preventDefault();
      const subMenu = this.nextElementSibling;
      const isActive = this.classList.contains('active');

      // Close all submenus
      document.querySelectorAll('.category-link').forEach(link => {
         link.classList.remove('active');
         if (link.nextElementSibling) {
            link.nextElementSibling.style.display = 'none';
         }
      });

      // Toggle the clicked submenu
      if (!isActive) {
         this.classList.add('active');
         subMenu.classList.add = 'block';
      }
   });
});

function togglePasswordVisibility() {
   var passwordField = document.getElementById('password');
   var eyeIcon = document.getElementById('eyeIcon');

   if (passwordField.type === "password") {
       passwordField.type = "text";
       eyeIcon.classList.remove("fa-eye");
       eyeIcon.classList.add("fa-eye-slash");
   } else {
       passwordField.type = "password";
       eyeIcon.classList.remove("fa-eye-slash");
       eyeIcon.classList.add("fa-eye");
   }
}
