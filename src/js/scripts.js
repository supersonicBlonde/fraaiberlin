/*

@package fraaiberlin


*/

console.log('loaded-slick');


jQuery(function($){ 

     /* var element = $('.clear-selection').detach();
    $( ".filter-title" ).wrap( "<div class='filter-title-container d-flex align-items-center justify-content-between'></div>" );
    element.insertAfter($('.filter-title')).show();  */
   
});

function mobileOnlySlider() {
  $('.woocommerce-product-gallery__container').slick({
  autoplay: true,
  speed: 1000,
  autoplaySpeed: 1000
  });
  }

  if(window.innerWidth < 992) {
    mobileOnlySlider();
  }

  $(window).resize(function(e){
    if(window.innerWidth < 992) {
        if(!$('.woocommerce-product-gallery__container').hasClass('slick-initialized')){
            mobileOnlySlider();
        }

    }else{
        if($('.woocommerce-product-gallery__container').hasClass('slick-initialized')){
            $('.woocommerce-product-gallery__container').slick('unslick');
        }
    }
});

