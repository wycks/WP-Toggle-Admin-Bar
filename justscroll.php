<?php
/*
Plugin Name: Toggle Admin Bar
Plugin URI: http://www.wpsecure.net/
<<<<<<< HEAD
Description: Toggles the WordPress Admin Bar from view and saved toggle state
Author: Wycks
Author URI: http://wordpress.org/extend/plugins/profile/wycks
Version: 1.0.2
License: GPL2
*/


define( 'JUSTSCROLL_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );

// throw jQuery into the theme if it's not already there
function jts_add_jquery_tab(){
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-cookie', JUSTSCROLL_PLUGIN_PATH . 'jquery.cookie.min.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'jts_add_jquery_tab');
add_action('admin_enqueue_scripts', 'jts_add_jquery_tab');

// due to how the admin-bar.js is loaded we are gonna load it after in the same way
// also only show it if the actual admin bar is showing

add_action( 'admin_bar_menu', 'jts_slide_bar_tab', 1000 );
add_action('wp_footer', 'jts_slide_bar_tab', 1001);
add_action('admin_footer', 'jts_slide_bar_tab', 1001);

function jts_slide_bar_tab() {

  if (is_admin_bar_showing()) {
    
    global $wp_admin_bar;          
    $image = JUSTSCROLL_PLUGIN_PATH . 'slide-arrow.png'; 
    $wp_admin_bar->add_menu( array( 'id' => 'hide', 'title' => __( 'Hide Me', 'textdomain' ), 'href' => '#' ) );
?>

<div id='hello'><img src='<?php echo $image; ?>' /></div>

<script type="text/javascript">
jQuery(document).ready(function($) {

  if($.cookie('admin_toggle_cookie') == 'open') {
      $("#wpadminbar").show();
      $('#hello img').hide();  
      $('body').css('margin-top', '0px');
    };

  if($.cookie('admin_toggle_cookie') == 'closed') {
      $("#wpadminbar").hide();
      $("#hello img").show();
      $("#contextual-help-link-wrap").hide();  
      $('body').css('margin-top', '-30px');
    };    

  $('#wp-admin-bar-hide').click(function () { 
    $('#wpadminbar').slideUp();
    $("#hello img").show();
    $("#contextual-help-link-wrap").hide();  
    $('body').css('margin-top', '-30px');
    $.cookie('admin_toggle_cookie', 'closed', { expires: 7, path: '/'}); 
  });

  $('#hello img').click(function () {
    $('#wpadminbar').slideDown();
    $('#hello img').hide();  
    $('body').css('margin-top', '0px');
    $.cookie('admin_toggle_cookie', 'open', { expires: 7, path: '/'}); 
  });

});
</script>

<?php }; } 

add_action('wp_footer', 'jts_style_time');
add_action('admin_footer', 'jts_style_time');
function jts_style_time(){

  if (! is_admin()){ ?>
<style type="text/css">
#hello img{display: none;}
#hello{
position:absolute;
top:-5px;
right: 0;
cursor: pointer;
display: block;
border-right: 1px solid #CCC;
border-left: 1px solid #CCC;
border-bottom: 1px solid #CCC;
background: #E3E3E3;
background-image: -webkit-gradient(linear,left bottom,left top,from(#DFDFDF),to(#F1F1F1));
background-image: -webkit-linear-gradient(bottom,#DFDFDF,#F1F1F1);
background-image: -moz-linear-gradient(bottom,#DFDFDF,#F1F1F1);
background-image: -o-linear-gradient(bottom,#DFDFDF,#F1F1F1);
background-image: linear-gradient(to top,#DFDFDF,#F1F1F1);
}
</style>
<?php  
}else{ ?>
<style type="text/css">
#hello img{display: none;}
#hello{
position:absolute;
top:0;
right: 140px;
cursor: pointer;
display: block;
border-right: 1px solid #CCC;
border-left: 1px solid #CCC;
border-bottom: 1px solid #CCC;
background: #E3E3E3;
background-image: -webkit-gradient(linear,left bottom,left top,from(#DFDFDF),to(#F1F1F1));
background-image: -webkit-linear-gradient(bottom,#DFDFDF,#F1F1F1);
background-image: -moz-linear-gradient(bottom,#DFDFDF,#F1F1F1);
background-image: -o-linear-gradient(bottom,#DFDFDF,#F1F1F1);
background-image: linear-gradient(to top,#DFDFDF,#F1F1F1);
}
</style>
<?php }
}
?>
