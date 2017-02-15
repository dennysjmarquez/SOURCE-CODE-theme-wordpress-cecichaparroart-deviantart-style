<?php thb_sidebar_before(); ?>

<div style="padding: 2px;width: 100%;float: left;height: auto;overflow: visible;">
<aside class="sidebar <?php echo $sidebar_class; ?>" id="thb-sidebar-<?php echo $sidebar_type; ?>">
	<?php thb_sidebar_start(); ?>
	
	<?php dynamic_sidebar($sidebar); ?>
		<?php thb_sidebar_end(); ?>
</aside>
</div>
<?php thb_sidebar_after(); ?>