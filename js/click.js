var actualjavascroll='';
var initextcont=true;
var urldiferen=false;
var noajaxp=false;
var aborthtml = false; 
var idssspre2 = '';
var inieditor =false;
var titlep='';
		
		
		var toconte=false;
		var History = window.History;
		var caconte = $.ajax();
		var successajax = false;
		var successajax_cont = 0;


	
	// Wait for Document
	$(document).ready( function(){


			
			var cacheurl=new Array();
			var titleh = '';
			var myElement2;
			var idssspre = '';
	
	
			if(detectIE() <=9 ){
			
			
				if (History.getHash().indexOf("offset=") != 0 ){
					
					var URL2 = window.location.href.replace(/[\?#].*/, '') + History.getHash();
					
				
				}else{
					
					
					var URL2 = window.location.href.replace(/[\?#].*/, '');
					
				
				}
				
			
			}else{
			
			
				var URL2 = window.location.protocol + "//" + window.location.host + window.location.pathname;
			
			
			}
	
			
	
			if (URL2.indexOf("/photo/") >0){
			
			
					es=thb_system.root_url + '/wp-content/themes/cecichaparroart/js/tinymce/tinymce.min.js';

					if($("script[src*='"+es+"']").length==0){
						
						require(thb_system.root_url + '/wp-content/themes/cecichaparroart/js/tinymce/tinymce.min.js','tinymce2');
					
					}
			
			
					es=thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/saicl_script.min.js';
					if($("script[src*='"+es+"']").length==0){
						
						require(thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/saicl_script.min.js','saicl_script');
					
					}
			
				
				myElement2 = {
					title: $('title').html(),
					value: $('#content').html()
				}											
				cacheurl[URL2]=myElement2;
			
			}
	
		
		complete=true;
		var myajax_1 = $.manageAjax.create('myajax_1', {queue: false, maxRequests: 1, abortOld: true,cacheTTL:7000,cacheResponse:true});
		var myajax_2 = $.manageAjax.create('myajax_2', {queue: false, maxRequests: 1, abortOld: true,cacheTTL:7000,cacheResponse:true});
		
		
		$(document).delegate('a.Dajaxy', 'click', function (event) {
				
				History.clearQueue();
				event.preventDefault();
				click(this);
				
		
		});
		
		$(window).bind('hashchange', function () {

			if(detectIE() != 100 ){
			tt=window.location.href.replace(/[\?#].*/, '');
			
			
			if (History.getHash().indexOf("offset=") == 0 && urldiferen == true ){
			
				urldiferen=false;
				
				cargar(conscroll[0].url);
				
			}else if(History.getHash().indexOf("offset=") == -1){
			
				urldiferen=true;
				
				cargar(tt+History.getHash());
				

			
			}
			
			
					
		}
			
		
		});		


		$(window).bind('statechange', function () {
				
				
				
					
			if(detectIE() <= 9 ){
			
				return;
			
			}
				
				e = window.location.protocol + "//" + window.location.host + window.location.pathname;
				
				cargar(e);

		});


		function click(e){
			
			
			
			
			
			
			if(detectIE() <=9 ){
			
			
				if (History.getHash().indexOf("offset=") != 0 ){
					
					var URL = window.location.href.replace(/[\?#].*/, '') + History.getHash();
					
				
				}else{
					
					
					var URL = window.location.href.replace(/[\?#].*/, '');
					
				
				}
				
			
			}else{
			
			
				var URL = window.location.protocol + "//" + window.location.host + window.location.pathname;
			
			
			}
			
				
				
				if( URL.indexOf("/photo/") < 0 && URL.indexOf(thb_system.root_url) == 0 || URL.indexOf("/category/") > 0 && URL.indexOf("/photo/") < 0){
			
					scrolloff = $(window).scrollTop();
					
					var myElement = {
						url: URL,
						title: $('title').html(),
						value: $('#content').html()
					}

					
				conscroll[0] = myElement;				
				
				
			
				
				}
			
				
				titleh = $(e).attr('title') || $(e).attr('href');
				$('title').html(titleh);
				History.pushState(null, '', $(e).attr('href'));
			
			
		}
		
		

		
		
		function cargar(e){
			
			
				idssspre='';
				
			
			if(successajax_cont == 1){
			
				$.manageAjax.abort('myajax_1');$.manageAjax.clear('myajax_1');
			
			}else if(successajax_cont == 2){
			
				$.manageAjax.abort('myajax_2');$.manageAjax.clear('myajax_2');
			
			}
			
				
				
			
			if(conscroll.length > 0 && conscroll[0].url == e){
				
				
				
				$('title').html(conscroll[0].title);
				$("#content").html(conscroll[0].value);
				
				if( e.indexOf("/photo/") < 0 && e.indexOf(thb_system.root_url) == 0 || e.indexOf("/category/") > 0 && e.indexOf("/photo/") < 0){
					toconte = false;
				
				}
				
				
				
				
				if(detectIE() <= 9){	
					History.pushState(null, '', '');
				}
				
					
					
					$(window).scrollTop(scrolloff);
					
				
					
				$("#content").animate({'min-height' : ''});
					if (typeof actualID != 'undefined'){
						actualjavascroll=javascroll;
					}

				
					if($('#prueba').length > 0){
						$('#prueba').remove();
					}
					
					
					eh = parseInt($("#cuanprimero").attr("cuanprimero"));
					var offset2h = eh + parseInt(thb_system.posts_per_page);
					espera=0;
					

						
					
					if($('.load_more').length == 0 && $('#footer').css('display') !== 'none' && javascroll !=='ya' && $('.bt2').length  == 0){
						
							$('#footer').css('display','none');
							
							
							
					}						
						
						$('#randp').css('display','');
						
					
					
				return false;	
		
				

			
			
			}

			
			
				



			if(detectIE() <= 9){
						
				if ( conscroll.length > 0) {
					if (e.indexOf(conscroll[0].url+'/') == 0 ){
						
						var a = window.location.protocol + "//" + (window.location.hostname || window.location.host);
						if (window.location.port || !1) a += ":" + d.location.port;
				
						e=a+History.getHash();
							
				
				
					}
			
				}else if(History.getHash()){
				
				
						var a = window.location.protocol + "//" + (window.location.hostname || window.location.host);
						if (window.location.port || !1) a += ":" + d.location.port;
							
						e=a+History.getHash();
						
						
				
				
				
					
				
				}
			
			}
				
			
				if( e.indexOf("/photo/") < 0 && e.indexOf(thb_system.root_url) == 0 || e.indexOf("/category/") > 0 && e.indexOf("/photo/") < 0 && typeof conscroll[0].url === 'undefined'){
				
				
					
					window.location = location.href;
					return false;
				}			
			
			successajax=false;
			$(window).scrollTop(0);
			toconte=true;

			$("#content").animate({'min-height' : '777px'}).html('<div class="prueba" style="margin-left: 23%;margin-top: 10%;font-size: 15pt;font-style: italic;font-weight: bold;"> Loading ... </div> ');
				
				if($('.load_more').length == 0 && $('#footer').css('display') == 'none' && $('.bt2').length  == 0){
					
					$('#footer').css('display','inline-block');
				}						

				$('#randp').css('display','none');
			
				noajaxp = false;
					
					
					
			if (typeof cacheurl[e] != 'undefined'){
			
				noajaxp=true;
				
			
			$('title').html(cacheurl[e].title);
			$("#content").html(cacheurl[e].value).promise().done(function(){
					
					
					
						
						
						
						
							
							if($('.cuadrosG').length <= 0){
							
								cargaajax('imagen');
								
							}else{
								
								cargaajax('standard');
							
							}
							
							
					
					
						
					
					
			
			
			});
				


				successajax=true;
				
				
			}
			
			
			
			
			if(successajax_cont == 0 || successajax_cont ==2 && noajaxp == false){
						
					successajax_cont=1;
					
					myajax_1.add({
						success: function(data) {
							successajaxf(data);
						},
						url: e + '?comentajax=true'
                   });
				   
				   
				}else if(successajax_cont == 1  && noajaxp == false){
					
					successajax_cont=2;
				    
					myajax_2.add({
						success: function(data) {
							successajaxf(data);
						},
						url: e + '?comentajax=true'
                   });				   
				   
				   
				}
			

	function successajaxf(data){
			
		myElement2 = {
			title: titleh,
			value: data
		}
							
		cacheurl[e]=myElement2;
					
		$("#content").html(data);

		if($('.cuadrosG').length <= 0){
		
		
				cargaajax('imagen');
		
			
			
								
		}else{
							
			cargaajax('standard');
							
		}
								
		successajax=true;

	}
			
			
			function cargaajax(ob){
			
			
				if(ob == 'standard'){
					
					es=thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/libs/jquery.jPages.min.js';
					
					if($("script[src*='"+es+"']").length==0){
					
					
						require(thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/libs/jquery.jPages.min.js','jPages2');
					
					}					
					
					
					
					es=thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/saicl_script.min.js'
					
					if($("script[src*='"+es+"']").length==0){
					
						require(thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/saicl_script.min.js','saicl_script');
					
					}else{
					
						if(detectIE() <= 9 && History.getHash()){
							
							if(History.getHash()){
								var e = window.location.protocol + "//" + (window.location.hostname || window.location.host);
								if (window.location.port || !1) e += ":" + window.location.port;
							
								var url = e + History.getHash();
							
								if (url.indexOf("/photo") < 0 ){
									var url = thb_system.root_url + '/'+ History.getHash();	
								}
							
								SAIC_WP.ajaxurl2 = url;
							
							}else{
							
							var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
							
							SAIC_WP.ajaxurl2 = url;							
							
							}
					
						}else{
					
							var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
							SAIC_WP.ajaxurl2 = url;
					
					
						}					
						
						$.wait( function(){
							saicl_script();
						}, 1);
					
					}
					
					
						
					es=thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/libs/eventext.js';
					
					if($("script[src*='"+es+"']").length==0){
						
						require(thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/libs/eventext.js','textevent');

					}
						
					

				
					es=thb_system.root_url + '/wp-content/themes/cecichaparroart/js/tinymce/tinymce.min.js';
					
					if($("script[src*='"+es+"']").length==0){
						
						require(thb_system.root_url + '/wp-content/themes/cecichaparroart/js/tinymce/tinymce.min.js','tinymce2');
					
					}				
				
				}
			
			
			
				if(ob == 'imagen'){

					
					es=thb_system.root_url + '/wp-content/themes/cecichaparroart/js/zoom.js';
					
					if($("script[src*='"+es+"']").length==0){
								
						require(thb_system.root_url + '/wp-content/themes/cecichaparroart/js/zoom.js','zoomp');
					
					}else{
						
						if($('#wrapper_img').length > 0){

							jQuery('#wrapper_img').lhpMegaImgViewer('destroy');
							
							var contentUrl = $('#wrapper_img').data('content'),
							mapThumb = $('#wrapper_img').data('thumb');

							var cantenedorimg;
								cantenedorimg = {
								'contentUrl' : contentUrl,
								'mapThumb' : mapThumb
							};

							jQuery('#wrapper_img').lhpMegaImgViewer(cantenedorimg);
	
						}else{
					
							
							if($('.errorimg').length == 0) $('#wrapper').append('<span class="errorimg prueba">No imagen ...   :( </span>')
					
						
						}
					
					
					}
					
					
					es=thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/libs/jquery.jPages.min.js';
					
					if($("script[src*='"+es+"']").length==0){
					
						require(thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/libs/jquery.jPages.min.js','jPages2');
					
					}					
					
					es=thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/saicl_script.min.js';
					
					if($("script[src*='"+es+"']").length==0){
					
						require(thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/saicl_script.min.js','saicl_script');
					
					}else{
					
						if(detectIE() <= 9 && History.getHash()){
							
							if(History.getHash()){
								var e = window.location.protocol + "//" + (window.location.hostname || window.location.host);
								if (window.location.port || !1) e += ":" + window.location.port;
							
								var url = e + History.getHash();
							
								if (url.indexOf("/photo") < 0 ){
									var url = thb_system.root_url + '/'+ History.getHash();	
								}
							
								SAIC_WP.ajaxurl2 = url;
							}else{
							
							var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
							
							SAIC_WP.ajaxurl2 = url;
							
							}
							
					
						}else{
					
							var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
							SAIC_WP.ajaxurl2 = url;
					
					
						}					
						
						$.wait( function(){
							saicl_script();
						}, 1);
					
					}
					
					es=thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/libs/eventext.js';
					
					if($("script[src*='"+es+"']").length==0){
						
						require(thb_system.root_url + '/wp-content/plugins/simple-ajax-insert-comments-lite/js/libs/eventext.js','textevent');

					}
				
					es=thb_system.root_url + '/wp-content/themes/cecichaparroart/js/tinymce/tinymce.min.js';
					
					if($("script[src*='"+es+"']").length==0){
						
						require(thb_system.root_url + '/wp-content/themes/cecichaparroart/js/tinymce/tinymce.min.js','tinymce2');
					
					}

				
				
				}
			
			
			}
			
			
			
		

	
		}

		function require(file, qui){
				
			var head=document.getElementsByTagName("head")[0];
			var script=document.createElement('script');
			script.type='text/javascript';
			script.async = true;
			//script.id = qui;
			script.src=file;
	
				//real browsers
	
			script.onload=function() {
				
				if(detectIE() == 100){
					cargascrip(file, qui);
					
				}
			
			
			}
			
			//Internet explorer
			
			script.onreadystatechange = function () {
				if (script.readyState === 'loaded' || script.readyState === 'complete') {
					script.onreadystatechange = null;
					
					cargascrip(file, qui);
				}
		
			}

			head.appendChild(script);
			
		
		
			function cargascrip(file, qui){
		
				if(qui == 'zoomp'){
					
					
					
					if($("script[src*='"+file+"']").length > 0 && $('#wrapper_img').length > 0){
							
					
							var contentUrl = $('#wrapper_img').data('content'),
							mapThumb = $('#wrapper_img').data('thumb');

							
								cantenedorimg = {
								'contentUrl' : contentUrl,
								'mapThumb' : mapThumb
							};

							jQuery("#wrapper_img").lhpMegaImgViewer(cantenedorimg);

					}else{
					
					
						$('#wrapper').append('<span class="errorimg prueba">No imagen ...   :( </span>')
						
						
					}
				}
				
				if(qui == 'cvi_slider'){
					
					if($("script[src*='"+file+"']").length > 0){
						$.wait( function(){
							
							carga_cvi_slider();	
						}, 1);
					}else{
					
						if($('#loading2').length > 0) $('#loading2').remove();
					
					}
				}
				
				
				if(qui == 'textevent'){
					textevencall();
				}
				
				if(qui == 'saicl_script'){
				
				
					SAIC_WP.bloqueactual = '0';
					
					if(detectIE() <= 9 && History.getHash()){
					
						var e = window.location.protocol + "//" + (window.location.hostname || window.location.host);
						if (window.location.port || !1) e += ":" + window.location.port;
						
						var url = e + History.getHash();
						
						if (url.indexOf("/photo") < 0 ){
							var url = thb_system.root_url + '/'+ History.getHash();	
						}
						
						
						SAIC_WP.ajaxurl2 = url;
					
					}else{
					
					var url = window.location.protocol + "//" + window.location.host + window.location.pathname;
						
					SAIC_WP.ajaxurl2 = url;
					
					
					}					
					$.wait( function(){
						saicl_script();
					}, 1);
				
				}
				
				
		
			}
		
			
		}

	
	
	$(document).delegate(".saicl-textarea2", "click", function (t) {
		
		clickb('');
		
	});
	
		
	function clickb(obj){
		
		var idsss = $('h2.saicl-link').attr("id").replace("saicl-link-", "");
	
		if(tinymce.activeEditor == null){
			inieditor = false;
			
		}else{
			inieditor = true;
			
		}
	
	
		if (idssspre !== idsss || idssspre == '' || tinymce.activeEditor == null ){
				
				idssspre = idsss;
				
				cajatext(idsss,obj);
				
			
		}
	
	
	}
	
			
$(document).delegate(".saicl-modal-btn", "click", function (t) {
        
        var r = $(this).attr("role");
		if (r !== 'none'){
			clickb(r);
		}
		
		

});		
		
	

	
	function cajatext(idsss, obj){
		
		if(typeof tinymce !== 'undefined' ){
			
			tinymce.remove('div');
			
		}
		
		if($('h2.saicl-link').length < 0){
						
			return false
						
		}
				
		
			
		
			
		tinymce.init({
			selector: "#saicl-textarea2-"+idsss,
			object_resizing :true,
			relative_urls: true,
			inline: true,
			image_advtab: true,
			menubar:false,
			toolbar:true,
			statusbar : true,
			plugins: [ "advlist autolink lists link image charmap print preview hr anchor pagebreak","searchreplace wordcount visualblocks visualchars code fullscreen","insertdatetime media nonbreaking save table contextmenu directionality", "emoticons template paste textcolor" ],
			formats: {bold : {inline : 'b' },  italic : {inline : 'i' },underline : {inline : 'u'}
			},toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			content_css : thb_system.root_url + "/wp-content/themes/cecichaparroart/js/tinymce/stule.css",
			
				setup: function(editor) {
				
					editor.on('init', function() {
						
						$('#saicl-textarea2-'+idsss).trigger('blur');
						$('#saicl-textarea2-'+idsss).trigger('focus');
						$('.mce-btn-small').css('display','block');
			

				});
				
					
				
				}
		


		
		});	
		
		
		
		
			
		
		window.setTimeout(function(){
		
		
				switch (obj) {
				case "image":
					
					if(typeof tinymce){
						
						if (initextcont){
							$('button i.mce-i-image').trigger('click');
							initextcont=false;
						}
						
					}

					break;
				case "url":
					
					if(typeof tinymce){
						
						if (initextcont){
							$('button i.mce-i-link').trigger('click');
							initextcont=false;
						}
						
					}
					
					break;
				case "video":

				if(typeof tinymce){
						
						if (initextcont){
							$('button i.mce-i-media').trigger('click');
							initextcont=false;
						}
						
					}
				
					break;
				case "negrita":
					break;
				case "cursiva":
					break;
				case "subrayado":
					break;				
				case "alignleft":
					break;
				case "aligncenter":
					break;												
				case "JustifyRight":
					break;																
				case "InsertUnorderedList":
					break;																				
				case "InsertOrderedList":
					break;																								
				case "blockquote":
					break;																												
				case "preview":
					break;																																
				default:
					return


				}
			
			
			
		}
		
		
		
		, 600)	
		

		
	
	}
		

		
});		
	
	
