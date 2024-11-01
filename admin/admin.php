<?php
/*
** adding necessarey files
*/

function webNotificationBarAdminFiles() {

    wp_enqueue_style('webNotificationBarMainStyle', plugins_url('/css/style.css', __FILE__));
    wp_enqueue_style('webNotificationBarFontAwesome', plugins_url('/font-awesome/css/font-awesome.min.css', __FILE__));


    wp_enqueue_style('webNotificationBarMainStyleAnimate', plugins_url('/css/animate.css', __FILE__));
 
   
    wp_enqueue_script('webNotificationBarCutomLogic', plugins_url('/js/logic.js',__FILE__ ));
 

}
add_action('admin_enqueue_scripts', 'webNotificationBarAdminFiles');


//color picker
add_action( 'admin_enqueue_scripts', 'webNotificationBarColorPicker' );
function webNotificationBarColorPicker( $hook ) {

    if( is_admin() ) { 

        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 

        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'webNotificationBarcustom-script-handle', plugins_url( 'js/custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
    }
}



/*Theme customize */
add_action( 'admin_menu', 'webNotificationBarAdminPage' );

/**
 * Adds a new settings page under Setting menu
*/


function webNotificationBarAdminPage() {
    add_options_page( __( 'Web Notification Bar' ), __( 'Web Notification Bar' ), 'manage_options', 'wooLiveSaleAdminMainPage', 'webNotificationBarAdminPageDisplay' );
}

/**
* Tabs Method 
*/
function webNotificationBarAdminTabs( $current = 'first' ) {
    $tabs = array(
        'first'   => __( 'General Setting', 'plugin-textdomain' ), 
        
        );
    $html = '<h2 class="wooLiveSalenav-tabnav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? 'nav-tab-active' : '';
        $html .= '<a class="nav-tab ' . esc_html($class) . '" href="?page=wooLiveSaleAdminMainPage&tab=' . esc_html($tab) . '">' . esc_html($name) . '</a>';
    }
    $html .= '</h2>';
    echo $html ;
}

function webNotificationBarAdminPageDisplay(){
    ?>
    <div class="cont-p-dashboard">
        <div class="post_like_dislike_header wrap">Dashboard<span>Contact me for further customization, start from $5. 
            <a href="https://www.fiverr.com/aliali44">Contact</a>
        </span>
    </div>
    <?php

    // ================== Tabs ========================//
     $tab = ( ! empty( $_GET['tab'] ) ) ? esc_attr( $_GET['tab'] ) : 'first';
     webNotificationBarAdminTabs( $tab );


   // =========================== Tab 1 ========================//
    if ( $tab == 'first' ) {
    global $wpdb; 
  $db_table_name = $wpdb->prefix . 'web_notification_bar';
$row = $wpdb->get_results( "SELECT * FROM $db_table_name WHERE id = 1");
  foreach ($row as $row) {
  
        ?>
        <div class="woo-live-saleTabs woo-live-sale-firstTab">
                <div class="show-label animate__animated animate__backInDown">
                    <div class="container">
                    	<div class="left-icon"><i class="<?php echo esc_html($row->icons); ?>" aria-hidden="true"></i></div>
                    <label class="get-text"><?php echo esc_html($row->your_text); ?></label>
                    
                    <div class="remaing-time">
                    	
                    	<input type="tex" name="" readonly="" placeholder="Day" class="day1">
                    	<input type="tex" name="" readonly="" placeholder="Hour" class="hour1">
                    	<input type="tex" name="" readonly="" placeholder="Mints" class="min1">
                    	<input type="tex" name="" readonly="" placeholder="Sec" class="sec1">
                    </div>
                    <a href="<?php echo esc_url($row->pg_link); ?>" target="_blank"><div class="dis-btn"><?php echo esc_html($row->btn_name); ?></div></a>
                    <input type="hidden" name="" class="get-counter-value" value="<?php echo esc_html($row->countDownDate);?>">
                    </div>
                </div>
                <div class="activation-counter">
                    <div class="active-deactive">
                        <input type="checkbox" name="" value="<?php echo esc_html($row->active_deactive) ?>"><span>Activate</span>
                    </div>
                    <div class="counter-1">
                        <input type="checkbox" name="" value="<?php echo esc_html($row->counterDisplay) ?>"><span>Countdown</span>
                    </div>
                </div>
                <div style="clear: both;"></div>
            <div class="header-section">
                <div class="input-value">
                    <label>Enter your text:</label>
                    <textarea class="your-text"><?php echo esc_html($row->your_text); ?></textarea>
                    <label>Select font size:</label>
                    <input type="text" name="fontsize" class="fontsize" value="<?php echo esc_html($row->font_size); ?>">
                    <label>Select font color:</label>
                    <input type="color" name="textcolor" class="text-color" value="<?php echo esc_html($row->text_color); ?>">
                    <label>Alert box background color</label>
                    <input type="color" name="" class="box-bg-color" value="<?php echo esc_html($row->box_bg_color); ?>">
                    <div class="input-group">
                        <label>Select Icon</label>
      <input type="text" class="form-control icon-input" name="icon" value="<?php echo esc_html($row->icons); ?>">
      <div class="input-group-btn">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pick Icon<span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right icon-picker">
        <li>
            <div class="form-group">
                <input type="text" name="src" placeholder="Ara.." class="form-control filterbox">
            </div>
        </li>
        <br>    
        <hr>
        <ul class="icon-container"></ul>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
                </div>
                <div class="input-value">
                    <label>Change button name:</label>
                    <input type="text" name="btnname" class="btn-name" value="<?php echo esc_html($row->btn_name); ?>">
                    <label>Select Button text color:</label>
                    <input type="color" name="btncolor" class="btn-color" value="<?php echo esc_html($row->btn_color); ?>">
                    <label>Select Background Color</label>
                    <input type="color" name="bgcolor" class="bg-color" value="<?php echo esc_html($row->btn_bg_color); ?>">
                    <label>Enter URL</label>
                    <input type="text" name="link" class="pg-link" value="<?php echo esc_url($row->pg_link); ?>">
                </div>
                <div class="input-value">
                    <div class="pos-top-bottom">
                    	<label>Select Position:</label>
                    	<input type="radio" name="position" class="top1" value="top" >Top
                    	<input type="radio" name="position" class="bottom1" value="bottom">Bottom
                    </div>
                    <div class="pos-fix-relative">
                    	<label>Select Position:</label>
    	                <input type="radio" name="position2" class="fixed1" value="fixed" >Fixed
	                    <input type="radio" name="position2" class="relative1" value="relative">Relative
                    </div>
                    <div class="set-counter">
                    	<label>Set Countdown</label>
                    	<div class="set-time-value">
                    		<input type="date" name="" class="select-date">
                    	</div>
                    	<span class="pick-date">Ok</span>
                    </div>

                </div>
            
                <div style="clear: both;"></div>
                <div class="submit-btn">Submit</div>
            </div>


        </div>

        	<?php
    	}
    }
   
     
}


add_action('wp_ajax_updateNotification', 'webNotificationBarinsertData');

function webNotificationBarinsertData(){

	
	$getValue 		= sanitize_text_field( $_POST['getValue']);
	$boxFontSize 	= sanitize_text_field( $_POST['boxFontSize']);
	$boxFontColor 	= sanitize_text_field( $_POST['boxFontColor']);
	$box_bg_color 	= sanitize_text_field( $_POST['box_bg_color']);	
	$iconValue 		= sanitize_text_field( $_POST['iconValue']);
	$btnName 		= sanitize_text_field( $_POST['btnName']);
	$btnColor 		= sanitize_text_field( $_POST['btnColor']);
	$btn_bg_color 	= sanitize_text_field( $_POST['btn_bg_color']);
	$position 		= sanitize_text_field( $_POST['position']);
	$position_fixed = sanitize_text_field( $_POST['position_fixed']);
	$active_deactive	= sanitize_text_field( $_POST['active_deactive']);
	$pg_link 		= sanitize_text_field( $_POST['pg_link']);
	$countDownDate  = sanitize_text_field( $_POST['countDownDate']);
    $counterDisplay = sanitize_text_field( $_POST['counterDisplay']);




	
	global $wpdb;
	$db_table_name = $wpdb->prefix . 'web_notification_bar'; 

$wpdb->query($wpdb->prepare("UPDATE $db_table_name SET your_text='$getValue', font_size='$boxFontSize', text_color='$boxFontColor', box_bg_color='$box_bg_color' , icons='$iconValue' , btn_name='$btnName' , btn_color='$btnColor' , btn_bg_color='$btn_bg_color' , position_fix_relative='$position_fixed' , btn_position='$position', active_deactive='$active_deactive', pg_link='$pg_link' , countDownDate='$countDownDate' , counterDisplay= '$counterDisplay' WHERE id='1'"));


}

