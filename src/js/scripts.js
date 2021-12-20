/*

@package fraaiberlin


*/

console.log('loaded-slick');


jQuery(function($){ 
    $(".card-header button").click(function(e) {
        let button = e.target;
        button.classList.toggle("open");
    });
   
    $('.navbar .search-icon a').click(function(e) {
        e.preventDefault();
       
        $('.header-search-form-container').fadeIn().css('display' , 'flex');
      })
  
      $('.form-close').click(function(e) {
        e.preventDefault();
        $('.header-search-form-container').hide();
      
      })
  
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

