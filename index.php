<?php get_header(); ?>

<div class="container mx-auto pb-4 px-2 lg:px-0">
	<div class="flex pb-2">
		<main class="w-full lg:w-3/5 px-0 lg:px-4 mx-auto">
			<div class="posts-list">
				<?php 
					$posts_query = new WP_Query( array(
						'post_type' => 'post',
						'orderby' => 'date',
						'post_per_page' => 10,
					));
					if ($posts_query->have_posts()) : while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
					<?php get_template_part('blocks/posts/post-item', 'timeto'); ?>
				<?php endwhile; endif; wp_reset_postdata(); ?>
			</div>
		</main>
	</div>
</div>


<?php get_footer(); ?>