<?php
//extend Walker_Nav_Menu class. This function looks for "Cart" in the menu and add the number of items in parenthesis.
class add_cart_items_Walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        global $woocommerce;
        if ($element->title == "Cart") {
       		$element->title .= " (" . $woocommerce->cart->cart_contents_count . ($woocommerce->cart->cart_contents_count == 1 ? ' item':' items') . ")";		
			}
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );    	
	}		
}

//attach walker function to appropriate menu. Change 'secondary' to the theme location of the menu that includes the Cart link.
function attach_items_to_menu( $args ) {
	if( 'secondary' == $args['theme_location'] ) {
    	$args['walker'] = new add_cart_items_Walker;
  	}
  	return $args;
}

add_filter( 'wp_nav_menu_args', 'attach_items_to_menu' );

?>