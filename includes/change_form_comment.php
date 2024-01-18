<?if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter('comment_form_defaults', function ($defaults) {
    // изменим текст кнопки отправки формы
    $defaults['label_submit'] = 'Добавить комментарий';
    return $defaults;
});

add_filter('comment_form_default_fields', function($fields) {
    // удаляем поле «Сайт»
    unset($fields['url']);
    $fields['phone'] = '<p class="comment-form-phone">' .
					   '<label for="phone">' . __( 'Phone' ) . '</label>' .
					   '<input id="phone" name="phone" type="text" size="30"/></p>';
    $fields['file'] = '';
    return $fields;
});


add_action( 'comment_post', 'save_extend_comment_meta_data' );

/**
 * Сохраняет содержимое поля "Телефон" в метаполе.
 *
 * @param int $comment_id Идентификатор комментария
 */
function save_extend_comment_meta_data( $comment_id ) {
	if ( ! empty( $_POST['phone'] ) ) {
		$phone = sanitize_text_field( $_POST['phone'] );
		add_comment_meta( $comment_id, 'phone', $phone );
	}

    if ( ! empty( $_POST['file'] ) ) {
		$file = sanitize_text_field( $_POST['file'] );
		add_comment_meta( $comment_id, 'file', $file );
	}
}

add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );
function extend_comment_add_meta_box(){
    add_meta_box( 'title', 'Доп. информация', 'extend_comment_meta_box', 'comment', 'normal', 'high' );
}

// Отображаем наши поля
function extend_comment_meta_box( $comment ){
    $phone  = get_comment_meta( $comment->comment_ID, 'phone', true );
    $file  = get_comment_meta( $comment->comment_ID, 'file', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    if(!empty($phone) || !empty($file)) {
    ?>
    <table class="form-table editcomment">
        <tbody>
        <?if(!empty($phone)) {?>
        <tr>
            <td class="first"><label for="phone">Телефон</label></td>
            <td><input type="text" name="phone" value="<?=esc_attr($phone);?>" id="phone" readonly></td>
        </tr>
        <?}
        if(!empty($file)) {?>
        <tr>
            <td class="first">Изображение</td>
            <td>
                <img src="<?=$file;?>" width="400" height="auto"/>
                <br><br>
                <a href="<?=$file;?>" download>Скачать файл</a>
            </td>
        </tr>
        <?}?>
        </tbody>
    </table>
    <?
    }
}

function weblitex_comment( $comment, $args, $depth ){
    if($depth == 1){
        $file = get_comment_meta( $comment->comment_ID, 'file', true );
        ?> 
        <div class="fqu__item">
            <div class="fqu__item_wrapper">
                <h2><?=comment_author();?></h2><span><?=comment_date('j F Y');?></span>
            </div>
            <div class="fqu__item_wrapper">
                <p><?=get_comment_text();?></p>
                <?
                if(!empty($file)) {
                    echo '<img src="'.$file.'" alt="img">';
                }
                ?>
            </div>
    <?
    }
    if($depth == 2){ 
    ?>
        <div class="fqu__item_body">
            <p><?=get_comment_text();?></p>
        </div>
    <?}
}

function weblitex_end_comment( $comment, $args, $depth ){	
    if($depth == 1) {
        echo '</div>';
    }
}