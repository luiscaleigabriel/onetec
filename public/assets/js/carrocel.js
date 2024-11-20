/**
 * Swiper Slider
 */
var swiper = new Swiper(".mySwiper", {
  loop: true,
  spaceBetween: 10,

  navigation: {
    nextEl: '.btn-next',
  },

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 10,
    }
  },
});

var swiper1 = new Swiper(".mySwiperProduct", {
  loop: true,
  spaceBetween: 10,

  navigation: {
    nextEl: '.btn-next1',
    prevEl: '.btn-prev1',
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    600: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
});

const myloop1 = document.getElementById('btn-next');
const myloop2 = document.getElementById('btn-next1');
const myloop3 = document.getElementById('btn-next2');

setInterval(() => {
  if (myloop1) {
    myloop1.click();
    myloop2.click();
  }

  myloop3.click();
  
}, 10000);