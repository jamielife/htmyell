<?php
/*
Plugin Name: Disbale XML-RPC
Description: Disables XML-RPC capability of WordPress
Version: 1.0
Author: Jamie Taylor
Author URI: http://htmyell.com/
*/

	add_filter( 'xmlrpc_enabled', '__return_false' );
	add_filter( 'wp_headers', 'yourprefix_remove_x_pingback' );
	
	function yourprefix_remove_x_pingback($headers){
		unset( $headers['X-Pingback'] );
		return $headers;
	}
?>