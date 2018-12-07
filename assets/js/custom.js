"use strict";

(function ($) {
  $(document).ready(function () {
    var site = WPURLS.siteurl;
    var uwFox = "https://wwwtest.uwosh.edu/uwfox";
    var uwFDL = "https://wwwtest.uwosh.edu/uwfdl";
    var uwOshkoshCategory = 11;
    var uwFDLCategory = 12;
    var uwFoxCategory = 13;

    function fetchEmergencies(category) {
      $.ajax({
        url: 'https://wwwtest.uwosh.edu/emergency/wp-json/wp/v2/posts?categories=' + category,
        dataType: 'json',
        success: function success(response) {
          var broadcast = response;

          if (!$.isEmptyObject(broadcast)) {
            // There is a broadcast
            broadcast = broadcast[0]; // grabs the most recent announcement

            var broadcast_title = broadcast.title.rendered;
            var broadcast_link = broadcast.link;
            var broadcast_categories = broadcast.categories;
            var broadcast_description = $(broadcast.content.rendered).text();

            if (broadcast_description.length >= 100) {
              broadcast_description = broadcast_description.substring(0, 100) + "...";
            } // Setting the content for the notification


            $(".broadcast-link").attr("href", broadcast_link);
            $(".broadcast-title").html(broadcast_title + ": ");
            $(".broadcast-description").html(broadcast_description); // Setting the color for the banner

            var isInfo = $.inArray(6, broadcast_categories) != -1 ? true : false;
            var isWarning = $.inArray(7, broadcast_categories) != -1 ? true : false;
            var isEmergency = $.inArray(8, broadcast_categories) != -1 ? true : false;

            if (isEmergency) {
              $(".emergency-banner-wrapper").addClass("emergency");
            } else if (isWarning) {
              $(".emergency-banner-wrapper").addClass("warning");
            } else if (isInfo) {
              $(".emergency-banner-wrapper").addClass("info");
            } // Displaying the emergency banner on the site


            $(".emergency-banner-wrapper").css("display", "flex");
            $(".header-wrapper").addClass("emergency-bumpdown");
          }
        }
      });
    }

    if (site === uwFox) {
      // pull back emergencies for UW Fox Valley
      fetchEmergencies(uwFoxCategory);
    } else if (site === uwFDL) {
      // pull back emergencies for UW Fond Du Lac
      fetchEmergencies(uwFDLCategory);
    } else {
      // pull back emergencies for UW Oshkosh
      fetchEmergencies(uwOshkoshCategory);
    }
  });
})(jQuery);
"use strict"; // Wordpress uses the 'jQuery' object by default to call jQuery.
//  This wrapping, self-executing function allows us to use the
//  default $ for all of our jQuery calls.

(function ($) {
  $(document).ready(function () {
    // Custom search box
    $("#et_search_icon").click(function () {
      $("#et_top_search div div form").fadeToggle("slow");
    }); // Sets the jQuery date picker to start on Sunday instead of Monday

    if (typeof $(".selector").datepicker === "function") {
      $(".selector").datepicker({
        firstDay: 1
      });
    }
  });
  $(window).load(function () {
    // Turns off the Divi parent theme's event listener
    // (prevents the main menu from dropping down when a sub-menu
    // item is clicked)
    $(".et_pb_fullwidth_section").find("li.menu-item > a").off("click"); //fixes dropdown menu from having white background-color

    function menu_background() {
      jQuery(".et_pb_fullwidth_menu").each(function (index, value) {
        var backgroundColor = jQuery(value).css("background-color");
        jQuery(value).children().children().find("*").css("background-color", backgroundColor);
      });
    }

    menu_background(); //stops the mobile menu items from overlapping

    function menu_Overlap() {
      var menus = $(".et_mobile_menu").find("*");
      var _iteratorNormalCompletion = true;
      var _didIteratorError = false;
      var _iteratorError = undefined;

      try {
        for (var _iterator = menus[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
          var item = _step.value;

          if (item.firstElementChild == null) {
            $(item).addClass("mobile-menu-text");
          }
        }
      } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion && _iterator.return != null) {
            _iterator.return();
          }
        } finally {
          if (_didIteratorError) {
            throw _iteratorError;
          }
        }
      }
    }

    menu_Overlap();
    /*
    * Accessibility changes: for screen readers all nav menu <li> elements need to have unique ids to differentiate the menu item links from one another
    * NOTE: pay attention to when .children() and .find() is being used in this function, .children() gets the first set of children, .find() gets everything beneath the parent
    */

    function unique_menu_ids() {
      /*
      * Simple menu: do not have a lot of depth and already have known <ul> ids
      * I'm just looping through these menus and appending the parent id onto the end of all of the <li> children
      * 
      */
      var simple_menu_ids = ["top-menu", "et-secondary-menu"];
      var original_id;
      var new_id;

      for (var i = 0; i < simple_menu_ids.length; i++) {
        $('#' + simple_menu_ids[i]).find("li").each(function () {
          original_id = $(this).attr("id");
          new_id = original_id + "_" + simple_menu_ids[i];
          $(this).attr("id", new_id);
        });
      }
      /*
      * Complex menus: ones where we only have the class fullwidth-menu-nav on a <nav> element, or the mobile menus that are exact duplicates of the fullwidth-menu-nav menus
      */


      var complex_menu_ids = [];
      /*
      * fullwidth-menu-nav menus are tricky
      * first, search through the <nav> elements for those that have the class "fullwidth-menu-nav", these are the menus for the page, and grab its id
      * then, give the first set of <li> children of that <ul> element (using the id you just found), and append the <ul> id to the end of the ids for these <li> elements
      * then, push the newly created unique ids of these <li> elements to the complex_menu_ids array
      */

      $("nav").each(function () {
        if ($(this).hasClass("fullwidth-menu-nav")) {
          var ul_id = $(this).find("ul").attr("id"); // console.log( $("#" + ul_id).children("li").attr("id") );

          $("#" + ul_id).children("li").each(function () {
            original_id = $(this).attr("id");
            new_id = original_id + "_" + ul_id;
            $(this).attr("id", new_id);
            complex_menu_ids.push($(this).attr("id")); //  console.log("fullwidth_nav child: "+ $(this).attr("id") );
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
      * then, they push these newly unique-ified ids to the complex_menu_ids array
      * 
      */

      var mobile_ids = ["mobile_menu", "mobile_menu1", "mobile_menu2"];

      for (i = 0; i < mobile_ids.length; i++) {
        $("#" + mobile_ids[i]).children("li").each(function () {
          original_id = $(this).attr("id");
          new_id = original_id + "_" + mobile_ids[i];
          $(this).attr("id", new_id);
          complex_menu_ids.push($(this).attr("id")); // console.log("mobile_menu1 child: " +  $(this).attr("id") );
        });
      }
      /*
      * Similar to the loop at the beginning of this function, this loop iterates through the complex_menu_ids array that has now been filled with unique ids
      * this loop needs to come after the ".each methods" for the fullwidth-menu-nav, and mobile menus BECAUSE the <li>'s inside of the menus 
      * were duplicates of one another
      * now that these parent <li> elements inside of these menus are not duplicates of one another, we can actually iterate through all of the <li> under them and make them unique
      * which is what this loop is doing 
      */


      for (i = 0; i < complex_menu_ids.length; i++) {
        $('#' + complex_menu_ids[i]).find("li").each(function () {
          original_id = $(this).attr("id");
          new_id = original_id + "_" + complex_menu_ids[i];
          $(this).attr("id", new_id);
        });
      }
    }

    unique_menu_ids();
  });
})(jQuery);