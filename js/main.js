//$(window).unload(function() {
  //console.log('Handler for .unload() called.');
//});

$(document).ready(function(){
	var customizeMeStt, pluginMethodsStt, thumbGalleryStt, colorboxGalleryStt, pluginMethods;
	
	//init main menu
	$('ul#menu a').bind('click', function(event) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 900);
		event.preventDefault();
	});
	
	//init top buttons
	$('a.topBtt').bind('click', function(event) {
		$('html, body').stop().animate({
			scrollTop: 0
		}, 500);
		event.preventDefault();
	});
	
	//init customize me
	customizeMeStt = {
'viewportWidth' : '100%',
		'viewportHeight' : '100%',
		'fitToViewportShortSide' : false,  
		'contentSizeOver100' : false,
		'loadingBgColor' : '#212121',
		'startScale' : 0,
		'startX' : 1100,
		'startY' : 1700,
		'animTime' : 500,
		'draggInertia' : 10,
		'zoomLevel' : 1,
		'zoomStep' : 0.1,
		'contentUrl' : 'img/IMG_6135.jpg',
		'intNavEnable' : true,
		'intNavPos' : 'B',
		'intNavAutoHide' : false,
		'intNavMoveDownBtt' : true,
		'intNavMoveUpBtt' : true,
		'intNavMoveRightBtt' : true,
		'intNavMoveLeftBtt' : true,
		'intNavZoomBtt' : true,
		'intNavUnzoomBtt' : true,
		'intNavFitToViewportBtt' : true,
		'intNavFullSizeBtt' : true,
		'intNavBttSizeRation' : 1,
		'mapEnable' : true,
		'mapThumb' : 'img/IMG_6135-100x150.jpg',
		'mapPos' : 'BL',
		'popupShowAction' : 'click',
		'testMode' : false
		
	};
	
	$("#customizeMe").resizable({
		resize: function(event, ui) {
			$('#resizeIco').hide();
			$(this).lhpMegaImgViewer('adaptsToContainer');
		}
	});
	
	$('#firstSample .customizeMeForm .tip').each(function(){
		var $this = $(this);
		$this.hover(
			function (event) {
				var e;
				$('#firstSample .customizeMeForm .tipContainer').html($(this).attr('data-txt'))
				.css({display : 'block', opacity : 0})
				.stop().animate({ opacity : 1 }, { duration : 500 });
				e = $.Event('mousemove');
				e.pageX = event.pageX;
				e.pageY = event.pageY;
				$this.trigger(e);
			}, 
			function () {
				$('#firstSample .customizeMeForm .tipContainer')
				.stop().animate({ opacity : 0 }, { duration : 100, complete : function() {
						$(this).css({display : 'none'});
					}
				});
			}
		);
		$this.mousemove(function(event) {
			var $e = $('#firstSample .customizeMeForm .tipContainer'), eHeight = $e.height();
			$e.css({top : event.pageY-eHeight-10, left : event.pageX - 25})
		});
	});
	
	$('#firstSample .customizeMeForm input, #firstSample .customizeMeForm select').each(function(index){ 
		var $this = $(this), sttName = this.name.split('_')[2];
		
		if($this.hasClass('select_option')) {
			$this.find('option:contains("'+customizeMeStt[sttName]+'")').each(function(){
				if(customizeMeStt[sttName].toString() == $(this).val()) {
					$(this).attr('selected', 'selected');
				}
			});
			$this.change(function () {
				$this.blur();
			});
		} else {
			this.value = customizeMeStt[sttName];
		}
		
		$(this).blur(function () {
			var $this = $(this), sttName = this.name.split('_')[2], value = this.value, newSett = {}, yourCode, quota, k;
			
			$('#customizeMe').lhpMegaImgViewer('destroy');
			
			if($this.hasClass('number')) {
				newSett[sttName] = Number(value);
			} else if($this.hasClass('boolean')) {
				newSett[sttName] = ($this.find('option.[selected="selected"]').text() == 'true') ? true : false;
			} else if($this.hasClass('select_option')) {
				newSett[sttName] = $this.find('option.[selected="selected"]').text();
			} else {
				newSett[sttName] = value;
			}
			
			$.extend(customizeMeStt, newSett);
			$('#customizeMe').lhpMegaImgViewer(customizeMeStt);
			
			//user code
			yourCode = 'var <span>settings</span> = {<br/>';
			for(k in customizeMeStt){
				quota = '';
				if(typeof customizeMeStt[k] == 'string') {
					quota = '"';
				}
				yourCode += '\t"' + k + '" : ' + quota + customizeMeStt[k] + quota + ',<br/>';
			}
			yourCode = yourCode.slice(0,-6) + '<br/>};<br/>$("<span>#myDiv</span>").lhpMegaImgViewer(<span>settings</span>);'
			$('#firstSample pre.jsCode').html(yourCode);
		});
		
		$(this).keypress(function(e) {
			if(e.which == 13) {
				$(this).blur();
			}
		});

	});
	$('#cm_btt_viewportWidth').trigger('blur');
	
	//init plugin methods
	pluginMethodsStt = {
		'viewportWidth' : '100%',
		'viewportHeight' : '100%'
	};
	
	pluginMethods = [];
	pluginMethods[0] = function(){ $('#secCntr').lhpMegaImgViewer( pluginMethodsStt ); };
	pluginMethods[1] = function(){ $('#secCntr').lhpMegaImgViewer( 'setPosition', 1300, 300, 0.8 ); };
	pluginMethods[2] = function(){ $('#secCntr').lhpMegaImgViewer( 'moveUp' ); };
	pluginMethods[3] = function(){ $('#secCntr').lhpMegaImgViewer( 'moveDown' ); };
	pluginMethods[4] = function(){ $('#secCntr').lhpMegaImgViewer( 'moveLeft' ); };
	pluginMethods[5] = function(){ $('#secCntr').lhpMegaImgViewer( 'moveRight' ); };
	pluginMethods[6] = function(){ $('#secCntr').lhpMegaImgViewer( 'moveStop' ); };
	pluginMethods[7] = function(){ $('#secCntr').lhpMegaImgViewer( 'zoom' ); };
	pluginMethods[8] = function(){ $('#secCntr').lhpMegaImgViewer( 'unzoom' ); };
	pluginMethods[9] = function(){ $('#secCntr').lhpMegaImgViewer( 'zoomStop' ); };
	pluginMethods[10] = function(){ $('#secCntr').lhpMegaImgViewer( 'fitToViewport' ); };
	pluginMethods[11] = function(){ $('#secCntr').lhpMegaImgViewer( 'fullSize' ); };
	pluginMethods[12] = function(){ $('#secCntr').lhpMegaImgViewer( 'adaptsToContainer' ); };
	pluginMethods[13] = function(){ $('#secCntr').lhpMegaImgViewer( 'destroy' ); };
	
	$('#secCntr').lhpMegaImgViewer(pluginMethodsStt);
	
	$('#publicMethods a').each(function(index){
		$(this).click(function(index) {
			return function(e) {
				e.preventDefault();	
				pluginMethods[index]();
			}
		}(index));
	});
	
	//init thumbnail gallery
	thumbGalleryStt = {
		'viewportWidth' : '100%',
		'viewportHeight' : '100%',
		'startScale' : 0.5,
		'startX' : 0,
		'startY' : 0,
		'animTime' : 500,
		'draggInertia' : 10,
		'contentUrl' : 'img/1.jpg',
		'intNavEnable' : true,
		'intNavPos' : 'R',
		'intNavAutoHide' : false
	};
	
	$('#trdCntr').lhpMegaImgViewer(thumbGalleryStt);
	$('#galleryThumbImg a').each(function(index){
		$(this).click(function(e) {
			e.preventDefault();
			thumbGalleryStt.contentUrl = $(this).attr('href');
			$('#trdCntr').lhpMegaImgViewer('destroy');
			$('#trdCntr').lhpMegaImgViewer(thumbGalleryStt);
		});
	});
	$('#galleryThumbImg img').each(function(index){
		$(this).hover(function(){
			$(this).stop(true, true).animate({'opacity':.4});
		},
		function () {
			$(this).stop(true, true).animate({'opacity':1});
		});
	});

	//init colorbox gallery
	var $cbImgViewerCnt;
	colorboxGalleryStt = {
		'viewportWidth' : '100%',
		'viewportHeight' : '100%',
		'startScale' : 0.5,
		'startX' : 1000,
		'startY' : 0,
		'animTime' : 500,
		'draggInertia' : 10,
		'intNavEnable' : true,
		'intNavPos' : 'B',
		'intNavAutoHide' : true
	};
	$(".group1").colorbox({innerWidth : '600px', innerHeight : '400px', rel : 'group1'});
	$(".group1").colorbox({onComplete : function() {
		if($cbImgViewerCnt) {
			$cbImgViewerCnt.lhpMegaImgViewer('destroy');
		}
		$cbImgViewerCnt = $('<div/>').css({'width' : '100%', 'height' : '100%', 'overflow' : 'hidden'});
		$('#cboxLoadedContent').empty().append($cbImgViewerCnt);
		colorboxGalleryStt.contentUrl = $(this).attr('href');
		$cbImgViewerCnt.lhpMegaImgViewer(colorboxGalleryStt);
	},
	onClosed : function() {
		if($cbImgViewerCnt) {
			$cbImgViewerCnt.lhpMegaImgViewer('destroy');
		}
	}});
	$('#fourthSample img').each(function(index){
		$(this).hover(function(){
			$(this).stop(true, true).animate({'opacity':.4});
		},
		function () {
			$(this).stop(true, true).animate({'opacity':1});
		});
	});
	
});