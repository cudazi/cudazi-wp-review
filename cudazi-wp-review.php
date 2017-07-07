<?php
/*
Plugin Name:       WordPress Review Helper
Description:       Performs checks and setup of custom test environment
Version:           0.1
*/


// Function to display the admin notice HTML
function cudazi_build_notice($message){
	if ( $message && is_admin() ) {
		return '<div class="notice notice-error is-dismissible"><p>' . $message . '</p></div>'; 
	}
}


function cudazi_oninit(){

	// Split comments into pages to test comment navigation
	update_option( 'comments_per_page', 5 );
	update_option( 'page_comments', 1 );
}
add_action( 'init', 'cudazi_oninit' );



function cudazi_admin_notice_error() {

		// Front Page Display should remain as latest posts. Themes should not be altering this setting
		if ( get_option('page_on_front') != 0 ){
			echo cudazi_build_notice('Front page displays setting is not set to "Your latest posts"!');
		}

		// Check for WooCommerce support, alert if the plugin is not active for testing
		global $_wp_theme_features;
		if ( is_array( $_wp_theme_features ) ){
			if ( array_key_exists(('woocommerce'), $_wp_theme_features ) ){
				if ( ! class_exists( 'WooCommerce' ) ) {
					echo cudazi_build_notice('WooCommerce support added by theme, but plugin not active.');
				}else{
					echo cudazi_build_notice("WooCommerce support added by theme, don't forget to check it!");
				}
			}
		}

		// Themes should not use: add_filter( 'widget_text', 'do_shortcode' );
		if ( has_filter( 'widget_text', 'do_shortcode' ) ) {
			echo cudazi_build_notice('do_shortcode is applied to widget_text (Note: This could be due to an active plugin)');
		}

}
add_action( 'admin_notices', 'cudazi_admin_notice_error' );
