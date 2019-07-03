<?php
/*
Plugin Name: List Links
Plugin URI: https://github.com/ruthtillman/YOURLS/blob/master/list-links/plugin.php
Description: Shows an admin page that just lists your 1000 most recent links for quick viewing
Version: 1.0
Author: Ruth Kitchin Tillman
Author URI: http://ruthtillman.com
*/


// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

yourls_add_action( 'plugins_loaded', 'listlinks_add_page' );
function listlinks_add_page() {
        yourls_register_plugin_page( 'list_links', 'Basic Link List', 'listlinks_do_page' );
}
// Display popular links
function listlinks_do_page() {
        $nonce = yourls_create_nonce('list_links');
        echo '<h2>A basic list of my links</h2>';
        
listlinks_table(1000); // change from 1000 to whatever number of links you desire
}

function listlinks_table($numlinks) {

global $ydb;
 $table_url = YOURLS_DB_TABLE_URL;

$query = $ydb->get_results("SELECT url, keyword, timestamp FROM `$table_url` order by timestamp desc limit $numlinks");
if ($query) {
	echo '<table><thead><tr><th>Keyword</th><th>URL</th></tr></thead>';

	foreach( $query as $query_result ) {
		echo '<tr><td>';
		echo $query_result->keyword;
		echo '</td><td>';
		echo '<a href="' . $query_result->url . '">'. $query_result->url . '</a>';
		echo '</td></tr>';
	}
	echo '</table>';
}
}
