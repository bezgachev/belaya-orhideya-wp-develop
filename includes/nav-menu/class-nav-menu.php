<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// свой класс построения навигации в footer:
class footer_nav extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		if ($item->url && $item->url != '') {
			$output .= '';
		}
		if ($item->url && $item->url != '') {
			if ( $depth === 0) {
				$output .= '';
			}
			else if ( $depth === 1) { 
				$output .= '<div class="footer__link"><a href="' . $item->url . '">'. $item->title .'</a></div>';
			}
		}
		else {
				$output .= '<div class="footer__item"><h3>'. $item->title .'</h3><div class="footer__links">';
		}
	}
	function start_lvl(&$output, $depth=0, $args=null) {
		$output .= '';	
	}
	function end_lvl(&$output, $depth=0, $args=null) {
		$output .= '';
	}
	function end_el(&$output, $item, $depth=0, $args=null) { 
		if ( $depth === 0) {
			$output .= '</div></div>';
		}
	}
}