<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_user_options' );
function crb_user_options() {
Container::make( 'user_meta', 'Соц сети' )
    ->add_fields( array(
    		Field::make( 'rich_text', 'crb_user_bio', 'Биография' )->set_default_value( 'Автор ведет себя, как шпион - никакой информации.' ),
        Field::make( 'text', 'crb_user_who', 'Должность' ),
        Field::make( 'text', 'crb_user_facebook', 'Ссылка на Facebook' ),
        Field::make( 'text', 'crb_user_instagram', 'Ссылка на Instagram' ),
        Field::make( 'text', 'crb_user_twitter', 'Ссылка на Twitter' ),
        Field::make( 'text', 'crb_user_linkedin', 'Ссылка на Linkedin' ),
    ) );
	}

?>