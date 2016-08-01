<?php

/**
 * P
 *
 * @link       jeffseedesigns.com
 * @since      1.0.0
 *
 * @package    Simple_Subscriber
 * @subpackage Simple_Subscriber/admin
 */

class Simple_Subscriber_Form_Processor {

  public function process_signup_form() {
    $nonce = $_POST['signup_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'ss-ajax-create-nonce' ) )
      die ( 'Busted!');

    $email = $_POST['subscriber_email'];
    $email_list = get_site_option( 'ss_email_list', array() );
    $email_list[] = $email;

    update_site_option( 'ss_email_list', array_unique( $email_list ) );
    if( true ) :
      header('HTTP/1.0 200 Success', true, 200);
    else :
      header('HTTP/1.0 404 Not Found', true, 404);
    endif;

    // IMPORTANT: don't forget to "exit"
    exit;
  }
}
