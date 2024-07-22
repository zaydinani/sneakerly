(function ($) {
	$( window ).on( 'elementor/frontend/init', () => {
		class ImageGalleryWidget extends elementorModules.frontend.handlers.Base {
			getDefaultSettings() {
				return {
					selectors: {
						container: '.pp-image-gallery-container',
						gallery: '.pp-image-gallery',
						justifiedGallery: '.pp-image-gallery-justified',
						filterItems: '.pp-gallery-filter',
					},
				};
			}

			getDefaultElements() {
				const selectors = this.getSettings( 'selectors' );
				return {
					$container: this.$element.find( selectors.container ),
					$gallery: this.$element.find( selectors.gallery ),
					$justifiedGallery: this.$element.find( selectors.justifiedGallery ),
					$filterItems: this.$element.find( selectors.filterItems ),
				};
			}

			bindEvents() {
				const settings      = this.elements.$container.data('settings'),
					gallery         = this.elements.$gallery,
					filterItems     = this.elements.$filterItems,
					widgetId        = this.getID(),
					lightboxLibrary = this.getElementSettings('lightbox_library'),
					cachedItems     = [],
            		cachedIds       = [];

				if ( ! elementorFrontend.isEditMode() ) {
					if ( gallery.hasClass('pp-image-gallery-masonry') || gallery.hasClass('pp-image-gallery-filter-enabled') || settings.pagination === 'yes' ) {
						var layoutMode = 'fitRows';

						if ( gallery.hasClass('pp-image-gallery-masonry') ) {
							layoutMode = 'masonry';
						}

						let defaultFilter = '';

						$(filterItems).each(function() {
							if ( defaultFilter === '' || defaultFilter === undefined ) {
								defaultFilter = $(this).attr('data-default');
							}
						});

						var $isotope_args = {
								itemSelector    : '.pp-grid-item-wrap',
								layoutMode		: layoutMode,
								percentPosition : true,
								filter          : defaultFilter,
							},
							isotopeGallery = {};

						this.elements.$container.imagesLoaded( function() {
							isotopeGallery = gallery.isotope( $isotope_args );
							gallery.find('.pp-gallery-slide-image').on('load', function() {
								if ( $(this).hasClass('lazyloaded') ) {
									return;
								}
								setTimeout(function() {
									gallery.isotope( 'layout' );
								}, 500);
							});
						});

						this.elements.$container.on( 'click', '.pp-gallery-filter', function() {
							var $this = $(this),
								filterValue = $this.attr('data-filter'),
								filterIndex = $this.attr('data-gallery-index'),
								galleryItems = gallery.find(filterValue);

							if ( filterValue === '*' ) {
								galleryItems = gallery.find('.pp-grid-item-wrap');
							}

							$(galleryItems).each(function() {
								var imgLink = $(this).find('.pp-image-gallery-item-link');
								if ( lightboxLibrary === 'fancybox' ) {
									imgLink.attr('data-fancybox', filterIndex + '_' + widgetId);	
								} else {
									imgLink.attr('data-elementor-lightbox-slideshow', filterIndex + '_' + widgetId);
								}
							});

							$this.siblings().removeClass('pp-active');
							$this.addClass('pp-active');

							isotopeGallery.isotope({ filter: filterValue });
						});

						$('.pp-filters-dropdown').on( 'change', function() {
							// get filter value from option value.
							var filterValue = this.value,
								filterIndex = $(this).find(':selected').attr('data-gallery-index'),
								galleryItems = gallery.find(filterValue);

							if ( filterValue === '*' ) {
								galleryItems = gallery.find('.pp-grid-item-wrap');
							}

							$(galleryItems).each(function() {
								var imgLink = $(this).find('.pp-image-gallery-item-link');
								if ( lightboxLibrary === 'fancybox' ) {
									imgLink.attr('data-fancybox', filterIndex + '_' + widgetId);	
								} else {
									imgLink.attr('data-elementor-lightbox-slideshow', filterIndex + '_' + widgetId);
								}
							});

							isotopeGallery.isotope({ filter: filterValue });
						});

						// Trigger filter by hash parameter in URL.
						this.hashChange();

						// Trigger filter on hash change in URL.
						$(window).on( 'hashchange', function() {
							this.hashChange();
						}.bind(this) );

						elementorFrontend.elements.$window.on('elementor-pro/motion-fx/recalc', function() {
							isotopeGallery.isotope( 'layout' );
						});
					}
				}

				this.initTilt( settings, gallery );

				this.initjustifiedLayout(settings);

				this.initLightbox();

				gallery.find('.pp-grid-item-wrap').each(function() {
					cachedIds.push( $(this).data('item-id') );
				});

				const self = this;

				// Load More
				this.elements.$container.find('.pp-gallery-load-more').on('click', function(e) {
					e.preventDefault();

					var $this = $(this);
					$this.addClass('disabled pp-loading');

					if ( cachedItems.length > 0 ) {
						self.renderGalleryItems( cachedItems, cachedIds );
					} else {
						var data = {
							action: 'pp_gallery_get_images',
							pp_action: 'pp_gallery_get_images',
							settings: settings
						};

						$.ajax({
							type: 'post',
							url: window.location.href.split( '#' ).shift(),
							context: this,
							data: data,
							success: function(response) {
								if ( response.success ) {
									var items = response.data.items;
									if ( items ) {
										$(items).each(function() {
											if ( $(this).hasClass('pp-grid-item-wrap') ) {
												cachedItems.push( this );
											}
										});
									}

									self.renderGalleryItems( cachedItems, cachedIds );
								}
							},
							error: function(xhr, desc) {
								console.log(desc);
							}
						});
					}
				});
			}

			hashChange() {
				setTimeout(function() {
					if ( location.hash && $(location.hash).length > 0 ) {
						if ( $(location.hash).parent().hasClass('pp-gallery-filters') ) {
							$(location.hash).trigger('click');
						}
					}
				}, 500);
			}

			renderGalleryItems( cachedItems, cachedIds ) {
				const settings       = this.elements.$container.data('settings'),
					gallery          = this.elements.$gallery,
					galleryId        = gallery.attr( 'id' ),
					tiltEnable       = (settings.tilt_enable !== undefined) ? settings.tilt_enable : '',
					justifiedGallery = this.elements.$justifiedGallery;

				this.elements.$container.find('.pp-gallery-load-more').removeClass( 'disabled pp-loading' );

				if ( cachedItems.length > 0 ) {
					var count = 1;
					var items = [];

					$(cachedItems).each(function() {
						var id = $(this).data('item-id');

						if ( -1 === $.inArray( id, cachedIds ) ) {
							if ( count <= parseInt( settings.per_page, 10 ) ) {
								cachedIds.push( id );
								items.push( this );
								count++;
							} else {
								return false;
							}
						}
					});

					if ( items.length > 0 ) {
						items = $(items);

						items.imagesLoaded( function() {
							gallery.isotope('insert', items);
							setTimeout(function() {
								gallery.isotope('layout');
							}, 500);

							if ( tiltEnable === 'yes' ) {
								$( gallery ).find('.pp-grid-item').tilt({
									disableAxis: settings.tilt_axis,
									maxTilt: settings.tilt_amount,
									scale: settings.tilt_scale,
									speed: settings.tilt_speed
								});
							}
						});
					}

					if ( justifiedGallery.length > 0 ) {
						justifiedGallery.imagesLoaded( function() {
						})
						.done(function( instance ) {
							setTimeout(function(){
								justifiedGallery.justifiedGallery( 'norewind' );
							}, 200 );
							
						});
					}

					if ( cachedItems.length === cachedIds.length ) {
						this.elements.$container.find('.pp-gallery-pagination').hide();
					}

					var lightboxSelector = '.pp-grid-item-wrap .pp-image-gallery-item-link[data-fancybox="' + galleryId + '"]';

					if ( $(lightboxSelector).length > 0 ) {
						$(lightboxSelector).fancybox({
							loop: true
						});
					}
				}
			}

			initjustifiedLayout(settings) {
				const justifiedGallery = this.elements.$justifiedGallery;

				if ( justifiedGallery.length > 0 ) {
					justifiedGallery.imagesLoaded( function() {
					})
					.done(function(instance) {
						justifiedGallery.justifiedGallery({
							rowHeight : settings.row_height,
							lastRow : settings.last_row,
							selector : 'div',
							waitThumbnailsLoad : true,
							margins : settings.image_spacing,
							border : 0
						});
					});
				}
			}

			initLightbox() {
				const galleryId      = this.elements.$gallery.attr( 'id' ),
					lightboxSelector = '.pp-grid-item-wrap .pp-image-gallery-item-link[data-fancybox="' + galleryId + '"]',
					fancyboxSettings = this.elements.$gallery.data('fancybox-settings');

				if ( $(lightboxSelector).length > 0 ) {
					$(lightboxSelector).fancybox( fancyboxSettings );
				}
			}

			initTilt( settings, gallery ) {
				const tiltEnable = (settings.tilt_enable !== undefined) ? settings.tilt_enable : '';

				if ( tiltEnable === 'yes' ) {
					$(gallery).find('.pp-image-gallery-thumbnail-wrap').tilt({
						disableAxis: settings.tilt_axis,
						maxTilt: settings.tilt_amount,
						scale: settings.tilt_scale,
						speed: settings.tilt_speed,
						perspective: 1000
					});
				}
			}
		}

		elementorFrontend.elementsHandler.attachHandler( 'pp-image-gallery', ImageGalleryWidget );
	} );
})(jQuery);