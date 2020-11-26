<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="container mx-auto">
		<div class="w-full lg:w-4/5 page bg-white shadow-md rounded-md my-0 mx-auto lg:my-8 px-4 lg:px-8 py-8 lg:py-10">
			<h1 class="text-3xl lg:text-4xl font-bold mb-6"><?php the_title(); ?></h1>
			<article>
				<?php the_content(); ?>
			</article>
		</div>
	</div>
<?php endwhile; else: ?>
	<p><?php _e('Ничего не найдено'); ?></p>
<?php endif; ?>
<?php get_footer(); ?>