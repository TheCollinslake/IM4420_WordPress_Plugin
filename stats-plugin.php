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
    global $wpdb;
    
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
 $stat_table_name = $wpdb->base_prefix . "sp_stats";
    
    $sql_query = "SELECT entry_time, stat_text
                    FROM $stat_table_name;";
    
    $sp_chat_rows = $wpdb->get_results($sql_query);
    foreach ($sp_chat_rows as $rp_row)
    {
        echo $sp_row->entry_time . ":" .
        htmlspecialchars($sp_row->stat_text);
    }
}
		 
function sp_shortcode() {
    ob_start();
	
    html_code();

    return ob_get_clean();
}

add_shortcode( 'wp_stats', 'sp_shortcode' );

/**
 * Database setup. Hooks MUST be defined in this file but it's starting to get pretty big
 * so let's move our implementation to a separate file (chat-plugin-db-setup.php).
 */
require_once (dirname(__FILE__) . '/stats-plugin-db-setup.php');
register_activation_hook( __FILE__, 'sp_install' ); // Called when our plugin is activated
register_activation_hook( __FILE__, 'sp_install_data' ); // Called when our plugin is activated


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
