<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       jeffseedesigns.com
 * @since      1.0.0
 *
 * @package    Simple_Subscriber
 * @subpackage Simple_Subscriber/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Simple_Subscriber
 * @subpackage Simple_Subscriber/includes
 * @author     Jeff See <jeffsee.55@gmail.com>
 */
class Simple_Subscriber {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Simple_Subscriber_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'simple-subscriber';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_post_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Simple_Subscriber_Loader. Orchestrates the hooks of the plugin.
	 * - Simple_Subscriber_i18n. Defines internationalization functionality.
	 * - Simple_Subscriber_Admin. Defines all hooks for the admin area.
	 * - Simple_Subscriber_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-subscriber-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-subscriber-i18n.php';

		/**
		 * The class responsible for processing forms
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-subscriber-form-processor.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-simple-subscriber-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-simple-subscriber-public.php';

		$this->loader = new Simple_Subscriber_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Simple_Subscriber_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Simple_Subscriber_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the posts from the website
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_post_hooks() {
    $form_processor = new Simple_Subscriber_Form_Processor;

    //$this->loader->add_action( 'admin_post_nopriv_simple_subscriber_signup', $form_processor, 'process_signup_form' );
    //$this->loader->add_action( 'admin_post_simple_subscriber_signup', $form_processor, 'process_signup_form' );
    $this->loader->add_action( 'wp_ajax_nopriv_simple_subscriber_signup', $form_processor, 'process_signup_form' );
    $this->loader->add_action( 'wp_ajax_simple_subscriber_signup', $form_processor, 'process_signup_form' );
  }

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Simple_Subscriber_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu',            $plugin_admin, 'setup_admin_ui' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Simple_Subscriber_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts',      $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts',      $plugin_public, 'enqueue_scripts' );
    $this->loader->add_action( 'widgets_init',            $plugin_public, 'register_widgets' );
    $this->loader->add_action( 'pre_get_posts',           $plugin_public, 'filter_private_categories' );
    $this->loader->add_action( 'pre_get_posts',           $plugin_public, 'authorize_user_for_query' );
    $this->loader->add_action( 'wp',                      $plugin_public, 'authorize_user_for_post' );
    $this->loader->add_action( 'admin_post_nopriv_signin',$plugin_public, 'signin_user' );
    $this->loader->add_action( 'admin_post_nopriv_signup',$plugin_public, 'register_user' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Simple_Subscriber_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
