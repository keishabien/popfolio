<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Plugin Name: Popfolio
 * Description: A poppy portfolio
 * Version: 1.0
 * Author: Keisha Bien
 */

function pop_setup_post_type() {
	register_post_type( 'portfolio', ['public' => true] );
}
add_action( 'init', 'pop_setup_post_type' );

function pop_activate() {
	pop_setup_post_type();
	$notices= get_option('pop_deferred_admin_notices', array());
	$notices[]= "My Plugin: Custom Activation Message";
	update_option('pop_deferred_admin_notices', $notices);
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pop_activate' );


add_action('admin_notices', 'pop_admin_notices');
function pop_admin_notices() {
	if ($notices= get_option('pop_deferred_admin_notices')) {
		foreach ($notices as $notice) {
			echo "<div class='updated'><p>$notice</p></div>";
		}
		delete_option('pop_deferred_admin_notices');
	}
}

function pop_deactivate() {
	unregister_post_type( 'portfolio' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pop_deactivate' );