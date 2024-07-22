(function ($) {
	$( window ).on( 'elementor/frontend/init', () => {
		class CardSliderWidget extends elementorModules.frontend.handlers.Base {
			getDefaultSettings() {
				return {
					selectors: {
						swiperContainer: '.pp-swiper-slider',
						swiperSlide: '.swiper-slide',
					},
				};
			}

			getDefaultElements() {
				const selectors = this.getSettings( 'selectors' );
				return {
					$swiperContainer: this.$element.find( selectors.swiperContainer ),
					$swiperSlide: this.$element.find( selectors.swiperSlide ),
				};
			}

			getSliderSettings(prop) {
				const sliderSettings = ( undefined !== this.elements.$swiperContainer.data('slider-settings') ) ? this.elements.$swiperContainer.data('slider-settings') : '';

				if ( 'undefined' !== typeof prop && 'undefined' !== sliderSettings[prop] ) {
					return sliderSettings[prop];
				}

				return sliderSettings;
			}

			getEffect() {
				return this.getSliderSettings('effect');
			}

			getSwiperOptions() {
				const sliderSettings = this.getSliderSettings();

				const swiperOptions = {
					grabCursor:              'yes' === sliderSettings.grab_cursor,
					// initialSlide:             this.getInitialSlide(),
					slidesPerView:            1,
					slidesPerGroup:           1,
					loop:                     'yes' === sliderSettings.loop,
					centeredSlides:           'yes' === sliderSettings.centered_slides,
					speed:                    sliderSettings.speed,
					autoHeight:               sliderSettings.auto_height,
					effect:                   this.getEffect(),
					preventClicksPropagation: false,
					slideToClickedSlide:      true,
				};

				if ( 'fade' === this.getEffect() ) {
					swiperOptions.fadeEffect = {
						crossFade: true,
					};
				}

				if ( 'yes' === sliderSettings.keyboard ) {
					swiperOptions.keyboard = {
						enabled: true,
					};
				}

				if ( sliderSettings.show_arrows ) {
					var prevEle = ( this.isEdit ) ? '.elementor-swiper-button-prev' : '.swiper-button-prev-' + this.getID();
					var nextEle = ( this.isEdit ) ? '.elementor-swiper-button-next' : '.swiper-button-next-' + this.getID();

					swiperOptions.navigation = {
						prevEl: prevEle,
						nextEl: nextEle,
					};
				}

				if ( sliderSettings.pagination ) {
					var paginationEle = ( this.isEdit ) ? '.swiper-pagination' : '.swiper-pagination-' + this.getID();

					swiperOptions.pagination = {
						el: paginationEle,
						type: sliderSettings.pagination,
						clickable: true
					};
				}

				if ( !this.isEdit && sliderSettings.autoplay ) {
					swiperOptions.autoplay = {
						delay: sliderSettings.autoplay_speed,
						disableOnInteraction: !!sliderSettings.pause_on_interaction
					};
				}

				return swiperOptions;
			}

			bindEvents() {
				this.initSlider();
			}

			async initSlider() {
				const elementSettings = this.getElementSettings();

				const Swiper = elementorFrontend.utils.swiper;
    			this.swiper = await new Swiper(this.elements.$swiperContainer, this.getSwiperOptions());

				if ('yes' === elementSettings.pause_on_hover) {
					this.togglePauseOnHover(true);
				}

				this.setEqualHeight();

				if ( 'no' !== elementSettings.open_lightbox ) {
					this.removeDuplicateLightboxItems();
				}
			}

			togglePauseOnHover(toggleOn) {
				if (toggleOn) {
					this.elements.$swiperContainer.on({
						mouseenter: () => {
							this.swiper.autoplay.stop();
						},
						mouseleave: () => {
							this.swiper.autoplay.start();
						}
					});
				} else {
					this.elements.$swiperContainer.off('mouseenter mouseleave');
				}
			}

			setEqualHeight() {
				let height = 0;

				this.elements.$swiperSlide.each(function () {
					if ( $(this).height() > height) {
						height = $(this).height();
					}
				});

				this.elements.$swiperContainer.css( 'height', (height + 70) + 'px' );
			}

			removeDuplicateLightboxItems() {
				this.$element.find('.pp-card-slider-item.swiper-slide-duplicate').each(function () {
					let lightboxItem = $(this).find('.pp-card-slider-image a');

					lightboxItem.removeAttr( 'data-elementor-open-lightbox data-elementor-lightbox-slideshow data-elementor-lightbox-index' );
					lightboxItem.removeClass( 'elementor-clickable' );
				});
			}
		}

		elementorFrontend.elementsHandler.attachHandler( 'pp-card-slider', CardSliderWidget );
	} );
})(jQuery);