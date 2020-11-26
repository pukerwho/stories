<div class="bottom-info bg-white shadow-lg">
	<div class="container mx-auto">
		<div class="flex justify-center lg:justify-between py-3">
			<div class="flex flex-col lg:flex-row items-center">
				<span class="text-xl mb-2 mr-0 lg:mb-0 lg:mr-4 "><?php _e('Поделиться в', 'totop'); ?>:</span>
				<?php do_action('show_social_share_buttons'); ?>	
			</div>
			<div class="hidden lg:block">
				<?php 
					$next_post = get_previous_post(); 
					if( ! empty($next_post) ){
				?>
				<a href="<?php echo get_permalink( $next_post ); ?>" class="flex items-center">
					<div class="mr-4">
						<img src="<?php echo get_the_post_thumbnail_url($next_post, 'thumbnail'); ?>" alt="<?php echo esc_html($next_post->post_title); ?>" width="45px">
					</div>
					<div class="flex flex-col">
						<span class="text-sm"><?php _e('Следующая запись', 'totop'); ?></span>
						<span><?php echo esc_html(wp_trim_words(($next_post->post_title), 5)); ?></span>
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>