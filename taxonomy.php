<?php
/**
 * @package WordPress
 * @subpackage CeciChaparroART
 * @since CeciChaparroART 1.0
 */
$pagetitle = single_cat_title( '', false );
$pagesubtitle = __("Taxonomy", 'thb_text_domain');

get_header(); ?>
		<!-- Page header -->
		<header class="pageheader">
			<h1><?php echo $pagetitle; ?></h1>
			<h2><?php echo $pagesubtitle; ?></h2>
		</header><!-- /.pageheader -->

	<?php get_template_part('partial-header-closure'); ?>

	<?php thb_page_before(); ?>
		<section id="content">
		<?php thb_page_start(); ?>
			<?php get_template_part("loop/archive"); ?>
		<?php thb_page_end(); ?>
		</section>
	<?php thb_page_after(); ?>

		<?php thb_archives_sidebar(); ?>

<?php get_footer(); ?>