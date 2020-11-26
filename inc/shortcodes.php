<?php
	function single_notice_green($atts) {
		$params = shortcode_atts( array(
			'text' => 11112,
		), $atts );
		ob_start();
    ?>
    	<div class='notice_green'><img src='<?php bloginfo('template_url') ?>/img/notice_green.svg'><div><?php echo $params['text'] ?></div></div>
    <?php
    $out = ob_get_clean();
    wp_reset_postdata();
    return $out;
	}
	add_shortcode( 'blognotice', 'single_notice_green' );

	function check_list($atts) {
		$params = shortcode_atts( array(
			'checktext' => 'Полезная штука - скачивай, пригодится',
			'checkmodal' => 'checkListModal'
		), $atts );
		ob_start();
		?>
			<div class="form-me p-5 text-center">
				<div class="form-me__text mb-4 totop-animate totop-show"><?php echo $params['checktext'] ?></div>
				<div class="btn btn-success btn-lg totop-animate totop-show" data-toggle="modal" data-target="#<?php echo $params['checkmodal'] ?>">Скачать бесплатно</div>
			</div>
		<?php 
		$checkListOut = ob_get_clean();
		wp_reset_postdata();
		return $checkListOut;
	}
	add_shortcode( 'checklist', 'check_list' );

	function list_number($atts) {
		$params = shortcode_atts( array(
			'numbertext' => 'Следующий пункт',
			'mb' => '3',
		), $atts );
		ob_start();
		?>
			<h2 class="list_number mb-<?php echo $params['mb'] ?>">
				<?php echo $params['numbertext'] ?>	
			</h2>
		<?php 
		$listNumberOut = ob_get_clean();
		wp_reset_postdata();
		return $listNumberOut;
	}
	add_shortcode( 'listnumber', 'list_number' );
?>