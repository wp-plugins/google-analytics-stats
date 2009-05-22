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
				'gmailProfileName' => 'Your Google Analytics Profile Name');
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
						update_option($this->adminOptionsName, $fletcher_gas_Options);
						
						?>
<div class="updated"><p><strong><?php _e("Settings Updated.", "FletcherPluginSeries");?></strong></p></div>
					<?php
					} ?>
<div class=wrap>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h2>Google Analytics Stats Admin</h2>
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