<?php
/*
Plugin Name: Google Analytics Stats
Plugin URI: http://chris-fletcher.com/plug-ins/google-analytics-stats/
Description: Shows a graph on the Dashboard page, with 3 Google Analytics metrics: Page Views, Visits, New Visits in 3 different colors. All you have to do
			 is put in your gmail username and password and the profile name of the metrics you want to display.

			 New in Version 1.1 - You can now turn on and off any one of the 3 metrics being displayed in your chart and you can also turn the animation on or off.
Author: Chris Fletcher
Version: 1.1
Author URI: http://chris-fletcher.com
*/

require_once 'google_analytics.class.php';

if (class_exists("FletcherPluginSeries")) {
	$dl_pluginSeries = new FletcherPluginSeries();
}

//Initialize the admin panel
if (!function_exists("FletcherPluginSeries_ap")) {
	function FletcherPluginSeries_ap() {
		global $dl_pluginSeries;
		if (!isset($dl_pluginSeries)) {
			return;
		}
		if (function_exists('add_options_page')) {
	add_options_page('Google Analytics Stats', 'Google Analytics Stats', 9, basename(__FILE__), array(&$dl_pluginSeries, 'printAdminPage'));
		}
	}	
}

//Actions and Filters	
if (isset($dl_pluginSeries)) {
	//Actions
	add_action('admin_menu', 'FletcherPluginSeries_ap');
}



function gpr_wp_dashboard_test() {
	
$ccInstance = new FletcherPluginSeries();
$fletcher_Options1 = $ccInstance->getAdminOptions();

$my_gmail_profilename = $fletcher_Options1['gmailProfileName'];

echo '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"width="400" height="250" id="ie_chart_2" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="' . get_settings('siteurl') .'/wp-content/plugins/google-analytics-stats/charts.swf?width=400&height=250&library_path=' . get_settings('siteurl') .'/wp-content/plugins/google-analytics-stats/charts_library&xml_source='. get_settings('siteurl') .'/wp-content/plugins/google-analytics-stats/xml_data.php"/>
<param name="quality" value="high" />
<param name="bgcolor" value="#FFFFFF" />
<embed src="' . get_settings('siteurl') .'/wp-content/plugins/google-analytics-stats/charts.swf" FlashVars="library_path='. get_settings('siteurl') .'/wp-content/plugins/google-analytics-stats/charts_library&xml_source=' . get_settings('siteurl') .'/wp-content/plugins/google-analytics-stats/xml_data.php" quality="high" bgcolor="#FFFFFF" width="400" height="250" align="middle" allowScriptAccess="sameDomain" 
type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" id="chart_2"/>
</object>';

}
$gas_widget_id = "gpr_wp_dashboard_test";
$gas_widget_name = "Google Analytics Stats - " . $my_gmail_profilename;
$gas_callback = "gpr_wp_dashboard_test";

function gpr_wp_dashboard_setup() {
	wp_add_dashboard_widget( 'gpr_wp_dashboard_test', __( 'Google Analytics Stats' ),'gpr_wp_dashboard_test');
}
add_action('wp_dashboard_setup', 'gpr_wp_dashboard_setup');

?>