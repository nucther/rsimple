<?php
/**
 * Rsimple Custom Taxonomy
 */

class rsimple_taxonomy{

    public function publish($posttype = null, $taxName = null, $label = null, $override = array() ){
      $label_lower = strtolower($label);
      $labels = array(
        'name' => $label,
        'singular_name' => $taxName,
        'popular_items' => 'Popular '. $label,
        'all_item' => 'All '. $label,
        'parent_item' => 'Parent '. $label,
        'parent_colon_item' => 'Parent '. $label .':',
        'edit_item' => 'Edit '. $label,
        'view_item' => 'View '. $label,
        'update_item' => 'Update '. $label,
        'add_new_item' => 'Add New '. $label,
        'new_name_item' => 'New '. $label.' Name',
        'separate_items_with_commas' => 'Separate '. $label_lower .' with commas',
        'add_or_remove_items' => 'Add or remove '. $label_lower,
        'choose_from_most_user' => 'Choose from the most used '. $label_lower,
        'not_found' => 'No '. $label_lower .' found',
      );

      if(array_key_exists('capabilities', $override) && $override['capabilities'] === true){
				$override['capabilities'] = array(
						'manage_terms' => 'manage_'. $label,
						'edit_terms' => 'manage_'. $label,
						'delete_terms' => 'manage_'. $label,
						'assign_terms' => 'edit_posts',
					);
			}

      if(array_key_exists('hierarchical', $override) && $override['hierarchical'] === true){
				$override['hierarchical'] = true;
			} else {
				$override['hierarchical'] = false;
			}

      $args = array(
				'labels' => $labels,
				'show_admin_column' => false,
				'rewrite' => array('slug' => $taxName,'with_front' => false,'hierarchical'=>true),
				'public'            =>  true,
				'show_in_nav_menus' =>  true,
				'has_archive' =>  false,
			);

			$args = array_merge($args, $override);

      register_taxonomy( $taxName, $posttype, $args );
    }
}

?>
