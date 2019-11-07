let slider = document.querySelector('.glide');

if (slider) {
  var glide = new Glide(slider, {
    type: 'carousel',
    startAt: 0,
    perView: 6,
    breakpoints: {
        1024: {
          perView: 4
        },
        600: {
          perView: 3
        },
        480: {
            perView: 2
        }

    },
    //peek: 100
  });

  glide.mount();
}