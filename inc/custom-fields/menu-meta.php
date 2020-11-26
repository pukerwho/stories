<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_menu_fields' );
function crb_menu_fields() {
	Container::make( 'nav_menu_item', __( 'Menu Settings' ) )
    ->add_fields( array(
        Field::make( 'image', 'crb_menu_icon', 'Иконка' )->set_value_type( 'url'),
    ));
}
?>