/*

@package fraaiberlin


*/

console.log('loaded-filter');



jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
  // FILTER BY CATEGORY
  $('.category-filter').click(function(e){
      e.preventDefault();

      var button = $(this), 
        filter = button.data('filter'),
        data = {  
          'action': 'filter_by_category',
          'nonce' : ajax_var.check_nonce,
          'filter' : filter
        }; 

        $.ajax({
          type: "POST",
          dataType: 'json',
          url: ajax_var.url,
          data: data,
          success: function(response){
             
            $(".catalogue-container .row").html(response.data);
         
          },
          error : function(jqXHR, textStatus, errorThrown) {
              console.log('error')
          }
   
      });
      return false;
   
    });


  // CLEAR FILTER
  $('.clear').click(function(e){
    e.preventDefault();

    var button = $(this), 
      filter = button.data('filter'),
      data = {  
        'action': 'clear_filter',
        'nonce' : ajax_var.check_nonce,
        'filter' : filter
      }; 

      $.ajax({
        type: "POST",
        dataType: 'json',
        url: ajax_var.url,
        data: data,
        success: function(response){
           
          $(".catalogue-container .row").html(response.data);
       
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log('error')
        }
 
    });
    return false;
 
  });

  });



