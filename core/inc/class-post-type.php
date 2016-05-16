<?php
/**
 * Rsimple Custom Post Type
 */

class rsimple_posttype{

  /**
   * Create new custom post type
   * @param  string  $postName
   * @param  string  $label
   * @param  bolean $capability
   * @param  array  $override
   * @return random
   */
  public function publish( $postName = null, $label = null, $capability = false, $override = array() ){
    $postNameLower = strtolower($postName);
    $labelLower = strtolower($label);
    $labelUpper = strtoupper($label);

    $labels = array(
      'name' => $label,
      'singular_name' => $label,
      'add_new' => 'Add New',
      'add_new_item' => 'Add New '. $label,
      'edit_item' => 'Edit '. $label,
      'new_item' => 'New '. $label,
      'view_item' => 'View '. $label,
      'search_item' => 'Search '. $label,
      'not_found' => 'No '. $label .' found',
      'not_found_in_trash' => 'No '. $label .' In Trash',
      'parent_item_colon' => '',
      'menu_name' => $label
    );

    $capabilities = array(
    	'publish_posts' => 'publish_'.$labelLower,
    	'edit_post' => 'edit_'.$postNameLower,
    	'edit_posts' => 'edit_'.$labelLower,
    	'edit_others_posts' => 'edit_others_'.$labelLower,
    	'delete_post' => 'delete_'.$postNameLower,
    	'delete_posts' => 'delete_'.$labelLower,
    	'delete_others_posts' => 'delete_others_'.$labelLower,
    	'read_post' => 'read_'.$postNameLower,
    	'read_private_posts' => 'read_private_'.$labelLower,
    );

    if($capability == true){
    	$cap_args = array(
    		'capability_type' => $postNameLower,
    		'capabilities' => $capabilities
    	);
    } else {
    	$cap_args = array();
    }

    $args = array(
    	'labels' => $labels,
    	'descriptions' => $label,
    	'rewrite' => array('slug' => sanitize_title($postName),'hierarchical'=>true,'with_front'=> false),
    	'public' => true,
    	'has_archive' => true,
    	'query_var' => true,
    );

    $args = array_merge($args, (array)$cap_args, $override );

    register_post_type($postName, $args);

    return;
  }
}

 ?>
