<?

/**
 * 
 * получаем сортированное меню 
 * 
 * id - id меню 
 * 
 * */
function get_sorted_menu($id){
	$menu_sort = [];
	$menu = wp_get_nav_menu_items($id);
	foreach ($menu as $value) {
	  if ($value->menu_item_parent != '0' && $value->menu_item_parent != '') {
	    /* > 1 */
	    if ($menu_sort[$value->menu_item_parent]) {
	      $temp_parent = $value->menu_item_parent;
	      /* 2 уровень */
	      $menu_sort[$temp_parent]['ITEMS'][$value->ID]['ID'] = $value->ID;
	      $menu_sort[$temp_parent]['ITEMS'][$value->ID]['title'] = $value->title;
	      $menu_sort[$temp_parent]['ITEMS'][$value->ID]['url'] = $value->url;
	      $menu_sort[$temp_parent]['ITEMS'][$value->ID]['menu_item_parent'] = $value->menu_item_parent;
	    } elseif ($value->menu_item_parent != $temp_parent){
	      /* 3 уровень */
	      $menu_sort[$temp_parent]['ITEMS'][$value->menu_item_parent]['ITEMS'][$value->ID]['ID'] = $value->ID;
	      $menu_sort[$temp_parent]['ITEMS'][$value->menu_item_parent]['ITEMS'][$value->ID]['title'] = $value->title;
	      $menu_sort[$temp_parent]['ITEMS'][$value->menu_item_parent]['ITEMS'][$value->ID]['url'] = $value->url;
	      $menu_sort[$temp_parent]['ITEMS'][$value->menu_item_parent]['ITEMS'][$value->ID]['menu_item_parent'] = $value->menu_item_parent;
	    }
	    
	  } else {
	    /* 1 уровень */
	    $menu_sort[$value->ID]['ID'] = $value->ID;
	    $menu_sort[$value->ID]['title'] = $value->title;
	    $menu_sort[$value->ID]['url'] = $value->url;
	    $menu_sort[$value->ID]['menu_item_parent'] = $value->menu_item_parent;  
	  }
	}

	return $menu_sort;
}

?>