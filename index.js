const parallaxes = document.getElementById('parallaxe');
const images = ['img/work1.jpeg', 'img/work3.webp', 'work5.webp'];
let index = 0;
console.log(parallaxes);

setInterval(() => {
    index = (index + 1) % images.length;
    parallaxes.style.backgroundImage = `url('${images[index]}')`;
}, 4000);


$(document).ready(function(){
  $('.team-carousel').owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    dots: false,
    autoplay: true,
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 2
      },
      992: {
        items: 3
      },
      1200: {
        items: 4
      }
    }
  });
});


