<div class="post-item flex flex-col lg:flex-row mb-6">
	<div class="post-item__photo">
		<!-- IMG -->
		<?php if( has_post_thumbnail() ): ?>
			<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>	" class="post-item__img w-full mb-2">
		<?php endif; ?>
	</div>
	<div class="post-item__content pl-0 lg:pl-8">
		<div class="post-item__title mb-2">
			<a href="<?php the_permalink(); ?>" class="hover:text-blue-900"><?php the_title(); ?>	</a>
		</div>
		<?php 
			$current_term = wp_get_post_terms(  get_the_ID() , 'category', array( 'parent' => 0 ) );
			foreach (array_slice($current_term, 0,1) as $myterm): ?>
			<?php if ($myterm): ?>
				<div class="post-item__category mb-2">
					<a href="<?php echo get_term_link($myterm->term_id, 'category') ?>">
						<span class="text-gray-600"><?php echo $myterm->name; ?></span>
					</a>
				</div>		
			<?php endif; ?>
		<?php endforeach; ?>
		<div class="flex">
			<img src="<?php bloginfo('template_url'); ?>/img/icons/comments.svg" class="mr-2">
			<span class="mr-2"><?php _e('Комментариев','totop'); ?>:</span>
			<span><?php echo get_comments_number(); ?></span>
		</div>
	</div>
</div>