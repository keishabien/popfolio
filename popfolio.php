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
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pop_activate' );