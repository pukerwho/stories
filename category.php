<?php get_header(); ?>

<div class="category">
	<div class="category-color w-full h-32" style="background: <?php echo carbon_get_term_meta(get_queried_object_id(), 'crb_category_color'); ?>"></div>
	<div class="container mx-auto px-2 lg:px-0">
		<div class="w-full lg:w-9/12 category-hero bg-white shadow-md rounded-md px-4 lg:px-10 py-8 -mt-16 mb-10 mx-auto">
			<div>
				<?php if (carbon_get_term_meta(get_queried_object_id(), 'crb_category_icon')): ?>
					<img src="<?php echo carbon_get_term_meta(get_queried_object_id(), 'crb_category_icon'); ?>" width="100px" class="category-hero__icon" style="border: 8px solid <?php echo carbon_get_term_meta(get_queried_object_id(), 'crb_category_color'); ?>">
				<?php else: ?>
					<img src="<?php bloginfo('template_url'); ?>/img/icons/file.svg" width="100px" class="category-hero__icon" style="border: 8px solid <?php echo carbon_get_term_meta(get_queried_object_id(), 'crb_category_color'); ?>">
				<?php endif; ?>
			</div>
			<div class="text-3xl text-left lg:text-center font-bold mt-10 mb-5">
				<?php single_cat_title(); ?>
			</div>
			<div class="text-xl text-left lg:text-center mx-auto">
				<?php echo carbon_get_term_meta(get_queried_object_id(), 'crb_category_description'); ?>
			</div>
		</div>
	</div>
	<div class="container mx-auto px-2 lg:px-0 mb-10">
		<div class="w-full lg:w-9/12 mx-auto">
			<div>
				<?php 
				$current_term = get_queried_object_id();
				$current_page = !empty( $_GET['page'] ) ? $_GET['page'] : 1;
				$custom_query = new WP_Query( array( 
					'post_type' => 'post', 
					'posts_per_page' => 10,
					'paged' => $current_page,
					'orderby' => 'date',
					'order' => 'DESC',
					'tax_query' => array(
				    array(
			        'taxonomy' => 'category',
					    'terms' => $current_term,
			        'field' => 'term_id',
			        'include_children' => true,
			        'operator' => 'IN'
				    )
					),
				));
				if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
					<a href="<?php the_permalink(); ?>" class="block mb-10 lg:mb-6">
						<div class="flex items-start lg:items-center">
							<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?>" alt="<?php the_title(); ?>	" loading="lazy" class="rounded-full object-cover mr-4" width="80px" height="80px">
							<div>
								<div class="text-xl">
									<?php the_title(); ?>	
								</div>
								<div class="post-author__name text-sm">
									<?php _e('Автор', 'totop'); ?>: <?php echo get_the_author(); ?>
								</div>
							</div>
						</div>
					</a>
				<?php endwhile; endif; wp_reset_postdata(); ?>
			</div>
			<div class="flex justify-center items-center">
				<div class="pagination">
					<?php 
						$big = 9999999991; // уникальное число
						echo paginate_links( array(
							'format' => '?page=%#%',
							'total' => $custom_query->max_num_pages,
							'current' => $current_page,
							'prev_next' => true,
							'next_text' => (''),
							'prev_text' => (''),
						)); 
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>