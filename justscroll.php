<?php
/*
Plugin Name: Toggle Admin Bar
Plugin URI: http://www.wpsecure.net/
<<<<<<< HEAD
Description: Toggles the WordPress Admin Bar from view and saved toggle state
Author: Wycks
Author URI: http://wordpress.org/extend/plugins/profile/wycks
Version: 1.1
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



=======
Description: Toggles the WordPress Admin Bar from view
Author: Wycks
Author URI: http://wordpress.org/extend/plugins/profile/wycks
Version: 1.0.1
License: GPL2
*/
//
// TODO make the body scroll up maybe so there is no space?



// throw jquery into the theme if it's not already there
function admin_add_jquery_tab(){

         wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'admin_add_jquery_tab');



// due to how the admin-bar.js is loaded we are gonna load it after in the same way
// also only show it if the actual admin bar is showing duh


add_action('wp_footer', 'admin_slide_bar_tab', 1001);
add_action('admin_footer', 'admin_slide_bar_tab', 1001);
function admin_slide_bar_tab() {

          if (is_admin_bar_showing()) {
              
           $image = plugins_url('toggle-admin-bar/slide-arrow.png'); 

?>

<script type="text/javascript">

    
   jQuery("<div id='hide'><li>Hide Me</li></div>").appendTo("#wpadminbar");
     jQuery("<div id='hello'><img src='<?php echo $image; ?>' /></div>").appendTo("body");
    
    
      jQuery("#hide").click(function () {
      
         jQuery("#wpadminbar").slideUp();
         
     
         jQuery("#hello").click(function () {
      
         jQuery("#wpadminbar").slideDown();
      
      
         });
      
     });
    
</script>
<style type="text/css">
    #hello{position:absolute;top:0;cursor: pointer;left: 90%;}
    #hello img{text-align: center;position: fixed;box-shadow: 1px 0px 10px #888;padding-bottom: 2px;}
    #hide li {border-left: 1px solid #333;list-style: none;padding-left: 10px;padding-right: 10px;}
    #hide  li:hover{background-color: #3E3E3E;}
    #hide{font:normal 13px/28px Arial,Helvetica,sans-serif;;float:left;cursor: pointer;margin-left: 5px;}
</style>

<?php

};
}
?>
>>>>>>> 8da7b38be0dd1ff647bdebd9891b1188ad124bd0
