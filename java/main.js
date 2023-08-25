// Swipe slider
var swiper = new Swiper(".bg-slider-thumbs", {
    loop: true,
    spaceBetween: 0,
    slidesPerView: 0,
  });
  var swiper2 = new Swiper(".bg-slider", {
    loop: true,
    spaceBetween: 0,
    thumbs: {
      swiper: swiper,
    },
  });

// NAVIGATE THE EFFECTS ON SCROLL
window.addEventListener("scroll", function(){
  const header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY > 0);
});

