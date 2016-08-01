<?php

/**
* The public-facing functionality of the plugin.
*
* @link       jeffseedesigns.com
* @since      1.0.0
*
* @package    Simple_Subscriber
* @subpackage Simple_Subscriber/public
*/

/**
* The public-facing functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the admin-specific stylesheet and JavaScript.
*
* @package    Simple_Subscriber
* @subpackage Simple_Subscriber/public
* @author     Jeff See <jeffsee.55@gmail.com>
*/
class Simple_Subscriber_Public {

  /**
  * The ID of this plugin.
  *
  * @since    1.0.0
  * @access   private
  * @var      string    $plugin_name    The ID of this plugin.
  */
  private $plugin_name;

  /**
  * The version of this plugin.
  *
  * @since    1.0.0
  * @access   private
  * @var      string    $version    The current version of this plugin.
  */
  private $version;

  /**
  * Initialize the class and set its properties.
  *
  * @since    1.0.0
  * @param      string    $plugin_name       The name of the plugin.
  * @param      string    $version    The version of this plugin.
  */
  public function __construct( $plugin_name, $version ) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;

    $this->load_dependencies();
  }

  private function load_dependencies() {

    /**
    * The class responsible for defining all actions that occur in the public-facing
    * side of the site.
    */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-simple-subscriber-signup-widget.php';
  }

  /**
  * Register the stylesheets for the public-facing side of the site.
  *
  * @since    1.0.0
  */
  public function enqueue_styles() {

    /**
    * This function is provided for demonstration purposes only.
    *
    * An instance of this class should be passed to the run() function
    * defined in Simple_Subscriber_Loader as all of the hooks are defined
    * in that particular class.
    *
    * The Simple_Subscriber_Loader will then create the relationship
    * between the defined hooks and the functions defined in this
    * class.
    */

    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-subscriber-public.css', array(), $this->version, 'all' );

  }

  /**
  * Register the JavaScript for the public-facing side of the site.
  *
  * @since    1.0.0
  */
  public function enqueue_scripts() {

    /**
    * This function is provided for demonstration purposes only.
    *
    * An instance of this class should be passed to the run() function
    * defined in Simple_Subscriber_Loader as all of the hooks are defined
    * in that particular class.
    *
    * The Simple_Subscriber_Loader will then create the relationship
    * between the defined hooks and the functions defined in this
    * class.
    */

    // Enqueued script with localized data.
    wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-subscriber-public.js', array( 'jquery' ), $this->version, false );
    wp_localize_script( $this->plugin_name, 'simple_subscriber_vars', array(
        'button' => __('Sign Up', 'simple_subscriber')
      )
    );

  }

  public function register_widgets() {
    register_widget( 'Simple_Subscriber_Signup_Widget' );
  }

  public function sigin_user() {
  }

  public function register_user() {
  }

  public function authorize_user_for_query( $query ) {
    if( isset( $query->query['category_name'] ) ) {
      if( $query->query['category_name'] == 'investors' ) {
        exit( 'hi' );
      }
    }
  }

  public function authorize_user_for_post() {
    global $post;
    if( is_single() && $post->post_type == 'post' ) :
      $categories = wp_get_object_terms( $post->ID, 'category', array( 'fields' => 'slugs' )  );
      if( in_array( 'investors', $categories ) ) {
        $this->authorize();
      }
    endif;
  }

  private function authorize() {
    if( !is_user_logged_in() ) {
      wp_redirect( '/sign-in' );
    }
  }


  public function render_signin_form() {
    get_template_part();
  }

  public function render_signup_form() {
    get_template_part();
  }
}