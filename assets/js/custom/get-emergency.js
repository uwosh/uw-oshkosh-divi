( function( $ ) {
	$( document ).ready( function() {
		const site = WPURLS.siteurl;
		const uwFox = 'https://wwwtest.uwosh.edu/uwfox';
		const uwFDL = 'https://wwwtest.uwosh.edu/uwfdl';
		const uwOshkoshCategory = 11;
		const uwFDLCategory = 12;
		const uwFoxCategory = 13;

		function fetchEmergencies( category ) {
			$.ajax({
				url: 'https://wwwtest.uwosh.edu/emergency/wp-json/wp/v2/posts?categories=' + category,
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
							$( '.emergency-banner-wrapper' ).css( 'display', 'flex' );
						});
					}
				}
			});
		}

		if ( site === uwFox ) {

			// pull back emergencies for UW Fox Valley
			fetchEmergencies( uwFoxCategory );
		} else if ( site === uwFDL ) {

			// pull back emergencies for UW Fond Du Lac
			fetchEmergencies( uwFDLCategory );
		} else {

			// pull back emergencies for UW Oshkosh
			fetchEmergencies( uwOshkoshCategory );
		}
	});
}( jQuery ) );
