<?php
$search = !empty($_GET['q']) || false;

if (is_tag()){

$action=esc_url( home_url( '/' ));

}else if (count(get_the_category()) > 0 ){
global $term;
//$category = get_the_category();

//$term->slug

//die(print_r($term));

	$WP_PATH = implode("/", (explode("/", $_SERVER['SCRIPT_NAME'], -1)));
	$WP_PATH .= '/category/';
	$resul = str_ireplace($WP_PATH,'',$_SERVER[REQUEST_URI]);
	
	

	$action=get_bloginfo('url').'/category/'.$resul;
	
	
	
}else{
	$action=esc_url( home_url( '/' ));
}
if ($search){$svalue=$_GET['q'];}

$form .= '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url( $action ) . '">
				<div>
					<label class="screen-reader-text" for="q">' . _x( 'Search for:', 'label' ) . '</label>
					<input type="text" value="' . $svalue . '" name="q" id="q" />
					<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
				</div>
			</form>';

echo $form;
?>
