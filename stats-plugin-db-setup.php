<?php

global $sp_db_version;
$sp_db_version = '1.0';

function sp_install_data() {
	global $wpdb;
	
	$user_id = 1;
	$stat_text = '2% of people have green eyes.';
	
	$table_name = $wpdb->prefix . 'sp_stats';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'user_id' => $user_id, 
			'stat_text' => $stat_text
		) 
	);
}

function sp_install() {
	global $wpdb;
	global $sp_db_version;

	$table_name = $wpdb->prefix . 'sp_stats';
	$charset_collate = $wpdb->get_charset_collate();
    $installed_ver = get_option( "sp_db_version" );

  if ( $installed_ver != $sp_db_version ) {
    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      user_id mediumint(9) NOT NULL,
      stat_text text NOT NULL,
      entry_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      UNIQUE KEY id (id)
    );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    update_option( 'sp_db_version', $sp_db_version );
  }
}
?>