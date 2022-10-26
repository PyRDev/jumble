/* Sliders pour page accueil */

document.addEventListener( 'DOMContentLoaded', function() {
    var slider1 = new Splide('#slider1', {
        type    : 'loop',
        autoplay: true,
    });
    slider1.mount();


   var slider2 = new Splide('#slider2', {
       type: 'loop',
       perPage: 3,
       perMove: 1,
       width: '80vw',
   });
   slider2.mount();

    var slider3 = new Splide('#slider3', {
        type: 'loop',
        perPage: 3,
        perMove: 1,
        width: '80vw',
    });
    slider3.mount();


} );


