(function ($) {
	$( window ).on( 'elementor/frontend/init', () => {
		class SitemapWidget extends elementorModules.frontend.handlers.Base {
			getDefaultSettings() {
				return {
					selectors: {
						list: '.pp-sitemap-list',
					},
				};
			}

			getDefaultElements() {
				const selectors = this.getSettings( 'selectors' );
				return {
					$list: this.$element.find( selectors.list )
				};
			}

			bindEvents() {
				const elementSettings = this.getElementSettings(),
					list              = this.elements.$list,
					tree              = elementSettings.sitemap_tree,
					style             = elementSettings.sitemap_tree_style;

				if ( 'yes' === tree ) {
					if ( 'plus_circle' === style ) {
						list.treed();
					}
					else if ( 'caret' === style ) {
						list.treed({ openedClass: 'fa-caret-down', closedClass: 'fa-caret-right' });
					}
					else if ( 'plus' === style ) {
						list.treed({ openedClass: 'fa-minus', closedClass: 'fa-plus' });
					}
					else if ( 'folder' === style ) {
						list.treed({ openedClass: 'fa-folder-open', closedClass: 'fa-folder' });
					}
				}
			}
		}

		elementorFrontend.elementsHandler.attachHandler( 'pp-sitemap', SitemapWidget );
	} );
})(jQuery);