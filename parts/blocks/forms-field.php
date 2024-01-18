<?if(!defined('ABSPATH')){exit;}
$placeholder = get_sub_field('placeholder');
$required = get_sub_field('required');
$required = (($required) ? true : false);
$form_name = $args;

echo ($required) ? '<div data-tooltip="Обязательное поле" class="tooltiper form__field">' : '<div class="form__field">';
    if ($form_name == 'message') {
        echo '<textarea name="'.$form_name.'" placeholder="';
        echo $placeholder;
        echo ($required) ? '*">' : '">';
        echo '</textarea>';
    }else {
        echo '<input type="'.(($form_name == 'tel') ? 'tel' : 'text').'" name="'.$form_name.'" placeholder="';
        echo $placeholder;
        echo ($required) ? '*"/>' : '"/>';
    }
echo '</div>';