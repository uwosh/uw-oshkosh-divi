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

    
    function test_li(){
      var new_id;
        $('li').each(function(){
          var current_li_id = $(this).attr("id");
          
          if($(this).parent().attr("id")){
              var parent_id = $(this).parent().attr("id");
              
              new_id = current_li_id + "_" + parent_id; 
      
              $(this).attr("id", new_id);
          }
          else{
              if($(this).parent().hasClass("sub-menu")) {
                  //<ul id="this_is_what_i_want">(parent) <li>(parent) <ul class="sub-menu">(parent) <li> (this)
                  var ul_li_ul = $(this).parent().parent().parent().attr("id");
                  
                  // var parent_class = "sub-menu";
                    
                  // new_id = current_li_id + "_" + parent_class; 

                  // $(this).attr("id", new_id);

                  //what you're trying to do here: get sub-menu parent id's, but the catch is that there are sub-menus inside of sub-menus inside etc. that need 
                  // a parent of a parent of a parent of a parent :) 
                  if($(this).parent().parent().parent().attr("id")){
                    new_id = current_li_id + "_" + ul_li_ul;
                    $(this).attr("id", new_id);
                    console.log(ul_li_ul);

                  } 
                  else{
                    var ul_li_ul_li = $(this).parent().parent().parent().parent().parent().attr("id");
                    console.log(ul_li_ul_li);
                  }
                
              }
          }
        });

    }
    test_li();

  });
})(jQuery);
