<?php
/*
Plugin Name: Page Screenshot Print
Description: Adds a print button to a page/post with the shortcode [page-screenshot-print].
Version: 1.0
Author: Julian Muslia
*/

function page_screenshot_print_button() {

  ?>
  <button id="page-screenshot-print-button">
    <i class="fa fa-print" aria-hidden="true"></i> Print
  </button>
  <?php
  
 // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js');
  wp_enqueue_script('polyfill', plugin_dir_url( __FILE__ ) . 'js/polyfill.min.js');
  wp_enqueue_script('html2canvas', plugin_dir_url( __FILE__ ) . 'js/html2canvas.min.js');
  ?>
  <script>
    (function($) {
      $(document).ready(function() {
        $("#page-screenshot-print-button").click(function() {
          html2canvas(document.body, { 
            // logging: true, // e nevojshme per debugging 
            // allowTaint: true, 
            useCORS: true 
          }).then(function(canvas) {
            var img = canvas.toDataURL("image/png");
           var newWindow = window.open("", "Print Window", "height=400,width=600"); 
            
           newWindow.document.write("<html><head><title>Print Page</title></head><body id='print_it'><img src='" + img + "' style='width:100%' /></body></html>");
           newWindow.focus();
           newWindow.onload = function() {
           newWindow.print();
          }
        });
          setTimeout(function(){
   window.location.reload();
}, 5000);
        });
      });
    })(jQuery);
  </script>
  
  <?php
}

add_shortcode('page-screenshot-print', 'page_screenshot_print_button');
