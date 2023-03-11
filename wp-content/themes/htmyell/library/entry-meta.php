<?php
/**
 * Entry meta information for posts
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */

if ( ! function_exists( 'foundationpress_entry_meta' ) ) :
	function foundationpress_entry_meta() {
		echo '<p class="byline author">'. __( '', 'foundationpress' ) .''. get_the_author() .'</p>';
		echo '<time class="updated" datetime="'. get_the_time( 'c' ) .'">'. sprintf( __( '%s', 'foundationpress' ), get_the_date() ) .'</time>';
	}
endif;
?>
