<?php
$pageid = get_the_ID();
$category = get_the_category(); 

if($category){

	$cate=$category[0]->cat_ID;
	
	$published_posts =  wt_get_category_count($cate);
	
}else{
	$count_posts = wp_count_posts();
	$published_posts =  $count_posts->publish;
}
$imgurl=types_render_field("image", array("url" => "true")); 

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php thb_html_class(); ?>> 
<head>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/zoom.css" />

<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.2.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.mousewheel.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/zoom.js' id="zoomp"></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/tinymce/tinymce.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/2_jquery.ajaxmanager.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/2_jquery.history.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/saicl_script.min.js'></script>

<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/2_click.js'></script>


<?php if($imgurl !==''): ?>






<?php endif; ?>



<script type='text/javascript'>



function GetUrlvalues(name, type){


	if(type==''){type='&'}
		
	var vars = [];
	var noo = true;
	var onlyhash=false;
	
	if(type == '#' && window.location.hash){
			onlyhash=true;
			searchurl=window.location.hash;
	
	}else{
			searchurl =window.location.search;
	}
	
	
	
	if(searchurl.length == (searchurl.lastIndexOf(type+name) + (name.length+1)) ){
		
		return null;
	}
	
		if (window.location.search.indexOf('?'+name+'=') >= 0 && window.location.search.indexOf('&'+name+'=') < 0 && onlyhash == false){
			noo = false;
			var result = new RegExp(name + "=([^&]*)", "i").exec(window.location.search);
			
				varres = {
					type: '?',
					value: result[1]
				}
				
				return vars[0]=varres;
		
		}
	
	
	
	var res = searchurl.slice(searchurl.indexOf(type) + 1).split(type);
    
    for(var i = 0; i < res.length; i++){
		
		var result = new RegExp("\\b" + name + "=\\b", "i").test(res[i]);
		
		
	  
		if (res[i] == name){noo = true;}
	  
		if(res[i].replace(name + '=', '') !== res[i] && result){
			
			noo = false;
			varres = {
				type: type,
				value: res[i].replace(name + '=', '')
			}
			
			vars[0]=varres;
			
			
	  
		}
      
    }
	
	if(noo == true){
		
		return null;
	}else{
		
		return vars[0];	
	}

}



if(window.location.hash) {
var nocambiarurl =true;



if (window.location.hash.indexOf('#/') >= 0 ) {
	nocambiarurl=false;
	var hashes2 = window.location.href.slice(window.location.href.indexOf('#/') + 1).split('#/');
	
	$(location).attr('href',window.location.protocol + "//" + window.location.host + hashes2);
	
 
 }else if (window.location.hash.indexOf('#photo') >= 0 ) {
	nocambiarurl=false;
	
	var hashes2 = window.location.href.slice(window.location.href.indexOf('#photo') + 1).split('#photo');
	
	
	
	window.location.href = window.location.protocol + "//" + window.location.host + window.location.pathname +'/'+ hashes2;
	
 
 }else if((window.location.hash.indexOf('#offset') == 0 )){
		var hashes2 = window.location.href.slice(window.location.href.indexOf('#offset') + 1).split('#offset');
		
		
		window.location.href = window.location.protocol + "//" + window.location.host + window.location.pathname +'/?'+ hashes2;
 
 }

 
 
 
if(nocambiarurl){

var valueurl = new Array();
var composturl ='';

				

var byName1 = GetUrlvalues('offset','#');

if( byName1 !== null ){ valueurl['offset'] = byName1.value  }

var byName2 = GetUrlvalues('q','');

if( byName2 !== null ){ valueurl['q'] = byName2.value  }


if (byName1 !== undefined || byName2 !== undefined) {

if(valueurl['q'] && valueurl['offset']){

	composturl = '?q=' + valueurl['q'] + '&offset='+ valueurl['offset'];


}else if(valueurl['q'] && !valueurl['offset']){

	composturl = '?q=' + valueurl['q'];

}else if(valueurl['offset'] && !valueurl['q']){

	composturl = '?offset='+ valueurl['offset'];

}







	$(location).attr('href',window.location.pathname+composturl);

}else{

 

  


}

}
}

function detectIE() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf('MSIE ');

    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }


    // other browser
    return 100;
}	


var conscroll=new Array();
	var myElement = {
		url: '',
		title: '',
		value: ''
	}

function scroll2(ele,vat){
	
$(ele).stop();
if(parseInt($(ele).position().top-210) <= -parseInt($(ele)[0].scrollHeight)){
	$(ele).animate({top: 0}, 'linear');
	return;
}


if(vat===1){
	$(ele).stop().animate({top: 0}, 'linear');
	return;
}
	$(ele).animate({top: "-="+($(ele)[0].scrollHeight-210)}, $(ele)[0].scrollHeight*20,'linear');
}


$.wait = function( callback, seconds){return window.setTimeout( callback, seconds * 1000 );}
var espera=0;


</script>


	
	
		<?php thb_head_meta(); ?>

		<title><?php thb_title(); ?></title>
		<meta http-equiv="x-dns-prefetch-control" content="off" />
		<meta name="classification" content="Art">
		<meta name="copyright" content="Copyright <?php echo date('Y') ?> Ceci Chaparro Photography">
		<meta name="og:title" content="<?php echo get_the_title($post_id) ?>">
		<meta name="og:image" content="<?php echo $imgurl ?>">
		<meta name="og:url" content="<?php echo get_permalink( $post_id ) ?>">
		<meta property="og:image" content="<?php echo $imgurl ?>">

		<?php wp_head(); ?>



	</head>
	<body class="ui-page ui-body-c home page page-id-<?php echo $pageid ?> page-template page-template-template-blog-stream-php logo-left logo-left pageheader-layout-left pageheader-big thb-desktop">
	
	
<div id="loading">
	  <!--
	  <div>
		<img src="" alt="" class="logo" />
		<span></span>
		<img src="/assets/images/loading.gif" alt="" />
	  </div>
   -->
	</div>

<div style="height: 59px; position: relative; background: none repeat scroll 0% 0% rgb(33, 33, 33);	">	
<table border="1" width="100%" id="menub">
	<tr>
		<td>
		<div id="container-search" class="container-search"><?php get_search_form(); ?></div>
		</td>
		<td width="100%"><div class="nav"><?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		
		<ul id="menu-primary" class="menu" style="margin: 0px;">
			<li id="contact-ajax" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo get_bloginfo('url').'/contact/'; ?>">Contact</a></li>
		</ul>
		
		</div>

		
		</td>
	</tr>
</table>
</div>
	

	<?php thb_body_start(); ?>
	

	
			<?php thb_header_before(); ?>

