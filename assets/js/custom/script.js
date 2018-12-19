'use strict';

// Wordpress uses the 'jQuery' object by default to call jQuery.
//  This wrapping, self-executing function allows us to use the
//  default $ for all of our jQuery calls.
( function( $ ) {
	$( document ).ready( function() {

		// Custom search box
		$( '#et_search_icon' ).click( function() {
			$( '#et_top_search div div form' ).fadeToggle( 'slow' );
		});

		// Sets the jQuery date picker to start on Sunday instead of Monday
		if ( 'function' === typeof( $( '.selector' ).datepicker ) ) {
			$( '.selector' ).datepicker({ firstDay: 1 });
		}
	});

	$( window ).load( function() {

		// Turns off the Divi parent theme's event listener
		// (prevents the main menu from dropping down when a sub-menu
		// item is clicked)
		$( '.et_pb_fullwidth_section' )
			.find( 'li.menu-item > a' )
			.off( 'click' );

		//fixes dropdown menu from having white background-color
		function menuBackground() {
			jQuery( '.et_pb_fullwidth_menu' ).each( function( index, value ) {
				var backgroundColor = jQuery( value ).css( 'background-color' );

				jQuery( value )
					.children()
					.children()
					.find( '*' )
					.css( 'background-color', backgroundColor );
			});
		}
		menuBackground();

		//stops the mobile menu items from overlapping
		function menuOverlap() {
			var menus = $( '.et_mobile_menu' ).find( '*' );
			for ( let item of menus ) {
				if ( null == item.firstElementChild ) {
					$( item ).addClass( 'mobile-menu-text' );
				}
			}
		}
		menuOverlap();

		/*
* Accessibility changes: for screen readers all nav menu <li> elements need to have unique ids to differentiate the menu item links from one another
* NOTE: pay attention to when .children() and .find() is being used in this function, .children() gets the first set of children, .find() gets everything beneath the parent
*/
		function uniqueMenuIds() {

			/*
			* Simple menu: do not have a lot of depth and already have known <ul> ids
			* I'm just looping through these menus and appending the parent id onto the end of all of the <li> children
			*
			*/
			var simpleMenuIds = [ 'top-menu', 'et-secondary-menu' ];
			var originalId, newId, ulId;
			var mobileIds = [ 'mobile_menu', 'mobile_menu1', 'mobile_menu2' ];

			/*
			* Complex menus: ones where we only have the class fullwidth-menu-nav on a <nav> element, or the mobile menus that are exact duplicates of the fullwidth-menu-nav menus
			*/
			var complexMenuIds = [];


			for ( let i = 0; i < simpleMenuIds.length; i++ ) {
				$( '#' + simpleMenuIds[i]).find( 'li' ).each( function() {
					originalId = $( this ).attr( 'id' );
					newId = originalId + '_' + simpleMenuIds[i];

					$( this ).attr( 'id', newId );
				});
			}

			/*
			* fullwidth-menu-nav menus are tricky
			* first, search through the <nav> elements for those that have the class "fullwidth-menu-nav", these are the menus for the page, and grab its id
			* then, give the first set of <li> children of that <ul> element (using the id you just found), and append the <ul> id to the end of the ids for these <li> elements
			* then, push the newly created unique ids of these <li> elements to the complexMenuIds array
			*/
			$( 'nav' ).each( function() {

				if ( $( this ).hasClass( 'fullwidth-menu-nav' ) ) {
					ulId = $( this ).find( 'ul' ).attr( 'id' );

					// console.log( $("#" + ulId).children("li").attr("id") );
					$( '#' + ulId ).children( 'li' ).each( function() {
						originalId = $( this ).attr( 'id' );
						newId = originalId + '_' + ulId;
						$( this ).attr( 'id', newId );

						complexMenuIds.push( $( this ).attr( 'id' ) );

						//  console.log("fullwidth_nav child: "+ $(this).attr("id") );
					});
				}
			});

			/*
			* mobile_menu1 is the mobile version of the first fullwidth-menu-nav menu on the page, mobile_menu2 is the mobile version of the second fullwidth-menu-nav menu on the page
			* so far, I'm operating under the assumption that there are only 2 custom menus on the page
			*
			* mobile_menu is a combination of the full website menus top-menu and et-secondary-menu
			*
			* these functions get the  first set of children of the mobile menus and append "mobile_menu1" to their ids
			* then, they push these newly unique-ified ids to the complexMenuIds array
			*
			*/
			for ( let i = 0; i < mobileIds.length; i++ ) {
				$( '#' + mobileIds[i]).children( 'li' ).each( function() {
					originalId = $( this ).attr( 'id' );
					newId = originalId + '_' + mobileIds[i];
					$( this ).attr( 'id', newId );

					complexMenuIds.push( $( this ).attr( 'id' ) );
				});

			}

			/*
      * Similar to the loop at the beginning of this function, this loop iterates through the complexMenuIds array that has now been filled with unique ids
      * this loop needs to come after the ".each methods" for the fullwidth-menu-nav, and mobile menus BECAUSE the <li>'s inside of the menus
      * were duplicates of one another
      * now that these parent <li> elements inside of these menus are not duplicates of one another, we can actually iterate through all of the <li> under them and make them unique
      * which is what this loop is doing
      */
			for ( let i = 0; i < complexMenuIds.length; i++ ) {
				$( '#' + complexMenuIds[i]).find( 'li' ).each( function() {
					originalId = $( this ).attr( 'id' );
					newId = originalId + '_' + complexMenuIds[i];

					$( this ).attr( 'id', newId );
				});
			}

		}
		uniqueMenuIds();

	});
}( jQuery ) );
