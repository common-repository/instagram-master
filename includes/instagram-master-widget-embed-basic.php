<?php
//Hook Widget
add_action( 'widgets_init', 'instagram_master_widget_embed_basic' );
//Register Widget
function instagram_master_widget_embed_basic() {
register_widget( 'instagram_master_widget_embed_basic' );
}
add_action( 'wp_enqueue_scripts', 'instagram_master_wbecss' );
//load css for shortcode
function instagram_master_wbecss() {
if ( is_active_widget( false, false, 'instagram_master_widget_embed_basic', true ) ) {
	wp_register_script( 'instagram_master_wbecss', 'https://www.instagram.com/embed.js' );
	wp_enqueue_script( 'instagram_master_wbecss' );
}
}

class instagram_master_widget_embed_basic extends WP_Widget {
	function __construct(){
	$widget_ops = array( 'classname' => 'Instagram Master Basic Responsive Embed', 'description' => __('Instagram Basic Responsive Embed Widget is light fast loading widget to manually display an Instagram video or image.', 'instagram_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'instagram_master_widget_embed_basic' );
	parent::__construct( 'instagram_master_widget_embed_basic', __('Instagram Basic Responsive Embed', 'instagram_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$instagram_title = isset( $instance['instagram_title'] ) ? $instance['instagram_title'] :false;
		$instagram_title_new = isset( $instance['instagram_title_new'] ) ? $instance['instagram_title_new'] :false;
		$show_instagram_embed_bas = isset( $instance['show_instagram_embed_bas'] ) ? $instance['show_instagram_embed_bas'] :false;
		$instagram_embed_bas_link = $instance['instagram_embed_bas_link'];
		echo $before_widget;
		
		// Display the widget title
		if ( $instagram_title ){
			if (empty($instagram_title_new)){
				$instagram_title_new = constant('INSTAGRAM_MASTER_NAME');
				echo $before_title . $instagram_title_new . $after_title;
			}
			else{
				echo $before_title . $instagram_title_new . $after_title;
			}
		}
		else{
		}
		//Display Instagram Photos
		if ( $show_instagram_embed_bas ){
			if(empty($instagram_embed_bas_link)){
				$instagram_embed_bas_link = 'https://instagram.com/p/n9bpTRIhA9/';
			}
			echo '<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="'.$instagram_embed_bas_link.'" data-instgrm-version="8" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:2400px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
				</blockquote>';
		}
		else {
		}
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['instagram_title'] = strip_tags( $new_instance['instagram_title'] );
		$instance['instagram_title_new'] = $new_instance['instagram_title_new'];
		$instance['show_instagram_embed_bas'] = $new_instance['show_instagram_embed_bas'];
		$instance['instagram_embed_bas_link'] = $new_instance['instagram_embed_bas_link'];
		return $instance;
	}
	function form( $instance ) {
	$plugin_master_name = constant('INSTAGRAM_MASTER_NAME');
	//Set up some default widget settings.
	$defaults = array( 'instagram_title_new' => __('Instagram Master', 'instagram_master'), 'instagram_title' => true, 'instagram_title_new' => false, 'show_instagram_embed_bas' => false, 'instagram_embed_bas_link' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['instagram_title'], true ); ?> id="<?php echo $this->get_field_id( 'instagram_title' ); ?>" name="<?php echo $this->get_field_name( 'instagram_title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'instagram_title' ); ?>"><b><?php _e('Display Widget Title', 'instagram_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'instagram_title_new' ); ?>"><?php _e('Change Title:', 'instagram_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'instagram_title_new' ); ?>" name="<?php echo $this->get_field_name( 'instagram_title_new' ); ?>" value="<?php echo $instance['instagram_title_new']; ?>" style="width:auto;" />
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_instagram_embed_bas'], true ); ?> id="<?php echo $this->get_field_id( 'show_instagram_embed_bas' ); ?>" name="<?php echo $this->get_field_name( 'show_instagram_embed_bas' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_instagram_embed_bas' ); ?>"><b><?php _e('Activate Instagram Embed', 'instagram_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'instagram_embed_bas_link' ); ?>"><b><?php _e('Instagram Manual Embed:', 'instagram_master'); ?></b></label></br>
	<input id="<?php echo $this->get_field_id( 'instagram_embed_bas_link' ); ?>" name="<?php echo $this->get_field_name( 'instagram_embed_bas_link' ); ?>" value="<?php echo $instance['instagram_embed_bas_link']; ?>" style="width:auto;" />
	</p>
	<div class="description">Navigate to any Instagram photo or image page.</div>
	<div class="description">Copy the browser link and paste it above.</div>
	<div class="description">Example:</div>
	<div class="description">https://instagram.com/p/n9bpTRIhA9/</div>
	<br>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<b><?php echo $plugin_master_name; ?> Website</b>
	</p>
	<p><a class="button-secondary" href="https://wordpress.techgasp.com/instagram-master/" target="_blank" title="<?php echo $plugin_master_name; ?> Info Page">Info Page</a> <a class="button-secondary" href="https://wordpress.techgasp.com/instagram-master-documentation/" target="_blank" title="<?php echo $plugin_master_name; ?> Documentation">Documentation</a> <a class="button-primary" href="https://wordpress.techgasp.com/instagram-master/" target="_blank" title="Visit Website">Get Add-ons</a></p>
	<?php
	}
 }
?>
