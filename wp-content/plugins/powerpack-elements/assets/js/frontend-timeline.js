(function($) {
	$( window ).on( 'elementor/frontend/init', () => {
		class TimelineWidget extends elementorModules.frontend.handlers.Base {
			getDefaultSettings() {
				return {
					selectors: {
						timeline: '.pp-timeline',
						items: '.pp-timeline-vertical .pp-timeline-item',
						slickSlide: '.pp-timeline-item',
						connector: '.pp-timeline-vertical .pp-timeline-connector',
						progressBar: '.pp-timeline-vertical .pp-timeline-connector-inner',
						markerClass: '.pp-timeline-vertical .pp-timeline-marker-wrapper',
						carousel: '.pp-timeline-horizontal .pp-timeline-items',
						sliderWrap: '.pp-timeline-wrapper',
						sliderNav: '.pp-timeline-navigation',
					},
					slidesToShow: {
						widescreen: 3,
						desktop: 3,
						laptop: 3,
						tablet_extra: 3,
						tablet: 2,
						mobile_extra: 2,
						mobile: 1
					}
				};
			}

			getDefaultElements() {
				const selectors = this.getSettings( 'selectors' );
				return {
					$timeline: this.$element.find( selectors.timeline ),
					$items: this.$element.find( selectors.items ),
					$slickSlide: this.$element.find( selectors.slickSlide ),
					$connector: this.$element.find( selectors.connector ),
					$progressBar: this.$element.find( selectors.progressBar ),
					$markerClass: this.$element.find( selectors.markerClass ),
					$carousel: this.$element.find( selectors.carousel ),
					$sliderWrap: this.$element.find( selectors.sliderWrap ),
					$sliderNav: this.$element.find( selectors.sliderNav ),
				}
			}

			getSlidesCount() {
				return this.elements.$slickSlide.length;
			}

			getDeviceSlidesPerView(device) {
				const slidesPerViewKey = 'columns' + ('desktop' === device ? '' : '_' + device);
				return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesPerViewKey) || this.getSettings('slidesToShow')[device]);
			}

			getDeviceSlidesToScroll(device) {
				const slidesToScrollKey = 'slides_to_scroll' + ('desktop' === device ? '' : '_' + device);
				return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesToScrollKey) || 1);
			}

			getSlickOptions() {
				const elementSettings = this.getElementSettings(),
					rtl = this.elements.$sliderWrap.data( 'rtl' );
				let centerMode = false;

				let slides     = ( elementSettings.columns !== undefined && elementSettings.columns !== '' ) ? parseInt( elementSettings.columns, 10 ) : 3,
				slidesToScroll = ( elementSettings.slides_to_scroll !== undefined && elementSettings.slides_to_scroll !== '' ) ? parseInt( elementSettings.slides_to_scroll, 10 ) : 3;

				if ( 'yes' === elementSettings.infinite_loop && 'yes' === elementSettings.center_mode ) {
					centerMode = true;
				}
				const slickOptions = {
					slidesToShow:   slides,
					slidesToScroll: slidesToScroll,
					autoplay:       'yes' === elementSettings.autoplay,
					autoplaySpeed:  elementSettings.autoplay_speed,
					arrows:         false,
					pauseOnHover:   'yes' === elementSettings.pause_on_hover,
					pauseOnFocus:   'yes' === elementSettings.pause_on_hover,
					centerMode:     centerMode,
					speed:          elementSettings.animation_speed,
					infinite:       'yes' === elementSettings.infinite_loop,
					rtl:            'yes' === rtl,
				};

				const breakpointsSettings = {},
				breakpoints = elementorFrontend.config.responsive.activeBreakpoints;

				Object.keys(breakpoints).forEach((breakpointName, index) => {
					if ( 'widescreen' !== breakpointName ) {
						breakpointsSettings[index] = {
							breakpoint: breakpoints[breakpointName].value + 1,
							settings: {
								slidesToShow: this.getDeviceSlidesPerView(breakpointName),
								slidesToScroll: this.getDeviceSlidesToScroll(breakpointName)
							}
						}
					}
				});

				slickOptions.responsive = Object.values(breakpointsSettings);

				return slickOptions;
			}

			bindEvents() {
				const elementSettings = this.getElementSettings();
				/* if ( 'undefined' !== typeof elementor.$previewContents ) {
					this.window	= elementor.$previewContents;
				} */

				if ( 'vertical' === elementSettings.layout ) {
					this.winHeight	= $(window).height();
					this.scrollTop	= $(window).scrollTop();
					this.window	    = $(window);

					this.window.on( 'scroll', $.proxy( function() {
						this.scrollTop = this.window.scrollTop();
						
						this.requestAnimation();
						this.revealItems();
					}, this ) );

					$(window).on( 'resize', $.proxy( function() {
						this.scrollTop 	= this.window.scrollTop();
						this.winHeight	= $(window).height();

						this.requestAnimation();
					}, this ) );

					this.requestAnimation();
					this.revealItems();
				}

				if ( 'horizontal' === elementSettings.layout ) {
					this.initHorizontalLayout();
				}
			}

			requestAnimation() {
				if ( ! this.isAnimating ) {
					let frameId = requestAnimationFrame( this.reboot.bind(this) );
				}

				this.isAnimating = true;
			}

			revealItems() {
				var self = this;

				this.elements.$items.each( function() {
					if ( ( $(this).offset().top <= ( self.window.scrollTop() + $(window).outerHeight() * 0.95 ) ) && $(this).hasClass('pp-timeline-item-hidden') ) {
						$(this).removeClass('pp-timeline-item-hidden').addClass( self.animationClass );
					}
				} );
			}

			setup() {
				var self = this,
					lastMarkerHeight = this.elements.$items.last().find( this.elements.$markerClass ).outerHeight();

				this.elements.$connector.css({
					'top': self.elements.$items.first().find( self.elements.$markerClass ).offset().top - self.elements.$items.first().offset().top,
					'bottom': ( self.$element.offset().top + self.$element.outerHeight() ) - self.elements.$items.last().find( self.elements.$markerClass ).offset().top - ( lastMarkerHeight / 2 )
				});
			}

			reboot() {
				this.isAnimating = false;

				if ( this.winHeight !== this.lastWinHeight ) {
					this.setup();
				}

				this.start.bind( this )();
			}

			start() {
				if ( this.scrollTop !== this.lastScrollTop || this.winHeight !== this.lastWinHeight ) {
					this.lastScrollTop = this.scrollTop;
					this.lastWinHeight = this.winHeight;

					this.progress();
				}
			}

			progress() {
				var self = this,
					win	= $(window);

				this.elements.$items.each( function() {
					if ( $(this).find( self.elements.$markerClass ).offset().top < ( self.window.scrollTop() + win.outerHeight() / 2 ) ) {
						$(this).addClass('pp-timeline-item-active');
					} else {
						$(this).removeClass('pp-timeline-item-active');
					}
				} );

				let lastMarkerPos = this.elements.$items.last().find( this.elements.$markerClass ).offset().top,
					lastMarkerHeight = this.elements.$items.last().find( this.elements.$markerClass ).outerHeight(),
					progressPos	= ( this.window.scrollTop() - this.elements.$progressBar.offset().top ) + ( win.outerHeight() / 2 );

				if ( lastMarkerPos <= ( this.window.scrollTop() + win.outerHeight() / 2 ) ) {
					progressPos = lastMarkerPos - this.elements.$progressBar.offset().top;
				}

				progressPos = progressPos + ( lastMarkerHeight / 2 );

				this.elements.$progressBar.css( 'height', progressPos + 'px' );
			}

			initHorizontalLayout() {
				const elementSettings = this.getElementSettings();

				this.initCarousel();
				this.initCarouselNav();

				this.elements.$carousel.slick( 'setPosition' );

				if ( elementorFrontend.isEditMode() ) {
					this.elements.$sliderWrap.resize( function() {
						this.elements.$carousel.slick( 'setPosition' );
					});
				}

				// When user hover then pause and after hover start Slider.
				if ( 'yes' === elementSettings.pause_on_hover ) {
					this.togglePauseOnHover(true);
				}
			}

			togglePauseOnHover(toggleOn) {
				if (toggleOn) {
					this.$element.on({
						mouseenter: () => {
							this.elements.$carousel.slick( 'slickPause' );
							this.elements.$sliderNav.slick( 'slickPause' );
						},
						mouseleave: () => {
							this.elements.$carousel.slick( 'slickPlay' );
							this.elements.$sliderNav.slick( 'slickPlay' );
						}
					});
				} else {
					this.$element.off('mouseenter mouseleave');
				}
			}

			initCarousel() {
				const elementSettings = this.getElementSettings();
				let slickConfig = this.getSlickOptions();

				slickConfig.dots     = 'yes' === elementSettings.dots;
				slickConfig.asNavFor = this.elements.$sliderNav;
				
				this.elements.$carousel.slick(slickConfig);
			}

			initCarouselNav() {
				const elementSettings = this.getElementSettings();

				let slickConfig = this.getSlickOptions();

				slickConfig.asNavFor      = this.elements.$carousel;
				slickConfig.arrows        = 'yes' === elementSettings.arrows;
				slickConfig.prevArrow     = '.pp-arrow-prev-' + this.getID();
				slickConfig.nextArrow     = '.pp-arrow-next-' + this.getID();
				slickConfig.centerMode    = 'yes' === elementSettings.center_mode;
				slickConfig.focusOnSelect = true;

				this.elements.$sliderNav.slick(slickConfig);
			}
		}

		elementorFrontend.elementsHandler.attachHandler( 'pp-timeline', TimelineWidget );
	} );
})(jQuery);