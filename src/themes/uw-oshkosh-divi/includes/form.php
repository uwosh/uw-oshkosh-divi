<?php

// get ahold of the wpdb
require_once('../../../../wp-config.php');
require_once ('../../../../wp-includes/wp-db.php');
require_once( '../../../../wp-load.php');
global $wpdb;
//get the URL from the form
$gcs_code =$_POST['gcs_code'];
//get the wordpress prefix for this page
$prefix= $wpdb->prefix;
//getting the gcs_address table
$gcs_table=$prefix. "gcs_address";
//If no table existed creates a table before adding code
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
$bad_value1= "????";
$bad_value2="<gcse:searchbox-only>";
$validation1= strpos($gcs_code,$bad_value1);
$validation2= strpos($gcs_code,$bad_value2);
//Check to see if textarea is bland or just white space
if (trim($gcs_code) != '')
{
  // checks to make sure code was edited correctly
  if ($validation1=== false && $validation2=== false)
  {
    //insert url into database
    if ($gcs_code!=NULL){
      $wpdb->insert(
        $gcs_table,
        array(
          'address_code' => $gcs_code
        ),
        array(
          '%s'
        )
      );
      //print success
      echo "Google custom search code succesfully added ";
    }
  }
  // if code was not edited from original copy or the url was not changed it will return this
  else
  {
    echo "Please enter valid code";
  }
}
//if nothing is in form box alrt user
else
{
  ?>
  Please Enter Code In Text Box
  <?php
}
?>
