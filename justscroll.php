<?php
/*
Plugin Name: Toggle Admin Bar
Plugin URI: http://www.wpsecure.net/
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
