<?php
// Instantiate the Google Custom Search module
require 'includes/gcs-module.php' ;

// Stylesheets
function uwo_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'uwo_theme_enqueue_styles' );

// Custom JavaScript
function uwo_theme_enqueue_script(){
  wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/script.js', array('jquery') ,'1.0', true );
  wp_enqueue_script( 'jfeed', get_stylesheet_directory_uri() . '/lib/xml2json.js', array('jquery') ,'1.0', true );
  wp_enqueue_script( 'get-emergency', get_stylesheet_directory_uri() . '/js/get-emergency.js', array('jquery') ,'1.0', true );
}
add_action( 'wp_enqueue_scripts', 'uwo_theme_enqueue_script' );

// Customize Wordpress login page
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/wordmark-login.png);
            background-size: contain;
            padding-bottom: 30px;
            margin-left: 0;
            margin-right: 0;
            width: 322px;
            height: 149px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Favicons
function uwo_favicon_link() {
    echo '<!-- Favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="' . get_stylesheet_directory_uri() . '/images/favicons/favicon.ico?v=2">
    <link rel="apple-touch-icon" sizes="57x57" href="' . get_stylesheet_directory_uri() . '/images/favicons/apple-touch-icon-57x57.png?v=2">
    <link rel="apple-touch-icon" sizes="114x114" href="' . get_stylesheet_directory_uri() . '/images/favicons/apple-touch-icon-114x114.png?v=2">
    <link rel="apple-touch-icon" sizes="72x72" href="' . get_stylesheet_directory_uri() . '/images/favicons/apple-touch-icon-72x72.png?v=2">
    <link rel="apple-touch-icon" sizes="144x144" href="' . get_stylesheet_directory_uri() . '/images/favicons/apple-touch-icon-144x144.png?v=2">
    <link rel="apple-touch-icon" sizes="60x60" href="' . get_stylesheet_directory_uri() . '/images/favicons/apple-touch-icon-60x60.png?v=2">
    <link rel="apple-touch-icon" sizes="120x120" href="' . get_stylesheet_directory_uri() . '/images/favicons/apple-touch-icon-120x120.png?v=2">
    <link rel="apple-touch-icon" sizes="76x76" href="' . get_stylesheet_directory_uri() . '/images/favicons/apple-touch-icon-76x76.png?v=2">
    <link rel="apple-touch-icon" sizes="152x152" href="' . get_stylesheet_directory_uri() . '/images/favicons/apple-touch-icon-152x152.png?v=2">
    <meta name="apple-mobile-web-app-title" content="UW Oshkosh">
    <link rel="icon" type="image/png" href="' . get_stylesheet_directory_uri() . '/images/favicons/favicon-196x196.png?v=2" sizes="196x196">
    <link rel="icon" type="image/png" href="' . get_stylesheet_directory_uri() . '/images/favicons/favicon-160x160.png?v=2" sizes="160x160">
    <link rel="icon" type="image/png" href="' . get_stylesheet_directory_uri() . '/images/favicons/favicon-96x96.png?v=2" sizes="96x96">
    <link rel="icon" type="image/png" href="' . get_stylesheet_directory_uri() . '/images/favicons/favicon-16x16.png?v=2" sizes="16x16">
    <link rel="icon" type="image/png" href="' . get_stylesheet_directory_uri() . '/images/favicons/favicon-32x32.png?v=2" sizes="32x32">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-TileImage" content="' . get_stylesheet_directory_uri() . '/images/favicons/mstile-144x144.png?v=2">
    <meta name="application-name" content="UW Oshkosh">';
}
add_action( 'wp_head', 'uwo_favicon_link' );
/**
 * I want to use the basic 2012 theme but don't want TinyMCE to create
 * unwanted HTML. By removing editor-style.css from the $editor_styles
 * global, this code effectively undoes the call to add_editor_style()
 */
add_action( 'after_setup_theme', 'foobar_setup', 11 );
function foobar_setup() {
  global $editor_styles;
  $editor_styles = array();
}

?>
<?php
/*
* For accessibility a user needs to be able to zoom in on a webpage, ex. cases where the user has poor eyesight, to acheive this
* we need the meta tag in the header to have "maximum-scale" > 2 and "user-scalable" cannot be disabled.
*/

/*remove the function that sets:
* '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />'
*/
function child_remove_parent_function(){
    remove_action('wp_head', 'et_add_viewport_meta');
}
add_action('wp_loaded', 'child_remove_parent_function');

/*
* replace removed function with child function that allows zooming
*/
function accessible_viewport_meta(){
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1" />';
}
add_action('wp_head', 'et_add_viewport_meta_2');

/*
* altering comment template to add aria-label for accessibility: 
* wp looks for the comment_form default variables when it creates form fields
* Param: $arg stands for the comment_field that is being modified
* in this function we are writing our own version of the comment_field,
* one that has the appropriate aria-labels describing what the field is
* for screen readers 
* Return: $arg with the changes that we made to the comment_field so that 
* wp knows to use this version of the comment_field variable when creating comment_fields
*/
function wpsites_modify_comment_form_text_area($arg) {
    $arg['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-label="comment" aria-required="true"></textarea></p>';
    return $arg;
}

add_filter('comment_form_defaults', 'wpsites_modify_comment_form_text_area');

/*
* altering comment fields so that they also have aria labels:
* similar to the wpsites_modify_comment_form_text_area function;
* Param: $fields represents the array of templates for form fields that 
* accompany the comment_field when a user submits a comment on a wp site
* in this function we are setting our own version of these form fields that match the 
* accessibility needs w/ proper aria-labels & aria-describedby attributes
* Return: $fields, passes the changes we made to the template for these variables for when
* wp creates the fields author, email, url and cookies the accompany the comment field when 
* a user submits a comment on a post
*/

function accessible_comment_form_default_fields($fields){
    $fields = [
        'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name *', 'textdomain'  ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="author" name="author" aria-label="comment author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email *', 'textdomain'  ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="email" aria-label="comment author email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
        'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'textdomain'  ) . '</label> ' .
                    '<input id="url" aria-label="comment author website url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',
        'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
                    '<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.' ) . '</label></p>',
    ];
    return $fields;
}
add_filter('comment_form_default_fields', 'accessible_comment_form_default_fields');

/*
* function to alter the nav menu <li> id values
* 
* Params:
* $menu_item_item_id: string, the id that is applied to the menu item's li element
* $item: wp_post object, the current menu item
* $args: stdClass, an object of the wp_nav_menu() arguments
* $depth: int, depth of menu item ex. can be used for padding
*
* Return:
* $menu_item_item_id: the new id of the menu items, unique and descriptive for accessibility 
*/
function change_menu_li_id($menu_item_item_id, $item, $args, $depth){
    /*
    * to start the menu item id is automatically ex. menu-item-100,
    * grab the current li based on the given $menu_item_item_id value (string)
    */
    $li = $dom->getElementById($menu_item_item_id);

    /*
    * get the id of the ul, of the current li 
    */

    /*
    * set the id of each <li> to a unique id based on the navigation label and which menu they are under
    */
    $menu_item_item_id = $item->title;
    /*
    * replace spaces with underscores
    */
    $menu_item_item_id = str_replace(' ', '_', $menu_item_item_id);
    return $menu_item_item_id; 
}
add_filter('nav_menu_item_id','change_menu_li_id', 10, 4);

?>
