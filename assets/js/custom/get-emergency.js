( function( $ ) {
	$( document ).ready( function() {
		const site = WPURLS.siteurl;

		const siteEnums = Object.freeze({
			UW_OSHKOSH: 'https://uwosh.edu',
			UW_FDL: 'https://uwosh.edu/uwfdl',
			UW_FOX: 'https://uwosh.edu/uwfox'
		});

		const categoryEnums = Object.freeze({
			UW_OSHKOSH: 11,
			UW_FDL: 12,
			UW_FOX: 13
		});

		function fetchEmergencies( category ) {
			$.ajax({
				url: 'https://uwosh.edu/emergency/wp-json/wp/v2/posts?categories=' + category,
				dataType: 'json',
				success: function( response ) {
					var broadcasts = response.slice( 0, 2 );
					var broadcastTitle, broadcastLink, broadcastCategories, broadcastDescription, isInfo, isWarning, isEmergency;
					if ( ! $.isEmptyObject( broadcasts ) ) {

						broadcasts.forEach( ( broadcast, index ) => {

							// There is a broadcast
							broadcastTitle = broadcast.title.rendered;
							broadcastLink = broadcast.link;
							broadcastCategories = broadcast.categories;
							broadcastDescription = $( broadcast.content.rendered ).text();
							if ( 100 <= broadcastDescription.length ) {
								broadcastDescription = broadcastDescription.substring( 0, 100 ) + '...';
							}

							// Setting the content for the notification
							$( `#emergency-banner-${index} .broadcast-link` ).attr( 'href', broadcastLink );
							$( `#emergency-banner-${index}  .broadcast-title` ).html( broadcastTitle + ': ' );
							$( `#emergency-banner-${index}  .broadcast-description` ).html( broadcastDescription );

							// Setting the color for the banner
							isInfo = -1 != $.inArray( 6, broadcastCategories ) ? true : false;
							isWarning = -1 != $.inArray( 7, broadcastCategories ) ? true : false;
							isEmergency = -1 != $.inArray( 8, broadcastCategories ) ? true : false;

							if ( isEmergency ) {
								$( `#emergency-banner-${index}.emergency-banner-wrapper` ).addClass( 'emergency' );
							} else if ( isWarning ) {
								$( `#emergency-banner-${index}.emergency-banner-wrapper` ).addClass( 'warning' );
							} else if ( isInfo ) {
								$( `#emergency-banner-${index}.emergency-banner-wrapper` ).addClass( 'info' );
							}

							// Displaying the emergency banner on the site
							// $( `#emergency-banner-${index}` ).css( 'display', 'flex' );
							$( `#emergency-banner-${index}` ).removeClass( 'disabled' );
						});
					}
				}
			});
		}

		if ( site === siteEnums.UW_FOX ) {

			// pull back emergencies for UW Fox Valley
			fetchEmergencies( categoryEnums.UW_FOX );
		} else if ( site === siteEnums.UW_FDL ) {

			// pull back emergencies for UW Fond Du Lac
			fetchEmergencies( categoryEnums.UW_FDL );
		} else if ( site === siteEnums.UW_OSHKOSH ) {

			// pull back emergencies for every category because we are on the home page
			fetchEmergencies( `${categoryEnums.UW_FOX},${categoryEnums.UW_FDL},${categoryEnums.UW_OSHKOSH}` );
		} else {

			// pull back emergencies for other UW Oshkosh site
			fetchEmergencies( categoryEnums.UW_OSHKOSH );
		}
	});
}( jQuery ) );
