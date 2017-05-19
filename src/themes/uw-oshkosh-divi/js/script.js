// Wordpress uses the 'jQuery' object by default to call jQuery.
//  This wrapping, self-executing function allows us to use the
//  default $ for all of our jQuery calls.
(function ($) {
  $(document).ready(function(){
    // Custom search box
    $("#et_search_icon").click(function(){
      $("form.gsc-search-box").fadeToggle("slow");
    });
  });

  $( window ).load(function() {
    // Turns off the Divi parent theme's event listener
    // (prevents the main menu from dropping down when a sub-menu
    // item is clicked)
    $(".et_pb_fullwidth_section").find("li.menu-item > a").off("click");
    //fixes dropdown menu from having white background-color
    function menu_background()
    {
      var nameOfMenu = $(".et_pb_fullwidth_menu");
      for ( let name of nameOfMenu){
        var classname= $(name).attr("class");
        var splitClassName= classname.split(" ");
        var lastClass = splitClassName.pop();
        $("." + lastClass ).children().children().find("*").css('background-color', $("."+lastClass).css('background-color'));
      }
    }
    menu_background();
    //stops the mobile menu items from overlapping
    function menu_Overlap(){
      var menus = $(".et_mobile_menu").find('*');
      for (let item of menus){
        if(item.firstElementChild===null){
          $(item).addClass("mobile-menu-text");
        }
      }
    }
    menu_Overlap();
  });
}(jQuery));
