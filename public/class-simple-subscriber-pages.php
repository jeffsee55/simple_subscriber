<?php namespace GM\VirtualPages;

/*
  Plugin Name: GM Virtual Pages
 */

require_once 'PageInterface.php';
require_once 'ControllerInterface.php';
require_once 'TemplateLoaderInterface.php';
require_once 'Page.php';
require_once 'Controller.php';
require_once 'TemplateLoader.php';

$controller = new Controller ( new TemplateLoader );

add_action( 'init', array( $controller, 'init' ) );

add_filter( 'do_parse_request', array( $controller, 'dispatch' ), PHP_INT_MAX, 2 );

add_action( 'loop_end', function( \WP_Query $query ) {
    if ( isset( $query->virtual_page ) && ! empty( $query->virtual_page ) ) {
        $query->virtual_page = NULL;
    }
} );
