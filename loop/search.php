<?php if( have_posts() ) : $i=1; while( have_posts() ) : the_post(); ?>
	<?php thb_post_before(); ?>
	<?php
		$post_id = get_the_ID();
		$post_classes = thb_get_post_classes( $i, array('item list'), 2 );
		$post_classes[] = 'search-result';
	?>

	<article id="post-<?php echo $post_id; ?>" <?php post_class($post_classes); ?>>
		<?php thb_post_start(); ?>

		<?php get_template_part( 'loop/formats/search-standard' ); ?>

		<?php thb_post_end(); ?>
	</article>

	<?php thb_post_after(); ?>
<?php $i++; endwhile; ?>

<?php else : ?>

	<div class="notice warning">
		<p><?php _e('Sorry, there aren\'t posts to be shown!', 'thb_text_domain'); ?></p>
	</div>

<?php endif; ?>

<?php thb_pagination( array( 'type' => 'links' ) ); ?>