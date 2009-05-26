<?php
include '../../../wp-blog-header.php'; 
require_once 'googleAPI.class.php';
require_once 'google_analytics.class.php';

$coolClassInstance = new FletcherPluginSeries();
$fletcher_Options = $coolClassInstance->getAdminOptions();

$my_gmail_username = $fletcher_Options['gmailUsername'];
$my_gmail_password = $fletcher_Options['gmailPassword'];
$my_gmail_profilename = $fletcher_Options['gmailProfileName'];
$my_show_Animation = $fletcher_Options['showAnimation'];

$my_now_date = date("Y-m-d");
$my_start_date = date("Y-m-d", strtotime("-14 days"));

$gapi = new googleAPI($my_gmail_username,$my_gmail_password,$my_gmail_profilename);
$reportData = $gapi->viewReport($my_start_date,$my_now_date,"ga:pageviews,ga:visits,ga:newVisits","ga:date");

$xml = '<?xml version="1.0" ?><chart>';
$xml .= '<chart_type>line</chart_type>';
$xml .= '<axis_category skip="1" size="10" color="FF0000" alpha="75" orientation="diagonal_down" />';
if($my_show_Animation == 'True'){
$xml .= '<chart_transition type="drop" delay="1" duration="2" order="series" />';
}
$xml .= '<chart_data>';
$xml .= '<row>';
$xml .= '<null/>';

$i=0;
while($i < count($reportData) -3 ) {
	$theDate = $reportData[$i]["ga:date"];
	$theMonth = substr($theDate,4,2);
	$theDay = substr($theDate,6,2);
	$xml .= '<string>' . $theMonth . '/' . $theDay . '</string>';
	$i++;
}

$xml .= '</row>';
if ($fletcher_Options['showPageViews'] == 'True'){
$xml .= '<row>';
$xml .= '<string>Page Views</string>';

$i=0;
while($i < count($reportData) -3 ) {
	$xml .= '<number tooltip="'. $reportData[$i]["ga:pageviews"] . '">' . $reportData[$i]["ga:pageviews"] . '</number>';
	$i++;
}

$xml .= '</row>';
}

if ($fletcher_Options['showVisits'] == 'True'){
$xml .= '<row>';
$xml .= '<string>Visits</string>';

$i=0;
while($i < count($reportData) -3 ) {
	$xml .= '<number tooltip="' . $reportData[$i]["ga:visits"] . '">' . $reportData[$i]["ga:visits"] . '</number>';
	$i++;
}

$xml .= '</row>';
}

if ($fletcher_Options['showNewVisits'] == 'True'){
$xml .= '<row>';
$xml .= '<string>New Visits</string>';

$i=0;
while($i < count($reportData) -3 ) {
	$xml .= '<number tooltip="' . $reportData[$i]["ga:newVisits"] . '">' . $reportData[$i]["ga:newVisits"] . '</number>';
	$i++;
}

$xml .= '</row>';
}

$xml .= '</chart_data>';
$xml .= '</chart>';

echo $xml;
?>