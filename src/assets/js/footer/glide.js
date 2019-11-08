let slider_nav = document.querySelector('.glide_nav');
if (slider_nav) {
  var glide_nav = new Glide(slider_nav, {
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
  glide_nav.mount();
}

let slider_profile = document.querySelector('.glide_profile');
if (slider_profile) {
  var glide_profile = new Glide(slider_profile, {
    type: 'carousel',
    startAt: 0,
    perView: 1,
  });
  glide_profile.mount();
}