/*
	scrollorama - The jQuery plugin for doing cool scrolly stuff
	by John Polacek (@johnpolacek)
	
	Dual licensed under MIT and GPL.
*/


(function($) {
    $.scrollorama = function(options) {
		var scrollorama = this,
			blocks = [],
			browserPrefix = '',
			ieVersion = '',
			onBlockChange = function() {},
			latestKnownScrollY = 0,
            ticking = false,
            requestAnimFrame =	window.requestAnimationFrame ||
								window.webkitRequestAnimationFrame ||
								window.mozRequestAnimationFrame    ||
								window.oRequestAnimationFrame      ||
								window.msRequestAnimationFrame     ||
								function( callback ){
									window.setTimeout(callback, 1000 / 60);
								},
			defaults = {offset:0, enablePin: false};
		
		scrollorama.settings = $.extend({}, defaults, options);
		scrollorama.blockIndex = 0;
		
		if (options.blocks === undefined) { alert('ERROR: Must assign blocks class selector to scrollorama plugin'); }
		
		// PRIVATE FUNCTIONS
		function init() {
			var i, block, didScroll, marginTop = false;
			if (typeof scrollorama.settings.blocks === 'string') { scrollorama.settings.blocks = $(scrollorama.settings.blocks); }
			
			// set browser prefix (using getBrowser based on jQuery’s $.browser)
			var browser = getBrowser();
			if (browser.mozilla) { browserPrefix = '-moz-'; }
			if (browser.webkit) { browserPrefix = '-webkit-'; }
			if (browser.opera) { browserPrefix = '-o-'; }
			if (browser.msie) {
				browserPrefix = '-ms-';
				ieVersion = parseInt(browser.version, 10);
			}
			
			// create blocks array to contain animation props
			$('body').css('position','relative');
			for (i=0; i<scrollorama.settings.blocks.length; i++) {
				block = scrollorama.settings.blocks.eq(i);
				marginTop = block.css('margin-top');
				blocks.push({
					block: block,
					top: block.offset().top - (!Boolean(marginTop) ? parseInt(marginTop, 10) : 0),
					pin: 0,
					animations:[]
				});
			}
			
			
			
			// create scroll-wrap div only once

			
			latestKnownScrollY = 0;
            ticking = false;
            $(window).on( 'scroll.scrollorama', onScroll );
		}

		function onScroll() {
            latestKnownScrollY = window.scrollY;
            requestTick();
        }
        
        function requestTick() {
            if(!ticking) {
                requestAnimFrame(function(){
                    onScrollorama();
                    update();
                });
            }
            ticking = true;
        }
        
        function update() {
            // reset the tick so we can
            // capture the next onScroll
            ticking = false;
        }
		
		function onScrollorama() {
			var scrollTop = $(window).scrollTop(),
			currBlockIndex = getCurrBlockIndex(scrollTop),
			i, j, anim, startAnimPos, endAnimPos, animPercent, animVal;
			
			// update all animations
			for (i=0; i<blocks.length; i++) {
				
				// go through the animations for each block
				if (blocks[i].animations.length) {
					for (j=0; j<blocks[i].animations.length; j++) {
						anim = blocks[i].animations[j];
						
						// if above current block, settings should be at start value
						if (i > currBlockIndex) {
							if (currBlockIndex !== i-1 && anim.baseline !== 'bottom') {
								setProperty(anim, anim.startVal);
							}
							if (blocks[i].pin) {
								blocks[i].block
								.css('position', 'absolute')
								.css('top', blocks[i].top);
							}
						}
						
						// if below current block, settings should be at end value
						// unless on an element that gets animated when it hits the bottom of the viewport
						else if (i < currBlockIndex) {
							setProperty(anim, anim.endVal);
							if (blocks[i].pin) {
								blocks[i].block
                                    .css('position', 'absolute')
                                    .css('top', (blocks[i].top + blocks[i].pin));
							}
						}
						
						// otherwise, set values per scroll position
						if (i === currBlockIndex || (currBlockIndex === i-1 && anim.baseline === 'bottom')) {
							// if block gets pinned, set position fixed
							if (blocks[i].pin && currBlockIndex === i) {
								blocks[i].block
                                    .css('position', 'fixed')
                                    .css('top', 0);
							}
							
							// set start and end animation positions
							startAnimPos = blocks[i].top + anim.delay;
							if (anim.baseline === 'bottom') { startAnimPos -= $(window).height(); }
							endAnimPos = startAnimPos + anim.duration;
							
							// if scroll is before start of animation, set to start value
							if (scrollTop < startAnimPos) {
								setProperty(anim, anim.startVal);
							}
							
							// if scroll is after end of animation, set to end value
							else if (scrollTop > endAnimPos) {
								setProperty(anim, anim.endVal);
								if (blocks[i].pin) {
									blocks[i].block
                                        .css('position', 'absolute')
                                        .css('top', (blocks[i].top + blocks[i].pin));
								}
							}
							
							// otherwise, set value based on scroll
							else {
								// calculate percent to animate
								animPercent = (scrollTop - startAnimPos) / anim.duration;
								// account for easing if there is any
								if ( anim.easing && $.isFunction( $.easing[anim.easing] ) ) {
									animPercent = $.easing[anim.easing]( animPercent, animPercent*1000, 0, 1, 1000 );
								}
								// then multiply the percent by the value range and calculate the new value
								animVal = anim.startVal + (animPercent * (anim.endVal - anim.startVal));
								setProperty(anim, animVal);
							}
						}
					}
				}
			}
			
			// update blockIndex and trigger event if changed
			if (scrollorama.blockIndex !== currBlockIndex) {
				scrollorama.blockIndex = currBlockIndex;
				alert('dede');
				onBlockChange();
			}
		}
		
		function getCurrBlockIndex(scrollTop) {
			var currBlockIndex = 0, i;
			for (i=0; i<blocks.length; i++) {
				// check if block is in view
				if (blocks[i].top <= scrollTop - scrollorama.settings.offset) { 
				
				currBlockIndex = i; 
				
				
				}
			}
			return currBlockIndex;
		}
		
		
		
		// function for passing blockChange event callback
		scrollorama.onBlockChange = function(f) {
			onBlockChange = f;
		};
		
		// function for getting an array of scrollpoints
		// (top of each animation block and animation element scroll start point)
		
		// Remove scrollorama
		scrollorama.destroy = function () {
			// Remove animations
			for (i=0; i<blocks.length; i++) {
				// Remove CSS rules
				blocks[i].block.css({
					top: '',
					position: ''
				});
				
				// Remove scrolloroma-specific attributes
				delete blocks[i].animations;
				delete blocks[i].top;
				delete blocks[i].pin;
			}

			// Unbind the window scroll event
			$(window).off('scroll.scrollorama');
			$('#scroll-wrap').remove();
			
			// Remove the scrolloroma object
			delete scrollorama;
		};
		
		init();
		
		return scrollorama;
    };

	// Easing functions from jQuery UI
	$.extend($.easing, {
		def: 'easeOutQuad',
		swing: function (x, t, b, c, d) {
			//alert($.easing.default);
			return $.easing[$.easing.def](x, t, b, c, d);
		},
		easeInQuad: function (x, t, b, c, d) {
			return c*(t/=d)*t + b;
		},
		easeOutQuad: function (x, t, b, c, d) {
			return -c *(t/=d)*(t-2) + b;
		},
		easeInOutQuad: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) { return c/2*t*t + b; }
			return -c/2 * ((--t)*(t-2) - 1) + b;
		},
		easeInCubic: function (x, t, b, c, d) {
			return c*(t/=d)*t*t + b;
		},
		easeOutCubic: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		},
		easeInOutCubic: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) { return c/2*t*t*t + b; }
			return c/2*((t-=2)*t*t + 2) + b;
		},
		easeInQuart: function (x, t, b, c, d) {
			return c*(t/=d)*t*t*t + b;
		},
		easeOutQuart: function (x, t, b, c, d) {
			return -c * ((t=t/d-1)*t*t*t - 1) + b;
		},
		easeInOutQuart: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) { return c/2*t*t*t*t + b; }
			return -c/2 * ((t-=2)*t*t*t - 2) + b;
		},
		easeInQuint: function (x, t, b, c, d) {
			return c*(t/=d)*t*t*t*t + b;
		},
		easeOutQuint: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t*t*t + 1) + b;
		},
		easeInOutQuint: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) { return c/2*t*t*t*t*t + b; }
			return c/2*((t-=2)*t*t*t*t + 2) + b;
		},
		easeInSine: function (x, t, b, c, d) {
			return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
		},
		easeOutSine: function (x, t, b, c, d) {
			return c * Math.sin(t/d * (Math.PI/2)) + b;
		},
		easeInOutSine: function (x, t, b, c, d) {
			return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
		},
		easeInExpo: function (x, t, b, c, d) {
			return (t===0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
		},
		easeOutExpo: function (x, t, b, c, d) {
			return (t===d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
		},
		easeInOutExpo: function (x, t, b, c, d) {
			if (t===0) { return b; }
			if (t===d) { return b+c; }
			if ((t/=d/2) < 1) { return c/2 * Math.pow(2, 10 * (t - 1)) + b; }
			return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
		},
		easeInCirc: function (x, t, b, c, d) {
			return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
		},
		easeOutCirc: function (x, t, b, c, d) {
			return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
		},
		easeInOutCirc: function (x, t, b, c, d) {
			if ((t/=d/2) < 1) { return -c/2 * (Math.sqrt(1 - t*t) - 1) + b; }
			return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
		},
		easeInElastic: function (x, t, b, c, d) {
			var s=1.70158,p=0,a=c;
			if (t===0) { return b; }
			if ((t/=d)===1) { return b+c; }
			if (!p) { p=d*0.3; }
			if (a < Math.abs(c)) { a=c; s=p/4; }
			else{ s = p/(2*Math.PI) * Math.asin (c/a); }
			return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		},
		easeOutElastic: function (x, t, b, c, d) {
			var s=1.70158,p=0,a=c;
			if (t===0) { return b; }
			if ((t/=d)===1) { return b+c; }
			if (!p) { p=d*0.3; }
			if (a < Math.abs(c)) { a=c; s=p/4; }
			else { s = p/(2*Math.PI) * Math.asin (c/a); }
			return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
		},
		easeInOutElastic: function (x, t, b, c, d) {
			var s=1.70158,p=0,a=c;
			if (t===0) { return b; }
			if ((t/=d/2)===2) { return b+c; }
			if (!p) { p=d*(0.3*1.5); }
			if (a < Math.abs(c)) { a=c; s=p/4; }
			else { s = p/(2*Math.PI) * Math.asin (c/a); }
			if (t < 1) { return -0.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b; }
			return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*0.5 + c + b;
		},
		easeInBack: function (x, t, b, c, d, s) {
			if (s === undefined) { s = 1.70158; }
			return c*(t/=d)*t*((s+1)*t - s) + b;
		},
		easeOutBack: function (x, t, b, c, d, s) {
			if (s === undefined) { s = 1.70158; }
			return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
		},
		easeInOutBack: function (x, t, b, c, d, s) {
			if (s === undefined) { s = 1.70158; }
			if ((t/=d/2) < 1) { return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b; }
			return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
		},
		easeInBounce: function (x, t, b, c, d) {
			return c - $.easing.easeOutBounce (x, d-t, 0, c, d) + b;
		},
		easeOutBounce: function (x, t, b, c, d) {
			if ((t/=d) < (1/2.75)) {
				return c*(7.5625*t*t) + b;
			} else if (t < (2/2.75)) {
				return c*(7.5625*(t-=(1.5/2.75))*t + 0.75) + b;
			} else if (t < (2.5/2.75)) {
				return c*(7.5625*(t-=(2.25/2.75))*t + 0.9375) + b;
			} else {
				return c*(7.5625*(t-=(2.625/2.75))*t + 0.984375) + b;
			}
		},
		easeInOutBounce: function (x, t, b, c, d) {
			if (t < d/2) { return $.easing.easeInBounce (x, t*2, 0, c, d) * 0.5 + b; }
			return $.easing.easeOutBounce (x, t*2-d, 0, c, d) * 0.5 + c*0.5 + b;
		}
	});
     
})(jQuery);

/*!
 * Modified from: jQuery Migrate - v1.1.0 - 2013-01-31
 * https://github.com/jquery/jquery-migrate
 * Copyright 2005, 2013 jQuery Foundation, Inc. and other contributors; Licensed MIT
 */
function getBrowser() {
	var matched = uaMatch( navigator.userAgent );
	var browser = {};
	if ( matched.browser ) {
		browser[ matched.browser ] = true;
		browser.version = matched.version;
	}
	// Chrome is Webkit, but Webkit is also Safari.
	if ( browser.chrome ) {
		browser.webkit = true;
	} else if ( browser.webkit ) {
		browser.safari = true;
	}
	return browser;
}

function uaMatch(ua) {
	ua = ua.toLowerCase();

	var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
		/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
		/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
		/(msie) ([\w.]+)/.exec( ua ) ||
		ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
		[];

	return {
		browser: match[ 1 ] || "",
		version: match[ 2 ] || "0"
	};
}