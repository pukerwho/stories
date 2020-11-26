<?php get_header(); ?>

<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<div class="container mx-auto px-2 lg:px-0 py-5">
	<div class="flex w-full lg:w-4/5 flex-col lg:flex-row mx-auto">
		<div class="w-full lg:w-1/3 mr-6">
			<div class="author-info bg-custom-gray flex items-center flex-col rounded-md border-custom-gray shadow-sm py-4 mb-6 lg:mb-0">
				<div class="author-avatar mb-4">
					<?php 
						$avatar = get_avatar(get_the_author_meta('ID'));
					?>
					<?php if ($avatar): ?>
				    <?php echo $avatar; ?>
				  <?php else: ?>
				    <img src="<?php bloginfo('template_part'); ?>/img/user.svg">
				  <?php endif; ?>
				</div>
				<h1 class="text-2xl mb-1"><?php echo $curauth->display_name; ?></h1>
				<div class="text-gray-700 mb-2"><?php echo carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_who' ); ?></div>
				<div class="flex -mx-1">
					<?php if(!empty(carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_facebook' ))) { ?>
					<div class="mx-1">
						<a href="<?php echo carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_facebook' ); ?>" class="text-sm text-blue-800 hover:text-gray-900">Facebook</a>
					</div class="mx-1">
					<?php } ?>
					<?php if(!empty(carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_instagram' ))) { ?>
					<div class="mx-1">
						<a href="<?php echo carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_instagram' ); ?>" class="text-sm text-blue-800 hover:text-gray-900">Instagram</a>
					</div>
					<?php } ?>
					<?php if(!empty(carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_twitter' ))) { ?>
					<div class="mx-1">
						<a href="<?php echo carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_twitter' ); ?>" class="text-sm text-blue-800 hover:text-gray-900">Twitter</a>
					</div>
					<?php } ?>
					<?php if(!empty(carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_linkedin' ))) { ?>
					<div class="mx-1">
						<a href="<?php echo carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_linkedin' ); ?>" class="text-sm text-blue-800 hover:text-gray-900">Linkedin</a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="w-full lg:w-2/3">
			<div class="text-2xl mb-2">
				<?php _e('Биография', 'totop'); ?>	
			</div>
			<div class="mb-6">
				<?php echo carbon_get_user_meta( get_the_author_meta( 'ID' ), 'crb_user_bio' ); ?>
			</div>
			<div class="text-2xl mb-2">
				<?php _e('Публикации', 'totop'); ?>	
			</div>
			<!-- СПИСОК ЗАПИСЕЙ АВТОРА -->
			<div>
				<?php 
				$current_page = !empty( $_GET['page'] ) ? $_GET['page'] : 1;
				$custom_query = new WP_Query( array( 
					'post_type' => 'post', 
					'posts_per_page' => 10,
					'paged' => $current_page,
					'author__in'=> get_the_author_meta( 'ID' ), 
					'orderby' => 'date',
					'order' => 'DESC',

				));
				if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
					<?php get_template_part('blocks/posts/post-item', 'timeto'); ?>
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