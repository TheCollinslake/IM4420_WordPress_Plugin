<?php
/* 
Plugin Name: WP Stats Plugin
Plugin URI: http://example.com
Description: Plugin that displays some stats
Version: 1.0
Author: Caleb Collins
Author: URI: http://example.com
*/

function html_code() {
    $result = count_users()
    echo 'There are' , $rusult['total_users'], 'total users';
    foreach($result['avail_roles'] ar $role => $count)
        echo ',', $count, 'are', $role, 's';
    echo '.';
    //echo more fun stats
}

function sp_shortcode() {
    ob_start();
    
    html_code();
    
    return ob_get_clean();
}

add_shortcode('wp_stats','sp_shortcode');


?>
