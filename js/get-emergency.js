(function ($) {
  $(document).ready(function () {
    $.ajax({
      url: 'https://uwosh.edu/emergency/category/broadcast/feed/',
      dataType: 'xml',
      success: function (response) {
        var json = $.xml2json(response);
        var broadcast = json["#document"]["rss"]["channel"]["item"];
        if (broadcast != null) {
          // There is a broadcast
          if (broadcast.length > 1) {
            broadcast = broadcast[0];
          }
          var broadcast_title = broadcast["title"];
          var broadcast_link = broadcast["link"];
          var broadcast_categories = broadcast["category"];
          var broadcast_description = broadcast["description"];
          if (broadcast_description.length >= 100) {
            broadcast_description = broadcast_description.substring(0, 100) + "...";
          }

          // Setting the content for the notification
          $(".broadcast-link").attr("href", broadcast_link);
          $(".broadcast-title").html(broadcast_title + ": ");
          $(".broadcast-description").html(broadcast_description);

          // Setting the color for the banner
          var isInfo = $.inArray("Information", broadcast_categories) != -1 ? true : false;
          var isWarning = $.inArray("Warning", broadcast_categories) != -1 ? true : false;
          var isEmergency = $.inArray("Emergency", broadcast_categories) != -1 ? true : false;

          if (isEmergency) {
            $(".emergency-banner-wrapper").addClass("emergency");
          } else if (isWarning) {
            $(".emergency-banner-wrapper").addClass("warning");
          } else if (isInfo) {
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