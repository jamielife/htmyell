<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
        <div class="titleBar row collapse" data-equalizer>
            <div class="commentCount columns small-2" data-equalizer-watch>
                <a href="<?php the_permalink(); ?>"><?php comments_number( '0', '1', '%' ); ?></a>
            </div>
            <h2 class="columns small-10" data-equalizer-watch><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </div>
        <div class="entry-meta">
            <?php foundationpress_entry_meta(); ?>
        </div>
	</header>
	<div class="entry-content">
	   <?php the_excerpt(); ?>
	</div>
	<footer>
		<?php $tag = get_the_tags(); if ( $tag ) { ?><p><?php the_tags(); ?></p><?php } ?>
	</footer>
</article>