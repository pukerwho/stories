<?php
  $siteName = 'TimeToTop';
  $title = wp_get_document_title();
  $descr = get_bloginfo('description');
  $keyW = 'создание, продвижение, реклама';
  $img = $_SERVER['HTTP_HOST'].'/img/soc_img.jpg';
  $url = $_SERVER['REQUEST_URI'];
?>

<?php if(is_single() || is_page()) {
  //ДЛЯ ПОСТОВ
  if (have_posts()) : while (have_posts()) : the_post();
    $seoMetaTitle = carbon_get_the_post_meta('crb_post_seo_title');
    if ($seoMetaTitle != '') { $title = $seoMetaTitle; } else { $title = get_the_title($post->ID); }

    $seoMetaDescr = carbon_get_the_post_meta('crb_post_seo_description');
    if ($seoMetaDescr != '') { $descr = $seoMetaDescr; } else { $descr = get_the_excerpt($post->ID); }

    $seoMetakeyw = carbon_get_the_post_meta('crb_post_seo_keywords');
    if ($seoMetakeyw != '') { $keyW = $seoMetakeyw; }

    $img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    $url = get_the_permalink($post->ID);
    endwhile; endif;

  } elseif (is_category()) {
    // ДЛЯ КАТЕГОРИЙ
    $seoMetaTitle = carbon_get_term_meta(get_queried_object_id(),'crb_category_seo_title');
    if ($seoMetaTitle != '') { $title = $seoMetaTitle; };

    $seoMetaDescr = carbon_get_term_meta(get_queried_object_id(),'crb_category_seo_description');
    if ($seoMetaDescr != '') { $descr = $seoMetaDescr; };

    $seoMetakeyw = carbon_get_term_meta(get_queried_object_id(),'crb_category_seo_keywords');
    if ($seoMetakeyw != '') { $keyW = $seoMetakeyw; };

  } elseif (is_home()) {
    $title = 'Сайт для вебмастеров: как создавать, продвигать и рекламировать сайты';
    $descr = 'Этот ресурс будет полезен для верстальщиков, для дизайнеров, для сеошников. Блоги для вебмастеров - множество полезной и ценной информации. Заходите!';

  } elseif (is_search()) {
    $title = 'Поиск по запросу "'.$s.'"';
  
  } elseif (is_404()) {
    $title = '404 - Страница не найдена';

  } elseif (is_archive()) {
    $cat_obj = $wp_query->get_queried_object();
    $name = $cat_obj->name;
  } 
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <title><?php echo $title.' — '.$siteName; ?></title>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="description" content='<?php echo $descr; ?>'>
  <meta name="keywords" content='<?php echo $keyW; ?>'>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="apple-touch-icon" href="/example.png">
  <base href="<?php echo home_url(); ?>">
  <link rel="alternate" hreflang="x-default" href="<?php echo home_url(); ?>">

  <!-- Google Plus -->
  <meta itemprop="name" content='<?php echo $title; ?>'/>
  <meta itemprop="description" content="<?php echo $descr; ?>"/>
  <meta itemprop="image" content="<?php echo $img; ?>"/>

  <!-- Twitter -->
  <meta name="twitter:card" content="summary"/>
  <meta name="twitter:title" content='<?php echo $title; ?>'>
  <meta name="twitter:description" content="<?php echo $descr; ?>"/>
  <meta name="twitter:image:src" content="<?php echo $img; ?>"/>
  <meta name="twitter:domain" content="<?php echo $url; ?>"/>

  <!-- Facebook -->
  <meta property="og:type" content="website"/>
  <meta property="og:title" content='<?php echo $title; ?>'/>
  <meta property="og:description" content="<?php echo $descr; ?>"/>
  <meta property="og:url" content="<?php echo $url; ?>"/>
  <meta property="og:image" content="<?php echo $img; ?>"/>
  <meta property="og:site_name" content='<?php echo $siteName; ?>'/>

  <?php
  // ENQUEUE your css and js in inc/enqueues.php

    wp_head();
	?>

</head>
<body <?php echo body_class(); ?>>
  <!-- <div class="preloader"></div> -->
  
  <header class="header py-5 border-b-2 border-solid border-gray-200 px-4 lg:px-0">
    <div class="container mx-auto">
      <div class="w-full lg:w-3/5 mx-auto">
        <div class="header-content flex justify-between items-center">
          <div class="header-logo logo">
            <a href="<?php echo home_url(); ?>" class="flex items-end text-xl font-bold">
              Все про <span class="text-custom-orange mx-1">конструкторы</span> сайтов
            </a>
          </div>
          <div class="header-menu__desktop menu hidden lg:block">
            <?php wp_nav_menu([
              'theme_location' => 'head_menu',
              'menu_id' => 'head_menu',
              'menu_class' => 'flex justify-between -mx-1'
            ]); ?>
          </div>
          <div class="header-menu__mobile menu block lg:hidden">
            <span class="menu-line"></span>
            <span class="menu-line"></span>
            <span class="menu-line"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-cover bg-custom-gray px-6 py-10">
      <?php
        $menu_name = 'head_menu';
        $locations = get_nav_menu_locations();

        if( $locations && isset( $locations[ $menu_name ] ) ){
          $menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );

          $menu_list = '<ul id="menu-' . $menu_name . '" class="flex flex-col mb-10">';
          foreach ( (array) $menu_items as $key => $menu_item ){
            $menu_icon = carbon_get_nav_menu_item_meta( $menu_item->ID, 'crb_menu_icon' ); 
            $menu_list .= '<li class="flex items-center mb-3"><img src="' . $menu_icon . '" class="mr-2" width="25px"><a href="' . $menu_item->url . '" class="text-xl">' . $menu_item->title . '</a></li>';
          }
          $menu_list .= '</ul>';
        }
        else {
          $menu_list = '<ul><li>Меню "' . $menu_name . '" не определено.</li></ul>';
        }

        echo $menu_list;
      ?>
      <div class="flex items-center mb-4">
        <img src="<?php bloginfo('template_url'); ?>/img/icons/categories.svg" width="25px" class="mr-3">
        <div class="text-xl font-bold">
          <?php _e('Категории', 'totop'); ?>
        </div>
      </div>
      <ul>
        <?php 
        $categories = get_terms( [
          'taxonomy' => 'category',
          'parent' => 0,
          'hide_empty' => false,
        ] );

        foreach($categories as $cat): ?>
          <li class="mb-2">
            <a href="<?php echo get_category_link( $cat->term_id); ?>">
              # <?php echo $cat->name; ?>  
            </a>  
          </li>
        <?php endforeach; ?>  
      </ul>
    </div>
  </header>
  <section id="content" role="main">