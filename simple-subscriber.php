<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              jeffseedesigns.com
 * @since             1.0.0
 * @package           Simple_Subscriber
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Subscriber
 * Plugin URI:        jeffseedesigns.com
 * Description:       Subscription and newsletter sign up
 * Version:           1.0.0
 * Author:            Jeff See
 * Author URI:        jeffseedesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-subscriber
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-subscriber-activator.php
 */
function activate_simple_subscriber() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-subscriber-activator.php';
	Simple_Subscriber_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-subscriber-deactivator.php
 */
function deactivate_simple_subscriber() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-subscriber-deactivator.php';
	Simple_Subscriber_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simple_subscriber' );
register_deactivation_hook( __FILE__, 'deactivate_simple_subscriber' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-subscriber.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_simple_subscriber() {

	$plugin = new Simple_Subscriber();
	$plugin->run();

}
run_simple_subscriber();
