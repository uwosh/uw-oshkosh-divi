<?php
if (file_exists('wp-content/custom-files/google-custom-search.php'))
  {
      global $wpdb;
      $prefix= $wpdb->prefix;
      $gcs_table = $prefix . "gcs_address";
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
      $script= file_get_contents('wp-content/custom-files/google-custom-search.php');
      // takes off php script before and after
      ?>
      <script type="text/javascript">
        alert('<?php echo $script ?>')
      </script>
      <?php
      $scrub_php= substr($script,16,-6);
      //inserts data into table
      $wpdb->insert(
      $gcs_table,
      array(
        'address_code' => $scrub_php
       ),
      array(
        '%s'
       )
     );
     //deletes file and folder
       if(unlink("wp-content/custom-files/google-custom-search.php"))
       {
         rmdir("wp-content/custom-files");
       }
    ?>
    <script type="text/javascript">
      location.reload (true);
    </script>
    <?php
   }
 ?>
