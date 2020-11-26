<?php
// CОЗДАЕМ КНОПКИ ДЛЯ СОЦ СЕТЕЙ
function crunchify_social_sharing_buttons($content) {
  global $post;
  if(is_singular()){
  
    // Get current page URL 
    $crunchifyURL = urlencode(get_permalink());
 
    // Get current page title
    $crunchifyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
    // $crunchifyTitle = str_replace( ' ', '%20', get_the_title());
    
    // Get Post Thumbnail for pinterest
    $crunchifyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 
    // Construct sharing URL without using any script
    $twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL.'&amp;via=Crunchify';
    $telegramURL = 'https://t.me/share/url?url='. $crunchifyURL .'&text='. $crunchifyTitle .'';
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
    $viberURL = 'viber://pa?chatURI='. $crunchifyURL .'';
 
    // Based on popular demand added Pinterest too
    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$crunchifyURL.'&amp;media='.$crunchifyThumbnail[0].'&amp;description='.$crunchifyTitle;
 
    // Add sharing button at the end of page/page content
    
    $content .= '<div class="sidebar-social flex">';
    $content .= '<li class="share-item"><a class="share-link share-facebook" href="'.$facebookURL.'" target="_blank"><span class="mr-2">Фейсбуке</span><img src="'. get_template_directory_uri() .'/img/icons/facebook-share.svg" class="share-icon"></a></li>';

    $content .= '<li class="share-item"><a class="share-link share-twitter" href="'.$twitterURL.'" target="_blank"><span class="mr-2">Твиттере</span><img src="'. get_template_directory_uri() .'/img/icons/twitter-share.svg" class="share-icon"></a></li>';
    
    $content .= '<li class="share-item"><a class="share-link share-telegram" href="'.$telegramURL.'" target="_blank"><span class="mr-2">Телеграме</span><img src="'. get_template_directory_uri() .'/img/icons/telegram-share.svg" class="share-icon"></a></li>';
    
    $content .= '<li class="share-item"><a class="share-link share-viber" href="'.$viberURL.'" target="_blank"><span class="mr-2">Вайбере</span><img src="'. get_template_directory_uri() .'/img/icons/viber-share.svg" class="share-icon"></a></li>';
    $content .= '</div>';
    echo $content;
  }else{
    // if not a post/page then don't include sharing button
    echo '';
  }
};

add_action( 'show_social_share_buttons', 'crunchify_social_sharing_buttons' );

?>