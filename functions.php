<?php if ( ! isset( $_SESSION ) ) session_start(); ?>
<?php
ob_start();
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '5200' );
@ini_set( 'max_input_time', '5200' );

add_filter( 'user_contactmethods', 'perfil_usuario_personalizado' );
function perfil_usuario_personalizado( $user_contact ) {
    
	
	
	$user_contact['perfil_tlf'] = __('Tlf');
	
	
    
    return $user_contact;
}

add_filter( 'user_contactmethods', 'perfil_usuario_personalizado' );


if(!empty($_GET['scroll'])){

	global $scroll;
	$scroll="true";

}

if(!empty($_GET['offset']) && is_numeric($_GET['offset'])){


	global $offset;
	$offset=$_GET['offset'];
	
    $negative = ($offset < 0 );
    if ( $negative ) {
			
			$offset = $offset -$offset;
			
	}

}else{
	global $offset;
	
	$offset = 0;
}

	

if(!empty($_GET['view_mode'])){
			
			
			$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
			setcookie('view_mode', $_GET['view_mode'],0,$domain);
			$_COOKIE['view_mode']=$_GET['view_mode'];
		
		
		

}

if (isset($_GET['page_mode'])){

	
			
			if ($_GET['page_mode'] == 0 || $_GET['page_mode'] == 1){
				$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
				setcookie('page_mode', $_GET['page_mode'],0,$domain);
				$_COOKIE['page_mode']=$_GET['page_mode'];
				
			
			}
			
	

}


if (isset($_GET['emo'])){
	
	$emog = $_GET['emo'];
	
		switch( $emog ) {
			case 'pespeople':
				die(people());
				break;
			case 'pesplaces':
				die(places());
				break;				
			case 'pesnature':
				die(nature());
				break;				
			case 'pesobjects':
				die(objects());
				break;				
			case 'pessymbols':
				die(symbols());
				break;				
			case 'pesclassic':
				die(classic());
				break;				
		}


}



function the_category2( $separator = '', $parents='', $post_id = false ) {
	return get_the_category_list( $separator, $parents, $post_id );
	
}


function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


/**
 * Dev functions and definitions.
 *
 * @package WordPress
 * @subpackage CeciChaparroART
 * @since CeciChaparroART 1.0
 */

/**
 * Framework and configuration.
 * PLEASE LEAVE THIS AREA UNTOUCHED, IN ORDER NOT TO BREAK CORE FUNCTIONALITY.
 * -----------------------------------------------------------------------------
 */

 

 
 
 
if( !defined('THB_THEME_KEY') ) define( 'THB_THEME_KEY', 'cecichaparroart' ); // Required, not displayed anywhere.



set_include_path('pel' . PATH_SEPARATOR . get_include_path());
require_once('pel/src/PelJpeg.php');





function wt_get_category_count($input = '') {
	global $wpdb;
	if($input == '')
	{
		$category = get_the_category();
		return $category[0]->category_count;
	}
	elseif(is_numeric($input))
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
		return $wpdb->get_var($SQL);
	}
	else
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
		return $wpdb->get_var($SQL);
	}
}



function spiciest(){
    global $wpdb, $paged, $max_num_pages;

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $post_per_page = intval(get_query_var('posts_per_page')); //6
	$offset = ($paged - 1)*$post_per_page;

	// query normal post
	$query_spicy = "
        SELECT DISTINCT * FROM $wpdb->posts
		INNER JOIN (SELECT *, SUBSTRING(name, 6) as 'post_ID',
		votes_up  AS votes_balance,
		votes_up + votes_down AS votes_total
		FROM thumbsup_items) AS thumbsup
		ON $wpdb->posts.ID = thumbsup.post_ID
		WHERE $wpdb->posts.post_status = 'publish'
		AND $wpdb->posts.post_type = 'post'
		AND $wpdb->posts.post_password = ''
		ORDER BY votes_up DESC, votes_balance DESC";

	//query the posts with pagination
	$spicy = $query_spicy . " LIMIT ".$offset.", ".$post_per_page."; ";

    $spicy_results = $wpdb->get_results( $spicy, OBJECT);

	// run query to count the result later
	$total_result = $wpdb->get_results( $query_spicy, OBJECT);

	$total_spicy_post = count($total_result);
    $max_num_pages = ceil($total_spicy_post / $post_per_page);

    return $spicy_results;
    }


function encodeURIComponent($string) {
   $result = "";
   for ($i = 0; $i < strlen($string); $i++) {
      $result .= encodeURIComponentbycharacter(urlencode($string[$i]));
   }
   return $result;
}

function encodeURIComponentbycharacter($char) { if ($char == "+") { return "+"; } if ($char == "%21") { return "!"; }if ($char == "%27") { return '"'; } if ($char == "%28") { return "("; } if ($char == "%29") { return ")"; } if ($char == "%2A") { return "*"; } if ($char == "%7E") { return "~"; } if ($char == "%80") { return "%E2%82%AC"; } if ($char == "%81") { return "%C2%81"; } if ($char == "%82") { return "%E2%80%9A"; } if ($char == "%83") { return "%C6%92"; } if ($char == "%84") { return "%E2%80%9E"; } if ($char == "%85") { return "%E2%80%A6"; } if ($char == "%86") { return "%E2%80%A0"; } if ($char == "%87") { return "%E2%80%A1"; } if ($char == "%88") { return "%CB%86"; } if ($char == "%89") { return "%E2%80%B0"; } if ($char == "%8A") { return "%C5%A0"; } if ($char == "%8B") { return "%E2%80%B9"; } if ($char == "%8C") { return "%C5%92"; } if ($char == "%8D") { return "%C2%8D"; } if ($char == "%8E") { return "%C5%BD"; } if ($char == "%8F") { return "%C2%8F"; } if ($char == "%90") { return "%C2%90"; } if ($char == "%91") { return "%E2%80%98"; } if ($char == "%92") { return "%E2%80%99"; } if ($char == "%93") { return "%E2%80%9C"; } if ($char == "%94") { return "%E2%80%9D"; } if ($char == "%95") { return "%E2%80%A2"; } if ($char == "%96") { return "%E2%80%93"; } if ($char == "%97") { return "%E2%80%94"; } if ($char == "%98") { return "%CB%9C"; } if ($char == "%99") { return "%E2%84%A2"; } if ($char == "%9A") { return "%C5%A1"; } if ($char == "%9B") { return "%E2%80%BA"; } if ($char == "%9C") { return "%C5%93"; } if ($char == "%9D") { return "%C2%9D"; } if ($char == "%9E") { return "%C5%BE"; } if ($char == "%9F") { return "%C5%B8"; } if ($char == "%A0") { return "%C2%A0"; } if ($char == "%A1") { return "%C2%A1"; } if ($char == "%A2") { return "%C2%A2"; } if ($char == "%A3") { return "%C2%A3"; } if ($char == "%A4") { return "%C2%A4"; } if ($char == "%A5") { return "%C2%A5"; } if ($char == "%A6") { return "%C2%A6"; } if ($char == "%A7") { return "%C2%A7"; } if ($char == "%A8") { return "%C2%A8"; } if ($char == "%A9") { return "%C2%A9"; } if ($char == "%AA") { return "%C2%AA"; } if ($char == "%AB") { return "%C2%AB"; } if ($char == "%AC") { return "%C2%AC"; } if ($char == "%AD") { return "%C2%AD"; } if ($char == "%AE") { return "%C2%AE"; } if ($char == "%AF") { return "%C2%AF"; } if ($char == "%B0") { return "%C2%B0"; } if ($char == "%B1") { return "%C2%B1"; } if ($char == "%B2") { return "%C2%B2"; } if ($char == "%B3") { return "%C2%B3"; } if ($char == "%B4") { return "%C2%B4"; } if ($char == "%B5") { return "%C2%B5"; } if ($char == "%B6") { return "%C2%B6"; } if ($char == "%B7") { return "%C2%B7"; } if ($char == "%B8") { return "%C2%B8"; } if ($char == "%B9") { return "%C2%B9"; } if ($char == "%BA") { return "%C2%BA"; } if ($char == "%BB") { return "%C2%BB"; } if ($char == "%BC") { return "%C2%BC"; } if ($char == "%BD") { return "%C2%BD"; } if ($char == "%BE") { return "%C2%BE"; } if ($char == "%BF") { return "%C2%BF"; } if ($char == "%C0") { return "%C3%80"; } if ($char == "%C1") { return "%C3%81"; } if ($char == "%C2") { return "%C3%82"; } if ($char == "%C3") { return "%C3%83"; } if ($char == "%C4") { return "%C3%84"; } if ($char == "%C5") { return "%C3%85"; } if ($char == "%C6") { return "%C3%86"; } if ($char == "%C7") { return "%C3%87"; } if ($char == "%C8") { return "%C3%88"; } if ($char == "%C9") { return "%C3%89"; } if ($char == "%CA") { return "%C3%8A"; } if ($char == "%CB") { return "%C3%8B"; } if ($char == "%CC") { return "%C3%8C"; } if ($char == "%CD") { return "%C3%8D"; } if ($char == "%CE") { return "%C3%8E"; } if ($char == "%CF") { return "%C3%8F"; } if ($char == "%D0") { return "%C3%90"; } if ($char == "%D1") { return "%C3%91"; } if ($char == "%D2") { return "%C3%92"; } if ($char == "%D3") { return "%C3%93"; } if ($char == "%D4") { return "%C3%94"; } if ($char == "%D5") { return "%C3%95"; } if ($char == "%D6") { return "%C3%96"; } if ($char == "%D7") { return "%C3%97"; } if ($char == "%D8") { return "%C3%98"; } if ($char == "%D9") { return "%C3%99"; } if ($char == "%DA") { return "%C3%9A"; } if ($char == "%DB") { return "%C3%9B"; } if ($char == "%DC") { return "%C3%9C"; } if ($char == "%DD") { return "%C3%9D"; } if ($char == "%DE") { return "%C3%9E"; } if ($char == "%DF") { return "%C3%9F"; } if ($char == "%E0") { return "%C3%A0"; } if ($char == "%E1") { return "%C3%A1"; } if ($char == "%E2") { return "%C3%A2"; } if ($char == "%E3") { return "%C3%A3"; } if ($char == "%E4") { return "%C3%A4"; } if ($char == "%E5") { return "%C3%A5"; } if ($char == "%E6") { return "%C3%A6"; } if ($char == "%E7") { return "%C3%A7"; } if ($char == "%E8") { return "%C3%A8"; } if ($char == "%E9") { return "%C3%A9"; } if ($char == "%EA") { return "%C3%AA"; } if ($char == "%EB") { return "%C3%AB"; } if ($char == "%EC") { return "%C3%AC"; } if ($char == "%ED") { return "%C3%AD"; } if ($char == "%EE") { return "%C3%AE"; } if ($char == "%EF") { return "%C3%AF"; } if ($char == "%F0") { return "%C3%B0"; } if ($char == "%F1") { return "%C3%B1"; } if ($char == "%F2") { return "%C3%B2"; } if ($char == "%F3") { return "%C3%B3"; } if ($char == "%F4") { return "%C3%B4"; } if ($char == "%F5") { return "%C3%B5"; } if ($char == "%F6") { return "%C3%B6"; } if ($char == "%F7") { return "%C3%B7"; } if ($char == "%F8") { return "%C3%B8"; } if ($char == "%F9") { return "%C3%B9"; } if ($char == "%FA") { return "%C3%BA"; } if ($char == "%FB") { return "%C3%BB"; } if ($char == "%FC") { return "%C3%BC"; } if ($char == "%FD") { return "%C3%BD"; } if ($char == "%FE") { return "%C3%BE"; } if ($char == "%FF") { return "%C3%BF"; } return $char; }


/**
 * You can start adding your custom functions from here!
 * -----------------------------------------------------------------------------
 */

if( !isset($content_width) ) $content_width = 1400;

/**
 * Prints jQuery in footer on front-end.
 */
// function ds_print_jquery_in_footer( &$scripts) {
// 	if ( ! is_admin() ) {
// 		$scripts->add_data( 'jquery', 'group', 1 );
// 		$scripts->add_data( 'swfobject', 'group', 1 );
// 		$scripts->add_data( 'comment-reply', 'group', 1 );
// 	}
// }
// add_action( 'wp_default_scripts', 'ds_print_jquery_in_footer' );





function add_exif($meta,$file,$sourceImageType) {
			$post_ID = $_POST['post_id']; 
			
				
			
		if($sourceImageType !== 2){
			return false;
		}

			$pelExif=array();	
			$pelJpeg = new PelJpeg($file);
			$pelExif = $pelJpeg->getExif();

		if ($pelExif !== null){
		
			$pelExif = $pelJpeg->getExif()->getTiff()->getIfd();
			$TAG=$pelExif->getEntry(PelTag::MAKE);
		}else{
		
			return false;
		}

		
		
$miarreglo2 = array();
$miarreglo = explode ('|',$pelExif);



for($i=0;$i<count($miarreglo);$i++){
	
		

	
	if ($ya == true){
		
			$ii=$ii+1;
		$data1 =$ii;
			$ii = $ii +1;
		$data2=$ii;
		$miarreglo2[$miarreglo[$data1]]=$miarreglo[$data2];
		
	}else{
		
		$ii=$i+1;
		$miarreglo2[$miarreglo[$i]]=$miarreglo[$ii];
		
	}
	
	
	$ya=true;	

}				
 
if(!wp_is_post_revision($post_ID)) {
	
	delete_post_meta( $post_ID,'Make');
	delete_post_meta( $post_ID,'Model');
	delete_post_meta( $post_ID,'ShutterSpeedValue');
	delete_post_meta( $post_ID,'FocalLength');
	delete_post_meta( $post_ID,'ExposureTime');
	delete_post_meta( $post_ID,'ISOSpeedRatings');
	delete_post_meta( $post_ID,'DateTimeOriginal');
	
	
	$TAG=$miarreglo2[Make];
	
	if($TAG !==null){
		
		add_post_meta( $post_ID, 'Make', $TAG, true);
	}
	
	$TAG=$miarreglo2[Model];
	if($TAG !==null){
		add_post_meta( $post_ID, 'Model', $TAG, true);
	}
	$TAG=$miarreglo2[ShutterSpeedValue];
	if($TAG !==null){
		add_post_meta( $post_ID, 'ShutterSpeedValue', $TAG, true);
	}
	$TAG=$miarreglo2[ApertureValue];
	if($TAG !==null){
		add_post_meta( $post_ID, 'ApertureValue', $TAG, true);
	}
	$TAG=$miarreglo2[FocalLength];
	if($TAG !==null){
		add_post_meta( $post_ID, 'FocalLength', $TAG, true);	
	}
	$TAG=$miarreglo2[ExposureTime];
	if($TAG !==null){	
		add_post_meta( $post_ID, 'ExposureTime', $TAG, true);		
	}
	$TAG=$miarreglo2[ISOSpeedRatings];
	if($TAG !==null){
		add_post_meta( $post_ID, 'ISOSpeedRatings', $TAG, true);			
	}
	$TAG=$miarreglo2[DateTimeOriginal];
	if($TAG !==null){

		$yy = substr($TAG,0,4);$mm = substr($TAG,5,2);$dd = substr($TAG,8,2);$h =  substr($TAG,11,2);$m =  substr($TAG,14,2);$s =  substr($TAG,17,2);
		$monthNames = array ( "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nove", "Dec" );
		$TAG=$monthNames[$mm-1].' '.$dd.', '.$yy.', '.date("g:i:s A ", strtotime($h.":".$m.":".$s));

		add_post_meta( $post_ID, 'DateTimeOriginal', $TAG, true);			
	}
	$TAG=$miarreglo2[Software];
	
	
	
	if($TAG !==null){
	
		add_post_meta( $post_ID, 'Software', $TAG, true);			
		
		
	}
	
}else{


	$TAG=$miarreglo2[Make];
	
	if($TAG !==null){
		
		add_post_meta( $post_ID, 'Make', $TAG, true);
	}
	
	$TAG=$miarreglo2[Model];
	if($TAG !==null){
		add_post_meta( $post_ID, 'Model', $TAG, true);
	}
	$TAG=$miarreglo2[ShutterSpeedValue];
	if($TAG !==null){
		add_post_meta( $post_ID, 'ShutterSpeedValue', $TAG, true);
	}
	$TAG=$miarreglo2[ApertureValue];
	if($TAG !==null){
		add_post_meta( $post_ID, 'ApertureValue', $TAG, true);
	}
	$TAG=$miarreglo2[FocalLength];
	if($TAG !==null){
		add_post_meta( $post_ID, 'FocalLength', $TAG, true);	
	}
	$TAG=$miarreglo2[ExposureTime];
	if($TAG !==null){	
		add_post_meta( $post_ID, 'ExposureTime', $TAG, true);		
	}
	$TAG=$miarreglo2[ISOSpeedRatings];
	if($TAG !==null){
		add_post_meta( $post_ID, 'ISOSpeedRatings', $TAG, true);			
	}
	$TAG=$miarreglo2[DateTimeOriginal];
	if($TAG !==null){

		$yy = substr($TAG,0,4);$mm = substr($TAG,5,2);$dd = substr($TAG,8,2);$h =  substr($TAG,11,2);$m =  substr($TAG,14,2);$s =  substr($TAG,17,2);
		$monthNames = array ( "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nove", "Dec" );
		$TAG=$monthNames[$mm-1].' '.$dd.', '.$yy.', '.date("g:i:s A ", strtotime($h.":".$m.":".$s));

		add_post_meta( $post_ID, 'DateTimeOriginal', $TAG, true);			
	}
	$TAG=$miarreglo2[Software];
	if($TAG !==null){
		add_post_meta( $post_ID, 'Software', $TAG, true);			
	}
	

}

		
			
			
	//return $meta;
}
add_filter('wp_read_image_metadata', 'add_exif','',3);


$allowedposttags = array(
		'address' => array(),
		'a' => array(
			'href' => true,
			'rel' => true,
			'rev' => true,
			'name' => true,
			'target' => true,
		),
		'abbr' => array(),
		'acronym' => array(),
		'area' => array(
			'alt' => true,
			'coords' => true,
			'href' => true,
			'nohref' => true,
			'shape' => true,
			'target' => true,
		),
		'article' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'aside' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'b' => array(),
		'big' => array(),
		'blockquote' => array(
			'cite' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'br' => array(),
		'button' => array(
			'disabled' => true,
			'name' => true,
			'type' => true,
			'value' => true,
		),
		'caption' => array(
			'align' => true,
		),
		'cite' => array(
			'dir' => true,
			'lang' => true,
		),
		'code' => array(),
		'col' => array(
			'align' => true,
			'char' => true,
			'charoff' => true,
			'span' => true,
			'dir' => true,
			'valign' => true,
			'width' => true,
		),
		'del' => array(
			'datetime' => true,
		),
		'dd' => array(),
		'details' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'open' => true,
			'xml:lang' => true,
		),
		'div' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'dl' => array(),
		'dt' => array(),
		'em' => array(),
		'fieldset' => array(),
		'figure' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'figcaption' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'font' => array(
			'color' => true,
			'face' => true,
			'size' => true,
		),
		'footer' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'form' => array(
			'action' => true,
			'accept' => true,
			'accept-charset' => true,
			'enctype' => true,
			'method' => true,
			'name' => true,
			'target' => true,
		),
		'h1' => array(
			'align' => true,
		),
		'h2' => array(
			'align' => true,
		),
		'h3' => array(
			'align' => true,
		),
		'h4' => array(
			'align' => true,
		),
		'h5' => array(
			'align' => true,
		),
		'h6' => array(
			'align' => true,
		),
		'header' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'hgroup' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'hr' => array(
			'align' => true,
			'noshade' => true,
			'size' => true,
			'width' => true,
		),
		'i' => array(),
		'img' => array(
			'alt' => true,
			'align' => true,
			'border' => true,
			'height' => true,
			'hspace' => true,
			'longdesc' => true,
			'vspace' => true,
			'src' => true,
			'usemap' => true,
			'width' => true,
			'class' => true,
			'id' => true,			
		),
		'ins' => array(
			'datetime' => true,
			'cite' => true,
		),
		'kbd' => array(),
		'label' => array(
			'for' => true,
		),
		'legend' => array(
			'align' => true,
		),
		'li' => array(
			'align' => true,
			'value' => true,
		),
		'map' => array(
			'name' => true,
		),
		'menu' => array(
			'type' => true,
		),
		'nav' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'p' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'pre' => array(
			'width' => true,
		),
		'q' => array(
			'cite' => true,
		),
		's' => array(),
		'span' => array(
			'dir' => true,
			'align' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'section' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'small' => array(),
		'strike' => array(),
		'strong' => array(),
		'sub' => array(),
		'summary' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'sup' => array(),
		'table' => array(
			'align' => true,
			'bgcolor' => true,
			'border' => true,
			'cellpadding' => true,
			'cellspacing' => true,
			'dir' => true,
			'rules' => true,
			'summary' => true,
			'width' => true,
		),
		'tbody' => array(
			'align' => true,
			'char' => true,
			'charoff' => true,
			'valign' => true,
		),
		'td' => array(
			'abbr' => true,
			'align' => true,
			'axis' => true,
			'bgcolor' => true,
			'char' => true,
			'charoff' => true,
			'colspan' => true,
			'dir' => true,
			'headers' => true,
			'height' => true,
			'nowrap' => true,
			'rowspan' => true,
			'scope' => true,
			'valign' => true,
			'width' => true,
		),
		'textarea' => array(
			'cols' => true,
			'rows' => true,
			'disabled' => true,
			'name' => true,
			'readonly' => true,
		),
		'tfoot' => array(
			'align' => true,
			'char' => true,
			'charoff' => true,
			'valign' => true,
		),
		'th' => array(
			'abbr' => true,
			'align' => true,
			'axis' => true,
			'bgcolor' => true,
			'char' => true,
			'charoff' => true,
			'colspan' => true,
			'headers' => true,
			'height' => true,
			'nowrap' => true,
			'rowspan' => true,
			'scope' => true,
			'valign' => true,
			'width' => true,
		),
		'thead' => array(
			'align' => true,
			'char' => true,
			'charoff' => true,
			'valign' => true,
		),
		'title' => array(),
		'tr' => array(
			'align' => true,
			'bgcolor' => true,
			'char' => true,
			'charoff' => true,
			'valign' => true,
		),
		'tt' => array(),
		'u' => array(),
		'ul' => array(
			'type' => true,
		),
		'ol' => array(
			'start' => true,
			'type' => true,
		),
		'var' => array(),
	);

$allowedtags = array(
		'p' => array(
		),
		'li' => array(
			'type' => true,
		),
		'ul' => array(
			'type' => true,
		),
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'abbr' => array(
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'b' => array(),
		'blockquote' => array(
			'cite' => true,
		),
		'cite' => array(),
		'code' => array(),
		'del' => array(
			'datetime' => true,
		),
		'em' => array(),
		'i' => array(),
		'u' => array(),
		'q' => array(
			'cite' => true,
		),
		'strike' => array(),
		'ol' => array(
			'start' => true,
			'type' => true,
		),
		'strong' => array(),
			'img' => array(
			'alt' => true,
			'align' => true,
			'border' => true,
			'height' => true,
			'hspace' => true,
			'longdesc' => true,
			'vspace' => true,
			'src' => true,
			'usemap' => true,
			'width' => true,
			'class' => true,
			'id' => true,
		),
	);

$wpsmiliestrans = array(
	//peple//
		':bowtie:' => 'emojis/bowtie.png',
		':smile:' => 'emojis/smile.png',
		':laughing:' => 'emojis/laughing.png',
		':blush:' => 'emojis/blush.png',
		':smiley:' => 'emojis/smiley.png',
		':relaxed:' => 'emojis/relaxed.png',
		':smirk:' => 'emojis/smirk.png',
		':heart_eyes:' => 'emojis/heart_eyes.png',
		':kissing_heart:' => 'emojis/kissing_heart.png',
		':kissing_closed_eyes:' => 'emojis/kissing_closed_eyes.png',
		':flushed:' => 'emojis/flushed.png',
		':relieved:' => 'emojis/relieved.png',
		':satisfied:' => 'emojis/satisfied.png',
		':grin:' => 'emojis/grin.png',
		':wink:' => 'emojis/wink.png',
		':stuck_out_tongue_winking_eye:' => 'emojis/stuck_out_tongue_winking_eye.png',
		':wink2:' => 'emojis/stuck_out_tongue_winking_eye.png',
		':stuck_out_tongue_closed_eyes:' => 'emojis/stuck_out_tongue_closed_eyes.png',
		':grinning:' => 'emojis/grinning.png',
		':kissing:' => 'emojis/kissing.png',
		':kissing_smiling_eyes:' => 'emojis/kissing_smiling_eyes.png',
		':stuck_out_tongue:' => 'emojis/stuck_out_tongue.png',
		':sleeping:' => 'emojis/sleeping.png',
		':worried:' => 'emojis/worried.png',
		':frowning:' => 'emojis/frowning.png',
		':anguished:' => 'emojis/anguished.png',
		':open_mouth:' => 'emojis/open_mouth.png',
		':grimacing:' => 'emojis/grimacing.png',
		':confused:' => 'emojis/confused.png',
		':hushed:' => 'emojis/hushed.png',
		':expressionless:' => 'emojis/expressionless.png',
		':unamused:' => 'emojis/unamused.png',
		':sweat_smile:' => 'emojis/sweat_smile.png',
		':sweat:' => 'emojis/sweat.png',
		':disappointed_relieved:' => 'emojis/disappointed_relieved.png',
		':weary:' => 'emojis/weary.png',
		':pensive:' => 'emojis/pensive.png',
		':disappointed:' => 'emojis/disappointed.png',
		':confounded:' => 'emojis/confounded.png',
		':fearful:' => 'emojis/fearful.png',
		':cold_sweat:' => 'emojis/cold_sweat.png',
		':persevere:' => 'emojis/persevere.png',
		':cry:' => 'emojis/cry.png',
		':sob:' => 'emojis/sob.png',
		':joy:' => 'emojis/joy.png',
		':astonished:' => 'emojis/astonished.png',
		':scream:' => 'emojis/scream.png',
		':neckbeard:' => 'emojis/neckbeard.png',
		':tired_face:' => 'emojis/tired_face.png',
		':angry:' => 'emojis/angry.png',
		':rage:' => 'emojis/rage.png',
		':triumph:' => 'emojis/triumph.png',
		':sleepy:' => 'emojis/sleepy.png',
		':yum:' => 'emojis/yum.png',
		':mask:' => 'emojis/mask.png',
		':sunglasses:' => 'emojis/sunglasses.png',
		':dizzy_face:' => 'emojis/dizzy_face.png',
		':imp:' => 'emojis/imp.png',
		':smiling_imp:' => 'emojis/smiling_imp.png',
		':neutral_face:' => 'emojis/neutral_face.png',
		':no_mouth:' => 'emojis/no_mouth.png',
		':innocent:' => 'emojis/innocent.png',
		':alien:' => 'emojis/alien.png',
		':yellow_heart:' => 'emojis/yellow_heart.png',
		':blue_heart:' => 'emojis/blue_heart.png',
		':purple_heart:' => 'emojis/purple_heart.png',
		':heart:' => 'emojis/heart.png',
		':green_heart:' => 'emojis/green_heart.png',
		':broken_heart:' => 'emojis/broken_heart.png',
		':heartbeat:' => 'emojis/heartbeat.png',
		':heartpulse:' => 'emojis/heartpulse.png',
		':two_hearts:' => 'emojis/two_hearts.png',
		':revolving_hearts:' => 'emojis/revolving_hearts.png',
		':cupid:' => 'emojis/cupid.png',
		':sparkling_heart:' => 'emojis/sparkling_heart.png',
		':sparkles:' => 'emojis/sparkles.png',
		':star:' => 'emojis/star.png',
		':star2:' => 'emojis/star2.png',
		':dizzy:' => 'emojis/dizzy.png',
		':boom:' => 'emojis/boom.png',
		':collision:' => 'emojis/collision.png',
		':anger:' => 'emojis/anger.png',
		':exclamation:' => 'emojis/exclamation.png',
		':question:' => 'emojis/question.png',
		':grey_exclamation:' => 'emojis/grey_exclamation.png',
		':grey_question:' => 'emojis/grey_question.png',
		':zzz:' => 'emojis/zzz.png',
		':dash:' => 'emojis/dash.png',
		':sweat_drops:' => 'emojis/sweat_drops.png',
		':notes:' => 'emojis/notes.png',
		':musical_note:' => 'emojis/musical_note.png',
		':fire:' => 'emojis/fire.png',
		':hankey:' => 'emojis/hankey.png',
		':poop:' => 'emojis/poop.png',
		':shit:' => 'emojis/shit.png',
		':+1:' => 'emojis/plus1.png',
		':thumbsup:' => 'emojis/thumbsup.png',
		':-1:' => 'emojis/-1.png',
		':thumbsdown:' => 'emojis/thumbsdown.png',
		':ok_hand:' => 'emojis/ok_hand.png',
		':punch:' => 'emojis/punch.png',
		':facepunch:' => 'emojis/facepunch.png',
		':fist:' => 'emojis/fist.png',
		':v:' => 'emojis/v.png',
		':wave:' => 'emojis/wave.png',
		':hand:' => 'emojis/hand.png',
		':raised_hand:' => 'emojis/raised_hand.png',
		':open_hands:' => 'emojis/open_hands.png',
		':point_up:' => 'emojis/point_up.png',
		':point_down:' => 'emojis/point_down.png',
		':point_left:' => 'emojis/point_left.png',
		':point_right:' => 'emojis/point_right.png',
		':raised_hands:' => 'emojis/raised_hands.png',
		':pray:' => 'emojis/pray.png',
		':point_up_2:' => 'emojis/point_up_2.png',
		':clap:' => 'emojis/clap.png',
		':muscle:' => 'emojis/muscle.png',
		':metal:' => 'emojis/metal.png',
		':fu:' => 'emojis/fu.png',
		':walking:' => 'emojis/walking.png',
		':runner:' => 'emojis/runner.png',
		':running:' => 'emojis/running.png',
		':couple:' => 'emojis/couple.png',
		':family:' => 'emojis/family.png',
		':two_men_holding_hands:' => 'emojis/two_men_holding_hands.png',
		':two_women_holding_hands:' => 'emojis/two_women_holding_hands.png',
		':dancer:' => 'emojis/dancer.png',
		':dancers:' => 'emojis/dancers.png',
		':ok_woman:' => 'emojis/ok_woman.png',
		':no_good:' => 'emojis/no_good.png',
		':information_desk_person:' => 'emojis/information_desk_person.png',
		':raising_hand:' => 'emojis/raising_hand.png',
		':bride_with_veil:' => 'emojis/bride_with_veil.png',
		':person_with_pouting_face:' => 'emojis/person_with_pouting_face.png',
		':person_frowning:' => 'emojis/person_frowning.png',
		':bow:' => 'emojis/bow.png',
		':couplekiss:' => 'emojis/couplekiss.png',
		':couple_with_heart:' => 'emojis/couple_with_heart.png',
		':massage:' => 'emojis/massage.png',
		':haircut:' => 'emojis/haircut.png',
		':nail_care:' => 'emojis/nail_care.png',
		':boy:' => 'emojis/boy.png',
		':girl:' => 'emojis/girl.png',
		':woman:' => 'emojis/woman.png',
		':man:' => 'emojis/man.png',
		':baby:' => 'emojis/baby.png',
		':older_woman:' => 'emojis/older_woman.png',
		':older_man:' => 'emojis/older_man.png',
		':person_with_blond_hair:' => 'emojis/person_with_blond_hair.png',
		':man_with_gua_pi_mao:' => 'emojis/man_with_gua_pi_mao.png',
		':man_with_turban:' => 'emojis/man_with_turban.png',
		':construction_worker:' => 'emojis/construction_worker.png',
		':cop:' => 'emojis/cop.png',
		':angel:' => 'emojis/angel.png',
		':princess:' => 'emojis/princess.png',
		':smiley_cat:' => 'emojis/smiley_cat.png',
		':smile_cat:' => 'emojis/smile_cat.png',
		':heart_eyes_cat:' => 'emojis/heart_eyes_cat.png',
		':kissing_cat:' => 'emojis/kissing_cat.png',
		':smirk_cat:' => 'emojis/smirk_cat.png',
		':scream_cat:' => 'emojis/scream_cat.png',
		':crying_cat_face:' => 'emojis/crying_cat_face.png',
		':joy_cat:' => 'emojis/joy_cat.png',
		':pouting_cat:' => 'emojis/pouting_cat.png',
		':japanese_ogre:' => 'emojis/japanese_ogre.png',
		':japanese_goblin:' => 'emojis/japanese_goblin.png',
		':see_no_evil:' => 'emojis/see_no_evil.png',
		':hear_no_evil:' => 'emojis/hear_no_evil.png',
		':speak_no_evil:' => 'emojis/speak_no_evil.png',
		':guardsman:' => 'emojis/guardsman.png',
		':skull:' => 'emojis/skull.png',
		':feet:' => 'emojis/feet.png',
		':lips:' => 'emojis/lips.png',
		':kiss:' => 'emojis/kiss.png',
		':droplet:' => 'emojis/droplet.png',
		':ear:' => 'emojis/ear.png',
		':eyes:' => 'emojis/eyes.png',
		':nose:' => 'emojis/nose.png',
		':tongue:' => 'emojis/tongue.png',
		':love_letter:' => 'emojis/love_letter.png',
		':bust_in_silhouette:' => 'emojis/bust_in_silhouette.png',
		':busts_in_silhouette:' => 'emojis/busts_in_silhouette.png',
		':speech_balloon:' => 'emojis/speech_balloon.png',
		':thought_balloon:' => 'emojis/thought_balloon.png',
		':feelsgood:' => 'emojis/feelsgood.png',
		':finnadie:' => 'emojis/finnadie.png',
		':goberserk:' => 'emojis/goberserk.png',
		':godmode:' => 'emojis/godmode.png',
		':hurtrealbad:' => 'emojis/hurtrealbad.png',
		':rage1:' => 'emojis/rage1.png',
		':rage2:' => 'emojis/rage2.png',
		':rage3:' => 'emojis/rage3.png',
		':rage4:' => 'emojis/rage4.png',
		':suspect:' => 'emojis/suspect.png',
		':trollface:' => 'emojis/trollface.png',
	//fin - people //
	// Nature //
		':sunny:' => 'emojis/sunny.png',
		':umbrella:' => 'emojis/umbrella.png',
		':cloud:' => 'emojis/cloud.png',
		':snowflake:' => 'emojis/snowflake.png',
		':snowman:' => 'emojis/snowman.png',
		':zap:' => 'emojis/zap.png',
		':cyclone:' => 'emojis/cyclone.png',
		':foggy:' => 'emojis/foggy.png',
		':ocean:' => 'emojis/ocean.png',
		':cat:' => 'emojis/cat.png',
		':dog:' => 'emojis/dog.png',
		':mouse:' => 'emojis/mouse.png',
		':hamster:' => 'emojis/hamster.png',
		':rabbit:' => 'emojis/rabbit.png',
		':wolf:' => 'emojis/wolf.png',
		':frog:' => 'emojis/frog.png',
		':tiger:' => 'emojis/tiger.png',
		':koala:' => 'emojis/koala.png',
		':bear:' => 'emojis/bear.png',
		':pig:' => 'emojis/pig.png',
		':pig_nose:' => 'emojis/pig_nose.png',
		':cow:' => 'emojis/cow.png',
		':boar:' => 'emojis/boar.png',
		':monkey_face:' => 'emojis/monkey_face.png',
		':monkey:' => 'emojis/monkey.png',
		':horse:' => 'emojis/horse.png',
		':racehorse:' => 'emojis/racehorse.png',
		':camel:' => 'emojis/camel.png',
		':sheep:' => 'emojis/sheep.png',
		':elephant:' => 'emojis/elephant.png',
		':panda_face:' => 'emojis/panda_face.png',
		':snake:' => 'emojis/snake.png',
		':bird:' => 'emojis/bird.png',
		':baby_chick:' => 'emojis/baby_chick.png',
		':hatched_chick:' => 'emojis/hatched_chick.png',
		':hatching_chick:' => 'emojis/hatching_chick.png',
		':chicken:' => 'emojis/chicken.png',
		':penguin:' => 'emojis/penguin.png',
		':turtle:' => 'emojis/turtle.png',
		':bug:' => 'emojis/bug.png',
		':honeybee:' => 'emojis/honeybee.png',
		':ant:' => 'emojis/ant.png',
		':beetle:' => 'emojis/beetle.png',
		':snail:' => 'emojis/snail.png',
		':octopus:' => 'emojis/octopus.png',
		':tropical_fish:' => 'emojis/tropical_fish.png',
		':fish:' => 'emojis/fish.png',
		':whale:' => 'emojis/whale.png',
		':whale2:' => 'emojis/whale2.png',
		':dolphin:' => 'emojis/dolphin.png',
		':cow2:' => 'emojis/cow2.png',
		':ram:' => 'emojis/ram.png',
		':rat:' => 'emojis/rat.png',
		':water_buffalo:' => 'emojis/water_buffalo.png',
		':tiger2:' => 'emojis/tiger2.png',
		':rabbit2:' => 'emojis/rabbit2.png',
		':dragon:' => 'emojis/dragon.png',
		':goat:' => 'emojis/goat.png',
		':rooster:' => 'emojis/rooster.png',
		':dog2:' => 'emojis/dog2.png',
		':pig2:' => 'emojis/pig2.png',
		':mouse2:' => 'emojis/mouse2.png',
		':ox:' => 'emojis/ox.png',
		':dragon_face:' => 'emojis/dragon_face.png',
		':blowfish:' => 'emojis/blowfish.png',
		':crocodile:' => 'emojis/crocodile.png',
		':dromedary_camel:' => 'emojis/dromedary_camel.png',
		':leopard:' => 'emojis/leopard.png',
		':cat2:' => 'emojis/cat2.png',
		':poodle:' => 'emojis/poodle.png',
		':paw_prints:' => 'emojis/paw_prints.png',
		':bouquet:' => 'emojis/bouquet.png',
		':cherry_blossom:' => 'emojis/cherry_blossom.png',
		':tulip:' => 'emojis/tulip.png',
		':four_leaf_clover:' => 'emojis/four_leaf_clover.png',
		':rose:' => 'emojis/rose.png',
		':sunflower:' => 'emojis/sunflower.png',
		':hibiscus:' => 'emojis/hibiscus.png',
		':maple_leaf:' => 'emojis/maple_leaf.png',
		':leaves:' => 'emojis/leaves.png',
		':fallen_leaf:' => 'emojis/fallen_leaf.png',
		':herb:' => 'emojis/herb.png',
		':mushroom:' => 'emojis/mushroom.png',
		':cactus:' => 'emojis/cactus.png',
		':palm_tree:' => 'emojis/palm_tree.png',
		':evergreen_tree:' => 'emojis/evergreen_tree.png',
		':deciduous_tree:' => 'emojis/deciduous_tree.png',
		':chestnut:' => 'emojis/chestnut.png',
		':seedling:' => 'emojis/seedling.png',
		':blossom:' => 'emojis/blossom.png',
		':ear_of_rice:' => 'emojis/ear_of_rice.png',
		':shell:' => 'emojis/shell.png',
		':globe_with_meridians:' => 'emojis/globe_with_meridians.png',
		':sun_with_face:' => 'emojis/sun_with_face.png',
		':full_moon_with_face:' => 'emojis/full_moon_with_face.png',
		':new_moon_with_face:' => 'emojis/new_moon_with_face.png',
		':new_moon:' => 'emojis/new_moon.png',
		':waxing_crescent_moon:' => 'emojis/waxing_crescent_moon.png',
		':first_quarter_moon:' => 'emojis/first_quarter_moon.png',
		':waxing_gibbous_moon:' => 'emojis/waxing_gibbous_moon.png',
		':full_moon:' => 'emojis/full_moon.png',
		':waning_gibbous_moon:' => 'emojis/waning_gibbous_moon.png',
		':last_quarter_moon:' => 'emojis/last_quarter_moon.png',
		':waning_crescent_moon:' => 'emojis/waning_crescent_moon.png',
		':last_quarter_moon_with_face:' => 'emojis/last_quarter_moon_with_face.png',
		':first_quarter_moon_with_face:' => 'emojis/first_quarter_moon_with_face.png',
		':moon:' => 'emojis/moon.png',
		':earth_africa:' => 'emojis/earth_africa.png',
		':earth_americas:' => 'emojis/earth_americas.png',
		':earth_asia:' => 'emojis/earth_asia.png',
		':volcano:' => 'emojis/volcano.png',
		':milky_way:' => 'emojis/milky_way.png',
		':partly_sunny:' => 'emojis/partly_sunny.png',
		':octocat:' => 'emojis/octocat.png',
		':squirrel:' => 'emojis/squirrel.png',
	//fin - Nature //
	// Objects //
		':bamboo:' => 'emojis/bamboo.png',
		':gift_heart:' => 'emojis/gift_heart.png',
		':dolls:' => 'emojis/dolls.png',
		':school_satchel:' => 'emojis/school_satchel.png',
		':mortar_board:' => 'emojis/mortar_board.png',
		':flags:' => 'emojis/flags.png',
		':fireworks:' => 'emojis/fireworks.png',
		':sparkler:' => 'emojis/sparkler.png',
		':wind_chime:' => 'emojis/wind_chime.png',
		':rice_scene:' => 'emojis/rice_scene.png',
		':jack_o_lantern:' => 'emojis/jack_o_lantern.png',
		':ghost:' => 'emojis/ghost.png',
		':santa:' => 'emojis/santa.png',
		':christmas_tree:' => 'emojis/christmas_tree.png',
		':gift:' => 'emojis/gift.png',
		':bell:' => 'emojis/bell.png',
		':no_bell:' => 'emojis/no_bell.png',
		':tanabata_tree:' => 'emojis/tanabata_tree.png',
		':tada:' => 'emojis/tada.png',
		':confetti_ball:' => 'emojis/confetti_ball.png',
		':balloon:' => 'emojis/balloon.png',
		':crystal_ball:' => 'emojis/crystal_ball.png',
		':cd:' => 'emojis/cd.png',
		':dvd:' => 'emojis/dvd.png',
		':floppy_disk:' => 'emojis/floppy_disk.png',
		':camera:' => 'emojis/camera.png',
		':video_camera:' => 'emojis/video_camera.png',
		':movie_camera:' => 'emojis/movie_camera.png',
		':computer:' => 'emojis/computer.png',
		':tv:' => 'emojis/tv.png',
		':iphone:' => 'emojis/iphone.png',
		':phone:' => 'emojis/phone.png',
		':telephone:' => 'emojis/telephone.png',
		':telephone_receiver:' => 'emojis/telephone_receiver.png',
		':pager:' => 'emojis/pager.png',
		':fax:' => 'emojis/fax.png',
		':minidisc:' => 'emojis/minidisc.png',
		':vhs:' => 'emojis/vhs.png',
		':sound:' => 'emojis/sound.png',
		':speaker:' => 'emojis/speaker.png',
		':mute:' => 'emojis/mute.png',
		':loudspeaker:' => 'emojis/loudspeaker.png',
		':mega:' => 'emojis/mega.png',
		':hourglass:' => 'emojis/hourglass.png',
		':hourglass_flowing_sand:' => 'emojis/hourglass_flowing_sand.png',
		':alarm_clock:' => 'emojis/alarm_clock.png',
		':watch:' => 'emojis/watch.png',
		':radio:' => 'emojis/radio.png',
		':satellite:' => 'emojis/satellite.png',
		':loop:' => 'emojis/loop.png',
		':mag:' => 'emojis/mag.png',
		':mag_right:' => 'emojis/mag_right.png',
		':unlock:' => 'emojis/unlock.png',
		':lock:' => 'emojis/lock.png',
		':lock_with_ink_pen:' => 'emojis/lock_with_ink_pen.png',
		':closed_lock_with_key:' => 'emojis/closed_lock_with_key.png',
		':key:' => 'emojis/key.png',
		':bulb:' => 'emojis/bulb.png',
		':flashlight:' => 'emojis/flashlight.png',
		':high_brightness:' => 'emojis/high_brightness.png',
		':low_brightness:' => 'emojis/low_brightness.png',
		':electric_plug:' => 'emojis/electric_plug.png',
		':battery:' => 'emojis/battery.png',
		':calling:' => 'emojis/calling.png',
		':email:' => 'emojis/email.png',
		':mailbox:' => 'emojis/mailbox.png',
		':postbox:' => 'emojis/postbox.png',
		':bath:' => 'emojis/bath.png',
		':bathtub:' => 'emojis/bathtub.png',
		':shower:' => 'emojis/shower.png',
		':toilet:' => 'emojis/toilet.png',
		':wrench:' => 'emojis/wrench.png',
		':nut_and_bolt:' => 'emojis/nut_and_bolt.png',
		':hammer:' => 'emojis/hammer.png',
		':seat:' => 'emojis/seat.png',
		':moneybag:' => 'emojis/moneybag.png',
		':yen:' => 'emojis/yen.png',
		':dollar:' => 'emojis/dollar.png',
		':pound:' => 'emojis/pound.png',
		':euro:' => 'emojis/euro.png',
		':credit_card:' => 'emojis/credit_card.png',
		':money_with_wings:' => 'emojis/money_with_wings.png',
		':e-mail:' => 'emojis/e-mail.png',
		':inbox_tray:' => 'emojis/inbox_tray.png',
		':outbox_tray:' => 'emojis/outbox_tray.png',
		':envelope:' => 'emojis/envelope.png',
		':incoming_envelope:' => 'emojis/incoming_envelope.png',
		':postal_horn:' => 'emojis/postal_horn.png',
		':mailbox_closed:' => 'emojis/mailbox_closed.png',
		':mailbox_with_mail:' => 'emojis/mailbox_with_mail.png',
		':mailbox_with_no_mail:' => 'emojis/mailbox_with_no_mail.png',
		':door:' => 'emojis/door.png',
		':smoking:' => 'emojis/smoking.png',
		':bomb:' => 'emojis/bomb.png',
		':gun:' => 'emojis/gun.png',
		':hocho:' => 'emojis/hocho.png',
		':pill:' => 'emojis/pill.png',
		':syringe:' => 'emojis/syringe.png',
		':page_facing_up:' => 'emojis/page_facing_up.png',
		':page_with_curl:' => 'emojis/page_with_curl.png',
		':bookmark_tabs:' => 'emojis/bookmark_tabs.png',
		':bar_chart:' => 'emojis/bar_chart.png',
		':chart_with_upwards_trend:' => 'emojis/chart_with_upwards_trend.png',
		':chart_with_downwards_trend:' => 'emojis/chart_with_downwards_trend.png',
		':scroll:' => 'emojis/scroll.png',
		':clipboard:' => 'emojis/clipboard.png',
		':calendar:' => 'emojis/calendar.png',
		':date:' => 'emojis/date.png',
		':card_index:' => 'emojis/card_index.png',
		':file_folder:' => 'emojis/file_folder.png',
		':open_file_folder:' => 'emojis/open_file_folder.png',
		':scissors:' => 'emojis/scissors.png',
		':pushpin:' => 'emojis/pushpin.png',
		':paperclip:' => 'emojis/paperclip.png',
		':black_nib:' => 'emojis/black_nib.png',
		':pencil2:' => 'emojis/pencil2.png',
		':straight_ruler:' => 'emojis/straight_ruler.png',
		':triangular_ruler:' => 'emojis/triangular_ruler.png',
		':closed_book:' => 'emojis/closed_book.png',
		':green_book:' => 'emojis/green_book.png',
		':blue_book:' => 'emojis/blue_book.png',
		':orange_book:' => 'emojis/orange_book.png',
		':notebook:' => 'emojis/notebook.png',
		':notebook_with_decorative_cover:' => 'emojis/notebook_with_decorative_cover.png',
		':ledger:' => 'emojis/ledger.png',
		':books:' => 'emojis/books.png',
		':bookmark:' => 'emojis/bookmark.png',
		':name_badge:' => 'emojis/name_badge.png',
		':microscope:' => 'emojis/microscope.png',
		':telescope:' => 'emojis/telescope.png',
		':newspaper:' => 'emojis/newspaper.png',
		':football:' => 'emojis/football.png',
		':basketball:' => 'emojis/basketball.png',
		':soccer:' => 'emojis/soccer.png',
		':baseball:' => 'emojis/baseball.png',
		':tennis:' => 'emojis/tennis.png',
		':8ball:' => 'emojis/8ball.png',
		':rugby_football:' => 'emojis/rugby_football.png',
		':bowling:' => 'emojis/bowling.png',
		':golf:' => 'emojis/golf.png',
		':mountain_bicyclist:' => 'emojis/mountain_bicyclist.png',
		':bicyclist:' => 'emojis/bicyclist.png',
		':horse_racing:' => 'emojis/horse_racing.png',
		':snowboarder:' => 'emojis/snowboarder.png',
		':swimmer:' => 'emojis/swimmer.png',
		':surfer:' => 'emojis/surfer.png',
		':ski:' => 'emojis/ski.png',
		':spades:' => 'emojis/spades.png',
		':hearts:' => 'emojis/hearts.png',
		':clubs:' => 'emojis/clubs.png',
		':diamonds:' => 'emojis/diamonds.png',
		':gem:' => 'emojis/gem.png',
		':ring:' => 'emojis/ring.png',
		':trophy:' => 'emojis/trophy.png',
		':musical_score:' => 'emojis/musical_score.png',
		':musical_keyboard:' => 'emojis/musical_keyboard.png',
		':violin:' => 'emojis/violin.png',
		':space_invader:' => 'emojis/space_invader.png',
		':video_game:' => 'emojis/video_game.png',
		':black_joker:' => 'emojis/black_joker.png',
		':flower_playing_cards:' => 'emojis/flower_playing_cards.png',
		':game_die:' => 'emojis/game_die.png',
		':dart:' => 'emojis/dart.png',
		':mahjong:' => 'emojis/mahjong.png',
		':clapper:' => 'emojis/clapper.png',
		':memo:' => 'emojis/memo.png',
		':pencil:' => 'emojis/pencil.png',
		':book:' => 'emojis/book.png',
		':art:' => 'emojis/art.png',
		':microphone:' => 'emojis/microphone.png',
		':headphones:' => 'emojis/headphones.png',
		':trumpet:' => 'emojis/trumpet.png',
		':saxophone:' => 'emojis/saxophone.png',
		':guitar:' => 'emojis/guitar.png',
		':shoe:' => 'emojis/shoe.png',
		':sandal:' => 'emojis/sandal.png',
		':high_heel:' => 'emojis/high_heel.png',
		':lipstick:' => 'emojis/lipstick.png',
		':boot:' => 'emojis/boot.png',
		':shirt:' => 'emojis/shirt.png',
		':tshirt:' => 'emojis/tshirt.png',
		':necktie:' => 'emojis/necktie.png',
		':womans_clothes:' => 'emojis/womans_clothes.png',
		':dress:' => 'emojis/dress.png',
		':running_shirt_with_sash:' => 'emojis/running_shirt_with_sash.png',
		':jeans:' => 'emojis/jeans.png',
		':kimono:' => 'emojis/kimono.png',
		':bikini:' => 'emojis/bikini.png',
		':ribbon:' => 'emojis/ribbon.png',
		':tophat:' => 'emojis/tophat.png',
		':crown:' => 'emojis/crown.png',
		':womans_hat:' => 'emojis/womans_hat.png',
		':mans_shoe:' => 'emojis/mans_shoe.png',
		':closed_umbrella:' => 'emojis/closed_umbrella.png',
		':briefcase:' => 'emojis/briefcase.png',
		':handbag:' => 'emojis/handbag.png',
		':pouch:' => 'emojis/pouch.png',
		':purse:' => 'emojis/purse.png',
		':eyeglasses:' => 'emojis/eyeglasses.png',
		':fishing_pole_and_fish:' => 'emojis/fishing_pole_and_fish.png',
		':coffee:' => 'emojis/coffee.png',
		':tea:' => 'emojis/tea.png',
		':sake:' => 'emojis/sake.png',
		':baby_bottle:' => 'emojis/baby_bottle.png',
		':beer:' => 'emojis/beer.png',
		':beers:' => 'emojis/beers.png',
		':cocktail:' => 'emojis/cocktail.png',
		':tropical_drink:' => 'emojis/tropical_drink.png',
		':wine_glass:' => 'emojis/wine_glass.png',
		':fork_and_knife:' => 'emojis/fork_and_knife.png',
		':pizza:' => 'emojis/pizza.png',
		':hamburger:' => 'emojis/hamburger.png',
		':fries:' => 'emojis/fries.png',
		':poultry_leg:' => 'emojis/poultry_leg.png',
		':meat_on_bone:' => 'emojis/meat_on_bone.png',
		':spaghetti:' => 'emojis/spaghetti.png',
		':curry:' => 'emojis/curry.png',
		':fried_shrimp:' => 'emojis/fried_shrimp.png',
		':bento:' => 'emojis/bento.png',
		':sushi:' => 'emojis/sushi.png',
		':fish_cake:' => 'emojis/fish_cake.png',
		':rice_ball:' => 'emojis/rice_ball.png',
		':rice_cracker:' => 'emojis/rice_cracker.png',
		':rice:' => 'emojis/rice.png',
		':ramen:' => 'emojis/ramen.png',
		':stew:' => 'emojis/stew.png',
		':oden:' => 'emojis/oden.png',
		':dango:' => 'emojis/dango.png',
		':egg:' => 'emojis/egg.png',
		':bread:' => 'emojis/bread.png',
		':doughnut:' => 'emojis/doughnut.png',
		':custard:' => 'emojis/custard.png',
		':icecream:' => 'emojis/icecream.png',
		':ice_cream:' => 'emojis/ice_cream.png',
		':shaved_ice:' => 'emojis/shaved_ice.png',
		':birthday:' => 'emojis/birthday.png',
		':cake:' => 'emojis/cake.png',
		':cookie:' => 'emojis/cookie.png',
		':chocolate_bar:' => 'emojis/chocolate_bar.png',
		':candy:' => 'emojis/candy.png',
		':lollipop:' => 'emojis/lollipop.png',
		':honey_pot:' => 'emojis/honey_pot.png',
		':apple:' => 'emojis/apple.png',
		':green_apple:' => 'emojis/green_apple.png',
		':tangerine:' => 'emojis/tangerine.png',
		':lemon:' => 'emojis/lemon.png',
		':cherries:' => 'emojis/cherries.png',
		':grapes:' => 'emojis/grapes.png',
		':watermelon:' => 'emojis/watermelon.png',
		':strawberry:' => 'emojis/strawberry.png',
		':peach:' => 'emojis/peach.png',
		':melon:' => 'emojis/melon.png',
		':banana:' => 'emojis/banana.png',
		':pear:' => 'emojis/pear.png',
		':pineapple:' => 'emojis/pineapple.png',
		':sweet_potato:' => 'emojis/sweet_potato.png',
		':eggplant:' => 'emojis/eggplant.png',
		':tomato:' => 'emojis/tomato.png',
		':corn:' => 'emojis/corn.png',
	//fin - Objects //
	//Places//
		':onezeronine:' => 'emojis/onezeronine.png',
		':109:' => 'emojis/onezeronine.png',
		':house:' => 'emojis/house.png',
		':house_with_garden:' => 'emojis/house_with_garden.png',
		':school:' => 'emojis/school.png',
		':office:' => 'emojis/office.png',
		':post_office:' => 'emojis/post_office.png',
		':hospital:' => 'emojis/hospital.png',
		':bank:' => 'emojis/bank.png',
		':convenience_store:' => 'emojis/convenience_store.png',
		':love_hotel:' => 'emojis/love_hotel.png',
		':hotel:' => 'emojis/hotel.png',
		':wedding:' => 'emojis/wedding.png',
		':church:' => 'emojis/church.png',
		':department_store:' => 'emojis/department_store.png',
		':european_post_office:' => 'emojis/european_post_office.png',
		':city_sunrise:' => 'emojis/city_sunrise.png',
		':city_sunset:' => 'emojis/city_sunset.png',
		':japanese_castle:' => 'emojis/japanese_castle.png',
		':european_castle:' => 'emojis/european_castle.png',
		':tent:' => 'emojis/tent.png',
		':factory:' => 'emojis/factory.png',
		':tokyo_tower:' => 'emojis/tokyo_tower.png',
		':japan:' => 'emojis/japan.png',
		':mount_fuji:' => 'emojis/mount_fuji.png',
		':sunrise_over_mountains:' => 'emojis/sunrise_over_mountains.png',
		':sunrise:' => 'emojis/sunrise.png',
		':stars:' => 'emojis/stars.png',
		':statue_of_liberty:' => 'emojis/statue_of_liberty.png',
		':bridge_at_night:' => 'emojis/bridge_at_night.png',
		':carousel_horse:' => 'emojis/carousel_horse.png',
		':rainbow:' => 'emojis/rainbow.png',
		':ferris_wheel:' => 'emojis/ferris_wheel.png',
		':fountain:' => 'emojis/fountain.png',
		':roller_coaster:' => 'emojis/roller_coaster.png',
		':ship:' => 'emojis/ship.png',
		':speedboat:' => 'emojis/speedboat.png',
		':boat:' => 'emojis/boat.png',
		':sailboat:' => 'emojis/sailboat.png',
		':rowboat:' => 'emojis/rowboat.png',
		':anchor:' => 'emojis/anchor.png',
		':rocket:' => 'emojis/rocket.png',
		':airplane:' => 'emojis/airplane.png',
		':helicopter:' => 'emojis/helicopter.png',
		':steam_locomotive:' => 'emojis/steam_locomotive.png',
		':tram:' => 'emojis/tram.png',
		':mountain_railway:' => 'emojis/mountain_railway.png',
		':bike:' => 'emojis/bike.png',
		':aerial_tramway:' => 'emojis/aerial_tramway.png',
		':suspension_railway:' => 'emojis/suspension_railway.png',
		':mountain_cableway:' => 'emojis/mountain_cableway.png',
		':tractor:' => 'emojis/tractor.png',
		':blue_car:' => 'emojis/blue_car.png',
		':oncoming_automobile:' => 'emojis/oncoming_automobile.png',
		':car:' => 'emojis/car.png',
		':red_car:' => 'emojis/red_car.png',
		':taxi:' => 'emojis/taxi.png',
		':oncoming_taxi:' => 'emojis/oncoming_taxi.png',
		':articulated_lorry:' => 'emojis/articulated_lorry.png',
		':bus:' => 'emojis/bus.png',
		':oncoming_bus:' => 'emojis/oncoming_bus.png',
		':rotating_light:' => 'emojis/rotating_light.png',
		':police_car:' => 'emojis/police_car.png',
		':oncoming_police_car:' => 'emojis/oncoming_police_car.png',
		':fire_engine:' => 'emojis/fire_engine.png',
		':ambulance:' => 'emojis/ambulance.png',
		':minibus:' => 'emojis/minibus.png',
		':truck:' => 'emojis/truck.png',
		':train:' => 'emojis/train.png',
		':station:' => 'emojis/station.png',
		':train2:' => 'emojis/train2.png',
		':bullettrain_front:' => 'emojis/bullettrain_front.png',
		':bullettrain_side:' => 'emojis/bullettrain_side.png',
		':light_rail:' => 'emojis/light_rail.png',
		':monorail:' => 'emojis/monorail.png',
		':railway_car:' => 'emojis/railway_car.png',
		':trolleybus:' => 'emojis/trolleybus.png',
		':ticket:' => 'emojis/ticket.png',
		':fuelpump:' => 'emojis/fuelpump.png',
		':vertical_traffic_light:' => 'emojis/vertical_traffic_light.png',
		':traffic_light:' => 'emojis/traffic_light.png',
		':warning:' => 'emojis/warning.png',
		':construction:' => 'emojis/construction.png',
		':beginner:' => 'emojis/beginner.png',
		':atm:' => 'emojis/atm.png',
		':slot_machine:' => 'emojis/slot_machine.png',
		':busstop:' => 'emojis/busstop.png',
		':barber:' => 'emojis/barber.png',
		':hotsprings:' => 'emojis/hotsprings.png',
		':checkered_flag:' => 'emojis/checkered_flag.png',
		':crossed_flags:' => 'emojis/crossed_flags.png',
		':izakaya_lantern:' => 'emojis/izakaya_lantern.png',
		':moyai:' => 'emojis/moyai.png',
		':circus_tent:' => 'emojis/circus_tent.png',
		':performing_arts:' => 'emojis/performing_arts.png',
		':moyai:' => 'emojis/performing_arts.png',
		':round_pushpin:' => 'emojis/round_pushpin.png',
		':triangular_flag_on_post:' => 'emojis/triangular_flag_on_post.png',
		':jp:' => 'emojis/jp.png',
		':cn:' => 'emojis/cn.png',
		':kr:' => 'emojis/kr.png',
		':us:' => 'emojis/us.png',
		':fr:' => 'emojis/fr.png',
		':es:' => 'emojis/es.png',
		':it:' => 'emojis/it.png',
		':ru:' => 'emojis/ru.png',
		':gb:' => 'emojis/gb.png',
		':uk:' => 'emojis/uk.png',
		':de:' => 'emojis/de.png',
	//fin - Places //
	//Symbols //
		':one:' => 'emojis/one.png',
		':two:' => 'emojis/two.png',
		':three:' => 'emojis/three.png',
		':four:' => 'emojis/four.png',
		':five:' => 'emojis/five.png',
		':six:' => 'emojis/six.png',
		':seven:' => 'emojis/seven.png',
		':eight:' => 'emojis/eight.png',
		':nine:' => 'emojis/nine.png',
		':keycap_ten:' => 'emojis/keycap_ten.png',
		':1234:' => 'emojis/1234.png',
		':zero:' => 'emojis/zero.png',
		':hash:' => 'emojis/hash.png',
		':symbols:' => 'emojis/symbols.png',
		':arrow_backward:' => 'emojis/arrow_backward.png',
		':arrow_down:' => 'emojis/arrow_down.png',
		':arrow_forward:' => 'emojis/arrow_forward.png',
		':arrow_left:' => 'emojis/arrow_left.png',
		':capital_abcd:' => 'emojis/capital_abcd.png',
		':abcd:' => 'emojis/abcd.png',
		':abc:' => 'emojis/abc.png',
		':arrow_lower_left:' => 'emojis/arrow_lower_left.png',
		':arrow_lower_right:' => 'emojis/arrow_lower_right.png',
		':arrow_right:' => 'emojis/arrow_right.png',
		':arrow_up:' => 'emojis/arrow_up.png',
		':arrow_upper_left:' => 'emojis/arrow_upper_left.png',
		':arrow_upper_right:' => 'emojis/arrow_upper_right.png',
		':arrow_double_down:' => 'emojis/arrow_double_down.png',
		':arrow_double_up:' => 'emojis/arrow_double_up.png',
		':arrow_down_small:' => 'emojis/arrow_down_small.png',
		':arrow_heading_down:' => 'emojis/arrow_heading_down.png',
		':arrow_heading_up:' => 'emojis/arrow_heading_up.png',
		':leftwards_arrow_with_hook:' => 'emojis/leftwards_arrow_with_hook.png',
		':arrow_right_hook:' => 'emojis/arrow_right_hook.png',
		':left_right_arrow:' => 'emojis/left_right_arrow.png',
		':arrow_up_down:' => 'emojis/arrow_up_down.png',
		':arrow_up_small:' => 'emojis/arrow_up_small.png',
		':arrows_clockwise:' => 'emojis/arrows_clockwise.png',
		':arrows_counterclockwise:' => 'emojis/arrows_counterclockwise.png',
		':rewind:' => 'emojis/rewind.png',
		':fast_forward:' => 'emojis/fast_forward.png',
		':information_source:' => 'emojis/information_source.png',
		':ok:' => 'emojis/ok.png',
		':twisted_rightwards_arrows:' => 'emojis/twisted_rightwards_arrows.png',
		':repeat:' => 'emojis/repeat.png',
		':repeat_one:' => 'emojis/repeat_one.png',
		':new:' => 'emojis/new.png',
		':top:' => 'emojis/top.png',
		':up:' => 'emojis/up.png',
		':cool:' => 'emojis/cool.png',
		':free:' => 'emojis/free.png',
		':ng:' => 'emojis/ng.png',
		':cinema:' => 'emojis/cinema.png',
		':koko:' => 'emojis/koko.png',
		':signal_strength:' => 'emojis/signal_strength.png',
		':u5272:' => 'emojis/u5272.png',
		':u5408:' => 'emojis/u5408.png',
		':u55b6:' => 'emojis/u55b6.png',
		':u6307:' => 'emojis/u6307.png',
		':u6708:' => 'emojis/u6708.png',
		':u6709:' => 'emojis/u6709.png',
		':u6e80:' => 'emojis/u6e80.png',
		':u7121:' => 'emojis/u7121.png',
		':u7533:' => 'emojis/u7533.png',
		':u7a7a:' => 'emojis/u7a7a.png',
		':u7981:' => 'emojis/u7981.png',
		':sa:' => 'emojis/sa.png',
		':restroom:' => 'emojis/restroom.png',
		':mens:' => 'emojis/mens.png',
		':womens:' => 'emojis/womens.png',
		':baby_symbol:' => 'emojis/baby_symbol.png',
		':no_smoking:' => 'emojis/no_smoking.png',
		':parking:' => 'emojis/parking.png',
		':wheelchair:' => 'emojis/wheelchair.png',
		':metro:' => 'emojis/metro.png',
		':baggage_claim:' => 'emojis/baggage_claim.png',
		':accept:' => 'emojis/accept.png',
		':wc:' => 'emojis/wc.png',
		':potable_water:' => 'emojis/potable_water.png',
		':put_litter_in_its_place:' => 'emojis/put_litter_in_its_place.png',
		':secret:' => 'emojis/secret.png',
		':congratulations:' => 'emojis/congratulations.png',
		':m:' => 'emojis/m.png',
		':passport_control:' => 'emojis/passport_control.png',
		':left_luggage:' => 'emojis/left_luggage.png',
		':customs:' => 'emojis/customs.png',
		':ideograph_advantage:' => 'emojis/ideograph_advantage.png',
		':cl:' => 'emojis/cl.png',
		':sos:' => 'emojis/sos.png',
		':id:' => 'emojis/id.png',
		':no_entry_sign:' => 'emojis/no_entry_sign.png',
		':underage:' => 'emojis/underage.png',
		':no_mobile_phones:' => 'emojis/no_mobile_phones.png',
		':do_not_litter:' => 'emojis/do_not_litter.png',
		':non-potable_water:' => 'emojis/non-potable_water.png',
		':no_bicycles:' => 'emojis/no_bicycles.png',
		':no_pedestrians:' => 'emojis/no_pedestrians.png',
		':children_crossing:' => 'emojis/children_crossing.png',
		':no_entry:' => 'emojis/no_entry.png',
		':eight_spoked_asterisk:' => 'emojis/eight_spoked_asterisk.png',
		':eight_pointed_black_star:' => 'emojis/eight_pointed_black_star.png',
		':heart_decoration:' => 'emojis/heart_decoration.png',
		':vs:' => 'emojis/vs.png',
		':vibration_mode:' => 'emojis/vibration_mode.png',
		':mobile_phone_off:' => 'emojis/mobile_phone_off.png',
		':chart:' => 'emojis/chart.png',
		':currency_exchange:' => 'emojis/currency_exchange.png',
		':aries:' => 'emojis/aries.png',
		':taurus:' => 'emojis/taurus.png',
		':gemini:' => 'emojis/gemini.png',
		':cancer:' => 'emojis/cancer.png',
		':leo:' => 'emojis/leo.png',
		':virgo:' => 'emojis/virgo.png',
		':libra:' => 'emojis/libra.png',
		':scorpius:' => 'emojis/scorpius.png',
		':sagittarius:' => 'emojis/sagittarius.png',
		':capricorn:' => 'emojis/capricorn.png',
		':aquarius:' => 'emojis/aquarius.png',
		':pisces:' => 'emojis/pisces.png',
		':ophiuchus:' => 'emojis/ophiuchus.png',
		':six_pointed_star:' => 'emojis/six_pointed_star.png',
		':a:' => 'emojis/a.png',
		':b:' => 'emojis/b.png',
		':ab:' => 'emojis/ab.png',
		':o2:' => 'emojis/o2.png',
		':diamond_shape_with_a_dot_inside:' => 'emojis/diamond_shape_with_a_dot_inside.png',
		':recycle:' => 'emojis/recycle.png',
		':end:' => 'emojis/end.png',
		':on:' => 'emojis/on.png',
		':soon:' => 'emojis/soon.png',
		':clock1:' => 'emojis/clock1.png',
		':clock130:' => 'emojis/clock130.png',
		':clock10:' => 'emojis/clock10.png',
		':clock1030:' => 'emojis/clock1030.png',
		':clock11:' => 'emojis/clock11.png',
		':clock1130:' => 'emojis/clock1130.png',
		':clock12:' => 'emojis/clock12.png',
		':clock1230:' => 'emojis/clock1230.png',
		':clock2:' => 'emojis/clock2.png',
		':clock230:' => 'emojis/clock230.png',
		':clock3:' => 'emojis/clock3.png',
		':clock330:' => 'emojis/clock330.png',
		':clock4:' => 'emojis/clock4.png',
		':clock430:' => 'emojis/clock430.png',
		':clock5:' => 'emojis/clock5.png',
		':clock530:' => 'emojis/clock530.png',
		':clock6:' => 'emojis/clock6.png',
		':clock630:' => 'emojis/clock630.png',
		':clock7:' => 'emojis/clock7.png',
		':clock730:' => 'emojis/clock730.png',
		':clock8:' => 'emojis/clock8.png',
		':clock830:' => 'emojis/clock830.png',
		':clock9:' => 'emojis/clock9.png',
		':clock930:' => 'emojis/clock930.png',
		':heavy_dollar_sign:' => 'emojis/heavy_dollar_sign.png',
		':copyright:' => 'emojis/copyright.png',
		':registered:' => 'emojis/registered.png',
		':tm:' => 'emojis/tm.png',
		':x:' => 'emojis/x.png',
		':heavy_exclamation_mark:' => 'emojis/heavy_exclamation_mark.png',
		':bangbang:' => 'emojis/bangbang.png',
		':interrobang:' => 'emojis/interrobang.png',
		':o:' => 'emojis/o.png',
		':heavy_multiplication_x:' => 'emojis/heavy_multiplication_x.png',
		':heavy_plus_sign:' => 'emojis/heavy_plus_sign.png',
		':heavy_minus_sign:' => 'emojis/heavy_minus_sign.png',
		':white_flower:' => 'emojis/white_flower.png',
		':100:' => 'emojis/100.png',
		':heavy_check_mark:' => 'emojis/heavy_check_mark.png',
		':ballot_box_with_check:' => 'emojis/ballot_box_with_check.png',
		':radio_button:' => 'emojis/radio_button.png',
		':link:' => 'emojis/link.png',
		':curly_loop:' => 'emojis/curly_loop.png',
		':wavy_dash:' => 'emojis/wavy_dash.png',
		':part_alternation_mark:' => 'emojis/part_alternation_mark.png',
		':trident:' => 'emojis/trident.png',
		':black_square:' => 'emojis/black_square.png',
		':white_square:' => 'emojis/white_square.png',
		':white_check_mark:' => 'emojis/white_check_mark.png',
		':black_square_button:' => 'emojis/black_square_button.png',
		':white_square_button:' => 'emojis/white_square_button.png',
		':black_circle:' => 'emojis/black_circle.png',
		':white_circle:' => 'emojis/white_circle.png',
		':red_circle:' => 'emojis/red_circle.png',
		':large_blue_circle:' => 'emojis/large_blue_circle.png',
		':large_blue_diamond:' => 'emojis/large_blue_diamond.png',
		':large_orange_diamond:' => 'emojis/large_orange_diamond.png',
		':small_blue_diamond:' => 'emojis/small_blue_diamond.png',
		':small_orange_diamond:' => 'emojis/small_orange_diamond.png',
		':small_red_triangle:' => 'emojis/small_red_triangle.png',
		':small_red_triangle_down:' => 'emojis/small_red_triangle_down.png',
		':heavy_division_sign:' => 'emojis/heavy_division_sign.png',
		':negative_squared_cross_mark:' => 'emojis/negative_squared_cross_mark.png',
		':shipit:' => 'emojis/shipit.png',
	//fin - Symbols //
		'^^' => 'icon_mrgreen.gif',
		':mrgreen:' => 'icon_mrgreen.gif',
		':twisted:' => 'icon_twisted.gif',
		  ':arrow:' => 'icon_arrow.gif',
		  '8|' => 'icon_eek.gif',
		  ':)' => 'icon_smile.gif',
		    ':?' => 'icon_confused.gif',
		   ':evil:' => 'icon_evil.gif',
		   ':D' => 'icon_biggrin.gif',
		   ':idea:' => 'icon_idea.gif',
		   ':oops:' => 'icon_redface.gif',
		   ':razz:' => 'icon_razz.gif',
		   ':roll:' => 'icon_rolleyes.gif',
		    ':cry2:' => 'icon_cry.gif',
		    ':eek:' => 'icon_surprised.gif',
		    ':lol:' => 'icon_lol.gif',
		    ':mad:' => 'icon_mad.gif',
		    ':sad:' => 'icon_sad.gif',
		      '8-)' => 'icon_cool.gif',
		      '8-O' => 'icon_eek.gif',
		      ':-(' => 'icon_sad.gif',
		      ':-)' => 'icon_smile.gif',
		      ':-?' => 'icon_confused.gif',
		      ':-D' => 'icon_biggrin.gif',
		      ':-P' => 'icon_razz.gif',
		      ':-o' => 'icon_surprised.gif',
		      ':-x' => 'icon_mad.gif',
		      ':-|' => 'icon_neutral.gif',
		      ';-)' => 'icon_wink.gif',
		// This one transformation breaks regular text with frequency.
		//     '8)' => 'icon_cool.gif',
		       '8O' => 'icon_eek.gif',
		       ':(' => 'icon_sad.gif',
		       ':?' => 'icon_confused.gif',
		       ':P' => 'icon_razz.gif',
		       ':o' => 'icon_surprised.gif',
		       ':x' => 'icon_mad.gif',
		       ':|' => 'icon_neutral.gif',
		       ';)' => 'icon_wink.gif',
		      ':!:' => 'icon_exclaim.gif',
		      ':?:' => 'icon_question.gif',
			  
			  ':mario:' => 'mario.gif',
			  ':fantasma:' => 'fantasma.gif',
			  ':pacman:' => 'pacman.gif',
			  ':lala:' => 'lala.gif',
			  ':grin:' => 'grin.gif',
			  ':love:' => 'love.gif',
			  ':winky:' => 'winky.gif',
			  ':blaf:' => 'blaf.gif',
			  ':bobo:' => 'bobo.gif',
			  ':globo:' => 'globo.gif',
			  ':metal:' => 'metal.gif',
			  ':info:' => 'info.gif',
			  ':exc:' => 'exc.gif',
			  ':q:' => 'q.gif',
			  ':wow:' => 'wow.gif',
			  ':lol:' => 'lol.gif',
			  ':idiot:' => 'idiot.gif',
			  ':lpmqtp:' => 'lpmqtp.gif',
			  ':8s:' => '8s.gif',
			  ':headbang:' => 'bang.gif',
			  ':no:' => 'no.gif',
			  ':ok:' => 'ok.gif',
			  ':shrug:' => 'shrug.gif',
			  ':crying:' => 'crying.gif',
			  ':noo:' => 'noo.gif',
			  ':zombie:' => 'zombie.gif',
			  ':cold:' => 'cold.gif',
			  ':hot:' => 'hot.gif',
			  ':blind:' => 'blind.gif',
			  ':drool:' => 'drool.gif',
			  
			  
			  
			  
		);

function contact(){

	$arracont=array("id"=>"68","title"=>"Contact Form ajax");
	$html=wpcf7_contact_form_tag_func($arracont, '','contact-form-7');
	
	?>

	
	
	<div id="pesta2" style="display:none">
	<div class='cont-inf'>
	<?php
	  $email=get_the_author_meta('email',1); $tlf=get_the_author_meta('perfil_tlf',1);
      echo 'You can contact me for the account of mail: <a href="mailto:' . $email . '">'.$email."</a>,";
	  echo '<br>';
	  echo 'or For the telephones: <strong>' . $tlf.'</strong>';
	  echo '<br>';
	  echo '<strong>Thank for contact me.</strong>'
	  
	?>
	</div>
	</div>	
	<div id="pesta1">
	<?php echo $html; ?>
	</div>

	
	<?php
	
	return false;
}


		function wp_get_cat_postcount($id) {
			$cat = get_category($id);
			$count = (int) $cat->count;
			$taxonomy = 'category';
			$args = array(
				'child_of' => $id,
			);
			$tax_terms = get_terms($taxonomy,$args);
			
			
			
		foreach ($tax_terms as $tax_term) {
			$count +=$tax_term->count;
		}
		return $count;
	} 		

function Randimages() {


	
	$the_query = new WP_Query( array ( 'orderby' => 'rand', 
	'posts_per_page' => '8',
	'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => array( 'post-format-image' )
            )
        )
	
	));
	
	
	
	

	while ($the_query->have_posts()) : $the_query->the_post(); 
	
		get_template_part( 'loop/slider/slider');
	
	endwhile;     
	
	wp_reset_postdata();
	
	


}		
	
function Decate($pos = false) {

	global $term;
	


	$WP_PATH = implode("/", (explode("/", $_SERVER['SCRIPT_NAME'], -1)));
	$WP_PATH .= '/category/';
	$resul = str_ireplace($WP_PATH,'',$_SERVER[REQUEST_URI]);
	
	$active='';
	 
    $vegetables = explode("/", $resul);	
	$cuancont = count($vegetables);
	
	
	
	$parent1=get_category_by_slug($vegetables[$cuancont-2])->term_id;
	$parents2 = get_terms( 'category', array( 'parent' =>  $parent1 ) );
	$nolist=false;
	$norepetir=false;
	if(!$parents2 && ($cuancont-2) == 0){
			
		$nolist=true;
		$parents2 = get_terms( 'category', array( 'parent' =>  0 ) );
		
	}else if(!$parents2){
		$norepetir = true;
		
		$parents2 = get_terms( 'category', array( 'parent' =>  $term->category_parent ) );
		
	
	}
	
	
	
	
	if($resul !=$_SERVER[REQUEST_URI] && $nolist ==false){
		if($pos){
			$liscate ='<aside id="thb-sidebar-main-left2" class="sidebar"><section id="categories-2" class="widget widget_categories"><ul style="box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);padding-left: 0px;padding-top: 10px;padding-bottom: 10px;"><li style="padding-left: 9px;"><a style="font-weight: bold;color: #000 !important;" class="h" href="'.get_bloginfo('url').'/'.'">All Categories</a></li>';
		}else{
			$liscate ='<aside id="thb-sidebar-main-left" class="sidebar"><section id="categories-2" class="widget widget_categories"><ul style="box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);padding-left: 0px;padding-top: 10px;padding-bottom: 10px;"><li style="padding-left: 9px;"><a style="font-weight: bold;color: #000 !important;" class="h" href="'.get_bloginfo('url').'/'.'">All Categories</a></li>';
		}
		
	}else{
		if($pos){
			$liscate ='<aside id="thb-sidebar-main-left2" class="sidebar"><section id="categories-2" class="widget widget_categories"><ul style="box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3); padding-left:0px;padding-top: 10px;padding-bottom: 10px;">';
		}else{
			$liscate ='<aside id="thb-sidebar-main-left" class="sidebar"><section id="categories-2" class="widget widget_categories"><ul style="box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3); padding-left:0px;padding-top: 10px;padding-bottom: 10px;">';
		}
	}
	
	$primernivel=false;
	$nameu=get_bloginfo('url');
	
	
	
	foreach ($vegetables as $vegetables2) {

		$obj=get_category_by_slug($vegetables2);
		
		if($vegetables2 !=='' && $nolist == false && $obj){
			
				$name=get_category_by_slug($vegetables2)->name;
				
				
				
				if ($vegetables2== $term->slug){
					$active='select';
				}else{
					$active='';
				}
				
				
				if($primernivel == false){
					
					$primernivel=true;
					if(!$norepetir){
						$liscate .='<li style="padding-left: 9px;"><a class="h '.$active.'"  href="'.get_term_link( $obj ).'">'.$name.'</a>';
					}else if($norepetir && $term->slug !=$vegetables2){
						$liscate .='<li style="padding-left: 9px;"><a class="h '.$active.'"  href="'.get_term_link( $obj ).'">'.$name.'</a>';
					}
				
				}else{
					if(!$norepetir){	
						$liscate .='<ul style="padding-left:9px"><li><a class="h '.$active.'" href="'.get_term_link( $obj ).'">'.$name.'</a>';
					}else if($norepetir && $term->slug !=$vegetables2){
						
						$liscate .='<ul style="padding-left:9px"><li><a class="h '.$active.'" href="'.get_term_link( $obj ).'">'.$name.'</a>';
					}
				}
				
		}
			
	}
		
	for ($i = 0; $i < $cuancont-3; $i++) {
	
		$cierre .='</ul></li>';
		
	}	
	
	foreach( $parents2 as $parent ){

	
				if ($parent->slug == $term->slug){
					$active='select';
				}else{
					$active='';
				}

		if($cuancont > 1 && $nolist ==false){
			$echo2 .= '<ul style="padding-left:9px"><li style="padding-left: 0px;"><a class="h '.$active.'" href="' . get_term_link( $parent ) . '">' . $parent->name . '</a></ul>';
		}else{
			$echo2 .= '<li style="padding-left:9px"><a class="h '.$active.'" href="' . get_term_link( $parent ) . '">' . $parent->name . '</a></li>';
		}

	}

	if (($cuancont-2) > 0){
		$side = $liscate.$echo2.$cierre.'</ul></ul></li></section></aside>';
	}else{
		$side = $liscate.$echo2.$cierre.'</ul></section></aside>';
	}


	return $side;
	
}	


function my_enqueue( $hook ) {

	

    if ('post-new.php' == $hook || 'post.php' == $hook) {
	
		wp_enqueue_script( 'my_custom_script', get_bloginfo('template_directory') . '/js/newentrada.js' );
        
    }else{
	
		return;
	
	}
	
	
	
    
}

add_action('admin_enqueue_scripts', 'my_enqueue');



function auto_post_thumbnail() {
          global $post;
          $already_has_thumb = has_post_thumbnail($post->ID);
              if (!$already_has_thumb)  {
              $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
                          if ($attached_image) {
                                foreach ($attached_image as $attachment_id => $attachment) {
                                set_post_thumbnail($post->ID, $attachment_id);
                                }
                           } else {
                                //set_post_thumbnail($post->ID, 'ID_imagen_por_defecto');
                           }
                        }
      } 
 //Final de la función
add_action('the_post', 'auto_post_thumbnail');
add_action('save_post', 'auto_post_thumbnail');
add_action('draft_to_publish', 'auto_post_thumbnail');
add_action('new_to_publish', 'auto_post_thumbnail');
add_action('pending_to_publish', 'auto_post_thumbnail');
add_action('future_to_publish', 'auto_post_thumbnail');
	
	
include 'framework/boot.php'; // Framework
include 'config/config.php'; // Theme setup

		



