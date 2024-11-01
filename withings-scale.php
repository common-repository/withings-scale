<?php
/*
Plugin Name: Withings-Scale
Plugin URI: http://sandro.knot.org/blog/wordpress-plugin-withings-scale
Description: A widget incorporating a Withings Scale dashboard. You need to allow 270x410px for the widget.
Version: 0.2
Author: Sandro Fouche
Author URI: http://sandro.knot.org/blog
*/

add_action("widgets_init", array('withings_scale', 'register'));

class withings_scale {

  function control(){
   	$withingsData = get_option('withings-scale');  ?>

	<p>Withings Scale
	<p><label>title:<br/> <input name="title"
	type="text" value="<?php echo $withingsData['withings-title']; ?>" /></label></p>
	<p><label>UserID:<br/> <input name="userid"
	type="text" value="<?php echo $withingsData['withings-userid']; ?>" /></label></p>
	<p><label>Public Key:<br/><input name="publickey"
  	 type="text" value="<?php echo $withingsData['withings-publickey']; ?>" /></label></p>
  <?php
	if (isset($_POST['userid'])){
	   $withingsData['withings-title'] = attribute_escape($_POST['title']);
	   $withingsData['withings-userid'] = attribute_escape($_POST['userid']);
	   $withingsData['withings-publickey'] = attribute_escape($_POST['publickey']);
	   update_option('withings-scale', $withingsData);
        }
  }  

  function widget($args){
    $withingsData = get_option('withings-scale');

    echo $args['before_widget'];
    echo $args['before_title'] . $withingsData['withings-title'] . $args['after_title'];
    echo '<iframe src="http://www.withings.com/en/utils/graphwidget?userid=' . $withingsData['withings-userid'] . '&publickey=' . $withingsData['withings-publickey'] . '&massUnit=kg" width="270" height="410" scrolling="no" style="border: 0;" ></iframe>';
    echo $args['after_widget'];
  }

  function register(){
    register_sidebar_widget('Withings Scale', array('withings_scale', 'widget'));
    register_widget_control('Withings Scale', array('withings_scale', 'control'));
  }

}

?>
