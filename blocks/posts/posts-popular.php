<div class="sidebar-block rounded-md shadow-sm mb-4">
	<div class="sidebar-title flex items-center">
		<img src="<?php bloginfo('template_url'); ?>/img/icons/flame.svg" width="25px" class="mr-2">
		<div class="text-xl font-bold"><?php _e('Популярное', 'totop'); ?></div>	
	</div>
	
	<div>
		<ul class="flex flex-col">
			<?php 
			$posts_query = new WP_Query( array(
				'post_type' => array('post', 'page'),
				'orderby'     => 'modified',
				'order'       => 'DESC',
				'posts_per_page' => 10,
				'meta_key'       => '_crb_popular_sidebar',
			));
			if ($posts_query->have_posts()) : while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
				<li class="sidebar-block__item"><a href="<?php the_permalink(); ?>" class="sidebar-block__link"><?php the_title(); ?></a></li>
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</ul>
	</div>
</div>