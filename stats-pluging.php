<?php
/*
Plugin Name: WP Stats Plugin
Plugin URI: http://example.com
Description: Plugin that displays some stats
Version: 1.0
Author: Caleb Collins
Author URI: http;//example.com
*/

function html_code() {
    $result = count_users();
    echo 'There are ', $result['total_users'], ' total users';
    foreach($result['avail_roles'] as $role => $count)
        echo ', ', $count, ' are ', $role, 's';
    echo '.';
    
    echo "<br>";
    
    $total_posts = wp_count_posts();
    $posts_count = $total_posts->publish;

    echo "total posts: " . $posts_count;
    
    // echo more fun stats
}
		 
function sp_shortcode() {
    ob_start();
	
    html_code();

    return ob_get_clean();
}

add_shortcode( 'wp_stats', 'sp_shortcode' );

/**
 * Admin page setup.
 */
function wpdocs_register_cp_custom_menu_page() {
    add_menu_page(
        __( 'Stats Plugin', 'textdomain' ),
        'Stats Options',
        'manage_options',
        'stats_plugin/admin-options.php',
        '',
        plugins_url( 'chat-plugin/images/icon.png' ),
        6
    );
}

add_action( 'admin_menu', 'wpdocs_register_cp_custom_menu_page' );
?>
