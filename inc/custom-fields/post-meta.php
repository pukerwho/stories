<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_post_theme_options' );
function crb_post_theme_options() {
  Container::make( 'post_meta', 'SEO' )
  	->where( 'post_type', 'IN', array('page', 'post') )
    ->add_fields( array(
		  Field::make( 'text', 'crb_post_seo_title', 'Title' ),
      Field::make( 'textarea', 'crb_post_seo_description', 'Description' ),
      Field::make( 'textarea', 'crb_post_seo_keywords', 'Keywords' ),
      Field::make( 'checkbox', 'crb_popular_sidebar', 'Вывести в популярном' ),
  ) );
}

?>