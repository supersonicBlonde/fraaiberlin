/*
	
@package gsc

*/
	console.log('load more');

jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
    $('.loadmore').click(function(e){
        
        e.preventDefault();
        console.log('click');

       var button = $(this), 
           total = button.data('max'),
           current = button.data('current'),
           data = {  
           'action': 'loadmoregeneric',
		   'page' : current,
           'max' : total,
           'nonce' : ajax_var.check_nonce,
         }; 

   
         $.ajax({
           type: "POST",
           dataType: "html",
           url: ajax_var.url, 
           data: data,
           beforeSend: setOverlay(true),
           success: function(data){
             
               if(data) { 
                   
                $(".product-catalogue-item__container").append(data);
                setOverlay(false);
                 ajax_var.current_page++;
                   button.attr("disabled",false);
                   let scrollPos = 12*current;
                   current = current + 1;
                   console.log(scrollPos+1);
                   let scrollItem = document.querySelector('.product-catalogue-item:nth-child('+scrollPos+')');
                   console.log(scrollItem);
                   scrollItem.scrollIntoView({block: "nearest"});
                   button.data('current' , current)
                   if(current == total) {
                   console.log('reached');
                       /* $('.loadmore').attr('disabled');
                       $('.loadmore').addClass('disabled'); */
                       button.hide();
                   } 
                    
               } else{
                   alert('You reached the end!');
                   button.hide();
               } 
           },
           error : function(jqXHR, textStatus, errorThrown) {
               console.log('error')
           }
   
       });
       return false;
   
     });

});


function setOverlay(state) {

    
     if(state === true) { 
        
      jQuery('.scale').addClass('scaleOut');
      jQuery('.scale').removeClass('scaleIn');
      jQuery('#overlay').addClass('show');
      jQuery('#overlay').removeClass('hide'); 
    }
    else {
        jQuery('#overlay').removeClass('show');
        jQuery('#overlay').addClass('hide');
        jQuery('.scale').addClass('scaleIn');
        jQuery('.scale').removeClass('scaleOut');
    }  
}
