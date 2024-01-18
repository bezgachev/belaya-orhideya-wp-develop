<?if(!defined('ABSPATH')){exit;}
$check_bot = get_field('check_bot', 'options');
$page_id = get_queried_object_id();
echo '<section class="fqu">';
	echo '<div class="fqu__container">';
		echo '<h1>'.get_the_title($page_id).'</h1>';
		echo '<div class="fqu__wrapper">';
			$comments = get_comments(array(
				'post_id' => $page_id,
				'status' => 'approve'
			));


			if($comments) {
				echo '<div class="fqu__items">';
					wp_list_comments( array( 
						'callback' => 'weblitex_comment',
						'end-callback' => 'weblitex_end_comment',
						'style' => 'div',
						'reverse_top_level' => false,
						'per_page' => get_option( 'comments_per_page' ),
					), $comments);
				

					if (get_comment_pages_count($comments) > 1 ) {
						
						echo '<nav class="pagination">';
							$max_page = get_comment_pages_count($comments, get_option( 'comments_per_page' ), true);
							$paged = (get_query_var('cpage')) ? get_query_var('cpage') : 1; 
							paginate_comments_links (array(
								'base'    => add_query_arg( 'cpage', '%#%' ),
								'total'   => $max_page, 
								'current' => $paged,
								'format'  => null,
								'prev_text' => null,
								'next_text' => null,
								'add_fragment' => null,
								'show_all'     => false,
								'end_size'     => 1,
								'mid_size'     => 3,
								'add_args'     => false,
							));
						echo '</nav>';
					}
				echo '</div>';
			}
			$type_form = get_sub_field('type_form');
			if(!empty($type_form)) {
				echo '<div class="fqu__form sticky">';
					get_template_part('parts/blocks/forms');
				echo '</div>';
			}
		echo '</div>';
	echo '</div>';
echo '</section>';