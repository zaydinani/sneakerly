(function ($) {
    'use strict';
    
    var getElementSettings = function ($element) {
		var elementSettings = {},
			modelCID        = $element.data('model-cid');

		if ( isEditMode && modelCID ) {
			var settings     = elementorFrontend.config.elements.data[ modelCID ],
				settingsKeys = elementorFrontend.config.elements.keys[ settings.attributes.widgetType || settings.attributes.elType ];

			jQuery.each( settings.getActiveControls(), function( controlKey ) {
				if ( -1 !== settingsKeys.indexOf( controlKey ) ) {
					elementSettings[ controlKey ] = settings.attributes[ controlKey ];
				}
			} );
		} else {
			elementSettings = $element.data('settings') || {};
		}

		return elementSettings;
	};

    var isEditMode = false;

	var MapHandler = function ($scope, $) {
		var mapElem            = $scope.find('.pp-google-map').eq(0),
        	elementSettings    = getElementSettings( $scope ),
			widgetId           = $scope.data('id'),
			locations          = mapElem.data('locations'),
			zoom               = (mapElem.data('zoom') !== '') ? mapElem.data('zoom') : 4,
			zoomType           = (mapElem.data('zoomtype') !== '') ? mapElem.data('zoomtype') : 'auto',
			mapType            = (elementSettings.map_type !== '') ? elementSettings.map_type : 'roadmap',
			streetViewControl  = (elementSettings.map_option_streeview === 'yes') ? true : false,
			mapTypeControl     = (elementSettings.map_type_control === 'yes') ? true : false,
			zoomControl        = (elementSettings.zoom_control === 'yes') ? true : false,
			fullScreenControl  = (elementSettings.fullscreen_control === 'yes') ? true : false,
			scrollZoom         = (elementSettings.map_scroll_zoom === 'yes') ? 'auto' : 'none',
			mapStyle           = (mapElem.data('custom-style') !== '') ? mapElem.data('custom-style') : '',
			animation          = (elementSettings.marker_animation !== '') ? elementSettings.marker_animation : '',
			iwMaxWidth         = (mapElem.data('iw-max-width') !== '') ? mapElem.data('iw-max-width') : '',
			mapOptions         = '',
			markerAnimation    = '',
			i                  = '';

        if ( animation === 'drop' ) {
        	markerAnimation = google.maps.Animation.DROP;
        } else if ( animation === 'bounce' ) {
        	markerAnimation = google.maps.Animation.BOUNCE;
        }

		(function initMap() {
			var latlng = new google.maps.LatLng(locations[0][0], locations[0][1]);
				mapOptions = {
					zoom:               zoom,
					center:             latlng,
					mapTypeId:          mapType,
					mapTypeControl:     mapTypeControl,
					streetViewControl:  streetViewControl,
					zoomControl:        zoomControl,
					fullscreenControl:  fullScreenControl,
					gestureHandling:    scrollZoom,
					styles:             mapStyle
				};

			var map        = new google.maps.Map($scope.find('.pp-google-map')[0], mapOptions),
				infowindow = new google.maps.InfoWindow(),
				bounds     = new google.maps.LatLngBounds();

			for (i = 0; i < locations.length; i++) {
				var icon           = '',
					lat            = locations[i][0],
					lng            = locations[i][1],
					info_win       = locations[i][2],
					title          = locations[i][3],
					description    = locations[i][4],
					icon_type      = locations[i][5],
					icon_url       = locations[i][6],
					icon_size      = locations[i][7],
					iw_on_load     = locations[i][8];

				if ( lat.length !== '' && lng.length !== '' ) {
					if ( icon_type === 'custom' ) {
						icon_size = parseInt(icon_size, 10);

						icon = {
							url: icon_url
						};

                        if( ! isNaN( icon_size ) ) {
                    		icon.scaledSize = new google.maps.Size( icon_size, icon_size );
                            icon.origin = new google.maps.Point( 0, 0 );
							icon.anchor = new google.maps.Point( icon_size/2, icon_size );

                    	}
					}

					if ( 'auto' === zoomType ) {
						var loc = new google.maps.LatLng(lat, lng);
						bounds.extend(loc);
						map.fitBounds(bounds);
					}

					var marker = new google.maps.Marker({
						position:  new google.maps.LatLng(lat, lng),
						map:       map,
						title:     title,
						icon:      icon,
                        animation: markerAnimation
					});

					if ( info_win === 'yes' && iw_on_load === 'iw_open' ) {
						var contentString = '<div class="pp-infowindow-content">';
						contentString += '<div class="pp-infowindow-title">'+title+'</div>';
						if ( description.length !== '' ) {
							contentString += '<div class="pp-infowindow-description">'+description+'</div>';
						}
						contentString += '</div>';

                        if ( iwMaxWidth !== ''  ) {
		                	var maxWidth = parseInt( iwMaxWidth, 10 );
		                	infowindow = new google.maps.InfoWindow({
	                            content: contentString,
	                            maxWidth: maxWidth
	                        } );
		                } else {
	                        infowindow = new google.maps.InfoWindow({
	                            content: contentString
	                        } );
		                }

						infowindow.open(map, marker);
					}

					// Event that closes the Info Window with a click on the map
					google.maps.event.addListener(map, 'click', (function(infowindow) {
						return function() {
							infowindow.close();
						};
					})(infowindow));

					if ( info_win === 'yes' && locations[i][3] !== '' ) {
						google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
								var contentString = '<div class="pp-infowindow-content">';
									contentString += '<div class="pp-infowindow-title">'+locations[i][3]+'</div>';
									if ( locations[i][3].length !== '' ) {
										contentString += '<div class="pp-infowindow-description">'+locations[i][4]+'</div>';
									}
									contentString += '</div>';

								infowindow.setContent(contentString);
                                
                                if ( iwMaxWidth !== ''  ) {
                                    var maxWidth = parseInt( iwMaxWidth, 10 );
                                    var InfoWindowOptions = { maxWidth : maxWidth };
                                    infowindow.setOptions( { options:InfoWindowOptions } );
                                }

								infowindow.open(map, marker);
							};
						})(marker, i));
					}
				}
			}

			window['pp_map_' + widgetId] = map;
		})();
	};
    
    $(window).on('elementor/frontend/init', function () {
        if ( elementorFrontend.isEditMode() ) {
			isEditMode = true;
		}
        
        elementorFrontend.hooks.addAction('frontend/element_ready/pp-google-maps.default', MapHandler);
    });
    
}(jQuery));
