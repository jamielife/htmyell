<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */

?>

</section>
    <footer class="top-bar-container show-for-medium-up">
        <img id="megaphone" src="<?php bloginfo( 'template_url' ); ?>/assets/img/megaphone.png" alt="Htmyell Megaphone" />
        <span id="copyright">&copy; <?php echo date('Y'); ?> <a href="/">Htmyell Design &amp; Development</a></span>
    	<?php do_action( 'foundationpress_before_footer' ); ?>
    	<?php dynamic_sidebar( 'footer-widgets' ); ?>
    	<?php do_action( 'foundationpress_after_footer' ); ?>
    	<a class="icon right" target="_blank" href="https://www.linkedin.com/company/htmyell-design-&-development"><i class="fa fa-linkedin"></i></a>    	
    	<a class="icon right" target="_blank" href="https://twitter.com/htmyell"><i class="fa fa-twitter"></i></a>    	
    	<a class="icon right" target="_blank" href="https://www.facebook.com/htmyell"><i class="fa fa-facebook"></i></a>
    </footer>
<a class="exit-off-canvas"></a>

	<?php do_action( 'foundationpress_layout_end' ); ?>
	</div>
</div>
<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>