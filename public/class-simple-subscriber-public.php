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

    wp_enqueue_script( 'jquery-form' );
    wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-subscriber-public.js', array( 'jquery' ), $this->version, true);
    wp_localize_script( $this->plugin_name, 'SSAjax', 
      array( 
        'ajaxurl'      => admin_url( 'admin-ajax.php' ) ,
        'signup_nonce' => wp_create_nonce( 'ss-ajax-create-nonce' ),
      ) 
    );
  }


  public function register_widgets() {
    register_widget( 'Simple_Subscriber_Signup_Widget' );
  }


  public function filter_private_categories( $query ) {
    $private_cat_ids = $this->get_private_cat_ids();
    if( $this->is_private_request( $query, $private_cat_ids ) ) {
      $this->authorize();
    } else {
      if( !is_admin() )
        $query->set( 'category__not_in', $private_cat_ids);
    }
  }


  public function authorize_user_for_query( $query ) {
    if( isset( $query->query['category_name'] ) ) {
      if( $query->query['category_name'] == 'investors' ) {
        $this->authorize();
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


  public function render_profile_page( $template ) {
    exit( var_dump( $template ) );
    // if is the profile page
    // return $this_get_template_hierarchy( 'page-profile' );
    // else
    // return $template
  }

  private function get_template_hierarchy( $template ) {
    // Get the template slug
    $template_slug = rtrim( $template, '.php' );
    $template = $template_slug . '.php';
 
    // Check if a custom template exists in the theme folder, if not, load the plugin template file
    if ( $theme_file = locate_template( array( 'plugin_template/' . $template ) ) ) {
      $file = $theme_file;
    }
    else {
      $file = plugin_dir_path( __FILE__ ) . '/partials/' . $template;
    }
 
    return apply_filters( 'rc_repl_template_' . $template, $file );
  }


  private function authorize() {
    if(! is_user_logged_in() ) {
      wp_redirect( '/sign-in?message=sign_in_required' );
      die();
    }
  }


  private function get_private_cat_ids() {
    $investor_cat_id    = get_category_by_slug( 'investors' )->cat_ID;
    $private_cat_ids    = get_term_children( $investor_cat_id, 'category' );
    $private_cat_ids[]  = $investor_cat_id;

    return $private_cat_ids;
  }


  private function is_private_request( $query, $private_cat_ids ) {
    if( empty( $query->query_vars['category_name'] ) )
      return false;

    $request_cat_object = get_category_by_slug( $query->query_vars['category_name'] );
    $request_cat_id     = $request_cat_object->cat_ID;

    if( in_array( $request_cat_id, $private_cat_ids ) ) {
      return true;
    } else {
      return false;
    }
  }
}
