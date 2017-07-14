<?php // add the admin options page

add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
  add_options_page('GCS Settings Page', 'GCS Settings', 'customize', 'gcs-plugin', 'plugin_options_page');
}
add_action( 'after_switch_theme', 'check_gcs_table' );
function check_gcs_table(){

    global $wpdb;
    $prefix= $wpdb->prefix;
    $gcs_table = $prefix . "gcs_address";
    $gcs_code='';
    $placeholder='';
      if ($wpdb->get_var("SHOW TABLES LIKE '$gcs_table'")!=$gcs_table)
        {
          // Table doesn't exists, create one
          $charset_collate = $wpdb->get_charset_collate();
          $sql = "CREATE TABLE $gcs_table (
               id mediumint(9) NOT NULL AUTO_INCREMENT,
               address_code varchar(1000) NOT NULL,
               UNIQUE KEY id (id)
             ) $charset_collate;";
          require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
          dbDelta( $sql );
        }
      }

function plugin_options_page() {
  //checks if data is in the table
    global $wpdb;
    $prefix= $wpdb->prefix;
    $gcs_table = $prefix . "gcs_address";
    if ($wpdb->get_var("SHOW TABLES LIKE '$gcs_table'")==$gcs_table)
    {  $count_query = "select count(*) from $gcs_table";
       $num = $wpdb->get_var($count_query);
    if ($num >0)
    {
    //If data exists sets $gcs_code to the code value
    $maxId= $wpdb->get_var("SELECT Max(id) FROM $gcs_table  ");
    $gcs_code= stripslashes($wpdb->get_var("SELECT address_code FROM $gcs_table WHERE id= $maxId "));
      }
    }
    else {
      // if table is empty sets a placeholder
      $placeholder="Enter Code Here";
    }
      ?>
  <div>
    <!-- creation of the form -->
    <h1>GCS Settings</h1>
    <form id="gcsForm" action="" name="gcsForm" method="POST">
      <p>In the last line of the code snippet and type in this attribute to the opening 	&lt;gcse:searchbox-only&gt; tag:    resultsUrl='http://????.uwosh.edu/search-results/'<br>
        For Further Instructions<a target="_blank" href="https://kb.uwosh.edu/internal/page.php?id=56354"> Click Here</a></p><br>
        Enter Google Custom Search Code Below:<br>
        <textarea type='text' name='custom_search_address'id="gcs_address" placeholder='<?php echo $placeholder; ?>'  rows="14" cols="80"><?php echo $gcs_code; ?></textarea> <br>
        <?php submit_button('Submit', 'primary','button' ) ?>
      </form>
      <br>

      <script type="text/javascript">
      (function($) {
        $(document).ready(function(){
          //clicking button will get variable from the form box
          $('#button').click(function(event){
            event.preventDefault();
            //gets the routing to find the form.php file
            var path = '<?php echo get_stylesheet_directory_uri(); ?>';
            var gcs_code = $('#gcs_address').val();
            // uses ajax to pass variable to form.php page
            jQuery.ajax({
              url:path+"/includes/form.php",
              type: 'POST',
              data: {gcs_code:gcs_code},
              success: function (data) {
                console.log("got this: " + data);
                alert(data)
              },
              error: function (){
                alert('Failed to enter data');
                console.log("failed");
              }
            });
          });
        });
      })(jQuery);
      </script>
      <?php
     }
     ?>
