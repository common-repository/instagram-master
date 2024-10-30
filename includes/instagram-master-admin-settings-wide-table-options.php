<?php
if(!class_exists('WP_List_Table')){
	require_once( get_home_path() . 'wp-admin/includes/class-wp-list-table.php' );
}
class instagram_master_admin_settings_wide_table_options extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
	global $wpdb, $blog_id;
//Set Activate TechGasp Instagram System and ON
if(is_multisite()){
	add_blog_option($blog_id, 'instagram_master_system_wide', "true");
}
else{
	add_option('instagram_master_system_wide', "true");
}
//Save Options
if (isset($_POST['update_system_wide'])){
	if(is_multisite()){
		if (isset($_POST['instagram_master_system_wide'])){
			update_blog_option($blog_id, 'instagram_master_system_wide', $_POST['instagram_master_system_wide'] );
		}
		else{
			update_blog_option($blog_id, 'instagram_master_system_wide', 'false' );
		}
		if (isset($_POST['instagram_master_system_wide_username'])){
			update_blog_option($blog_id, 'instagram_master_system_wide_username', $_POST['instagram_master_system_wide_username'] );
		}
		else{
			update_blog_option($blog_id, 'instagram_master_system_wide_username', '' );
		}
	}
	else{
		if (isset($_POST['instagram_master_system_wide'])){
			update_option('instagram_master_system_wide', $_POST['instagram_master_system_wide'] );
		}
		else{
			update_option('instagram_master_system_wide', 'false' );
		}
		if (isset($_POST['instagram_master_system_wide_username'])){
			update_option('instagram_master_system_wide_username', $_POST['instagram_master_system_wide_username'] );
		}
		else{
			update_option('instagram_master_system_wide_username', '' );
		}
	}

?>
<div id="message" class="updated fade">
<p><strong><?php _e('Settings Saved!', 'instagram_master'); ?></strong></p>
</div>
<?php
}
//nothing to post
else{}

//Lets get data from single and multi to populate the form
if(is_multisite()){
	$instagram_master_system_wide = get_blog_option($blog_id, 'instagram_master_system_wide');
	$instagram_master_system_wide_username = get_blog_option($blog_id, 'instagram_master_system_wide_username');
}
else{
	$instagram_master_system_wide = get_option('instagram_master_system_wide');
	$instagram_master_system_wide_username = get_option('instagram_master_system_wide_username');
}

?>
<form method="post" width='1'>
<fieldset class="options">

<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="3"><h2><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;System Wide Settings', 'instagram_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th colspan="3"></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<th><input name="instagram_master_system_wide" id="instagram_master_system_wide" value="true" type="checkbox" <?php echo $instagram_master_system_wide == 'true' ? 'checked="checked"':''; ?> /></th>
			<td><label for="instagram_master_system_wide"><b><?php _e('Activate TechGasp Instagram System', 'instagram_master'); ?></b></label></td>
			<td style="vertical-align:middle">Default is <b>On</b>, if off no shortcodes or widgets will be loaded.</td>
		</tr>
		<tr>
			<th></th>
			<td><label for="instagram_master_system_wide_username"><?php _e('insert Instagram Username:', 'instagram_master'); ?></label></td>
			<td style="vertical-align:middle"><input id="instagram_master_system_wide_username" name="instagram_master_system_wide_username" type="text" size="22" value="<?php echo $instagram_master_system_wide_username; ?>"></td>
		</tr>
	</tbody>
</table>
<p class="submit"><input class='button-primary' type='submit' name='update_system_wide' value='<?php _e("Save Settings", 'instagram_master'); ?>' id='submitbutton' /></p>
</fieldset>
</form>
<?php
	}
//CLASS ENDS
}
