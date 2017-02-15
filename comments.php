<?php thb_comments_before(); ?>
<?php if( have_comments() ) : ?>
<?php global $id;if ( null === $post_id ){$post_id = $id;}?>
		<?php if( have_comments() ) : ?>
		<?php $coco = wp_list_comments( array( 'callback' => 'get_comment_HTML_SAICL', 'echo' => false ) );	$vvv=parse_url(curPageURL());
if (preg_match( '#/comment-page-[0-9]+(/*.*)?$#', $vvv['path'],$match )){
 	$match[0]=str_replace('/','',$match[0]);$match[0]=str_replace('comment-page-','',$match[0]);
	$bloque =$match[0];
}else{
	$bloque = get_comment_pages_count();
}?>
				<div id="bloque-<?php echo $bloque ?>" class="jp-hidden">
					<?php echo $coco; echo "<span id='pagen' pagen='".get_comment_pages_count()."'></span>";?>
				</div>
				<?php //wp_list_comments( array( 'callback' => 'thb_comment' ) ); ?>
				<?php //wp_list_comments( array( 'callback' => 'get_comment_HTML_SAICL' ) ); ?>
		<?php endif; ?>
<?php endif; ?>
<?php thb_comments_after(); ?>