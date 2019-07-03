<?php

/*

About:
This page can be inserted into the /pages/ directory of your YOURLS installation to create a public page at http://[domain], if the required index.php page is also in your document root.
The page creates a very basic linked table of your 1000 most recent shortlinks.
This is intended to give a basic framework for having a public listing of your links, with the title as clickable text. 
This may be useful when you don't want to load something as bulky as the admin interface but want to quickly browse or ctrl+f through your shortened links, or you can't login.
Each link is linked to the page so you can double-check that you really have the correct link.
This code limits to 1000 links. To increase or decrease that number, change the $numlinks variable at the bottom of the code from 1000.
Please fork and improve as desired! I made this intentionally basic for my own use.

Creator: Ruth Kitchin Tillman
Site: http://ruthtillman.com
Github: https://github.com/ruthtillman/YOURLS
Version: 1.0

Edited by: nina de jesus
Site: http://satifice.com

*/

echo '<h2>A basic list of my links</h2>';

function list_links_table($numlinks) {

global $ydb;
 $table_url = YOURLS_DB_TABLE_URL;

$query = $ydb->get_results("SELECT url, keyword, title, timestamp FROM `$table_url` order by timestamp desc limit $numlinks");
if ($query) {
	echo '<table><thead><tr><th>Keyword</th><th>URL</th></tr></thead>';

	foreach( $query as $query_result ) {
		echo '<tr><td>';
		echo $query_result->keyword;
		echo '</td><td>';
		echo '<a href="' . $query_result->url . '">'. $query_result->title . '</a>';
		echo '</td></tr>';
	}
	echo '</table>';
}
}

list_links_table(1000); // change from 1000 to whatever number of links you desire

?>
