<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
  Container::make( 'theme_options', __('Главные настройки') )
    ->add_tab( __('Контакты'), array(
        Field::make( 'text', 'crb_contact_address_link', 'Ссылка на Google maps' ),
        Field::make( 'complex', 'crb_contact_phones', 'Телефоны' )
          ->add_fields( array(
            Field::make( 'text', 'crb_contact_phone', 'Номер' ),
            Field::make( 'checkbox', 'crb_contact_phone_telegram', 'Telegram' ),
            Field::make( 'text', 'crb_contact_phone_telegram_number', 'Telegram nickname' )
             ->set_conditional_logic( array(
              array(
                'field' => 'crb_contact_phone_telegram',
                'value' => true,
              )
            ) ),
            Field::make( 'checkbox', 'crb_contact_phone_whatsapp', 'Whatsapp' ),
            Field::make( 'checkbox', 'crb_contact_phone_viber', 'Viber' ),
        ) ),
        Field::make( 'text', 'crb_contact_email', 'Email' ),
        Field::make( 'text', 'crb_contact_skype', 'Skype' ),  
        Field::make( 'text', 'crb_contact_instagram', 'Instagram' ),
        Field::make( 'text', 'crb_contact_facebook', 'Facebook' ),
    ) );
}

?>