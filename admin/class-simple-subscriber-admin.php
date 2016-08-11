<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       jeffseedesigns.com
 * @since      1.0.0
 *
 * @package    Simple_Subscriber
 * @subpackage Simple_Subscriber/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Subscriber
 * @subpackage Simple_Subscriber/admin
 * @author     Jeff See <jeffsee.55@gmail.com>
 */
class Simple_Subscriber_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

    $this->load_dependencies();
  }

  private function load_dependencies() {
  }

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-subscriber-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-subscriber-admin.js', array( 'jquery' ), $this->version, false );

	}

  public function setup_admin_ui() {
		// function add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null ) {
		add_menu_page(
			'Investors',
			'Investors',
			'manage_options',
			'investors',
			array( $this, 'render_investor_options_page' )
		);

		// function add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' ) {
		add_submenu_page(
      'investors',
			'Add Investor',
			'Add Investor',
			'manage_options',
			'add-investor',
			array( $this, 'render_investor_add_page' )
		);

		add_submenu_page(
      'investors',
			'Edit Investor',
			'Edit Investor',
			'manage_options',
			'edit-investor',
			array( $this, 'render_investor_edit_page' )
		);

		add_submenu_page(
      'investors',
			'Newsletter Subscribers',
			'Newsletter Subscribers',
			'manage_options',
			'newsletter-subscribers',
			array( $this, 'render_subscribers_page' )
		);

  }

  public function render_investors_page() {
    include(  plugin_dir_path( __FILE__ ) . 'partials/simple-subscriber-admin-investors-page.php' );
  }

  public function render_subscribers_page() {
    include(  plugin_dir_path( __FILE__ ) . 'partials/simple-subscriber-admin-subscribers-page.php' );
  }

  public function render_investor_options_page() {
    include(  plugin_dir_path( __FILE__ ) . 'partials/simple-subscriber-admin-options-page.php' );
  }

  public function render_investor_add_page() {
    include(  plugin_dir_path( __FILE__ ) . 'partials/simple-subscriber-admin-add-investor-page.php' );
  }

  public function render_investor_edit_page() {
    include(  plugin_dir_path( __FILE__ ) . 'partials/simple-subscriber-admin-edit-investor-page.php' );
  }
}
