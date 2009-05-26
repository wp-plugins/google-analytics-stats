<?php
if (!class_exists("FletcherPluginSeries")) {
	class FletcherPluginSeries {
		var $adminOptionsName = "FletcherPluginSeriesAdminOptions";
		function FletcherPluginSeries() { //constructor
			
		}
		function init() {
			$this->getAdminOptions();
		}
		//Returns an array of admin options
		function getAdminOptions() {
			$fletcherAdminOptions = array('gmailUsername' => 'Your GMail Username',
				'gmailPassword' => 'Your GMail Password', 
				'gmailProfileName' => 'Your Google Analytics Profile Name',
				'showAnimation' => 'True',
				'showPageViews' => 'True',
				'showVisits' => 'True',
				'showNewVisits' => 'True',
				'showSearchTerms' => 'True',
				'showReferrers' => 'True');
			$fletcher_gas_Options = get_option($this->adminOptionsName);
			if (!empty($fletcher_gas_Options)) {
				foreach ($fletcher_gas_Options as $key => $option)
					$fletcherAdminOptions[$key] = $option;
			}				
			update_option($this->adminOptionsName, $fletcherAdminOptions);
			return $fletcherAdminOptions;
		}
		
		function addHeaderCode() {
			$fletcher_gas_Options = $this->getAdminOptions();
			if ($fletcher_gas_Options['show_header'] == "false") { return; }
			?>
<!-- Fletcher Was Here -->
			<?php
		
		}
		function addContent($content = '') {
			$fletcher_gas_Options = $this->getAdminOptions();
			if ($fletcher_gas_Options['add_content'] == "true") {
				$content .= $fletcher_gas_Options['content'];
			}
			return $content;
		}
		function authorUpperCase($author = '') {
			$fletcher_gas_Options = $this->getAdminOptions();
			if ($fletcher_gas_Options['comment_author'] == "true") {
				$author = strtoupper($author);
			}
			return $author;
		}
		//Prints out the admin page
		function printAdminPage() {
					$fletcher_gas_Options = $this->getAdminOptions();
										
					if (isset($_POST['update_FletcherPluginSeriesSettings'])) { 
						if (isset($_POST['fletcher_gas_username'])) {
							$fletcher_gas_Options['gmailUsername'] = $_POST['fletcher_gas_username'];
						}	
						if (isset($_POST['fletcher_gas_password'])) {
							$fletcher_gas_Options['gmailPassword'] = $_POST['fletcher_gas_password'];
						}	
						if (isset($_POST['fletcher_gas_profilename'])) {
							$fletcher_gas_Options['gmailProfileName'] = $_POST['fletcher_gas_profilename'];
						}
						
						$fletcher_gas_Options['showAnimation'] = $_POST['fletcher_gas_showAnimation'];
						$fletcher_gas_Options['showPageViews'] = $_POST['fletcher_gas_showPageViews'];
						$fletcher_gas_Options['showVisits'] = $_POST['fletcher_gas_showVisits'];
						$fletcher_gas_Options['showNewVisits'] = $_POST['fletcher_gas_showNewVisits'];
						
							
						update_option($this->adminOptionsName, $fletcher_gas_Options);
						
						?>
<div class="updated"><p><strong><?php _e("Settings Updated.", "FletcherPluginSeries");?></strong></p></div>
					<?php
					} ?>
<div class=wrap>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h2>Google Analytics Stats Admin</h2>
<br>
Google Analytics Stats is brought to you for free by <a href="http://chris-fletcher.com">Chris Fletcher</a>. Visit my website to find more great plugins, and don't hesitate to ask me to develop your next big WordPress plugin idea. Help keep the plugins free You can send me a donation here <a href="http://chris-fletcher.com/plug-ins/google-analytics-stats/">Google Analytics Stats</a>
<h3>GMail Username:</h3>
<p>
    <input type="text" name="fletcher_gas_username" style="width: 80%;" id="fletcher_gas_username" value="<?php _e(apply_filters('format_to_edit',$fletcher_gas_Options['gmailUsername']), 'FletcherPluginSeries') ?>" />
</p>
<h3>GMail Password:</h3>
<p>
    <input type="text" name="fletcher_gas_password" style="width: 80%;" id="fletcher_gas_password" value="<?php _e(apply_filters('format_to_edit', $fletcher_gas_Options['gmailPassword']), 'FletcherPluginSeries') ?>" />
</p>
<h3>Profile Name:</h3>
<p>
    <input type="text" name="fletcher_gas_profilename" style="width: 80%;" id="fletcher_gas_profilename" value="<?php _e(apply_filters(' format_to_edit', $fletcher_gas_Options['gmailProfileName']), 'FletcherPluginSeries') ?>" />
</p>
<br>
<hr>
<h2>Other Options:</h2>
<p>
<h3>Chart Behavior:</h3>
<p>
	<?php if ($fletcher_gas_Options['showAnimation'] == 'True'){?>
	<input type="checkbox" name="fletcher_gas_showAnimation" id="fletcher_gas_showAnimation" value="True" checked /><label for="fletcher_gas_showAnimation"> <b>Show Graph Animation:</b> Choosing this option will show the linegraph's bouncing in.</label>
	<?php }else{?>
	<input type="checkbox" name="fletcher_gas_showAnimation" id="fletcher_gas_showAnimation" value="True" /><label for="fletcher_gas_showAnimation"> <b>Show Graph Animation:</b> Choosing this option will show the linegraph's bouncing in.</label>
	<?php }?>
<p>
<br>
<h3>Metrics to Show:</h3>
<p>
	<?php if ($fletcher_gas_Options['showPageViews'] == 'True'){?>
	<input type="checkbox" name="fletcher_gas_showPageViews" id="fletcher_gas_showPageViews" value="True" checked /><label for="fletcher_gas_showPageViews"> <b>Show Page Views:</b> Adds a line graph to your chart to show the total number of pageviews for your site.</label><br>
	<?php }else{?>
	<input type="checkbox" name="fletcher_gas_showPageViews" id="fletcher_gas_showPageViews" value="True" /><label for="fletcher_gas_showPageViews"> <b>Show Page Views:</b> Adds a line graph to your chart to show the total number of pageviews for your site.</label><br>
	<?php }?>
	<br>
	
	<?php if ($fletcher_gas_Options['showVisits'] == 'True'){?>
	<input type="checkbox" name="fletcher_gas_showVisits" id="fletcher_gas_showVisits" value="True" checked /><label for="fletcher_gas_showVisits"> <b>Show Visits:</b> Adds a line graph to your chart to show the total number of Visits.</label><br>
	<?php }else{?>
	<input type="checkbox" name="fletcher_gas_showVisits" id="fletcher_gas_showVisits" value="True" /><label for="fletcher_gas_showVisits"> <b>Show Visits:</b> Adds a line graph to your chart to show the total number of Visits.</label><br>
	<?php }?>
	<br>
	
	<?php if ($fletcher_gas_Options['showNewVisits'] == 'True'){?>
	<input type="checkbox" name="fletcher_gas_showNewVisits" id="fletcher_gas_showNewVisits" value="True" checked /><label for="fletcher_gas_showNewVisits"> <b>Show New Visits:</b> Adds a line graph to your chart to show the number of visitors whose visit to your site was marked as a first-time visit.</label><br>
	<?php }else{?>
	<input type="checkbox" name="fletcher_gas_showNewVisits" id="fletcher_gas_showNewVisits" value="True" /><label for="fletcher_gas_showNewVisits"> <b>Show New Visits:</b> Adds a line graph to your chart to show the number of visitors whose visit to your site was marked as a first-time visit.</label><br>
	<?php }?>
	<br>
</p>

<div class="submit">
  <input type="submit" name="update_FletcherPluginSeriesSettings" value="<?php _e('Update Settings', 'FletcherPluginSeries') ?>" /></div>
</form>
</div>
					<?php
				}//End function printAdminPage()
	
	}

} //End Class FletcherPluginSeries
?>