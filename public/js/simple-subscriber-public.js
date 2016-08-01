(function( $ ) {
  'use strict';

  var options = {
    //target:   $('#feedback'),
    beforeSubmit: showRequest,
    success:  showResponse,
    error:    showError,
    url:      SSAjax.ajaxurl,
    data:     {
      signup_nonce: SSAjax.signup_nonce
    }
  }

  $('#ss_signup_form').ajaxForm( options );

  function showRequest(formData, jqForm, options) { 
    $('.newsletter-signup-section').html( '<div style="text-align:center"><svg class="nc-icon glyph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 48 48"> <g> <circle class="nc-ripples" fill="#444444" cx="24" cy="24" r="24" transform="translate(6.469157142385043 6.469157142385043) scale(0.7304517857339565)" style="opacity:0.8609035714679132;"></circle> </g> <script>function ripplesStep(t){startRipples||(startRipples=t);var e=t-startRipples,a=Math.min(e/800,1);800&gt;e||(startRipples+=800);if(circleRipples[0]){window.requestAnimationFrame(ripplesStep),scale=.3+5*a/7;if(.3+a&gt;1)(scale=.8+2*(a-.7)/3);scale=Math.min(scale,1),translateX=24*(1-scale),translateY=24*(1-scale),opacity=10*a/7;if(.3+a&gt;1)(opacity=Math.max(1-10/3*(a-.7),0));for(j = 0; circleRipplesNumber &gt; j ; j++){circleRipples[j].setAttribute("transform","translate("+translateX+" "+translateY+") scale("+scale+")"),circleRipples[j].setAttribute("style","opacity:"+opacity+";")}}}!function(){var t=0;window.requestAnimationFrame||(window.requestAnimationFrame=function(e){var a=(new Date).getTime(),n=Math.max(0,16-(a-t)),r=window.setTimeout(function(){e(a+n)},n);return t=a+n,r})}();var circleRipples=document.getElementsByClassName("nc-ripples"),startRipples=null,circleRipplesNumber = circleRipples.length;window.requestAnimationFrame(ripplesStep);</script> </svg></div>' );
  }

  function showResponse(responseText, statusText, xhr, $form)  { 
    setTimeout(function () {
      $('.newsletter-signup-section').hide().html( '<p class="signup-notice success">Thank you. You have signed up to receive a quarterly newsletter with general news and updates from NTB Capital.</p>' ).fadeIn()
    }, 2000);
  }

  function showError(request, textStatus, errorThrown) {
    setTimeout(function () {
      $('.newsletter-signup-section').hide().html( '<p class="signup-notice failure">There was a problem signing up, please contact us and we\'ll get things sorted.<br><a title="Contact" class="btn btn-secondary" href="#" data-toggle="modal" data-target=".contact-modal">Contact</a></p>' ).fadeIn()
    }, 2000);
  }

})( jQuery );
