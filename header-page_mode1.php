<?php
if (!empty($_COOKIE['page_mode'])){$page_mode=$_COOKIE['page_mode'];}else{$page_mode=0;}

$search = !empty($_GET['q']) || false;

if($search){

$searchq=$_GET['q'];

}

$pageid = get_the_ID();

global $offset,$term; 
global $wp_query;
global $paged;


$category = get_the_category(); 


if(is_tag()){
		
		
		$published_posts =  wt_get_category_count(single_tag_title( '', false ));
		
		
		
}else if($category && !$search){
	$cate=$term->cat_ID;
	$published_posts =  wp_get_cat_postcount($cate);
	

}else if($category && $search){
global $wpdb;

	$cate=$term->cat_ID;
	
	
	
	
	//$parents2 = get_terms( 'category', array( 'parent' =>  $cate ) );
	$cats2=$cate;
	$cats = get_category_children($cate,',');
	$cats2 .=$cats;
	
	
	$published_posts =  wp_get_cat_postcount($cate);

	
	
$searchID = $wpdb->get_col( $wpdb->prepare("SELECT ID FROM $wpdb->posts
LEFT JOIN $wpdb->term_relationships ON
($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON
($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE UCASE($wpdb->posts.post_title) REGEXP '{$searchq}'
AND $wpdb->posts.post_status = 'publish'
AND $wpdb->posts.post_type = 'post'
AND $wpdb->term_taxonomy.term_id in ({$cats2})",''));	

//AND $wpdb->term_taxonomy.term_id = {$cate}",''));	




	$_SESSION['SEARCHID'] = $searchID;

	
	
	$published_posts =  count($searchID);
	$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
	setcookie('search', $published_posts,0,$domain);
	$_COOKIE['search'] = $published_posts;
	

}else if($search){

global $wpdb;

$searchID = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE UCASE(post_title) REGEXP '{$searchq}' AND post_type='post' AND post_status='publish'");

	

	$_SESSION['SEARCHID'] = $searchID;

	
	
	$published_posts =  count($searchID);
	$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
	setcookie('search', $published_posts,0,$domain);
	$_COOKIE['search'] = $published_posts;

}else{
	
	$count_posts = wp_count_posts();	
	$published_posts =  $count_posts->publish;
}

$ppp = get_option('posts_per_page');


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$offset2 = $offset + $ppp;
		
if ($offset2 >= $published_posts){

	$offset2 = $offset;
	$javascroll='ya';
	
}else{

	$javascroll=$offset2;
}


//echo scf_html();



//$arracont=array("id"=>"4017","title"=>"Formulario de contacto 1");
//$ddd = wpcf7_contact_form_tag_func($arracont, '','contact-form-7');

	




?>




<!doctype html>
<html <?php language_attributes(); ?> <?php thb_html_class(); ?>> 
<head>
<script type='text/javascript' >

var complete = false;
window.onclick = function(e) {
	if(complete == false){
        e = e || window.event;
        e.preventDefault();
		alert('loading ... Wait');
	}
}


</script>

<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/slide.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.ajaxmanager.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/cont.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/b.js'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/contact-form-7/includes/js/2scripts.js'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/contact-form-7/includes/js/jquery.form.min.js'></script>



<script type='text/javascript'>


$.loadScript=function(e,t,n){var r=false,i=null;if($.isFunction(t)){i=t;r=n||r}else{r=t||r;i=n||i}var s=true;if($("script[src*='"+e+"']").length==0){s=true}else{s=false}if(s){$.ajax({type:"GET",url:e,success:function(){var t=document.getElementsByTagName("head")[0];var n=document.createElement("script");n.type="text/javascript";n.src=e;t.appendChild(n);i()},dataType:"script",cache:r})}else{if($.isFunction(i)){i.call(this)}}}
		

		
</script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.history.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.scrollTo-1.4.3.1-min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/click.js'></script>

<script type='text/javascript'>


jQuery.whenArray = function ( array ) {
return jQuery.when.apply( this, array );
};



    function customFadeIn(quien,speed, callback) {
	
			$(quien).fadeTo(speed,1, '', function() {
           
				callback();
           
              
			  });
	

    };
    function customFadeOut(quien,speed, callback) {
        
		$(quien).fadeTo(speed,0,'', function() {
            
            if(callback != undefined)
                callback();
        });
    };


var scrolloff=0;
$.wait = function( callback, seconds){return window.setTimeout( callback, seconds * 1000 );}

 
var espera=0;




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

</script>

	
	
		<?php thb_head_meta(); ?>

		<title><?php thb_title(); ?></title>

		<?php wp_head(); ?>


<script type='text/javascript'>
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
</script>



<script type='text/javascript'>


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

var plubliposts = <?php echo $published_posts ?>;


$(document).ready( function(){

	$(".grup0").colorbox({rel:'grup0', slideshow:true, width:"100%", height:"100%"});
	var grups="grup0";
	var grups2="grup0";
	var numpages = 0;
	var page;
	

		if($('.'+grups).length > 0){
			$('a.sitback').css('display','');
				
		}


var cpri=$("#cuanprimero").attr("cuanprimero");
$("#cuanprimero").remove();
$('body').append('<div id="cuanprimero" cuanprimero="'+cpri+'"></div>');

$.preloadImages = function() {
	
	for(var i = 0; i < arguments.length; i++){
		
		$("<img />").attr("src", arguments[i]);
		
	}

}


img1=thb_system.root_url+'/wp-content/themes/cecichaparroart/css/712.gif';
img2=thb_system.root_url+'/wp-content/themes/cecichaparroart/js/images/navig/plus_on.png';
img3=thb_system.root_url+'/wp-content/themes/cecichaparroart/js/images/navig/plus_off.png';
img4=thb_system.root_url+'/wp-content/themes/cecichaparroart/js/images/navig/slider_on.png';
img5=thb_system.root_url+'/wp-content/themes/cecichaparroart/js/images/navig/slider_off.png';
img6=thb_system.root_url+'/wp-content/themes/cecichaparroart/js/images/navig/minus_on.png';
img7=thb_system.root_url+'/wp-content/themes/cecichaparroart/js/images/navig/minus_off.png';
img8=thb_system.root_url+'/wp-content/themes/cecichaparroart/js/images/navig/scale.png';

$.preloadImages(img1, img2, img3, img4, img5, img6, img7, img8);


				
				
	
	$(document).delegate('button.toolbarButton', "click", function () {
	
			pageNumbers =  parseInt($('input#pageNumber').val());
			

			

			
		switch ( $(this).attr('id') ) {
			case 'previous':
					
				if ((pageNumbers - 2) >= 0){
					
					
					$(window).scrollTop( $('#result-'+ (pageNumbers - 2) ).offset().top );
			
					
				
				}
				
				
				
				break;
			case 'next':
					

					
				if (( pageNumbers + 1 ) <= numpages){
					
					$(window).scrollTop( $('#result-'+ pageNumbers ).offset().top );
			

				
					
				}
		
				break;				
		
		}
		

		
	
	});
	
	

	$(document).delegate('input#pageNumber', "click", function () {
	
		$(this).select();
	
	});
	
	$(document).delegate('input#pageNumber', "change", function () {
	
		
		

      if ($(this).val() !== ($(this).val() | 0).toString() || $(this).val() > numpages) {
        
		$(this).attr('value', page);
		
      }else{
		$(window).scrollTop( $('#result-'+ ($(this).val() - 1) ).offset().top );
	  }
	
	
	});
	
	

  
  $(document).delegate('a.paging-results-go', "click", function (e) {
	var s = Math.max(parseInt($(".paging-results-go-input:visible").val(), 10), 0);
	if(!isNaN(s)){
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location = newURL + '?offset=' + s;
	}
  });

var espera;
espera=1;

var qq=GetUrlvalues('q','');


	
javascrollphp='<?php echo $javascroll ?>';

			
if( javascrollphp !== 'ya'){

	var cuanprimero = parseInt($('#cuanprimero').attr('cuanprimero'));
		
		if(isNaN(cuanprimero) ){
			var cuansegundo=parseInt($('#cuan').attr('cuan'));
			
			var totali='Display '+ cuansegundo + ' of '+ cuansegundo;
		
		}else{
			
			var cuansegundo=parseInt($('#cuan').attr('cuan'));
			
			primoff= '<?php echo $offset; ?>';
			
			if(primoff == 0 || primoff ==''){
			
				var totali='Display '+(cuanprimero + cuansegundo) + ' of '+ (cuanprimero + cuansegundo);
				$('#result-0').attr('data-displayd',(cuanprimero + cuansegundo));
				$('#result-0').attr('data-displayoff',(cuanprimero + cuansegundo));
			
			}else{
			
				var totali='Display '+(cuanprimero + cuansegundo) + ' of '+ '<?php echo $offset; ?>';
				
				$('#result-0').attr('data-displayd',(cuanprimero + cuansegundo));
				$('#result-0').attr('data-displayoff','<?php echo $offset; ?>');
				
			}
			
			
		
		}
		
	
	
	
	$('#Deviations').append(totali);

}
 
 
  $(document).delegate('a.load_more', "click", function (e) {
	e.preventDefault();
	$('#navi').remove();
	pegination(); 
  });
 



var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;

	
    var previous = "";
	var message = "";
	var a=0;	
	ya=false;
    javascroll=0;

	var barrascro1=false,barrascro2=false;

function scroll1(si){


	if (si){
	
	
    $.loadScript('<?php echo get_template_directory_uri().'/js/waypoints.min.js' ?>', true, function () {
		
		espera=0;
        
		
		_.defer(function () {
            jQuery(".contenedor:bottom-in-view").each(function () {
                if (!$('#prueba').length & ya & javascroll !== 'ya') {
                    pegination();
				}
				
            });
		
        });
		
		
		
    
		espera=0;
		_.defer(function () {
		
		if(window.location.href.indexOf('photo') <= 0 ){

			jQuery(".scrollblock:above-the-top").each(function() {
				message = $(this).attr('data-cont');
				page=$(this).attr('data-page');
				displayd=$(this).attr('data-displayd');
				displayoff=$(this).attr('data-displayoff');
				displayoff2 = displayoff;
				grups2=grups;
				grups="grup" + (page - 1);
				
				
				
				if(displayd == displayoff) displayoff2 = 0;
				
				
			});
        
			if (message != previous) {
			
				if($('.'+grups).length > 0){
					$('a.sitback').css('display','');
					
					$('.'+grups2).colorbox.remove();
					$('.'+grups).colorbox({rel:grups, slideshow:true, width:"100%", height:"100%",page: (page - 1)});
				}else{
				
					$('a.sitback').css('display','none');
				}
			
				
				
				
			
				if ('replaceState' in history){
			
					if (qq){
							
						val = '?q='+qq.value + '&offset='+message;
						window.history.replaceState( {} , '', val );	
			
					}else{
			
						window.history.replaceState( {} , '?offset=', '?offset='+message);	
					}
			
			
				}else{
				
					window.location.hash="#offset="+message;

				}
				previous = message;
				
				
				
					
					$('#pageNumberLabel').text('Page :');
					
					
					$('#pageNumber').attr('value',page);
					$('a.sitback').attr('data-grup','grup'+(page-1));
					numpages=( actualID + 1);
					$('#numPages').text('of '+ numpages);
					$('.paging-results-go-input').val(displayoff2);
					
					
					pageNumbers =  parseInt($('input#pageNumber').val());
			
					if ((pageNumbers - 1) == 0){
						
						$('button#previous').addClass("disabled");
						
					}else{
						
						$('button#previous').removeClass("disabled");
					}
			
					if ((pageNumbers ) >= numpages){
						
						$('button#next').addClass("disabled");
					}else{
						
						$('button#next').removeClass("disabled");
					}
					
					$('#numDisplay').text('Display ' + displayd +' of '+displayoff);
				
			
			}        
		
		}
			
			});
	
	
	
	
	});	
	

	}else{

		 
        _.defer(function () {
            jQuery(".contenedor:bottom-in-view").each(function () {
                if (!$('#prueba').length & ya & javascroll !== 'ya') {
                    pegination();
				}
			
			});
			espera = 0;
        });

		
		_.defer(function () {

		if(window.location.href.indexOf('photo') <= 0){

			jQuery(".scrollblock:above-the-top").each(function() {
				message = $(this).attr('data-cont');
				page=$(this).attr('data-page');
				displayd=$(this).attr('data-displayd');
				displayoff=$(this).attr('data-displayoff');
				displayoff2 = displayoff;
				grups2=grups;
				grups="grup" + (page - 1);
				
				if(displayd == displayoff) displayoff2 = 0;
			});
        
			if (message != previous) {
			
				if($('.'+grups).length > 0){
					$('a.sitback').css('display','');
					
					$('.'+grups2).colorbox.remove();
					$('.'+grups).colorbox({rel:grups, slideshow:true, width:"100%", height:"100%",page: (page - 1)});
				}else{
					$('a.sitback').css('display','none');
					
				}
				

			
				if ('replaceState' in history){
			
					if (qq){
							
						val = '?q='+qq.value + '&offset='+message;
						window.history.replaceState( {} , '', val );	
			
					}else{
			
						window.history.replaceState( {} , '?offset=', '?offset='+message);	
					}
			
			
				}else{
				
					window.location.hash="#offset="+message;

				}
				previous = message;
			
					
					
				
				
					$('#pageNumberLabel').text('Page :');
					//$('#pageNumberLabel').text('Page '+page+', Display '+displayd+' of '+displayoff+' Offset:');
					
					$('#pageNumber').attr('value',page);
					$('a.sitback').attr('data-grup','grup'+(page-1));
					numpages=( actualID + 1 );
					
					$('#numPages').text('of '+ numpages);
					$('.paging-results-go-input').val(displayoff2);
				
				
					pageNumbers =  parseInt($('input#pageNumber').val());
			
					if ((pageNumbers - 1) == 0){
						
						$('button#previous').addClass("disabled");
						
					}else{
						
						$('button#previous').removeClass("disabled");
					}
			
					if ((pageNumbers ) >= numpages){
						
						$('button#next').addClass("disabled");
					}else{
						
						$('button#next').removeClass("disabled");
					}
			
				$('#numDisplay').text('Display ' + displayd +' of '+displayoff);
			
			}     


			
		
		}

		espera=0;
		});	


		
	
	}

}
	

$(window).scroll(function () {
	
	if($("script[src*='"+'<?php echo get_template_directory_uri().'/js/waypoints.min.js' ?>'+"']").length==0){
		scroll1(true);
	}else{
		scroll1(false);
	}

});

var actualID = 0;
var dd=0;
var ii=0;


	var ptitle = $('title').html();

var sicon = false;
var siconp = false;
var URLP='';
var finpa=false;
var finpb=false;



function pegination() {

	
	var ptitle = $('title').html();
	
	
            if (detectIE() <= 9) {


                if (History.getHash().indexOf("offset=") != 0) {

                    URLP = window.location.href.replace(/[\?#].*/, '') + History.getHash();


                } else {


                    URLP = window.location.href.replace(/[\?#].*/, '');


                }


            } else {


                URLP = window.location.protocol + "//" + window.location.host + window.location.pathname;


            }


    ya = false;
    var e = parseInt($("#cuanprimero").attr("cuanprimero"));
    var offset2 = e + parseInt(thb_system.posts_per_page);
	
    
    if (offset2 >= plubliposts ) {
		

		if(sicon){
		
			
		
			if(siconp){
				
				var t = parseInt($("#cuanprimero").attr("cuanprimero"));
				var n = parseInt($("#cuan2").attr("cuan"));
				var r = "Display " + (t + n) + " of " + t;
                $("#cuan").remove()

                var den1 = '<div id="" style="margin-left:10px !important; margin-right: 10px ! important;"><div class="hr"></div><div class="browse-page-header" style="text-align: center;"><div style="padding-left: 5px;padding-right: 5px;">' + r + "</div></div></div>";
                $("#Deviations").html(r);
                $("#pri").removeClass("pri");
                $("#pri").html('<td width="100%">' + den1 + "<td>");

				$("#content3").append($('#loadconte').html());
				
				$("#result-" + actualID).attr('data-displayd',(t + n));
				$("#result-" + actualID).attr('data-displayoff',t);
				
				
				savec();
				$('#loadconte').html('');
				sicon=false;				
				siconp=false;
				finpa=true;
				
			}else{
				
				$("#content3").append($('#loadconte').html());
				
				savec();
				$('#loadconte').html('');
				sicon=false;
				finpa=true;
				
			}
		}

		
		
		offset2 = e;
		if (finpa==true && finpb == false){
			finpb=true;
			$("#content3").append('<div style="text-align: center;font-size: 18px; font-weight: bold; padding: 30px 0px;color: #D8E4D8;">-- END --</div>');
			savec(true);
        }else if(finpa ==false && finpb == false ) {
			$("#content3").append('<div style="text-align: center;font-size: 18px; font-weight: bold; padding: 30px 0px;color: #D8E4D8;">-- END --</div>');
			savec(true);
		}
		
		javascroll = "ya";
    
	} else if (offset2 - <?php echo $ppp ?> == 0) {
		
        javascroll = offset2
    } else {
        if (actualjavascroll == "") {
			
            javascroll = offset2;
			
        } else {
			
            javascroll = actualjavascroll + <?php echo $ppp ?>;
            actualjavascroll = "";
        }
    } if (javascroll == "ya") {
		
        return
    } else {
			
				
		$("#cuanprimero").attr("cuanprimero", javascroll);	
			
			
		
		
        
    }
    var t = parseInt($("#cuan").attr("cuan"));
    var n = parseInt($("#tool").attr("tool"));
    var r = $("#cuantos").attr("total");
    var i = $("#cuantos").attr("actual");
    var s = $("#cuantos").attr("type");
    if (parseInt(i) === parseInt(r)) {
        return
    } else {
        i = ++i;
        $("#cuantos").attr("actual", i);
        var i = $("#cuantos").attr("actual");
        t = parseInt($("#cuan").attr("cuan"));




        search = '<?php echo $search ?>';

        if (search) {
            search = '&q=<?php echo $_GET['q'] ?>';
        }
		
		
        var o = newURL + "?offset=" + javascroll + "&scroll=true" + search + "&grup="+(actualID + 1);

		
		if(sicon){
		
			if(siconp){
			
				var t = parseInt($("#cuanprimero").attr("cuanprimero")) - thb_system.posts_per_page;
				var n = parseInt($("#cuan").attr("cuan")) - thb_system.posts_per_page;
			
				var r = "Display " + (t + n) + " of " + javascroll;
				
                $("#cuan").remove();
				
				
                
                var den1 = '<div id="" style="margin-left:10px !important; margin-right: 10px ! important;"><div class="hr"></div><div class="browse-page-header" style="text-align: center;"><div style="padding-left: 5px;padding-right: 5px;">' + r + "</div></div></div>";
                $("#Deviations").html(r);
                $("#pri").removeClass("pri");
                $("#pri").html('<td width="100%">' + den1 + "<td>");

				$("#content3").append($('#loadconte').html());

				$("#result-" + actualID).attr('data-displayd',(t + n));
				$("#result-" + actualID).attr('data-displayoff',javascroll);
				$("#result-" + actualID).attr('data-page',(actualID + 1));
				
				savec();
				$('#loadconte').html('');
				sicon=false;				
				siconp=false;
			
			}else{
				$("#content3").append($('#loadconte').html());
				savec();
				$('#loadconte').html('');
				sicon=false;
			}
		}
		
		
        $("#navi").remove();

        $("#content3").append('<div id="prueba" class="prueba" style="width:100%;height:150px;text-align:center;line-height:150px;">Loading...</div>');
        var u = false,
            a = false;

        function f() {
            a = false
        }

        function l() {
            u = false
        }
        var c = window.navigator.userAgent;
        if (c.indexOf("MSIE ") > 0) {
            timer = setInterval(function () {

			
			
                if (!$("#prueba").length) {
                    clearInterval(timer)
                }

                if (u == false) {
                    u = true;
                    customFadeIn("#prueba", 250, f)
                }
                if (a == false) {
                    a = true;
                    customFadeOut("#prueba", 250, l)
                }
            }, 50)
        }
        var h = $.get(o, processData = false, function (e) {
            var n = parseInt($("#cuan").attr("cuan"));
            de = t + " de " + (t + n);
            var r = "<div>" + de + "</div>"
        }).done(function (e) {
            if ($("#tool").attr("tool") === "0") {
                $("#cuan").remove()
            } else {
                $("#cuan").remove();
                var t = $("#tool").attr("tool")
            }

            $("#prueba").remove();
            actualID = ++actualID;
			
			if ($("#content3").length <= 0){
				
				newblo = '<div id="result-' + actualID + '" class="scrollblock" data-cont="' +  javascroll  + '" ><div id="contenedor">' + e + '</div></div>';
				
				if($("#loadconte").length <=0){
					
					$("body").append('<div id="loadconte">'+ newblo + '</div>');
					sicon=true;
				}else{
					$("#loadconte").append(newblo);
					sicon=true;
				}
				
			
			}else{
				
				$("#content3").append('<div id="result-' + actualID + '" class="scrollblock" data-page="'+(actualID + 1)+'" data-displayd="" data-displayoff="" data-cont="' +  javascroll  + '"><div id="contenedor">' + e + '</div></div>');


				
			
			}
			
			
            //$("#content3").append('<div id="result-' + actualID + '" class="scrollblock" data-cont="' +  javascroll  + '"><div id="contenedor">' + e + '</div></div>')
			
			
        }).fail(function (e) {
            alert("error");
            salir()
        }).always(function (e) {
            var t = parseInt($("#cuanprimero").attr("cuanprimero"));
            var n = parseInt($("#cuan").attr("cuan"));
            if ($("#tool").attr("tool") === "0") {
                
				
				if ($('#pagination2').length == 0){siconp=true;}
				
				
				var r = "Display " + (t + n) + " of " + javascroll;
                
				
				
				$("#cuan").remove();


                var den1 = '<div id="" style="margin-left:10px !important; margin-right: 10px ! important;"><div class="hr"></div><div class="browse-page-header" style="text-align: center;"><div style="padding-left: 5px;padding-right: 5px;">' + r + "</div></div></div>";
                $("#Deviations").html(r);
                $("#pri").removeClass("pri");
                $("#pri").html('<td width="100%">' + den1 + "<td>");
                $("#tool").attr("tool", t + n)
						
				$("#result-" + actualID).attr('data-displayd',(t + n));
				$("#result-" + actualID).attr('data-displayoff',javascroll);
				$("#result-" + actualID).attr('data-page',(actualID + 1));
				
				
            } else {
                var r = "Display " + (t + n) + " of " + javascroll;
				
				
				
                $("#cuan").remove();
                var den1 = '<div id=""><div class="hr"></div><div class="browse-page-header" style="text-align: center;"><div style="padding-left: 5px;padding-right: 5px;">' + r + '<span style="padding-left: 5px;padding-right: 5px;"></span></div></div></div>';
                
				$("#result-" + actualID).prepend(den1);
				
                $("#tool").attr("tool", i + n)
				$("#result-" + actualID).attr('data-displayd', (t + n));
				$("#result-" + actualID).attr('data-displayoff', javascroll);
				$("#result-" + actualID).attr('data-page',(actualID + 1));

				
            }

				savec();
			

            var i = $("#tool").attr("tool");


			ya = true;
            espera = 1;

        })
    }
}


function savec(listo){

					
					numpages=( actualID + 1);
					
					$('#numPages').text('of '+ numpages);

					pageNumbers =  parseInt($('input#pageNumber').val());
			
					if ((pageNumbers - 1) == 0){
						
						$('button#previous').addClass("disabled");
						
					}else{
						
						$('button#previous').removeClass("disabled");
					}
			
					if ((pageNumbers ) >= numpages){
						
						$('button#next').addClass("disabled");
					}else{
						
						$('button#next').removeClass("disabled");
					}					
	
            if (detectIE() <= 9) {
				if (History.getHash().indexOf("offset=") != 0) {
                    URLP2 = window.location.href.replace(/[\?#].*/, '') + History.getHash();
                } else {
                    URLP2 = window.location.href.replace(/[\?#].*/, '');
                }
            } else {
                URLP2 = window.location.protocol + "//" + window.location.host + window.location.pathname;
            }	
	
	
	if(listo ==''){listo=false}

	
		
		
	
	
	if ($('#footer').css('display') !== 'none' && !listo && URLP2.indexOf("/photo/") < 0){
		$('#footer').css('display','none');
		
		
	}else if($('#footer').css('display') == 'none' && listo ){
		$('#footer').css('display','inline-block');

	}

	indexs=($('.scrollblock').length - 1);
	if ($('.scrollblock:eq('+indexs+')').attr("data-cont") && $("#content3").length >= 1){
		
		myElement = {
			url: URLP,
			title: ptitle,
			value: $('#content').html()
		}
		
		conscroll[0] = myElement;
	
	}
				
}


function salir() {

    return;

}
} );
</script>



	</head>
	<body class="ui-page ui-body-c home page page-id-<?php echo $pageid ?> page-template page-template-template-blog-stream-php logo-left logo-left pageheader-layout-left pageheader-big thb-desktop">


<div id="modal-contact" class="modal-contact2" style="display:none">
	<div style="opacity: 0.2; z-index: 900000;" id="saicl-overlay"></div>
	
	<div class="saicl-modal-identification" style="display: block;" id="saicl-modal2">
	
	<div id="saicl-modal-wrap">
	
	<span id="saicl-modal-close"></span>
	<div id="saicl-modal-header"><h3 id="saicl-modal-title">Contact</h3></div>
	<div class="constainer-pes">

	<div class="pesta pesta1 active" data-pesta="pesta1">Form</div>
	<div class="pesta pesta2" data-pesta="pesta2">Info Contact</div>

	</div>

	
	<div id="saicl-modal-content" class="conta">
		<div id="lod" style="text-align: center;">
		<img style="" alt="Enviando..." src="http://localhost/ceci/wp-content/plugins/contact-form-7/images/ajax-loader.gif" class="ajax-loader">
		</div>
	</div>
	
	<div id="saicl-modal-footer">
	
	<a id="send-contact" role="none" class="saicl-modal-ok saicl-modal-btn" href="#">Accept</a>
	<a id="cancel-contact" class="saicl-modal-cancel saicl-modal-btn" role="none" href="#">Cancel</a>
	
	</div>
	
	</div>
	</div>

</div>	
	
<div id="loading">
	  <!--
	  <div>
		<img src="" alt="" class="logo" />
		<span></span>
		<img src="/assets/images/loading.gif" alt="" />
	  </div>
   -->
	</div>
<div style="height: 59px; position: relative;">	
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
<?php if(!$category && !$search): ?>
<div class="slc">
<div id="randp" style="text-align: center;padding-top: 10px;margin-left: -6px;">
<center><div class="topceci"></div></center>
</div>
</div>
<?php endif; ?>
	<?php thb_body_start(); ?>
	

	
			<?php thb_header_before(); ?>

