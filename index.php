<?php

/*
  Plugin Name: Web Notification Bar
  Plugin URI: http://webtech.gq
  Description: Show notification bar on the front end for wordpress.
  Version: 1.0
  Author: Farooq Ahmad
  Author URI: https://www.fiverr.com/aliali44
 */

// Exit if accessed directly 
  if (!defined('ABSPATH'))
    exit;

include_once 'admin/admin.php';
/**
* creating a table for saving button update details
* on activating the plugin
*/


function webNotificationBarCraeteTabel()
{      
 
  global $wpdb; 
  $db_table_name = $wpdb->prefix . 'web_notification_bar';  // table name
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $db_table_name (
    id int(11) NOT NULL auto_increment,
    your_text varchar(200),
    font_size varchar(5),
    text_color varchar(15),
    box_bg_color varchar(15),
    icons varchar(100),
    btn_name varchar(15),
    btn_color varchar(15),
    btn_bg_color varchar(15),
    btn_position varchar(10),
    active_deactive varchar(2),
    pg_link varchar(200),
    position_fix_relative varchar(15),
    countDownDate varchar(1000),
    counterDisplay varchar(5),
    
    UNIQUE KEY id (id)
    ) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
add_option( 'test_db_version', $test_db_version );

   // Adding default values
   
$wpdb->insert( $db_table_name, array( 'your_text' => 'This is our first text' ,'font_size' => '18', 'text_color' => 'white', 'box_bg_color' => '#0081b3', 'icons' => 'fa fa-times-circle-o', 'btn_name' =>'Submit', 'btn_color' => 'white', 'btn_bg_color' => '#ff9801', 'btn_position' => 'top', 'active_deactive' => '0', 'pg_link' => 'url', 'position_fix_relative' => 'fixed', 'countDownDate' => '5644756', 'counterDisplay' => '1' ) );

} 

register_activation_hook( __FILE__, 'webNotificationBarCraeteTabel' );


//include_once 'admin/admin.php';

//enqueues font awesome stylesheet
function webNotificationBarFontAwesomeStyle() {
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

}

add_action('wp_enqueue_scripts', 'webNotificationBarFontAwesomeStyle');

//enqueues css and js files
add_action('wp_enqueue_scripts', 'webNotificationBarScripts');

function webNotificationBarScripts() {
        wp_enqueue_style('like', plugins_url('/assets/css/style.css', __FILE__));
//        wp_enqueue_style('FontAwesome', plugins_url('/admin/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_script('like', plugins_url('/assets/js/logic.js', __FILE__), array('jquery'), '1.0', true);


    wp_localize_script('like', 'counterURL', array(
        'ajax_url' => admin_url('admin-ajax.php')
        ));

    wp_localize_script('like', 'cookieURL', array(
        'cookie_ajax_url' => admin_url('admin-ajax.php')
        ));
}


add_action('wp_head', 'webNotificationBarCheckStatus');
function webNotificationBarCheckStatus(){
global $wpdb; 
  $db_table_name = $wpdb->prefix . 'web_notification_bar';

  $row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $db_table_name WHERE ID = 1" ) );

  $checkStatus  = $row->active_deactive;
  $checkCounter = $row->counterDisplay;
  if($checkStatus == '1')
  {

?>
    <div class="show-label" style="background: <?php echo esc_html($row->box_bg_color); ?>;">
      <div class="container1">
        <div class="left-icon">
          <i class="<?php echo esc_html($row->icons); ?>" style="color:<?php echo esc_html($row->text_color); ?> " aria-hidden="true"></i>
        </div>
        <label class="get-text" style="font-size:<?php echo esc_html($row->font_size)."px"; ?>; color:<?php echo esc_html($row->text_color); ?>"><?php echo esc_html($row->your_text); ?></label>
<?php
if($checkCounter == '1')
{

?>
        <div class="remaing-time">
          <input type="tex" name="" readonly="" placeholder="Day" class="day1">
          <input type="tex" name="" readonly="" placeholder="Hour" class="hour1">
          <input type="tex" name="" readonly="" placeholder="Mints" class="min1">
          <input type="tex" name="" readonly="" placeholder="Sec" class="sec1">
        </div>
<?php
}
?>
        <a href="<?php echo esc_url($row->pg_link); ?>" target="_blank"><div class="dis-btn" style="background:<?php echo esc_html($row->btn_bg_color);?>;color:<?php echo esc_html($row->btn_color); ;?>;"><?php echo esc_html($row->btn_name); ?></div></a>
      </div>
      <input type="hidden" name="" class="get-counter-value" value="<?php echo esc_html($row->countDownDate);?>">
      <input type="hidden" name=""  class="set-position-val" value="<?php echo esc_html($row->btn_position); ?>">
      <input type="hidden" name="" class="pos-fix-relative" value="<?php echo esc_html($row->position_fix_relative);?>">
    </div>

  <?php
} // end if condition
  

} // end checkRecordActive function

