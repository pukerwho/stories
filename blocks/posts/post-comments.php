<?php 
	$comment_textarea_text = "Ваш комментарий";
	$comment_name_text = "Ваше имя";
	$comment_btn_text = "Отправить";
?>

<?php function output_hidden_field_in_comment_form() {
  ?>
  	<?php global $wp; $current_post_link = home_url(add_query_arg(array(), $wp->request)); ?>
    <input type="hidden" name="redirect_to" value="<?php echo $current_post_link; ?>">
  <?php
}
add_action( 'comment_form', 'output_hidden_field_in_comment_form' );

?>

<div class="mb-5">
	<?php 
		comment_form([
			'comment_notes_before' => '',
			'title_reply' => '',
			'label_submit' => $comment_btn_text,
			'fields'               => [
				'author' => '<p class="comment-form-author">
					<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' placeholder="' . $comment_name_text . '" />
				</p>',
				'email'  => '<p class="comment-form-email">
					<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' placeholder="Ваш Email" />
				</p>',
			],
			'comment_field' => '<p class="comment-form-comment">
				<textarea id="comment" name="comment" rows="5" placeholder="' . $comment_textarea_text . '" aria-required="true" required="required"></textarea>
			</p>',
		]); 
	?>
</div>


<?php 
	function custom_comment_template($comment, $args, $depth) { ?>
		<div <?php comment_class('mb-5'); ?>>
			<div id="comment-<?php echo get_comment_ID(); ?>" class="bg-white shadow-md rounded-md px-6 py-4">
				<div class="post-comment__content mb-2">
					<div class="post-comment__name font-bold mb-2"><?php echo get_comment_author(); ?></div>
					<div class="post-comment__text"><?php comment_text(); ?></div>
				</div>
				<div class="post-comment__bottom flex justify-between items-center">
					<div><?php echo get_comment_date('j F'); ?> | <?php echo get_comment_time(); ?></div>
					<div class="post-comment__answer text-blue-800"><?php
						comment_reply_link(
							array(
								'depth'     => 1,
								'max_depth' => 5,
								'reply_text' => __('Ответить', 'restx'),
								'respond_id' => 'respond',
							)
						); 
					?></div>
				</div>
			</div>
			
	<?php }
?>
<?php function custom_comment_template_end( $comment, $args, $depth ){	
	echo '</div>';
} ?>

<?php 

	$list_comments_args = array(
		'callback' => 'custom_comment_template',
		'end-callback' => 'custom_comment_template_end' 
	);

	$args = array(
		'post__in' => get_the_ID(),
		'status' => 'approve'
	);

	$comments = get_comments( $args );
?>

<?php wp_list_comments($list_comments_args, $comments); ?>