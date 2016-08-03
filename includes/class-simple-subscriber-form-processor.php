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
    if ( ! wp_verify_nonce( $nonce, 'ss-ajax-create-nonce' ) ) {
      header('HTTP/1.0 404 Not Found', true, 404);
      die ( 'Busted!');
    }

    $email = $_POST['subscriber_email'];
    $email_list = get_site_option( 'ss_email_list', array() );
    $email_list[] = $email;

    if( update_site_option( 'ss_email_list', array_unique( $email_list ) ) ) :
      header('HTTP/1.0 200 Success', true, 200);
    else :
      header('HTTP/1.0 404 Not Found', true, 404);
    endif;

    exit;
  }

  public function process_profile_form() {
    // $nonce = $_POST['signup_nonce'];
    // if ( ! wp_verify_nonce( $nonce, 'ss-ajax-create-nonce' ) ) {
    //   header('HTTP/1.0 404 Not Found', true, 404);
    //   die ( 'Busted!');
    // }

    $this->ajax_password( 200, $response );
    $userdata = array(
      'ID'    => get_current_user_id(),
    );

    if( isset( $_POST['email'] ) )
      $userdata['user_email'] = esc_attr( $_POST['email'] );
    if( isset( $_POST['first_name'] ) )
      $userdata['first_name'] = $_POST['first_name'];
    if( isset( $_POST['last_name'] ) )
      $userdata['last_name'] = $_POST['last_name'];

    if( $_POST['password'] == $_POST['password_confirm'] ) {
      $userdata['user_pass'] = $_POST['password'];
      // sign in again
      $this->sign_in( $userdata );
      $response = "Success";
      $this->ajax_password( 200, $response );
    } else {
      $response = "Passwords do not match";
      $this->ajax_password( 400, $response );
    }

    $user_id = wp_update_user( $userdata );
    if( is_wp_error( $user_id ) ) {
      $response = 'There was a problem updating your profile';
      $this->ajax_password( 400, $response );
    } else {
      $response = 'Success';
      $this->ajax_password( 200, $response );
    }

    $meta_keys = array(
      'phone',
    );

    foreach( $meta_keys as $key ) {
      update_user_meta( $userdata['user_id'], $key, $_POST[$key] );
    }
    $this->ajax_response( 200, 'Success' );
  }

  private function sign_in( $userdata ) {
  	$userdata['remember'] = true;
  	$user = wp_signon( $userdata, false );
  	if ( is_wp_error($user) ) {
      $response = "Passwords not reset";
      $this->ajax_password( 400, $response );
    }
  }

  private function ajax_response( $status, $response ) {
    echo $response;
    if( $status == 400 ) :
      header('HTTP/1.0 400 Input Error', true, 400);
    else :
      header('HTTP/1.0 200 Success', true, 200);
    endif;
    exit;
  }
}
