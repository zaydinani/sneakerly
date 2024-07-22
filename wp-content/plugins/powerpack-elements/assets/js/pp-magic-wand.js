( function ( $ ) {

	var item_type = [ 'powerpack', 'pp_section', 'pp_column', 'pp_container' ];
	var item_type_elementor_hook = [ 'widget', 'column', 'section', 'container' ];

	xdLocalStorage.init(
		{
			iframeUrl: pp_magic_wand.cross_domain_cdn,
			initCallback: function () {}
		}
	);

	PPMWHandler = {
		copy: function( type, json ) {
			xdLocalStorage.setItem( 'ppe_container_new', JSON.stringify( {
				widgetType: type,
				widgetCode: json
			} ) );
		},

		paste: function( data, element ) {
			var container = null,
				data = data.widgetCode,
				dataString = JSON.stringify( data ),
				newData = {
					elType: data.elType,
					settings: data.settings
				},
				hasMedia = /\.(jpg|jpeg|png|gif|svg)/gi.test( dataString ),
				targetElement = element,
				targetElementType = element.model.get( 'elType' ),
				elementLocation = {
					index: 0
				};
		
			switch( data.elType ) {
				case 'section':
				case 'container':
					newData.elements = PPMWHandler.generateUniqueID( data.elements );
					container = elementor.getPreviewContainer();
					switch ( targetElementType ) {
						case 'widget':
                            elementLocation.index = targetElement.getContainer().parent.parent.view.getOption( "_index" ) + 1;
                            break;
                        case 'column':
                            elementLocation.index = targetElement.getContainer().parent.view.getOption( "_index" ) + 1;
                            break;
                        case 'section':
						case 'container':
                            elementLocation.index = targetElement.getOption( "_index" ) + 1;
                            break;
					}
					break;
				case 'column':
					newData.elements = PPMWHandler.generateUniqueID( data.elements );
					switch( targetElementType ){
                        case 'widget':
                            container = targetElement.getContainer().parent.parent;
                            elementLocation.index = targetElement.getContainer().parent.view.getOption( "_index" ) + 1;
                            break;
                        case 'column':
                            container = targetElement.getContainer().parent;
                            elementLocation.index = targetElement.getOption( "_index" ) + 1;
                            break;
                        case 'section':
						case 'container':
                            container = targetElement.getContainer();
                            break;
                    }
					break;
				case 'widget':
					newData.widgetType = data.widgetType;
					container = targetElement.getContainer();
                    switch( targetElementType ){
                        case 'widget':
                            container = targetElement.getContainer().parent;
                            elementLocation.index = targetElement.getOption( "_index" ) + 1;
                            break;
                        case 'column':
                            container = targetElement.getContainer();
                            break;
                        case 'section':
						case 'container':
                            container = targetElement.children.findByIndex(0).getContainer();
                            break;
                    }
					break;
			}

			var newEl = PPMWHandler.createElement( targetElement, targetElementType, {
				model: newData,
				container: container,
				options: elementLocation
			} );
		
			if ( hasMedia ) {
				PPMWHandler.processMedia( newEl, dataString, function( response ) {
					if ( response.success ) {
						var mediaElement = response.data[0];
						newData.elType = mediaElement.elType;
						newData.settings = mediaElement.settings;
		
						if ( "widget" === mediaElement.elType ) {
							newData.widgetType = mediaElement.widgetType;
						} else {
							newData.elements = mediaElement.elements;
						}

						newEl.view.$el.removeClass('ppe-processing-import').attr("data-pp-processing-import-title", "Image processing completed.");
		
						var t = setTimeout(function() {
							$e.run( "document/elements/delete", {
								container: newEl
							});
							$e.run( "document/elements/create", {
								model: newData,
								container: container,
								options: elementLocation
							});
							clearTimeout(t);
						}, 750);
					}
				} );
			}
		},

		createElement: function( targetElement, targetElementType, data ) {
			var element = $e.run( "document/elements/create", data );
		
			if ( undefined == element ) {
				if ( "widget" === targetElementType ) {
					if ( targetElement.$el.next( '.undefined.elementor-widget-empty' )  ) {
						targetElement.$el.next( '.undefined.elementor-widget-empty' ).after( '<div class="elementor-alert elementor-alert-warning">' + pp_magic_wand.widget_not_found + '</div>' );
					}
				} else {
					if ( targetElement.$el.find( '.undefined.elementor-widget-empty' ) ) {
						targetElement.$el.find( '.undefined.elementor-widget-empty' ).after( '<div class="elementor-alert elementor-alert-warning">' + pp_magic_wand.widget_not_found + '</div>' );
					}
				}
			}

			return element;
		},

		processMedia: function( newEl, dataString, callback ) {
			$.ajax({
				url: pp_magic_wand.ajaxURL,
				method: 'post',
				data: {
					nonce: pp_magic_wand.nonce,
					action: "pp_process_import",
					content: dataString
				},
				beforeSend: function () {
					newEl.view.$el.addClass( "ppe-processing-import" ).attr("data-pp-processing-import-title", "Processing images...");
				}
			}).done( function ( response ) {
				if ( 'function' === typeof callback ) {
					callback( response );
				}
			});
		},
		
		generateUniqueID: function( elements ) {		
			elements.forEach( function( item, index ) {
				if ( typeof elementorCommon.helpers.getUniqueId() != "undefined" ) {
					item.id = elementorCommon.helpers.getUniqueId();
				}

				if( item.elements.length > 0 ) {
					PPMWHandler.generateUniqueID( item.elements );
				}
			} );
		
			return elements;
		},
		
		getSectionData: function( post_id, section_id, nonce, callback ) {
			if ( 'undefined' === typeof post_id ) {
				return;
			}

			if ( 'undefined' === typeof section_id ) {
				return;
			}

			if ( 'undefined' === typeof nonce ) {
				nonce = 1;
			}

			$.post(
				pp_magic_wand.ajaxURL,
				{
					action: 'pp_get_section_data',
					post_id: post_id,
					section_id: section_id,
					nonce: nonce
				},
				function( response ) {
					if ( response.success ) {
						PPMWHandler.copy( 'section', response.data );
					}
					if ( 'function' === typeof callback ) {
						callback( response );
					}
				}
			);
		},

		isValidJson: function(str) {
			try {
				JSON.parse(str);
				return true;
			} catch (e) {
				return false;
			}
		}
	};

	if ( 'undefined' !== typeof elementor ) {

		item_type.forEach( function( item, index ) {
			elementor.hooks.addFilter( 'elements/' + item_type_elementor_hook[index] + '/contextMenuGroups', function ( groups, element ) {
				var loop_element = this;
				groups.push(
					{
						name: item_type[index],
						actions: [
							{
								name: 'copy',
								title: pp_magic_wand.pp_copy,
								icon: pp_magic_wand.cross_domain_icon,
								callback: function () {
									var widgetType = element.model.get( "widgetType" ),
										widgetCode = element.model.toJSON();
									PPMWHandler.copy( widgetType, widgetCode );

									// Create a textarea, set its value to the JSON string, and copy to clipboard
									var textarea = document.createElement('textarea');
									textarea.value = JSON.stringify({widgetType: widgetType, widgetCode: widgetCode});
									document.body.appendChild(textarea);
									textarea.select();
									document.execCommand('copy');
									document.body.removeChild(textarea);
								}
							},
							{
								name: 'paste',
								title: pp_magic_wand.pp_paste,
								icon: pp_magic_wand.cross_domain_icon,
								callback: function () {
									// var widgetData = '';
									// xdLocalStorage.getItem( 'ppe_container_new', function ( loop_element ) {
									// 	widgetData = JSON.parse( loop_element.value );
									// 	PPMWHandler.paste( widgetData, element );
									// });

									navigator.clipboard.readText().then(function (pastedData) {
										if (PPMWHandler.isValidJson(pastedData)) {
											var widgetData = JSON.parse(pastedData);
											if (widgetData && typeof widgetData == 'object') {
												// Call your paste handler function
												xdLocalStorage.setItem( 'ppe_container_new', pastedData );
												
												PPMWHandler.paste( widgetData, element);
											}
										}
									}).catch(function (err) {
										console.error("Error clipboard data: " + err);
									});
								}
							}
						]
					}
				);
				return groups;
			});
		});

	}

} )( jQuery );  
