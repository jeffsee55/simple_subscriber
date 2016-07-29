<?php

/**
 * Creates the widget for signing up as a subscriber
 *
 * @link       jeffseedesigns.com
 * @since      1.0.0
 *
 * @package    Simple_Subscriber
 * @subpackage Simple_Subscriber/public
 */

class Simple_Subscriber_Signup_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'signup_widget',
			'description' => 'Simple Subscriber Signup Widget',
		);
		parent::__construct( 'signup_widget', 'Simple Subscriber Signup Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
    $form = '';
    $form .= '<h1>Sign Up For Our Newsletter</h1>';
    $form .= '<div class="divider" style="visibility: visible; ">';
    $form .= '<span style="visibility: visible; transform: translateY(0) scale(1); opacity: 1; -webkit-transform: translateY(0) scale(1); opacity: 1; -webkit-transition: -webkit-transform 1s ease-in-out 0s, opacity 1s ease-in-out 0s; transition: transform 1s ease-in-out 0s, opacity 1s ease-in-out 0s; -webkit-perspective: 1000; -webkit-backface-visibility: hidden; "></span>';
    $form .= '<span style="visibility: visible; transform: translateY(0) scale(1); opacity: 1; -webkit-transform: translateY(0) scale(1); opacity: 1; -webkit-transition: -webkit-transform 1s ease-in-out 0s, opacity 1s ease-in-out 0s; transition: transform 1s ease-in-out 0s, opacity 1s ease-in-out 0s; -webkit-perspective: 1000; -webkit-backface-visibility: hidden; "></span>';
    $form .= '<span style="visibility: visible; transform: translateY(0) scale(1); opacity: 1; -webkit-transform: translateY(0) scale(1); opacity: 1; -webkit-transition: -webkit-transform 1s ease-in-out 0s, opacity 1s ease-in-out 0s; transition: transform 1s ease-in-out 0s, opacity 1s ease-in-out 0s; -webkit-perspective: 1000; -webkit-backface-visibility: hidden; "></span>';
    $form .= '</div>';
    $form .= '<div class="section-content">';
    $form .= '<form class="form-inline" style="text-align: center" action="/wp-admin/admin-post.php" method="post">';
    $form .= '<input type="hidden" name="action" value="simple_subscriber_signup">';
    $form .= '<div class="form-group">';
    $form .= '<input name="subscriber_email" type="email" required class="form-control" id="subsriber_email" placeholder="Email">';
    $form .= '</div>';
    $form .= '<button type="submit" class="btn btn-primary-outline">Subscribe</button>';
    $form .= '</form>';
    $form .= '</div>';

    echo $form;
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
    return '<input>';
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}
