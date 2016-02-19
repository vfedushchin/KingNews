(function($){
	"use strict";

	CHERRY_API.utilites.namespace('theme_script');
	CHERRY_API.theme_script = {
		init: function () {
			var self = this;

			// Document ready event check
			if( CHERRY_API.status.is_ready ){
				self.document_ready_render( self );
			}else{
				CHERRY_API.variable.$document.on( 'ready', self.document_ready_render( self ) );
			}

			// Windows load event check
			if( CHERRY_API.status.on_load ){
				self.window_load_render( self );
			}else{
				CHERRY_API.variable.$window.on( 'load', self.window_load_render( self ) );
			}
		},

		document_ready_render: function ( self ) {
			var self = self;

			self.smart_slider_init( self );
			self.swiper_carousel_init( self );
			self.featured_posts_block_init( self );
			self.news_smart_box_init( self );
			self.post_formats_custom_init( self );
			self.navbar_init( self );
			self.subscribe_init( self );
			self.main_menu( self, $( '.main-navigation' ) );
			self.to_top_init( self );
		},

		window_load_render: function ( self ) {
			var self = self;
			self.page_preloader_init( self );
		},

		smart_slider_init: function( self ) {
			$( '.king_news-smartslider' ).each( function() {
				var slider = $(this),
					sliderId = slider.data('id'),
					sliderWidth = slider.data('width'),
					sliderHeight = slider.data('height'),
					sliderOrientation = slider.data('orientation'),
					slideDistance = slider.data('slide-distance'),
					slideDuration = slider.data('slide-duration'),
					sliderFade = slider.data('slide-fade'),
					sliderNavigation = slider.data('navigation'),
					sliderFadeNavigation = slider.data('fade-navigation'),
					sliderPagination = slider.data('pagination'),
					sliderAutoplay = slider.data('autoplay'),
					sliderFullScreen = slider.data('fullscreen'),
					sliderShuffle = slider.data('shuffle'),
					sliderLoop = slider.data('loop'),
					sliderThumbnailsArrows = slider.data('thumbnails-arrows'),
					sliderThumbnailsPosition = slider.data('thumbnails-position'),
					sliderThumbnailsWidth = slider.data('thumbnails-width'),
					sliderThumbnailsHeight = slider.data('thumbnails-height');

				if ( $('.king_news-smartslider__slides', '#' + sliderId ).length > 0 ) {
					$( '#' + sliderId ).sliderPro( {
						width: sliderWidth,
						height: sliderHeight,
						orientation: sliderOrientation,
						slideDistance: slideDistance,
						slideAnimationDuration: slideDuration,
						fade: sliderFade,
						arrows: sliderNavigation,
						fadeArrows: sliderFadeNavigation,
						buttons: sliderPagination,
						autoplay: sliderAutoplay,
						fullScreen: sliderFullScreen,
						shuffle: sliderShuffle,
						loop: sliderLoop,
						waitForLayers: false,
						thumbnailArrows: sliderThumbnailsArrows,
						thumbnailsPosition: sliderThumbnailsPosition,
						thumbnailWidth: sliderThumbnailsWidth,
						thumbnailHeight: sliderThumbnailsHeight,
						init: function() {
							$( this ).resize();
							slider.fadeTo(500, 1);
						},
						breakpoints: {
							992: {
								height: parseFloat( sliderHeight ) * 0.75,
							},
							768: {
								height: parseFloat( sliderHeight ) * 0.5
							}
						}
					} );
				}
			});//each end
		},

		swiper_carousel_init: function ( self ) {

			// Enable swiper carousels
			jQuery('.king_news-carousel').each( function() {
				var swiper = null,
					uniqId = jQuery(this).data('uniq-id'),
					slidesPerView = parseFloat( jQuery(this).data('slides-per-view') ),
					slidesPerGroup = parseFloat( jQuery(this).data('slides-per-group') ),
					slidesPerColumn = parseFloat( jQuery(this).data('slides-per-column') ),
					spaceBetweenSlides = parseFloat( jQuery(this).data('space-between-slides') ),
					durationSpeed = parseFloat( jQuery(this).data('duration-speed') ),
					swiperLoop = jQuery(this).data('swiper-loop'),
					freeMode = jQuery(this).data('free-mode'),
					grabCursor = jQuery(this).data('grab-cursor'),
					mouseWheel = jQuery(this).data('mouse-wheel');

				var swiper = new Swiper( '#' + uniqId, {
						slidesPerView: slidesPerView,
						slidesPerGroup: slidesPerGroup,
						slidesPerColumn: slidesPerColumn,
						spaceBetween: spaceBetweenSlides,
						speed: durationSpeed,
						loop: swiperLoop,
						freeMode: freeMode,
						grabCursor: grabCursor,
						mousewheelControl: mouseWheel,
						paginationClickable: true,
						nextButton: '#' + uniqId + '-next',
						prevButton: '#' + uniqId + '-prev',
						pagination: '#' + uniqId + '-pagination',
						breakpoints: {
							1200: {
								slidesPerView: Math.floor( slidesPerView * 0.75 ),
								spaceBetween: Math.floor( spaceBetweenSlides * 0.75 )
							},
							992: {
								slidesPerView: Math.floor( slidesPerView * 0.5 ),
								spaceBetween: Math.floor( spaceBetweenSlides * 0.5 )
							},
							768: {
								slidesPerView: Math.floor( slidesPerView * 0.25 ),
								spaceBetween: Math.floor( spaceBetweenSlides * 0.25 )
							},
						}
					}
				);
			});
		},


		
		news_smart_box_init: function ( self ) {
			jQuery('.news-smart-box__instance').each( function() {
				var uniqId = $( this ).data( 'uniq-id' ),
					instanceSettings = $( this ).data( 'instance-settings' ),
					instance = $( '#' + uniqId ),
					$termItemList = $( '.terms-list .term-item', instance ),
					$currentTerm = $( '.current-term span', instance ),
					$listContainer = $( '.news-smart-box__wrapper', instance ),
					$ajaxPreloader = $( '.nsb-spinner', instance ),
					ajaxGetNewInstance = null,
					ajaxGetNewInstanceSuccess = true,
					showNewItems = null;

					$termItemList.on( 'click', function(){
						var slug = $( this ).data( 'slug' ),
							data = {
								action: 'new_smart_box_instance',
								value_slug: slug,
								instance_settings: instanceSettings
							},
							currentTermName = $( 'span', this ).text(),
							counter = 0;

						$currentTerm.html( currentTermName );

						if ( ajaxGetNewInstance != null && ajaxGetNewInstanceSuccess ) {
							ajaxGetNewInstance.abort();
						}
						ajaxGetNewInstance = $.ajax({
							type: 'GET',
							url: king_news.ajaxurl,
							data: data,
							cache: false,
							beforeSend: function(){
								ajaxGetNewInstanceSuccess = false;
								$ajaxPreloader.css( { 'display' : 'block' } ).fadeTo( 300, 1 );
							},
							success: function( response ){

							/*for share icons hover appear*/
							setTimeout( function() {
								$('.news-smart-box .share-btns-main').hover(function(){
									$(this).toggleClass('show-share-list');
								})
							}, 1000 );


								ajaxGetNewInstanceSuccess = true;

								$ajaxPreloader.fadeTo( 300, 0, function() {
									$( this ).css( { 'display' : 'none' } );
								});

								$( '.news-smart-box__listing', $listContainer ).html( response );

								counter = 0;
								$( '.news-smart-box__listing .post .inner', $listContainer ).addClass( 'animate-cycle-show' );
								$( '.news-smart-box__listing .post', $listContainer ).each( function() {
									showItem( $( this ), 100 * parseInt( counter ) );
									counter++;
								})

							}
						});

					});

					var showItem = function( itemList, delay ) {
						var timeOutInterval = setTimeout( function() {
							$('.inner', itemList).removeClass( 'animate-cycle-show' );
						}, delay );
					}
			});
		},

		post_formats_custom_init: function ( self ) {
			CHERRY_API.variable.$document.on( 'cherry-post-formats-custom-init', function( event ) {

				if ( 'slider' !== event.object ) {
					return;
				}

				var uniqId = '#' + event.item.attr( 'id' ),
					swiper = new Swiper( uniqId, {
						pagination: uniqId + ' .swiper-pagination',
						paginationClickable: true,
						nextButton: uniqId + ' .swiper-button-next',
						prevButton: uniqId + ' .swiper-button-prev',
						spaceBetween: 30
				} );

				event.item.data( 'initalized', true );
			});
		},

		navbar_init: function ( self ) {

			$( window ).load( function() {

				var $navbar = $('.header-container');

				if ( ! $.isFunction( jQuery.fn.stickUp ) || ! $navbar.length ) {
					return !1;
				}

				if ( $('#wpadminbar').length ) {
					$navbar.addClass('has-bar');
				}

				$navbar.stickUp();

			});
		},

		subscribe_init: function( self ) {
			CHERRY_API.variable.$document.on( 'click', '.subscribe-block__submit', function( event ){

				event.preventDefault();

				var $this       = $(this),
					form       = $this.parents( 'form' ),
					nonce      = form.find( 'input[name="king_news_subscribe"]' ).val(),
					mail_input = form.find( 'input[name="subscribe-mail"]' ),
					mail       = mail_input.val(),
					error      = form.find( '.subscribe-block__error' ),
					success    = form.find( '.subscribe-block__success' ),
					hidden     = 'hidden';

				if ( '' == mail ) {
					mail_input.addClass( 'error' );
					return !1;
				}

				if ( $this.hasClass( 'processing' ) ) {
					return !1;
				}

				$this.addClass( 'processing' );
				error.empty();

				if ( ! error.hasClass( hidden ) ) {
					error.addClass( hidden );
				}

				if ( ! success.hasClass( hidden ) ) {
					success.addClass( hidden );
				}

				$.ajax({
					url: king_news.ajaxurl,
					type: 'post',
					dataType: 'json',
					data: {
						action: 'king_news_subscribe',
						mail: mail,
						nonce: nonce
					},
					error: function() {
						$this.removeClass( 'processing' );
					}
				}).done( function( response ) {

					$this.removeClass( 'processing' );

					if ( true === response.success ) {
						success.removeClass( hidden );
						mail_input.val('');
						return 1;
					}

					error.removeClass( hidden ).html( response.data.message );
					return !1;

				});

			})
		},

		main_menu: function ( self, target ) {

			var menu = target,
				duration_timeout,
				closeSubs,
				hideSub,
				showSub,
				init;

			closeSubs = function() {
				$( '.menu-hover > a', menu ).each(
					function() {
						hideSub( $(this) );
					}
				);
			};

			hideSub = function( anchor ) {

				anchor.parent().removeClass( 'menu-hover' ).triggerHandler( 'close_menu' );

				anchor.siblings('ul').addClass('in-transition');

				clearTimeout( duration_timeout );
				duration_timeout = setTimeout(
					function() {
						anchor.siblings('ul').removeClass( 'in-transition' );
					},
					200
				);
			};

			showSub = function( anchor ) {

				// all open children of open siblings
				var item = anchor.parent();

				item
					.siblings()
					.find( '.menu-hover' )
					.addBack( '.menu-hover' )
					.children( 'a' )
					.each(function() {
						hideSub( $( this ), true );
					});

				item.addClass( 'menu-hover' ).triggerHandler( 'open_menu' );
			};

			init = function() {
				var $mainNavigation = $('.main-navigation'),
					$mainMenu = $('ul.menu', $mainNavigation),
					$menuToggle = $('.menu-toggle', $mainNavigation);

				$( 'li.menu-item-has-children, li.page_item_has_children', menu ).hoverIntent( {
					over: function () {
						showSub( $(this).children('a') );
					},
					out: function () {
						if ( $(this).hasClass( 'menu-hover' ) ) {
							hideSub( $( this ).children( 'a' ) );
						}
					},
					timeout: 300
				} );


				$menuToggle.on( 'click', function(){
					$mainNavigation.toggleClass( 'toggled' );
				});
			};

			init();
		},

		page_preloader_init: function ( self ) {

			if ( $( '.page-preloader-cover' )[0] ) {
				$( '.page-preloader-cover' ).delay( 500 ).fadeTo( 500, 0, function() {
					$( this ).remove();
				});
			}
		},

		to_top_init: function ( self ) {
			if ( $.isFunction( jQuery.fn.UItoTop ) ) {
				$().UItoTop({
					text: '',
					scrollSpeed: 600
				});
			}
		},






		featured_posts_block_init: function ( self ) {
			var $wrapper = $( '.tm_fpblock' ),
				$item = null,
				$items = [],
				offset = 0,
				height = 0;

			/**
			 * Update images height
			 */
			function _scaleImage() {
				if ( $wrapper.length > 0 ) {
					if ( $wrapper.hasClass( 'tm_fpblock-layout-4' ) ) {
						$item = $wrapper.find( '.tm_fpblock__item-2' );
						height = $item.prev().height();
						$item.find( '.tm_fpblock__item__preview' ).css( 'height', height );

						if ( 974 > $( window ).width() && 752 < $( window ).width() ) {
							$item = $wrapper.find( '.tm_fpblock__item-1' );
							offset = ( $item.height() / 2 ) - 1;
							$wrapper.find( '.tm_fpblock__item-small:last' ).css( 'top', offset + 'px' );
						} else {
							$wrapper.find( '.tm_fpblock__item-small:last' ).css( 'top', 'auto' );
						}

						$item = $wrapper.find( '.tm_fpblock__item:first' );
						height = $item.height();

						$items = $wrapper.find( '.tm_fpblock__item:not(.tm_fpblock__item-1):not(.tm_fpblock__item-2)' );

						if ( 752 < $( window ).width() ) {
							height = height / 2;
						}

						$items.each( function() {
							$item = $( this );
							$item.css( 'height', height );
							$item.find( '.tm_fpblock__item__preview' ).css( 'height', height );
							$item.find( '.tm_fpblock__item__preview > img' ).css( 'height', height );
						} );
					} else if ( $wrapper.hasClass( 'tm_fpblock-layout-2' ) ||
						$wrapper.hasClass( 'tm_fpblock-layout-3' ) ||
						$wrapper.hasClass( 'tm_fpblock-layout-5' ) ) {
						$item = $wrapper.find( '.tm_fpblock__item:first' );
						height = $item.height();

						$items = $wrapper.find( '.tm_fpblock__item:not(:first)' );

						if ( 752 < $( window ).width() ) {
							height = height / 2;
						}

						$items.each( function() {
							$item = $( this );
							$item.css( 'height', height );
							$item.find( '.tm_fpblock__item__preview' ).css( 'height', height );
							$item.find( '.tm_fpblock__item__preview > img' ).css( 'height', height );
						} );
					} else if ( $wrapper.hasClass( 'tm_fpblock-layout-1' ) ) {
						$item = $wrapper.find( '.tm_fpblock__item-large' );
						height = $item.height();

						$items = $wrapper.find( '.tm_fpblock__item:not(.tm_fpblock__item-large)' );

						if ( 752 < $( window ).width() ) {
							height = height / 2;
						}

						$items.each( function() {
							$item = $( this );
							$item.css( 'height', height );
							$item.find( '.tm_fpblock__item__preview' ).css( 'height', height );
							$item.find( '.tm_fpblock__item__preview > img' ).css( 'height', height );
						} );
					}
				}
			}

			_scaleImage();
			setTimeout(_scaleImage, 100);
			window.onresize = function() {
				_scaleImage();
			};
		}


	}
	CHERRY_API.theme_script.init();
}(jQuery));






jQuery(document).ready(function($){



/* start script for adding data-atribute to menu
=============================================*/ 
// ------------------------------------------------------------------------
$( "#main-menu > li > a" ).each(function( index ) {
		$( this ).attr('data-title', $( this ).text());
});
/* end script for adding data-atribute to menu
=============================================*/


// add/remove class for showing share-list in posts
function share_hover_init() {
	$('.news-smart-box .share-btns-main').hover(function(){
		$(this).toggleClass('show-share-list');

	});
}
$('.share-btns-main').hover(function(){
	$(this).toggleClass('show-share-list');
});



if ( $( ".post-left-column" ).length ) {
	// function for sticky social icons in post and pages
	(function(){
	var a = document.querySelector('.post-left-column'), b = null, P = 0;
	window.addEventListener('scroll', Ascroll, false);
	document.body.addEventListener('scroll', Ascroll, false);
	function Ascroll() {
		if (b == null) {
			var Sa = getComputedStyle(a, ''), s = '';
			for (var i = 0; i < Sa.length; i++) {
				if (Sa[i].indexOf('overflow') == 0 || Sa[i].indexOf('padding') == 0 || Sa[i].indexOf('border') == 0 || Sa[i].indexOf('outline') == 0 || Sa[i].indexOf('box-shadow') == 0 || Sa[i].indexOf('background') == 0) {
					s += Sa[i] + ': ' +Sa.getPropertyValue(Sa[i]) + '; '
				}
			}
			b = document.createElement('div');
			b.style.cssText = s + ' box-sizing: border-box; width: ' + a.offsetWidth + 'px;';
			a.insertBefore(b, a.firstChild);
			var l = a.childNodes.length;
			for (var i = 1; i < l; i++) {
				b.appendChild(a.childNodes[1]);
			}
			a.style.height = b.getBoundingClientRect().height + 'px';
			a.style.padding = '0';
			a.style.border = '0';
		}
		var Ra = a.getBoundingClientRect(),
				R = Math.round(Ra.top + b.getBoundingClientRect().height - document.querySelector('.post-right-column').getBoundingClientRect().bottom);  // block selector when the lower edge of which you want to detach the adhesive element
		if ((Ra.top - P) <= 0) {
			if ((Ra.top - P) <= R) {
				b.className = 'stop';
				b.style.top = - R +'px';
			} else {
				b.className = 'sticky';
				b.style.top = P + 'px';
			}
		} else {
			b.className = '';
			b.style.top = '';
		}
		window.addEventListener('resize', function() {
			a.children[0].style.width = getComputedStyle(a, '').width
		}, false);
	}
	})();
}


/*//initializing jQuery
jQuery(function($) {
	$(document).ready( function() {
		//enabling stickUp on the '.navbar-wrapper' class
		$('.share-btns__list-single-page').stickUp({
			//enabling marginTop with the 'auto' setting 
			marginTop: 'auto'
		});
	});
});*/


// add class for full-width layout
/*if ($('.post-list__item-content .post-thumbnail > a').hasClass('post-thumbnail--fullwidth')) {
	$('.post-list__item-content .post-thumbnail').addClass('post-thumbnail--fullwidth-all');
}*/





/* start for screenshort image - developing 
=============================================*/ 
// ------------------------------------------------------------------------
function setCookie(name, value, options) {
		options = options || {};
		var expires = options.expires;
		if (typeof expires == "number" && expires) {
				var d = new Date();
				d.setTime(d.getTime() + expires * 1000);
				expires = options.expires = d;
		}
		if (expires && expires.toUTCString) {
				options.expires = expires.toUTCString();
		}
		value = encodeURIComponent(value);
		var updatedCookie = name + "=" + value;
		for (var propName in options) {
				updatedCookie += "; " + propName;
				var propValue = options[propName];
				if (propValue !== true) {
						updatedCookie += "=" + propValue;
				}
		}
		document.cookie = updatedCookie;
};

// ------------------------------------------------------------------------
function getCookie(name) {
		var matches = document.cookie.match(new RegExp(
				"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
		));
		return matches ? decodeURIComponent(matches[1]) : undefined;
};
// ------------------------------------------------------------------------
function deleteCookie(name) {
		setCookie(name, "", {
				expires: -1
		});
};
// ------------------------------------------------------------------------
var _display_screen_class;
_display_screen_class = getCookie('_display_screen_class');


;(function ($) { 
		$("body").prepend("<div class='preview-container pr-bg-1'><div class='preview-container_bg'></div></div>");
		$('.preview-container').addClass(_display_screen_class);
		addEventListener("keydown", function(event) {
				if (event.keyCode == 81 && event.ctrlKey) {
						//press Ctl+q to show/hide screenshort
						// $('.preview-container').toggleClass('display');
						if ($('.preview-container').hasClass("display")) {
								$('.preview-container').removeClass('display');
								setCookie('_display_screen_class', '');
						} else {
								$('.preview-container').addClass('display');
								setCookie('_display_screen_class', 'display');
						}
				}
		});
})(jQuery);
/* end for screenshort image - developing 
=============================================*/





});
