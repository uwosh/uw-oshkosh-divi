"use strict";

// Wordpress uses the 'jQuery' object by default to call jQuery.
//  This wrapping, self-executing function allows us to use the
//  default $ for all of our jQuery calls.
(function($) {
  $(document).ready(function() {
    // Custom search box
    $("#et_search_icon").click(function() {
      $("#et_top_search div div form").fadeToggle("slow");
    });
  });

  $(window).load(function() {
    // Turns off the Divi parent theme's event listener
    // (prevents the main menu from dropping down when a sub-menu
    // item is clicked)
    $(".et_pb_fullwidth_section")
      .find("li.menu-item > a")
      .off("click");

    //fixes dropdown menu from having white background-color
    function menu_background() {
      jQuery(".et_pb_fullwidth_menu").each(function(index, value) {
        var backgroundColor = jQuery(value).css("background-color");

        jQuery(value)
          .children()
          .children()
          .find("*")
          .css("background-color", backgroundColor);
      });
    }
    menu_background();

    //stops the mobile menu items from overlapping
    function menu_Overlap() {
      var menus = $(".et_mobile_menu").find("*");
      for (let item of menus) {
        if (item.firstElementChild == null) {
          $(item).addClass("mobile-menu-text");
        }
      }
    }
    menu_Overlap();

    //this function is for checking each <li> element on the page and creating a unique id by adding on the id of the parent <ul> element
    function test_li(){
      var new_id;
        $('li').each(function(){
          var current_li_id = $(this).attr("id");
          
          if($(this).parent().attr("id")){
              var parent_id = $(this).parent().attr("id");
              
              new_id = current_li_id + "_" + parent_id; 
      
              $(this).attr("id", new_id);
          }


        });

    }
    test_li();

  });
})(jQuery);
