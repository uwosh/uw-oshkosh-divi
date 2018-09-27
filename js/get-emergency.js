(function ($) {
    $(document).ready(function(){
      $.ajax({
        url: 'https://uwosh.edu/emergency/wp-json/wp/v2/posts?categories=4',
        dataType: 'json',
        success: function(response) {
          var broadcast = response;
          if(!$.isEmptyObject(broadcast)) {
            // There is a broadcast
            broadcast = broadcast[0]; // grabs the most recent announcement
            var broadcast_title = broadcast.title.rendered;
            var broadcast_link = broadcast.link;
            var broadcast_categories = broadcast.categories;
            var broadcast_description = $(broadcast.content.rendered).text();
            if(broadcast_description.length >= 100) {
              broadcast_description = broadcast_description.substring(0, 100) + "...";
            }
  
            // Setting the content for the notification
            $(".broadcast-link").attr("href", broadcast_link);
            $(".broadcast-title").html(broadcast_title + ": ");
            $(".broadcast-description").html(broadcast_description);
            
            // Setting the color for the banner
            var isInfo = $.inArray(6, broadcast_categories) != -1 ? true : false;
            var isWarning = $.inArray(7, broadcast_categories) != -1 ? true : false;
            var isEmergency = $.inArray(8, broadcast_categories) != -1 ? true : false;
            
            if(isEmergency) {
              $(".emergency-banner-wrapper").addClass("emergency");
            } else if(isWarning) {
              $(".emergency-banner-wrapper").addClass("warning");
            } else if(isInfo) {
              $(".emergency-banner-wrapper").addClass("info");
            }
  
            // Displaying the emergency banner on the site
            $(".emergency-banner-wrapper").css("display", "flex");
            $(".header-wrapper").addClass("emergency-bumpdown");
          }
        }
      });
    });
  }(jQuery));