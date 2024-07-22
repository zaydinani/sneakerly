;(function($) {

	PPOffcanvasContent = function( $scope ) {
		
		this.node                   = $scope;
		this.wrap                   = $scope.find('.pp-offcanvas-content-wrap');
		this.cart_wrap              = $scope.find('.pp-offcanvas-cart-container');
		this.content                = $scope.find('.pp-offcanvas-content');
		this.button                 = $scope.find('.pp-offcanvas-toggle');
		this.settings               = this.wrap.data('settings');
		this.scopeUniqueId          = this.getOffcanvasUniqueScopeId( $scope ),
		this.toggle_source          = this.settings.toggle_source;
		this.id                     = this.scopeUniqueId;
		this.toggle_id              = this.settings.toggle_id;
		this.toggle_class           = this.settings.toggle_class;
		this.transition             = this.settings.transition;
		this.esc_close              = this.settings.esc_close;
		this.body_click_close       = this.settings.body_click_close;
		this.links_click_close      = this.settings.links_click_close;
		this.direction              = this.settings.direction;
		this.buttons_position       = this.settings.buttons_position;
		this.open_panel_add_to_cart = this.settings.open_panel_add_to_cart;
		this.add_to_cart_button     = $( '.add_to_cart_button, .single_add_to_cart_button' );
		this.duration               = 500;

		this.destroy();
		this.init();
	};

	PPOffcanvasContent.prototype = {
		id: '',
		node: '',
		wrap: '',
		content: '',
		button: '',
		settings: {},
		transition: '',
		duration: 400,
		initialized: false,
		animations: [
			'slide',
			'slide-along',
			'reveal',
			'push',
		],

		init: function () {
			if ( ! this.wrap.length ) {
				return;
			}

			$('html').addClass('pp-offcanvas-content-widget');

			if ( $('.pp-offcanvas-container').length === 0 ) {
				var faProJs = $('#font-awesome-pro-js').length > 0 ? $('#font-awesome-pro-js').attr('src') : false;
				if ( faProJs ) {
					$('#font-awesome-pro-js').remove();
				}
				$('body').wrapInner( '<div class="pp-offcanvas-container" />' );
				this.content.insertBefore('.pp-offcanvas-container');
				if ( faProJs ) {
					$('body').append( '<script type="text/javascript" id="font-awesome-pro-js" src="' + faProJs + '"></script>' );
				}
			}

			if ( this.wrap.find('.pp-offcanvas-content').length > 0 ) {
                if ( $('.pp-offcanvas-container > .pp-offcanvas-' + this.id).length > 0 ) {
                    $('.pp-offcanvas-container > .pp-offcanvas-' + this.id).remove();
                }
                if ( $('body > .pp-offcanvas-' + this.id ).length > 0 ) {
                    $('body > .pp-offcanvas-' + this.id ).remove();
                }
                $('body').prepend( this.wrap.find('.pp-offcanvas-content') );
			}

			this.bindEvents();
		},

		getOffcanvasUniqueScopeId: function( $scope ) {
			var scopeId = $scope.data('id'),
				$clones = $( '[data-id="' + scopeId + '"]' );

			if ( ! this.hasMultipleScopeId( scopeId ) ) {
				return scopeId;
			}
			scopeIdCloned = scopeId;
			
			$clones.each( function( index ) {
				$(this).attr( 'data-pp-offcanvas-index', index );
			});

			scopeId = scopeId + '_' + $scope.data('pp-offcanvas-index');

			$( '#pp-offcanvas-' + scopeIdCloned ).each( function() {
				$( this ).attr( 'id', 'pp-offcanvas-' + scopeId );

				if ( $( this ).hasClass( 'pp-offcanvas-' + scopeIdCloned ) ) {
					//$( this ).removeClass( 'pp-offcanvas-' + scopeIdCloned );
					$( this ).addClass( 'pp-offcanvas-' + scopeId );
				}
			} );

			return scopeId;
		},

		hasMultipleScopeId : function( scopeId ) {
			var $clones = $( '[data-id="' + scopeId + '"]' );

			if ( 1 === $clones.length ) {
				return false;
			}
			
			return true;
		},

		destroy: function() {
			this.close();

			this.animations.forEach(function( animation ) {
				if ( $('html').hasClass( 'pp-offcanvas-content-' + animation ) ) {
					$('html').removeClass( 'pp-offcanvas-content-' + animation )
				}
			});

			if ( $('body > .pp-offcanvas-' + this.id ).length > 0 ) {
				//$('body > .pp-offcanvas-' + this.id ).remove();
			}
		},

		setTrigger: function() {
			var $trigger = false;
			
			if ( this.toggle_source == 'element-id' && this.toggle_id != '' ) {
				$trigger = $( '#' + this.toggle_id );
			} else if ( this.toggle_source == 'element-class' && this.toggle_class != '' ) {
				$trigger = $( '.' + this.toggle_class );
			} else {
				$trigger = this.node.find( '.pp-offcanvas-toggle' );
			}
			
			return $trigger;
		},

		bindEvents: function () {
			var self = this;
			$trigger = this.setTrigger();

			if ( $trigger ) {
				$trigger.on('click', $.proxy( this.toggleContent, this ));
			}

			if( 'yes' === this.open_panel_add_to_cart ) {
				this.add_to_cart_button.on('click', function(e) {
					setTimeout(function() {
						self.toggleContent(e);
					}, 1000 );
				});
			}

			$('body').delegate( '.pp-offcanvas-content .pp-offcanvas-close', 'click', $.proxy( this.close, this ) );
			
			if ( this.links_click_close === 'yes' ) {
				$('body').delegate( '.pp-offcanvas-content .pp-offcanvas-body a', 'click', $.proxy( this.close, this ) );
			}

            if ( this.esc_close === 'yes' ) {
                this.closeESC();
            }
            if ( this.body_click_close === 'yes' ) {
                this.closeClick();
            }
			$(window).resize( $.proxy( this._resize, this ) );
		},

		toggleContent: function(e) {
			e.preventDefault();
			
			if ( ! $('html').hasClass('pp-offcanvas-open') ) {
				this.show();
			} else {
				this.close();
			}
				this._resize();
		},

		show: function() {
			$('.pp-offcanvas-' + this.id).addClass('pp-offcanvas-visible');
			// init animation class.
			$('html').addClass( 'pp-offcanvas-content-' + this.transition );
			$('html').addClass( 'pp-offcanvas-' + this.direction );
			$('html').addClass('pp-offcanvas-open');
			$('html').addClass('pp-offcanvas-' + this.id + '-open');
			$('html').addClass('pp-offcanvas-reset');

            this.button.addClass('pp-is-active');
				this._resize();
		},

		close: function() {
			$('html').removeClass('pp-offcanvas-open');
			$('html').removeClass('pp-offcanvas-' + this.id + '-open');
			setTimeout($.proxy(function () {
				$('html').removeClass('pp-offcanvas-reset');
				$('html').removeClass( 'pp-offcanvas-content-' + this.transition );
                $('html').removeClass( 'pp-offcanvas-' + this.direction );
				$('.pp-offcanvas-' + this.id).removeClass('pp-offcanvas-visible');
			}, this), 500);
            
            this.button.removeClass('pp-is-active');
		},

		closeESC: function() {
			var self = this;

			if ( '' === self.settings.esc_close ) {
				return;
			}

			// menu close on ESC key
			$(document).on('keydown', function (e) {
				if (e.keyCode === 27) { // ESC
					self.close();
				}
			});
		},

		closeClick: function() {
			var self = this;
			
			if ( this.toggle_source == 'element-id' && this.toggle_id != '' ) {
				$trigger = '#' + this.toggle_id;
			} else if ( this.toggle_source == 'element-class' && this.toggle_class != '' ) {
				$trigger = '.' + this.toggle_class;
			} else {
				$trigger = '.pp-offcanvas-toggle';
			}

			$(document).on('click', function (e) {
				if ( $(e.target).is('.pp-offcanvas-content') || 
					$(e.target).parents('.pp-offcanvas-content').length > 0 || 
					$(e.target).is('.pp-offcanvas-toggle') || 
					$(e.target).parents('.pp-offcanvas-toggle').length > 0 || 
					$(e.target).is($trigger) || 
					$(e.target).parents($trigger).length > 0 || 
					! $(e.target).is('.pp-offcanvas-container') ) {
					return;
				} else {
					self.close();
				}
			});
		},

		_resize: function() {
			if ( ! this.cart_wrap.length ) {
				return;
			}
			
			var off_canvas = $('.pp-offcanvas-' + this.id);
			
			if ( off_canvas && off_canvas.length > 0 ) {
				if ( this.buttons_position === 'bottom' ) {
					var winHeight = window.innerHeight;
					var offset = 0;

					// if ( $('body').hasClass('admin-bar') ) {
					// 	offset = 32;
					// }

					winHeight = winHeight - offset;
					off_canvas.find('.pp-offcanvas-inner').css({
						'height': winHeight + 'px',
						'top': offset
					});

					headerHeight = off_canvas.find('.pp-offcanvas-cart-header').outerHeight(true);
					wrapHeight = off_canvas.find('.pp-offcanvas-wrap').outerHeight();
					cartTotalHeight = off_canvas.find('.woocommerce-mini-cart__total').outerHeight();
					cartButtonsHeight = off_canvas.find('.woocommerce-mini-cart__buttons').outerHeight();
					cartMessageHeight = off_canvas.find('.pp-woo-menu-cart-message').outerHeight();
					if ( undefined === cartMessageHeight ) {
						cartMessageHeight = 0;
					}
					itemsHeight = winHeight - (headerHeight + cartTotalHeight + cartButtonsHeight + cartMessageHeight);

					finalItemsHeight = itemsHeight - ( winHeight - wrapHeight );
					finalItemsHeight += 'px';
				} else {
					finalItemsHeight = 'auto';
				}

				var style = '<style id="pp-woo-style-' + this.id + '">';
				style += '#' + off_canvas.attr('id') + ' .woocommerce-mini-cart.cart_list {'
				style += 'height: ' + finalItemsHeight;
				style += '}';
				style += '</style>';

				if ( $('#pp-woo-style-' + this.id).length > 0 ) {
					$('#pp-woo-style-' + this.id).remove();	
				}

				$('head').append(style);
			}
		}
	};

	var OffCanvasContentHandler = function ($scope, $) {
		var content_wrap = $scope.find('.pp-offcanvas-content-wrap');
		
		if ( $(content_wrap).length > 0 ) {
			new PPOffcanvasContent( $scope );
		}
	};

	/**
	 * Function for Woo Product Categories.
	 */
	var WooOffcanvasCartHandler = function ($scope, $) {
		var container = $scope.find(".pp-offcanvas-cart-container");

		if ( $(container).length > 0 ) {
			new PPOffcanvasContent($scope);
		}
	};

	$(window).on('elementor/frontend/init', function () {
        if ( elementorFrontend.isEditMode() ) {
			isEditMode = true;
		}

		elementorFrontend.hooks.addAction( 'frontend/element_ready/pp-offcanvas-content.default', OffCanvasContentHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/pp-woo-offcanvas-cart.default', WooOffcanvasCartHandler );
    });

})(jQuery);