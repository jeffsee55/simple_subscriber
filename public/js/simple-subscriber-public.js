(function( $ ) {
  'use strict';

  $('#subscriber_signup_form').submit(ajaxSubmit);

  function ajaxSubmit(){

    var newCustomerForm = $(this).serialize();

    $.ajax({
    type:"POST",
    url: "/wp-admin/admin-ajax.php",
    data: newCustomerForm,
    success:function(data){
    jQuery("#feedback").html(data);
    }
    });

    return false;
  }

})( jQuery );
