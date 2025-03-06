
let list = document.querySelector('.slider .list');
let items = document.querySelectorAll('.slider .list .item');
let dots = document.querySelectorAll('.slider .dots li');
let prev = document.getElementById('prev');
let next = document.getElementById('next');

let active = 0;
let lengthitems = items.length - 1;
// alert('za');
if (next) {
  next.onclick = function() {
      if (active + 1 > lengthitems) {
          active = 0;
      } else {
          active = active + 1;
      }
      reloadslider();
  }
  let autoslide = setInterval(() => { next.click(); }, 3000);
}
if (prev) {
  prev.onclick = function() {
      if (active - 1 < 0) {
          active = lengthitems;
      } else {
          active = active - 1;
      }
      reloadslider();
  }
}

function reloadslider() {
    let checkleft = items[active].offsetLeft;
    list.style.left = -checkleft + 'px';

    let lastactiveDot = document.querySelector('.slider .dots li.active');
    if (lastactiveDot) lastactiveDot.classList.remove('active');
    dots[active].classList.add('active');
}
if (dots) {
  dots.forEach((li, key) => {
      li.addEventListener('click', function() {
          active = key;
          reloadslider();
      })
  })
}



// <!-- news-slider -->
    $(document).ready(function () {      
      // alert('za');
      
      // Run your JavaScript after Livewire updates the DOM
      const halalBox = document.querySelectorAll('.services');
      if (halalBox.length > 0) {
          halalBox.forEach(box => {
              box.style.display = 'block'; // Show the element
              //alert('Zaheer'); // Example alert
          });
      }
        
      $("#news-slider").owlCarousel({
        items: 3,
        margin: 0,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1000: {
            items: 3
          }
        }
      });
    });
//   <!-- JavaScript to handle the carousel navigation -->
        // JavaScript to handle the carousel navigation
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const track = document.querySelector('.carousel-track');
        const slides = document.querySelectorAll('.carousel-slide');
        const totalSlides = slides.length;
        let currentIndex = 0;

        // Function to move the carousel
        function moveToSlide(index) {
            const slideWidth = slides[0].offsetWidth + 20; // width of a slide including margin
            track.style.transform = `translateX(-${index * slideWidth}px)`;
        }
        if (prevBtn) {
        // Event listeners for buttons
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex === 0) ? totalSlides - 1 : currentIndex - 1;
            moveToSlide(currentIndex);
        });
      }
      if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex === totalSlides - 1) ? 0 : currentIndex + 1;
            moveToSlide(currentIndex);
        });
      }
      if (document.querySelector('.search-button')) {
          document.querySelector('.search-button').addEventListener('click', () => {
          const query = document.querySelector('.search-bar').value;
          alert(`You searched for: ${query}`);
        });
      }
    // Get elements
    const filterButton = document.getElementById("filterButton");
    const filterModal = document.getElementById("filterModal");
    const closeModal = document.getElementById("closeModal");
    
    // Open modal
    if (filterButton) {

      filterButton.addEventListener("click", () => {
        filterModal.style.display = "flex";
      });
    }
    if (closeModal) {  
      // Close modal
      closeModal.addEventListener("click", () => {
        filterModal.style.display = "none";
      });
    }    
    if (window) {

      // Close modal when clicking outside the content
      window.addEventListener("click", (event) => {
        if (event.target === filterModal) {
          filterModal.style.display = "none";
        }
      });
    }    
    document.addEventListener('livewire:init', () => {
      Livewire.on('selectWeight', (event) => {
            // document.addEventListener('livewire:load', function () {
      // Livewire.on('weightSelected', function (selectedWeight) {
        alert('z');
          selectWeight(selectedWeight);
      });
    });
    // function selectWeight(button) {
    //     document.querySelectorAll('.weight-options button').forEach(btn => btn.classList.remove('active'));
    //   button.classList.add('active');
    // }
    function updateQuantity(change) {
    // window.updateQuantity = function (change) {
      const quantityInput = document.getElementById('quantity');
      let quantity = parseInt(quantityInput.value) + change;
      if (quantity < 1) quantity = 1;
      quantityInput.value = quantity;
    }
  document.addEventListener('DOMContentLoaded', function() {
    // function selectWeight(button) {
    // window.selectWeight = function (button) {
    //   document.querySelectorAll('.weight-options button').forEach(btn => btn.classList.remove('active'));
    //   button.classList.add('active');
    // }
    // // function updateQuantity(change) {
    // window.updateQuantity = function (change) {
    //   const quantityInput = document.getElementById('quantity');
    //   let quantity = parseInt(quantityInput.value) + change;
    //   if (quantity < 1) quantity = 1;
    //   quantityInput.value = quantity;
    // }


    // function changeImage(src) {
    //   // document.getElementById("mainImg").src = src;
    //   const mainImage = document.getElementById('mainImg');
    //   if (mainImage) {
    //       mainImage.src = imageUrl;
    //   }
    // }
    // document.addEventListener('livewire:update', () => {
    window.changeImage = function (imageUrl) {
      // alert('call');
      const mainImage = document.getElementById('mainImg');
      if (mainImage) {
        // alert('calledd');
          mainImage.src = imageUrl;//`${imageUrl}?t=${new Date().getTime()}`;
      }
    };    
  });
    
  document.addEventListener("DOMContentLoaded", function () {
    const menu = document.getElementById('menu');
    const overlay = document.getElementById('overlay');
    const openMenuBtn = document.getElementById('openMenuBtn');
    const closeMenuBtn = document.getElementById('closeMenuBtn');

    // Function to open the menu and activate overlay
    if(openMenuBtn){
      openMenuBtn.addEventListener('click', function () {
        // alert('z');
        menu.classList.add('open');
        overlay.classList.add('active');
      });
    }
    // Function to close the menu and deactivate overlay
    if(closeMenuBtn){
      closeMenuBtn.addEventListener('click', function () {
        menu.classList.remove('open');
        overlay.classList.remove('active');
      });
    }

    // Close menu if overlay is clicked
    // overlay.addEventListener('click', function () {
    //   menu.classList.remove('open');
    //   overlay.classList.remove('active');
    // });

    const userIcon = document.getElementById("userIcon");
    const dropdownMenu = document.getElementById("dropdownMenu");
    if(userIcon){
      userIcon.addEventListener("click", function (e) {
          e.stopPropagation(); // Prevent click from propagating to document
          dropdownMenu.classList.toggle("show");
      });
    }
    if(dropdownMenu){
      // Close the dropdown when clicking outside
      document.addEventListener("click", function () {
          dropdownMenu.classList.remove("show");
      });
    }
  });

