<?php
	$footer_stripe_id = thb_get_post_meta(thb_get_page_ID(), 'footerstripe');
	
?>
				
				<?php thb_content_end(); ?>

	
	
			<?php thb_content_after(); ?>

			<?php if( !empty($footer_stripe_id) ) : ?>
			<div id="footer-stripe">
				<div class="wrapper">
					<div class="thb-footer-stripe-content">
						<?php
							$content_type = thb_get_post_meta($footer_stripe_id, 'footerstripes_content_type');

							if( $content_type == 'social' ) {
								echo do_shortcode('[thb_social show="' . thb_get_post_meta($footer_stripe_id, 'footerstripes_social_services') . '"]');
							}
							elseif( $content_type == 'twitter' ) {
								echo '<div class="thb-twitter-livefeed">';
									echo do_shortcode('[thb_twitter user="' . thb_get_post_meta($footer_stripe_id, 'footerstripes_twitter_username') . '" num="' . thb_get_post_meta($footer_stripe_id, 'footerstripes_twitter_num') . '"]');
								echo '</div>';
							}
							elseif( $content_type == 'call-to-action' ) {
								$big_text = thb_get_post_meta($footer_stripe_id, 'footerstripes_call-to-action_big_text');
								$small_text = thb_get_post_meta($footer_stripe_id, 'footerstripes_call-to-action_small_text');
								$btn_label = thb_get_post_meta($footer_stripe_id, 'footerstripes_call-to-action_btn_text');
								$btn_url = thb_get_post_meta($footer_stripe_id, 'footerstripes_call-to-action_btn_url');

								echo '<div class="thb-call-to-container">';
									if( !empty($big_text) || !empty($small_text) ) {
										echo '<div class="thb-call-to-message">';
											echo '<p class="thb-call-big-text">' . $big_text . '</p>';
											echo '<p class="thb-call-small-text">' . nl2br($small_text) . '</p>';
										echo '</div>';
										if( !empty($btn_label) && !empty($btn_url) ) {
											echo '<a class="btn" href="' . $btn_url . '">'. $btn_label .'</a>';
										}
									}
								echo '</div>';
							}
						?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<section id="pie">
			<div class="footer-icon1"></div>
			<div class="linefooter"></div>
				<div class="wrapper">

					<?php get_template_part('partial-page-footer'); ?>

					<?php
						$footer_layout = thb_get_option('footer_layout');
					?>
					
				</div>
				<div style="display: block;">
				<div class="hr2"></div>
				</div>
				
				<div class="footerlinck">
				<div>©<?php echo date('Y'); ?> Ceci Chaparro Photography. All rights reserved.</div>
				</div>
			</section>

		

		<?php thb_body_end(); ?>

		<?php thb_footer(); ?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/jquery.easing.1.3.js'; ?>"></script>
		<?php wp_footer(); ?>
		<div id="tool" tool="0"></div>
	</body>
</html>
