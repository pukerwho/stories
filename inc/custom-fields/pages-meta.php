<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_page_theme_options' );
function crb_page_theme_options() {
  Container::make( 'post_meta', 'Main' )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'tpl_anekdot.php' )
    ->add_fields( array(
      Field::make( 'complex', 'crb_jokes', 'Анекдоты' )->add_fields( array(
        Field::make( 'rich_text', 'crb_joke', 'Анекдот' ),
      )),
    ));
}

?>