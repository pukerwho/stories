<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="post pb-4">
		<div class="container mx-auto px-2 lg:px-0">
			<main class="w-full lg:w-3/5 mx-0 lg:mx-auto">
				<article class="mb-6 mx-auto">
					<!-- Заглавное фото -->
					<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large') ?>" alt="" loading="lazy" itemprop="image" class="w-full post-thumb object-cover">
					<div class="py-5 lg:py-8">
						<!-- Хлебные крошки -->
						<div class="mb-5">
						<?php 
							$current_term = wp_get_post_terms(  get_the_ID() , 'category', array( 'parent' => 0 ) );
							foreach (array_slice($current_term, 0,1) as $myterm); {
							} ?>
							<?php if ($myterm): ?>
								<div class="breadcrumbs" itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
						      <ul class="flex">
										<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem' class="breadcrumbs-item">
											<a itemprop="item" href="<?php echo home_url(); ?>" class="breadcrumbs-link text-sm">
												<span itemprop="name"><?php _e( 'Главная', 'restx' ); ?></span>
											</a>                        
											<meta itemprop="position" content="1">
										</li>
										<li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem' class="breadcrumbs-item">
											<a itemprop="item" href="<?php get_post_type_archive_link('post'); ?>" class="breadcrumbs-link text-sm">
												<span itemprop="name"><?php _e('Публикации', 'totop'); ?></span>
											</a>                        
											<meta itemprop="position" content="2">
										</li>
						        <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem' class="breadcrumbs-item">
						          <a itemprop="item" href="<?php echo get_term_link($myterm->term_id, 'category') ?>" class="breadcrumbs-link text-sm">
												<span itemprop="name"><?php echo $myterm->name; ?></span>
											</a>                       
											<meta itemprop="position" content="3">
						        </li>
						      </ul>
						    </div>
							<?php endif;?>
						</div>

						<!-- Тайтл -->
						<h1 itemprop="headline" class="text-3xl font-bold mb-5"><?php the_title(); ?></h1>

						<!-- Хештеги -->
						<div class="post-categories -mx-1 mb-5">
							<?php 
					    $post_tags = wp_get_post_terms(  get_the_ID() , 'hashtags', array( 'parent' => 0 ) );
					    foreach($post_tags as $post_tag): ?>
					    	<?php if ($post_tag): ?>
					    		<a href="<?php echo get_term_link( $post_tag->term_id ); ?>" class="post-categories__link mx-1 p-2 rounded-md">
								 		<?php echo $post_tag->name; ?>
								 	</a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>

						<!-- Автор -->
						<div class="post-author flex flex-col lg:flex-row justify-start lg:justify-between items-start lg:items-center mb-8">
							<?php 
								$avatar = get_avatar(get_the_author_meta('ID'));
							?>
							<div class="flex items-center mb-2 lg:mb-0">
								<div class="post-author__avatar mr-2">
									<?php if ($avatar): ?>
								    <?php echo $avatar; ?>
								  <?php else: ?>
								    <img src="<?php bloginfo('template_part'); ?>/img/user.svg">
								  <?php endif; ?>
								</div>	
								<div class="post-author__info">
									<div class="post-author__name">
										<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a>
									</div>
									<div class="flex">
										<div class="post-item__date text-sm">
											<?php _e('Обновлено', 'totop'); ?>: <?php echo get_the_modified_time('F j, Y') ?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Основной контент -->
						<div itemprop="articleBody">
							<?php the_content(); ?>	
						</div>
					</div>
					
				</article>

				<!-- Похожие записи -->
				<div class="post-related shadow-md rounded-md px-6 lg:px-10 py-5 mb-6">
					<div class="text-3xl mb-6"><?php _e('Похожие записи', 'totop'); ?></div>
					<div>
						<?php 
						$current_id = get_the_ID();
						$custom_query = new WP_Query( array( 
						'post_type' => 'post', 
						'posts_per_page' => 3,
						'post__not_in' => array($current_id),
						'tax_query' => array(
					    array(
				        'taxonomy' => 'category',
						    'terms' => $myterm->term_id,
				        'field' => 'term_id',
				        'include_children' => true,
				        'operator' => 'IN'
					    )
						),
					) );
					if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
						<a href="<?php the_permalink(); ?>" class="block mb-8 lg:mb-6">
							<div class="flex items-start lg:items-center">
								<div>
									<div class="text-xl">
										<?php the_title(); ?>	
									</div>
									<div class="text-sm">
										<?php _e('Добавлено', 'timeto'); ?>: <?php echo get_the_date('j/n/Y') ?>
									</div>
								</div>
							</div>
						</a>
					<?php endwhile; endif; wp_reset_postdata(); ?>
					</div>
				</div>

				<!-- Комментарии -->
				<div class="post-comments shadow-md rounded-md px-6 lg:px-10 py-5 mb-6">
					<div class="text-3xl mb-6"><?php _e('Обсуждение', 'totop'); ?></div>
					<?php get_template_part('blocks/posts/post-comments'); ?>
				</div>
			</main>
		</div>
	</div>
<?php endwhile; else: ?>
	<p><?php _e('Ничего не найдено'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>