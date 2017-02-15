<?php
global $offset;
	

	$viewd=$_COOKIE['view_mode'];

if($viewd == 2){
	$modedtable='text-align: center !important;display: inline-block !important;';

	} 

	
	if( empty($type) ) $type = 'numbers';
	$type2 = is_single() ? 'links' : $type;
	
//	$type='numbers';

// obtenemos el total de páginas
global $wp_query;
global $paged;
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$total = $wp_query->max_num_pages;

$ppp = get_option('posts_per_page');
$count_posts = wp_count_posts();
$published_posts = $count_posts->publish;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;



$offset3 = $published_posts-$offset;
$page_offset = $offset + ( ($paged-1) * $published_posts );
$offset1 = $published_posts-$offset3;
$offset2 = $published_posts-$offset3 + $ppp;

	$offset1=$offset1 - $ppp;
    $negative = ($offset1 < 0 );
    if ( $negative ) {
			$offset1=0;
		}

if ($offset2 >= $published_posts){

	$valor1=$offset2-$published_posts;

	$offset2 = $published_posts-$offset3;
	$javascroll='ya';
	//echo '<a href="?offset='.($offset2 - $ppp).'">Previous</a>';
}elseif(($offset2 - $ppp) ==0){
	$javascroll=$offset2;
	//echo ' | <a href="?offset='.$offset2.'">Next</a>';
}else{
	//echo '<a href="?offset='.$offset1.'">Previous</a>';
	//echo ' | <a href="?offset='.$offset2.'">Next</a>';
	$javascroll=$offset2;
}

	
	if($offset !== null && $offset+2  >=! $published_posts){
	
		
		$offset4=$offset;
	}		
		
?>


<div id="foo">
</div>


<script type='text/javascript'>




$(document).ready( function(){




		


	//$('#navi').append('<a class="smbutton load_more" href="'+newURL+'?offset=<?php echo $javascroll; ?>">Show More</a>');	


			
			
			// assign function to add behavior for onBlockChange event




	
	var cuanprimero = parseInt($('#cuanprimero').attr('cuanprimero'));
		
		if(isNaN(cuanprimero) ){
			var cuansegundo=parseInt($('#cuan').attr('cuan'));
			
			var totali='Display '+ cuansegundo + ' of '+ cuansegundo;
		
		}else{
			var cuansegundo=parseInt($('#cuan').attr('cuan'));
			var totali='Display '+(cuanprimero + cuansegundo) + ' of '+ '<?php echo $offset+1; ?>';
		
		}
		
	
	
	
	$('#Deviations').append(totali);
	
	
  $('a.smbutton.load_more').live('click',function(eEvento){
	eEvento.preventDefault();
	$('#navi').remove();
	pegination(); 
  });
 

} );

var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
//alert(newURL);
	
	

	
	
	ya=false;
    javascroll=0;	

	
	$(window).scroll(function(){
	
		if ($(document).height() - $(window).height() <= $(window).scrollTop() + $('#footer').height()+600){
			
			
			if (!$('#prueba').length & ya & javascroll !== 'ya'){
			
				pegination();
			}
		
    }	
	
	

	
	
		$(".scrollblock").live("mouseenter", function() {
			//alert($(this).attr("data-cont"));
			 
			 if(getParameterByName("offset") !==$(this).attr("data-cont")){
			//	history.pushState({}, '', window.location.href);
		//		window.history.replaceState( {} , '?offset=', '?offset='+$(this).attr("data-cont") ); 
				
			 }
			 
			
		});

	
			
    
	
	
	
	
	});
	
var actualID = 0;
var dd=0;
var ii=0;

function pegination(){

	ya=false;

var cuanprimero=$('#cuanprimero').attr('cuanprimero');

	
	
offset3 = <?php echo $published_posts ?> - cuanprimero;

offset1 = <?php echo $published_posts ?>-offset3;
offset2 = <?php echo $published_posts ?>-offset3 + <?php echo $ppp; ?>;

	offset1=offset1 - <?php echo $ppp; ?>;
    negative = (offset1 < 0 );
    if ( negative ) {
			offset1=0;
		}

if (offset2 >= <?php echo $published_posts ?>){

	valor1=offset2-<?php echo $published_posts ?>;

	offset2 = <?php echo $published_posts ?>-offset3;
	javascroll='ya';
	
}else if((offset2 - <?php echo $ppp ?>) ==0){
	javascroll=offset2;
	
}else{

	javascroll=offset2;
}	
	
	if(javascroll == 'ya'){
	
		
		return;
	}else{
		$('#cuanprimero').attr('cuanprimero',javascroll);
		//alert('ddd '+javascroll);
	}
	
	
	
	
	
	
	var pepe=parseInt($('#cuan').attr('cuan'));
	var tool=parseInt($('#tool').attr('tool'));
	
	
	var total = $('#cuantos').attr('total');
	var actual = $('#cuantos').attr('actual');
	var type  = $('#cuantos').attr('type');
	
if(parseInt(actual) === parseInt(total)){
	
	return;
}else{

	
	
	actual = ++actual;
	
	$('#cuantos').attr('actual', actual);
	var actual = $('#cuantos').attr('actual');
	pepe=parseInt($('#cuan').attr('cuan'));
		

	var urll=newURL+"?offset="+javascroll+"\&scroll=true";
	//alert(urll);	
$('#navi').remove();	
$('#content3').append('<div id="prueba" class="prueba" style="width:100%;height:150px;text-align:center;line-height:150px;">Loading...</div>');




$("#prueba").addClass("prueba");
var jqxhr = $.get(urll,processData=false, function(h) {

			
			var pepe2=parseInt($('#cuan').attr('cuan'));
			
			de = pepe + " de "+ (pepe + pepe2 );
			var dee='<div>'+de+'</div>';
			
			

})
.done(function(h) {
//alert( "second success" );

			//var cuanprimero=parseInt($('#cuan').attr('cuan'));
			//$('#cuanprimero').attr('cuanprimero',cuanprimero);
			
			if($('#tool').attr('tool') === '0'){
				$('#cuan').remove();
				//de = tool + " de "+ (pepe + tool);
				//var dee='<div id="tool-'+ (pepe + tool ) +'">'+de+'</div>';
				//$('#tool').attr('tool',(pepe + tool));
			}else {
				
				$('#cuan').remove();
				var tool=$('#tool').attr('tool');
				//alert(tool);
			}
			
	
		
		$('#prueba').remove();
		actualID = ++actualID;
		$('#content3').append('<div id="result-'+actualID+'" class="scrollblock" data-Height="" data-cont="'+(javascroll+1)+'"><div id="contenedor">'+h+'</div></div>');		

	
	

	
	
})
.fail(function(h) {
	alert( "error" );
	salir();
})
.always(function(h) {
//	alert( "finished" );
	
	var cuanprimero = parseInt($('#cuanprimero').attr('cuanprimero'));
	
		
	
	var cuansegundo=parseInt($('#cuan').attr('cuan'));
	
		//alert('cuansegundo '+cuanprimero);
	
	if($('#tool').attr('tool') === '0'){
		
		
		
		var totali='Display '+(cuanprimero + cuansegundo) + ' of '+ javascroll;
		$('#cuan').remove();
		//alert('uno '+totali);
		
		config="<span id='cssmenu'><ul ><li class='active has-sub last'><a href='#'><span class='buto'>Config</span></a><ul><li class='header'>Type of Pagination:</li><li><span class='check'><input type='radio' value='V1' checked name='R1' id='infi'><label for='infi'>Scrolling infinitely</label><span></li><li class='last'><a href='#'><span>Location</span></a></li></ul></li></ul></span>";
		
		
		
		
		den1='<div id="brotop"><hr><div class="browse-page-header" style="text-align: center;"><div style="padding-left: 5px;padding-right: 5px;">'+totali+'<span style="padding-left: 5px;padding-right: 5px;"><a href="#" onclick="" class="browse-proper-button"><span>&#8593;</span> Top</a>'+config+'</span></div></div></div>';
		
		$('#Deviations').html(totali);
		$('#pri').html('<td>'+den1+'<td>');
		
		
		//$('#result-'+actualID).prepend(den1);
		
		
		$('#tool').attr('tool',(cuanprimero + cuansegundo));
	
	}else{
		
		var totali='Display '+(cuanprimero + cuansegundo) + ' of '+ javascroll;
		
		$('#cuan').remove();
		//alert('dos '+totali);
		den1='<div id="brotop"><hr><div class="browse-page-header" style="text-align: center;"><div style="padding-left: 5px;padding-right: 5px;">'+totali+'<span style="padding-left: 5px;padding-right: 5px;"><a href="#" onclick="" class="browse-proper-button"><span>&#8593;</span> Top</a></span></div></div>	</div>';
		
		$('#result-'+actualID).prepend(den1);
			
		$('#tool').attr('tool',(tool+cuansegundo));
		
	}



var posts = $(".scrollblock"),
    postsPos = [],
    postsCur = 0,
    targetOffset = 0;

posts.each(function(){
	postsPos.push($(this).offset().top);
});

$(window).bind("scroll", function(){






//alert($('#result-1').outerHeight());




//alert(posts.length);



//alert(targ+1 +' '+ $('.scrollblock').length);
//var targ = Math.floor(($(window).scrollTop()-($('#result-1').outerHeight()*2)+$('#result-0').outerHeight()-200) / ($('#result-1').outerHeight()+58));

//alert(posts.length);


//if ( $(window).scrollTop()-$('#result-0').outerHeight() <=  $('.contenedor').outerHeight()+$('#footer').height()+611) {


 //&& $(window).scrollTop() >= $("#result-1").offset().top
if ( $(window).scrollTop()-$('#result-0').outerHeight() <=  $('.contenedor').outerHeight()+$('#footer').height()+611) {
//var targ = postsPos.binarySearch($(window).scrollTop() + targetOffset);

//var targ = postsPos.binarySearch(($(window).scrollTop()-($('#result-1').outerHeight()*2)+$('#result-0').outerHeight()-200) );



  if (targ != postsCur) {
  	postsCur = targ;
	targetOffset=$(window).scrollTop();
			
	
		if(getParameterByName("offset") !==posts.eq(targ).attr('data-cont')){
			//	history.pushState({}, '', window.location.href);
		//		window.history.replaceState( {} , '?offset=', '?offset='+$(this).attr("data-cont") ); 
//alert(targ + ' '+posts.eq(targ).attr('data-cont'));



window.history.replaceState( {} , '?offset=', '?offset='+posts.eq(targ).attr('data-cont') ); 

 
		//dd=window.location.hash.split("?", 2)[1] || "";
		
//if (window.location.hash.charAt(1) === "!" && window.location.pathname !== '/') {
          //window.location.replace('/#.*' + '#=dd1');
    //}
    //if hasbang not found then convert link to hashbang mode
//    if(window.location.hash.charAt(1) !== "!") {
//          window.location.replace(window.location.pathname + window.location.search+'#/?offset='+posts.eq(targ).attr('data-cont'));
		  
		  
//    }


 
//Ponemos un hash y al cabo de 2 segundos se cambia:

	
		


		
			
			
			window.history.replaceState( {} , '?offset', '?offset='+posts.eq(targ).attr('data-cont') );			
			 }
	
	
	
	
  }

}  
  
});

	function getParameterByName(name){
        var url     = document.URL,
            count   = url.indexOf(name);
            sub     = url.substring(count);
            amper   = sub.indexOf("?"); 

        if(amper == "-1"){
            var param = sub.split("=");
            return param[1];
        }else{
            var param = sub.substr(0,amper).split("=");
            return param[1];
        }

    }

Array.prototype.binarySearch = function(find) {
  var low = 0, high = this.length - 1,
      i, comparison;
  while (low <= high) {
    i = Math.floor((low + high) / 2);
    if (this[i] < find) { low = i + 1; continue; };
    if (this[i] > find) { high = i - 1; continue; };
    return i;
  }
  return this[i] > find ? i-1 : i;
};
	
		
		
		//var scrollorama = $.scrollorama({ blocks:'.scrollblock' });
		
/*		
		scrollorama.onBlockChange(function() {
				
				var i = scrollorama.blockIndex;
						history.pushState({}, '', window.location.href);
						
						window.history.replaceState( {} , '?offset', '?offset='+scrollorama.settings.blocks.eq(i).attr('data-cont') );
			});
*/			
			
		dd=$('#result-'+actualID).outerHeight();
		
		if(dd == 640){
		dd=dd-20;
		}
		
		$('#result-'+actualID).attr('data-Height', dd);
		
		ya=true;
	
	
	
	

	
	var tool=$('#tool').attr('tool');
	//alert(javascroll);

	
	//den3 = $('#content3').html();


	
		
});













// Perform other work here ...
// Set another completion function for the request above

jqxhr.always(function() {
//alert( "second finished" );

});
			
	
}

//style="visibility: hidden;"

}


function base64_decode( data ) {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, dec = "", tmp_arr = [];

    if (!data) {
        return data;
    }

    data += '';

    do {  // unpack four hexets into three octets using index points in b64
        h1 = b64.indexOf(data.charAt(i++));
        h2 = b64.indexOf(data.charAt(i++));
        h3 = b64.indexOf(data.charAt(i++));
        h4 = b64.indexOf(data.charAt(i++));

        bits = h1<<18 | h2<<12 | h3<<6 | h4;

        o1 = bits>>16 & 0xff;
        o2 = bits>>8 & 0xff;
        o3 = bits & 0xff;

        if (h3 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1);
        } else if (h4 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1, o2);
        } else {
            tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
        }
    } while (i < data.length);

    dec = tmp_arr.join('');
    dec = this.utf8_decode(dec);
    return dec;
}

/**
 * Converts a UTF-8 encoded string to ISO-8859-1
 * @see http://phpjs.org/functions/utf8_decode
 */
function utf8_decode ( str_data ) {
    var tmp_arr = [], i = 0, ac = 0, c1 = 0, c2 = 0, c3 = 0;

    str_data += '';

    while ( i < str_data.length ) {
        c1 = str_data.charCodeAt(i);
        if (c1 < 128) {
            tmp_arr[ac++] = String.fromCharCode(c1);
            i++;
        } else if ((c1 > 191) && (c1 < 224)) {
            c2 = str_data.charCodeAt(i+1);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
            i += 2;
        } else {
            c2 = str_data.charCodeAt(i+1);
            c3 = str_data.charCodeAt(i+2);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3;
        }
    }

    return tmp_arr.join('');
}

function salir(){
	exit();
}

</script>

<div id="cuanprimero" cuanprimero="<?php echo $offset ?>"></div>
<div id="tool" tool="0"></div>

   

<table id="pagination2" border="0" width="100%" cellspacing="10">
	<tr id="pri">
		<td align="left" width="200" style="vertical-align:middle">
			<div id="Deviations">
			
			</div>
			
		</td>
		<td align="center" style="vertical-align:middle"><div class="navi" id="navi">
		
	<?php if ( $javascroll !== 'ya' ) : ?>	
	
	<a class="smbutton load_more" href="?offset=<?php echo $javascroll; ?>">Show More</a>
	
	<?php endif; ?>
		
		
		</div>

		</td>
		<td align="right" width="200" style="vertical-align:middle"><div>config</div></td>
	</tr>
	<tr>
		<td colspan="3">
			
			<div class="contenedor">
			<div id="content3" class="page2" style="<?php echo $modedtable ?>" ></div>
			</div>				
		</td>
	</tr>
</table>
