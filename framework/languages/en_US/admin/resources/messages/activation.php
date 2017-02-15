<?php
	global $current_user;
	get_currentuserinfo();

	$theme_support = 'mailto:escorpicond@gmail.com';
	$other_themes = 'mailto:escorpicond@gmail.com';
?>

<div class="thb-admin-message">
	<span class="thb-discard" data-key="activation">&times;</span>

	<p class="big">
		Welcome back, <?php echo $current_user->display_name; ?>!
	</p>

	<?php do_action('thb_admin_message_activation'); ?>
</div>