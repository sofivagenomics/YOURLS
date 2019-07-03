<?php

/*

About:
This page can be inserted into the /pages/ directory of your YOURLS installation to create a public page at http://[domain]/linklist. 
The page creates a very basic linked table of your 1000 most recent shortlinks on the YOURLS page background.
This may be useful when you don't want to load something as bulky as the admin interface but want to quickly browse or ctrl+f through your shortened links, or you can't login.
Each link is linked to the page so you can double-check that you really have the correct link.
This code limits to 1000 links. To increase or decrease that number, change the $numlinks variable at the bottom of the code from 1000.
Please fork and improve as desired! I made this intentionally basic for my own use.

Creator: Ruth Kitchin Tillman
Site: http://ruthtillman.com
Github: https://github.com/ruthtillman/YOURLS
Version: 1.0

*/

// Make sure we're in YOURLS context
if( !defined( 'YOURLS_ABSPATH' ) ) {
	// Attempt to guess URL via YOURLS
	$url = 'http://' . $_SERVER['HTTP_HOST'] . str_replace( array( '/pages/', '.php' ) , array ( '/', '' ), $_SERVER['REQUEST_URI'] );
	echo "Try this instead: <a href='$url'>$url</a>";
	die();
}

// Display page content. Any PHP, HTML and YOURLS function can go here.
$url = YOURLS_SITE . '/linkslist';

yourls_html_head( 'linkslist', 'Basic List of Links' );

// Start YOURLS engine
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/load-yourls.php' ;

 echo '<h2>A basic list of my links</h2>';

function list_links_table($numlinks) {

global $ydb;
 $table_url = YOURLS_DB_TABLE_URL;

$query = $ydb->get_results("SELECT url, keyword, timestamp FROM `$table_url` order by timestamp desc limit $numlinks");
if ($query) {
	//echo '<table><thead><tr><th>Keyword</th><th>URL</th></tr></thead>';
	echo '<table><thead><tr><th>ShortLink</th><th>URL</th></tr></thead>';

	//foreach( $query as $query_result ) {
	//	echo '<tr><td>';
	//	echo $query_result->keyword;
	//	echo '</td><td>';
	//	echo '<a href="' . $query_result->url . '">'. $query_result->url . '</a>';
	//	echo '</td></tr>';
	//}
    
	foreach( $query as $query_result ) {
		echo '<tr><td>';
        echo YOURLS_SITE;
        echo '/';
		echo $query_result->keyword;
		echo '</td><td>';
		echo $query_result->url;
		echo '</td></tr>';
	}
	echo '</table>';
}
}

list_links_table(1000); // change from 1000 to whatever number of links you desire
yourls_html_footer();

?>
