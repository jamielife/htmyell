<?php 
	wp_enqueue_style( 'normalize', 	plugins_url( '../wow_book/css/normalize.css', __FILE__ ), 		array(), '3.0.0', 	'all' );	
	wp_enqueue_style( 'wow-book', 	plugins_url( '../wow_book/wow_book/wow_book.css', __FILE__ ), 	array(), '1.3.6', 	'all' );	
	wp_enqueue_style( 'wow-main', 	plugins_url( '../wow_book/css/main.css', __FILE__ ), 			array(), '1.0', 	'all' );	
	wp_enqueue_script( 'modernizr', plugins_url( '../wow_book/js/vendor/modernizr-2.7.1.min.js', __FILE__ ), 	array('jquery'), '2.7.1', 	true );	
	wp_enqueue_script( 'jquery', 	plugins_url( '../wow_book/js/vendor/jquery-1.11.2.min.js', __FILE__ ), 		array('jquery'), '1.11.2', 	true );	
	wp_enqueue_script( 'helper', 	plugins_url( '../wow_book/js/helper.js', __FILE__ ), 						array('jquery'), '1.0', 	true );	
	wp_enqueue_script( 'pdf', 		plugins_url( '../wow_book/wow_book/pdf.combined.min.js', __FILE__ ), 		array('jquery'), '1.0', 	true );	
	wp_enqueue_script( 'wow-book', 	plugins_url( '../wow_book/wow_book/wow_book.min.js', __FILE__ ), 			array('jquery'), '3.0.6', 	true );	
?>

<div id="flipbook_copy"> 
	<div id="flipbook_page" style="overflow: hidden"></div>
</div>

<?php
	$flippbookLoop = new WP_Query( array( 'post_type' => 'flipbook'));
	
	while ( $flippbookLoop->have_posts() ) : $flippbookLoop->the_post();
	
		$width		= get_post_meta( get_the_ID(), 'meta-box-width', true );
		$height		= get_post_meta( get_the_ID(), 'meta-box-height', true );
		$toolbarPos	= get_post_meta( get_the_ID(), 'toolbar-position', true );
		$zoom		= get_post_meta( get_the_ID(), 'meta-box-zoom', true );
		$mouseZoom 	= get_post_meta( get_the_ID(), 'meta-box-mouse-zoom', true );
		$sound 		= get_post_meta( get_the_ID(), 'meta-box-sound', true );
		$slideshow 	= get_post_meta( get_the_ID(), 'meta-box-slide-show', true );
		$fullscreen	= get_post_meta( get_the_ID(), 'meta-box-fullscreen', true );
		$thumbs 	= get_post_meta( get_the_ID(), 'meta-box-thumbnails', true );
		$download 	= get_post_meta( get_the_ID(), 'meta-box-download', true );
		
	endwhile;		
		
	$args = array(
				'p'         => $shortcodeAttr['id'],
				'post_type' => 'any'
			);
	$flipbook_data = new WP_Query($args);
	
	$args = array(
		'post_type' => 'attachment',
		'numberposts' => null,
		'post_status' => null,
		'orderby' => 'date',
		'order' => 'ASC',
		'post_parent' => $shortcodeAttr['id']
	); 
	
	$attachments = get_posts($args);
	if ($attachments) {
		foreach ($attachments as $attachment) {
			$file = wp_get_attachment_url($attachment->ID, false);
		}
	}
			
	$toolbar = "lastLeft, left, right, lastRight,";
		if(!$zoom)			$toolbar .= " zoomin, zoomout,";
		if(!$slideshow)		$toolbar .= " slideshow,";
		if(!$sound)			$toolbar .= " flipsound,";
		if(!$fullscreen)	$toolbar .= " fullscreen,";
		if(!$thumbs)		$toolbar .= " thumbnails,";
		if(!$download)		$toolbar .= " download";			
?>

<script type="text/javascript">  
	jQuery(document).ready(function($){
	
		var bookOptions = {
				height   				: <?php echo $height; ?>,
				width    				: '100%',
	
				containerHeight 		: <?php echo $height; ?>,								
				containerWidth 			: '100%',
				
				zoomMax					: 4,
				zoomStep 				: 1,
				doubleClickToZoom 		: true, 
				mouseWheel 				: <?php echo (!isset($mouseZoom) ? '"zoom"' : 'false'); ?>, 
				
				curlSize				: 100,
				handleWidth				: 200,
				responsiveHandleWidth	: 200,
				bookShadow				: true, 
				centeredWhenClosed 		: true,
				hardcovers 				: false,
				pageNumbers				: false,
				toolbar 				: "<?php echo $toolbar; ?>",
				toolbarPosition 		: '<?php echo $toolbarPos; ?>',
				
				flipSound     			: <?php echo (!isset($sound) ? 'true' : 'false'); ?>,
				flipSoundFile 			: ["page-flip.mp3", "page-flip.ogg" ],
				flipSoundPath 			: "<?php echo plugins_url( '../wow_book/wow_book/sound/', __FILE__ ); ?>",
	
				thumbnailsPosition 		: 'left',
				responsiveHandleWidth 	: 50,
	
				container				: true,
				containerPadding		: "20px",
	
				pdf 					: "<?php echo $file; ?>",
				downloadURL 			: "<?php echo $file; ?>",
		};
			
		$("#flipbook_page").wowBook(bookOptions);

	});
</script>		