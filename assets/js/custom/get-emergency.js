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
					var broadcast = response;
					if ( ! $.isEmptyObject( broadcast ) ) {

						// There is a broadcast
						broadcast = broadcast[0]; // grabs the most recent announcement
						var broadcast_title = broadcast.title.rendered;
						var broadcast_link = broadcast.link;
						var broadcast_categories = broadcast.categories;
						var broadcast_description = $( broadcast.content.rendered ).text();
						if ( 100 <= broadcast_description.length ) {
							broadcast_description = broadcast_description.substring( 0, 100 ) + '...';
						}

						// Setting the content for the notification
						$( '.broadcast-link' ).attr( 'href', broadcast_link );
						$( '.broadcast-title' ).html( broadcast_title + ': ' );
						$( '.broadcast-description' ).html( broadcast_description );

						// Setting the color for the banner
						var isInfo = -1 != $.inArray(6, broadcast_categories) ? true : false;
						var isWarning = -1 != $.inArray(7, broadcast_categories) ? true : false;
						var isEmergency = -1 != $.inArray(8, broadcast_categories) ? true : false;

						if ( isEmergency ) {
							$( '.emergency-banner-wrapper' ).addClass( 'emergency' );
						} else if ( isWarning ) {
							$( '.emergency-banner-wrapper' ).addClass( 'warning' );
						} else if ( isInfo ) {
							$( '.emergency-banner-wrapper' ).addClass( 'info' );
						}

						// Displaying the emergency banner on the site
						$( '.emergency-banner-wrapper' ).css( 'display', 'flex' );
						$( '.header-wrapper' ).addClass( 'emergency-bumpdown' );
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
