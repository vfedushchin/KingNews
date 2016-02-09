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
			self.post_formats_custom_init( self );
			self.navbar_init( self );
			self.subscribe_init( self );
			self.main_menu( self, $( '.main-navigation' ) )
		},

		window_load_render: function ( self ) {
			var self = self;
			self.page_preloader_init( self );
		},

		smart_slider_init: function( self ) {
			$( '.__tm-smartslider' ).each( function() {
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

				if ( $('.__tm-smartslider__slides', '#' + sliderId ).length > 0 ) {
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
							//slider.fadeTo(500, 1);
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
			jQuery('.__tm-carousel').each( function() {
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
							992: {
								slidesPerView: Math.ceil( slidesPerView * 0.75 ),
								spaceBetween: Math.ceil( spaceBetweenSlides * 0.75 )
							},
							768: {
								slidesPerView: Math.ceil( slidesPerView * 0.5 ),
								spaceBetween: Math.ceil( spaceBetweenSlides * 0.5 )
							},
						}
					}
				);
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

				console.log( $.isFunction( jQuery.fn.stickUp ) );

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
					nonce      = form.find( 'input[name="__tm_subscribe"]' ).val(),
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
					url: __tm.ajaxurl,
					type: 'post',
					dataType: 'json',
					data: {
						action: '__tm_subscribe',
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

			};

			init();
		},

		page_preloader_init: function ( self ) {

			if ( $( '.page-preloader-cover' )[0] ) {
				$( '.page-preloader-cover' ).delay( 500 ).fadeTo( 500, 0, function() {
					$( this ).remove();
				});
			}
		}
	}
	CHERRY_API.theme_script.init();
}(jQuery));
