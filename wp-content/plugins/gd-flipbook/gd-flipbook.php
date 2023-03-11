<?php
/*
	Plugin Name: GD Flipbook
	Plugin URI: https://bitbucket.org/glynndevins/sba-flipbook/
	Description: Creates flipbook post type and shortcodes to allow for easy PDF flipbooks. 
	Version: 2.0.0
	Author: Jamie Taylor
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // end if

/*
 * Create a custom Flipbook Post Type
 */
add_action( 'init', 'create_flipbook_post_type' );
function create_flipbook_post_type() {
	register_post_type( 'flipbook', 
		array(
			'labels' => array(
				'name' => __( 'Flipbooks' ),
				'singular_name' => __( 'Flipbook' ),
			),
			'public' => true,
			'publicly_queryable' => false,
			'exclude_from_search' => false,
			'hierarchical' => true,
			//'menu_icon' => get_stylesheet_directory_uri() . '/images/super-duper.png',
			'can_export' => true,
		)
	);
}

/*
 * Register a custom admin meta boxes for Flipbook Posts
 */
add_action( 'add_meta_boxes', 'add_flipbook_meta_boxes' );

/* Create one or more meta boxes to be displayed on the post editor screen. */
function add_flipbook_meta_boxes() {
	add_meta_box(
		'flipbook-post-class',					// Unique ID
		esc_html__( 'Settings', 'example' ),	// Title
		'flipbook_meta_class_boxes',			// Callback function
		'flipbook',								// Admin page (or post type)
		'side',									// Context
		'default'								// Priority
	);
	add_meta_box(
		'flipbook-post-id',							
		esc_html__( 'Short Code', 'short-code' ),	
		'flipbook_meta_shortcode_boxes',			
		'flipbook',								
		'normal',									
		'default'
	);	
}

/*
 * Metaboxes admin forms html/display
 */	
function flipbook_meta_shortcode_boxes( $post ) { 	
	//printf('<pre>%s</pre><br /><br />', var_export($post, true));
	
	_e('<pre>[flipbook id="' . $post->ID . '"]</pre>'
		, 'example' ); 
}

function flipbook_meta_class_boxes($post)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce"); ?>
    
        <div>
			<!--
            <label for="meta-box-width"><?php _e( "Width", 'example' ); ?></label>
            <input class="widefat" name="meta-box-width" type="number" value="<?php echo get_post_meta($post->ID, "meta-box-width", true); ?>">
			-->
            
            <label for="meta-box-height"><?php _e( "Height", 'example' ); ?></label>
            <input class="widefat" name="meta-box-height" type="number" value="<?php echo get_post_meta($post->ID, "meta-box-height", true); ?>">

            <label for="toolbar-position">Toolbar Position</label>
            <select class="widefat" name="toolbar-position">
                <?php 
                    $option_values = array("top", "bottom");
                    foreach($option_values as $key => $value) 
                    {
                        if($value == get_post_meta($post->ID, "toolbar-position", true)) { ?>
                        	<option selected><?php echo $value; ?></option>
                        <?php } else { ?>
							<option><?php echo $value; ?></option>
                        <?php }
	                } ?>
            </select>
            
            <?php $checkbox_zoom 		= get_post_meta($post->ID, "meta-box-zoom", true); ?>
            <?php $checkbox_mouse_zoom	= get_post_meta($post->ID, "meta-box-mouse-zoom", true); ?>
            <?php $checkbox_slideshow 	= get_post_meta($post->ID, "meta-box-slide-show", true); ?>            
            <?php $checkbox_sound 		= get_post_meta($post->ID, "meta-box-sound", true); ?>            
            <?php $checkbox_fullscreen 	= get_post_meta($post->ID, "meta-box-fullscreen", true); ?>            
            <?php $checkbox_thumnails	= get_post_meta($post->ID, "meta-box-thumbnails", true); ?>            
            <?php $checkbox_download 	= get_post_meta($post->ID, "meta-box-download", true); ?>            
                       
			<input name="meta-box-zoom" type="checkbox" value="true" <?php if($checkbox_zoom == "true") echo "checked"; ?>>
            <label for="meta-box-zoom">Disable Zoom</label><br />

			<input name="meta-box-mouse-zoom" type="checkbox" value="true" <?php if($checkbox_mouse_zoom == "true") echo "checked"; ?>>
            <label for="meta-box-mouse-zoom">Disable Mouse Wheel Zoom</label><br />

			<input name="meta-box-slide-show" type="checkbox" value="true" <?php if($checkbox_slideshow == "true") echo "checked"; ?>>
            <label for="meta-box-slide-show">Disable Slideshow</label><br />
			
			<input name="meta-box-sound" type="checkbox" value="true" <?php if($checkbox_sound == "true") echo "checked"; ?>>
            <label for="meta-box-sound">Disable Sounds</label><br />			
	            	
			<input name="meta-box-fullscreen" type="checkbox" value="true" <?php if($checkbox_fullscreen == "true") echo "checked"; ?>>
			<label for="meta-box-fullscreen">Disable Fullscreen</label>			<br />		

			<input name="meta-box-thumbnails" type="checkbox" value="true" <?php if($checkbox_thumnails == "true") echo "checked"; ?>>
			<label for="meta-box-thumbnails">Disable Thumbnails</label><br />
		
			<input name="meta-box-download" type="checkbox" value="true" <?php if($checkbox_download == "true") echo "checked"; ?>>
			<label for="meta-box-download">Disable Download</label>
	            	          
        </div>
    <?php  
}

/*
 * Save custom admin meta boxes settings
 */
function save_custom_meta_box($post_id, $post, $update) {
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "flipbook";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_text_value = "";
    $meta_box_dropdown_value = "";
    $meta_box_checkbox_value = "";

    if(isset($_POST["meta-box-width"])){
        $meta_box_text_value = $_POST["meta-box-width"];
    }   
    update_post_meta($post_id, "meta-box-width", $meta_box_text_value);
    
    if(isset($_POST["meta-box-height"])){
        $meta_box_text_value = $_POST["meta-box-height"];
    }   
    update_post_meta($post_id, "meta-box-height", $meta_box_text_value);    

    if(isset($_POST["toolbar-position"])){
        $meta_box_dropdown_value = $_POST["toolbar-position"];
    }   
    update_post_meta($post_id, "toolbar-position", $meta_box_dropdown_value);

	//checkboxes
    update_post_meta($post_id, "meta-box-zoom", 		$_POST["meta-box-zoom"]);
    update_post_meta($post_id, "meta-box-mouse-zoom", 	$_POST["meta-box-mouse-zoom"]);
    update_post_meta($post_id, "meta-box-slide-show", 	$_POST["meta-box-slide-show"]);    
    update_post_meta($post_id, "meta-box-sound", 		$_POST["meta-box-sound"]);   
    update_post_meta($post_id, "meta-box-fullscreen", 	$_POST["meta-box-fullscreen"]);    
    update_post_meta($post_id, "meta-box-thumbnails", 	$_POST["meta-box-thumbnails"]);    
    update_post_meta($post_id, "meta-box-download", 	$_POST["meta-box-download"]);    
    
}

add_action("save_post", "save_custom_meta_box", 10, 3);


/*
 * Handle flipbook creation when shortcode is called
 */
function start_columns($shortcodeAttr){
    $shortcodeAttr = shortcode_atts( array(
        'id'	=> 0
    ), $shortcodeAttr);

	if(!isset($shortcodeAttr['id']))
		return false;
		
	ob_start();
	
	include(plugin_dir_path( __FILE__ ) . 'template/flipbook.php');
	
	$html = ob_get_contents();
	ob_end_clean();	
	
	return $html;
}
add_shortcode('flipbook', 'start_columns');


