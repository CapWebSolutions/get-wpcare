<?php
/**
 * Plugin Name: Get WPcare
 * Plugin URI: https://github.com/CapWebSolutions/get-wpcare
 * Description: Adds a clickable link in the admin bar enabling user to request Wpcare support.
 * Version: 1.0.0
 * Author: Cap Web Solutions
 * Author URI: https://capwebsolutions.com
 *
 * @package Get_WPcare
 * @version 1.0.0
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

function get_wpcare_link() {
	/** These are the various WPcare maintenance request links */
	$requests = '<a href="https://capwebsolutions.com/request-support/?from_site=' . get_site_url() . '" target="_blank">Submit WPcare Maintenance Request</a>
<a href="https://capwebsolutions.freshdesk.com/support/tickets/new" target="_blank">Need a Tiny-Task</a> 
';

	// Here we split it into lines
	$requests = explode( "\n", $requests );

	// And then randomly choose a line
	return wptexturize( $requests[ mt_rand( 0, count( $requests ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_wpcare_requests() {
	$chosen = get_wpcare_link();
	echo "<p id='wpcare'>$chosen</p>"; 
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_wpcare_requests' );

// We need some CSS to position the paragraph
add_action( 'admin_head', 'wpcare_css' );
function wpcare_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#wpcare {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}


?>
