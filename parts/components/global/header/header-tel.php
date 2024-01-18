<?if(!defined('ABSPATH')){exit;} ?>
<?

$phone = $args['phones'];
$label = $args['label'];
$phones = (is_array($phone)) ? true : false;
$icon = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7 14C10.866 14 14 10.866 14 7C14 3.13401 10.866 0 7 0C3.13401 0 0 3.13401 0 7C0 10.866 3.13401 14 7 14ZM3.85355 6.35C3.53857 6.03502 3.76165 5.5 4.20711 5.5H9.79289C10.2383 5.5 10.4614 6.03502 10.1464 6.35L7.35355 9.15C7.15829 9.34526 6.84171 9.34526 6.64645 9.15L3.85355 6.35Z" fill="#8D84C6"></path></svg>';
echo ($phones) ? '<div class="header__tel icon">' : '<div class="header__tel">';
    echo '<span>'.$label.'</span>';
    echo '<div class="header__tel_hover">';
    echo ($phones) ? $icon : '';
        if($phones) {
            foreach ($phone as $val) {
                echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $val).'">'.$val.'</a>';
            }
        }else {
            echo '<a href="tel:'.preg_replace('/[^0-9\+]/', '', $phone).'">'.$phone.'</a>';
        }
    echo '</div>';
echo '</div>';