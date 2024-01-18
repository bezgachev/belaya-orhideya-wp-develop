jQuery(function ($) {
    $(".admin-whatsapp, .admin-viber").find("input").mask("+7 (999) 999-99-99", {
        autoclear: false
    });
    $(".admin-tel_faks").find("input").mask("+7 (9999) 99-99-99", {
        autoclear: false
    });

    $(document).on("click", ".js-phones a.acf-repeater-add-row", function () {
        $('.js-phones input[type=\"text\"]').each(function () {

            $(this).mask("+7 (9999) 99-99-99", {
                autoclear: false
            });
        });
    });

    $(document).on("click", ".js-phones .acf-field[data-name=\"type_phone\"] input[type=\"radio\"]", function () {
        if ($(this).is(':checked')) {
            let value = $(this).val();
            if (value === '1') {
                $(this).parents('tr.acf-row').find('input[type=\"text\"]').mask("+7 (9999) 99-99-99", {
                    autoclear: false
                });
            } else {
                $(this).parents('tr.acf-row').find('input[type=\"text\"]').mask("+7 (999) 999-99-99", {
                    autoclear: false
                });
            }
        }
    });

    $('.admin-ogrn').find("input").mask('9999999999999');
    $('.admin-inn').find("input").mask('9999999999');
    $('.admin-kpp').find("input").mask('999999999');
    $('.admin-e-mail').find("input").bind('change keyup input click', function () {
        $(this).val($(this).val().replace(/[^A-Za-z0-9\.\-\_\@]/g, ''));
    });

    $('.admin-price-main, .admin-price-sale, .admin-metric_key').find("input").bind('change keyup input click', function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });

    $(document).on("click", ".js-specialist-card a.acf-repeater-add-row", function () {
        $('.js-specialist-card').find('.admin-experience input[type=\"text\"]').each(function () {
            $(this).bind('change keyup input click', function () {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
        });
    });

    $(document).on("click", ".admin-settings-forms a.acf-repeater-add-row", function () {
        $('.admin-settings-forms').find('.admin-metric_key input[type=\"text\"]').each(function () {
            $(this).bind('change keyup input click', function () {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
        });
    });





    $('.admin-star-count').find("input").bind('change keyup input click', function () {
        $(this).val($(this).val().replace(/[^1-5]/g, ''));
    });

    // $(document).on( "click", ".admin-https", function() {
    // 	let input = $(this).find('input');
    // 	if (input.val().length == 0) {
    // 		input.val('https://');
    // 	}
    // });

    const dashicons_visibility = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.3 3.3C16.9 2.9 16.2 2.9 15.7 3.3L13.3 5.7C12.2 5.3 11.1 5.1 10 5.1C6.2 5.2 2.8 7.2 1 10.5C1.2 10.9 1.5 11.3 1.8 11.7C2.6 12.8 3.6 13.7 4.7 14.4L3 16.1C2.6 16.5 2.5 17.2 3 17.7C3.4 18.1 4.1 18.2 4.6 17.7L17.3 4.9C17.7 4.4 17.7 3.7 17.3 3.3ZM6.7 12.3L5.4 13.6C4.2 12.9 3.1 11.9 2.3 10.7C3.5 9 5.1 7.8 7 7.2C5.7 8.6 5.6 10.8 6.7 12.3ZM10.1 9C9.6 8.5 9.7 7.7 10.2 7.2C10.7 6.8 11.4 6.8 11.9 7.2L10.1 9ZM18.3 9.5C17.8 8.8 17.2 8.1 16.5 7.6L15.5 8.6C16.3 9.2 17 9.9 17.6 10.8C15.9 13.4 13 15 9.9 15C9.6 15 9.4 15 9.1 15L8.1 16C8.8 15.9 9.4 16 10 16C13.3 16 16.4 14.4 18.3 11.7C18.6 11.3 18.8 10.9 19.1 10.5C18.8 10.2 18.6 9.8 18.3 9.5ZM14 10L10 14C12.2 14 14 12.2 14 10Z" fill="black"/></svg>';
    const dashicons_hidden = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_3019_1823)"><path d="M18.3004 9.50011C15.0004 4.90011 8.50039 3.80011 3.90039 7.20011C2.70039 8.10011 1.70039 9.30011 0.900391 10.6001C1.10039 11.0001 1.40039 11.4001 1.70039 11.8001C5.00039 16.4001 11.3004 17.4001 15.9004 14.2001C16.8004 13.5001 17.6004 12.8001 18.3004 11.8001C18.6004 11.4001 18.8004 11.0001 19.1004 10.6001C18.8004 10.2001 18.6004 9.80011 18.3004 9.50011ZM10.1004 7.20011C10.6004 6.70011 11.4004 6.70011 11.9004 7.20011C12.4004 7.70011 12.4004 8.50011 11.9004 9.00011C11.4004 9.50011 10.6004 9.50011 10.1004 9.00011C9.60039 8.50011 9.60039 7.70011 10.1004 7.20011ZM10.0004 14.9001C6.90039 14.9001 4.00039 13.3001 2.30039 10.7001C3.50039 9.00011 5.10039 7.80011 7.00039 7.20011C6.30039 8.00011 6.00039 8.90011 6.00039 9.90011C6.00039 12.1001 7.70039 14.0001 10.0004 14.0001C12.2004 14.0001 14.1004 12.3001 14.1004 10.0001V9.90011C14.1004 8.90011 13.7004 7.90011 13.0004 7.20011C14.9004 7.80011 16.5004 9.00011 17.7004 10.7001C16.0004 13.3001 13.1004 14.9001 10.0004 14.9001Z" fill="black"/></g><defs><clipPath id="clip0_3019_1823"><rect width="20" height="20" fill="white"/></clipPath></defs></svg>';

    $('.admin-password').find("input").after(`<div class="js-admin-password">${dashicons_visibility}</div>`);
    $(document).on('click', '.js-admin-password', function () {
        let th = $(this);
        th.toggleClass('show-password');
        if (th.hasClass('show-password')) {
            th.parent().find('input').attr('type', 'text');
            th.html(dashicons_hidden);
            th.parent().find('div').attr('title', 'Скрыть пароль');
        } else {
            th.parent().find('input').attr('type', 'password');
            th.html(dashicons_visibility);
            th.parent().find('div').attr('title', 'Показать пароль');
        }
    });
    let admin_smtp = $('.admin-test-mail-smtp');
    if (admin_smtp.length) {
        admin_smtp.find(".acf-input").html(`<div class="test-mail-smtp-send">Проверка соединения</div><div class="test-mail-smtp-info"></div>`);
    }
    let admin_smtp_btn = admin_smtp.find('.test-mail-smtp-send');
    if (admin_smtp_btn.length) {
        $(document).on('click', '.admin-test-mail-smtp .test-mail-smtp-send', function () {
            let smtp_info = $('.test-mail-smtp-info');
            smtp_info.text('Загрузка...');
            smtp_info.removeClass('send-ok send-error');
            const ajax_url = "/wp-admin/admin-ajax.php";
            const data = {
                action: 'test_smtp_action',
                nonce: backend_admin_object.nonce
            };
            $.ajax({
                type: 'POST',
                url: ajax_url,
                dataType: 'json',
                data: data,
                success: function (data) {
                    let value = data.test_smtp_message;
                    if (value == 'OK') {
                        smtp_info.text('Соединение успешно установлено. Проверьте почту');
                        smtp_info.addClass('send-ok');
                        // console.log('OK');
                    }
                    else if (value == 'ERROR') {
                        smtp_info.text('Ошибка. Проверьте настройки');
                        smtp_info.addClass('send-error');
                        // console.log('ERROR');
                    }
                    else if (value == 'ERROR-NONCE') {
                        smtp_info.text('Ошибка. Функция wp_verify_nonce() не пройдена. Передайте эту информацию обслуживающей организации вашего сайта');
                        smtp_info.addClass('send-error');
                        // console.log('ERROR');
                    } else {
                        smtp_info.text('Ошибка. Неизвестная ошибка. Передайте эту информацию обслуживающей организации вашего сайта');
                        smtp_info.addClass('send-error');
                    }
                    return true;
                },
                error: function () {
                    // console.log(data);
                    smtp_info.text('Ошибка: ERROR-FILE-NOT-UPLOADED-AJAX');
                    smtp_info.addClass('send-error');
                    // console.log('ERROR-FILE-NOT-UPLOADED');
                    return false;
                }
            });

        });
    }


    if ($('.admin-specialization-list').length) {

        let first_item_list_prev = $('.admin-specialization-list .acf-input .acf-table .acf-row:not(.acf-clone):first');
        if (first_item_list_prev !== null) {

            setTimeout(function () {
                first_item_list_prev.find('.acf-field-taxonomy').css('pointer-events', 'none');
                first_item_list_prev.find('.acf-field-taxonomy .select2-selection__arrow').remove();
                first_item_list_prev.find('.acf-field-taxonomy .select2-selection__placeholder span').text('Все категории');
                let first_item_list_prev_title = first_item_list_prev.find('.acf-field-text input').val();
                if (first_item_list_prev_title == '') {
                    first_item_list_prev.find('.acf-field-text input').val('Все специалисты');
                }
                first_item_list_prev.find('.acf-field-taxonomy .select2-selection__placeholder span').css('color', '#444');

            }, 1000);
        }

        $(document).on('click', '.admin-specialization-list a.acf-repeater-add-row', function () {
            let check_list = $(this).parents('.acf-input').find('.acf-table .ui-sortable .acf-row:not(.acf-clone)');
            if (check_list !== null) {
                let first_item_list = $(this).parents('.acf-input').find('.acf-table .ui-sortable .acf-row:not(.acf-clone):first');
                first_item_list.find('.acf-field-taxonomy').css('pointer-events', 'none');
                first_item_list.find('.acf-field-taxonomy .select2-selection__arrow').remove();
                first_item_list.find('.acf-field-taxonomy .select2-selection__placeholder span').text('Все категории');
                first_item_list.find('.acf-field-taxonomy .select2-selection__placeholder span').css('color', '#444');
                first_item_list.find('.acf-field-text input').val('Все специалисты');
            }
        });

    }

    function change_admin_preview_img(th, val) {
        let dir = '/wp-content/themes/weblitex/assets/img/wp/backend/flexible-editor/';
        let block = th.parents('.layout').find('.display_type_preview');
        if (block.find('.admin-preview-img').length) {
            block.find('.admin-preview-img').remove();
        }
        block.find('.acf-input').append(`<img width="300" src="${dir}${val}.png" class="admin-preview-img"/>`);
    }

    let flexible_editor = $('.layout:not(.acf-clone) .display_type_flexible_editor');
    if (flexible_editor.length) {
        flexible_editor.each(function () {
            let th = $(this);
            let value = th.find(':selected').val();
            let new_value;
            if (value == 'editor') {
                new_value = th.parents('.layout').find('.group .display_type_editor select option:selected').val();
                change_admin_preview_img(th, new_value);
            } else if (value == 'types') {
                let check_types_filter = th.parents('.layout').find('.types_filter_on input[type="checkbox"]');
                if (check_types_filter.is(':checked')) {
                    new_value = 'types-filter';
                    change_admin_preview_img(th, new_value);
                } else {
                    change_admin_preview_img(th, value);
                }
            } else if (value == 'advantages') {
                new_value = th.parents('.layout').find('.group .display_type_advantages select option:selected').val();
                change_admin_preview_img(th, new_value);
            }
            else if (value == 'about-us') {
                // new_value = 'about-us';
                new_value = th.parents('.layout').find('.acf-field-group[data-name="about_us"] .acf-field-select[data-name="rows"] select option:selected').val();
                change_admin_preview_img(th, new_value);
                console.log(new_value);
            }

            else {
                change_admin_preview_img(th, value);
            }
        });
    }

    $(document).on('click', '.layout:not(.acf-clone) .display_type_flexible_editor select', function () {
        let th = $(this);
        let value = th.val();
        if (value == 'editor') {
            let new_value = th.parents('.layout').find('.group .display_type_editor select option:selected').val();
            change_admin_preview_img(th, new_value);
        } else if (value == 'types') {
            let check_types_filter = th.parents('.layout').find('.types_filter_on input[type="checkbox"]');
            if (check_types_filter.is(':checked')) {
                new_value = 'types-filter';
                change_admin_preview_img(th, new_value);
            } else {
                change_admin_preview_img(th, value);
            }
        } else if (value == 'advantages') {
            new_value = th.parents('.layout').find('.group .display_type_advantages select option:selected').val();
            change_admin_preview_img(th, new_value);
        }
        else if (value == 'about-us') {
            // new_value = 'about-us';
            new_value = th.parents('.layout').find('.acf-field-group[data-name="about_us"] .acf-field-select[data-name="rows"] select option:selected').val();
            change_admin_preview_img(th, new_value);
            console.log(new_value);
        }
        else {
            change_admin_preview_img(th, value);
        }
    });







    $(document).on('click', '.layout:not(.acf-clone) .group .display_type_editor select, .layout:not(.acf-clone) .group .display_type_advantages select', function () {
        let th = $(this);
        let value = th.val();
        change_admin_preview_img(th, value);
    });

    $(document).on('click', '.layout:not(.acf-clone) .about-us-selected select', function () {
        let th = $(this);
        let value = th.val();
        change_admin_preview_img(th, value);
    });


    $(document).on('click', '.layout:not(.acf-clone) .types_filter_on input[type="checkbox"]', function () {
        let th = $(this);
        let value;
        if (th.is(':checked')) {
            value = 'types-filter';
        } else {
            value = 'types';
        }
        change_admin_preview_img(th, value);
    });







    let edit_taxonomy = $('.term-php #wpbody .edit-tag-actions');
    if (edit_taxonomy.length) {
        let taxonomy_url = $('#wpadminbar #wp-admin-bar-view a').attr('href');
        $('.term-php #wpbody #edittag .form-table[role="presentation"]').before(`
        <table class="form-table my-custom-table">
            <tbody>
            <tr class="form-field">
                <th scope="row"></th>
                <td class="acf-input my-custom-field">
                    <div class="button button-primary js-update-taxonomy">Обновить</div>
                    <a class="preview button preview-category" href="${taxonomy_url}" target="_blank" >Просмотреть изменения</a>
                </td>
            </tr>
            </tbody>
        </table>`);
        $(document).on('click', '.js-update-taxonomy', function () {
            $(this).parents('#edittag').find('.edit-tag-actions .button-primary').trigger('click');
        });
    }

    function change_img_service_main() {
        let taxonomy_category = $('.taxonomy-category #wpbody #edittag, .taxonomy-category #wpbody #addtag');
        if (taxonomy_category.length) {
            let taxonomy_table = taxonomy_category.find('table.form-table[role="presentation"], .form-field.term-parent-wrap');
            let taxonomy_parent = taxonomy_table.find('#parent option:selected').val();
            if (taxonomy_parent !== '-1') {
                taxonomy_category.find('.category_img_service, .category_main_service, h2:eq(0)').addClass('d-hide');
            } else {
                taxonomy_category.find('.category_img_service, .category_main_service, h2:eq(0)').removeClass('d-hide');
            }
        }
    }
    change_img_service_main();
    $(document).on('change', '.taxonomy-category #parent', function () {
        change_img_service_main();
    });

    function change_vacancy() {
        let taxonomy_vacancy = $('.taxonomy-vacancy #wpbody #edittag, .taxonomy-vacancy #wpbody #addtag');
        if (taxonomy_vacancy.length) {
            let check_section_on = taxonomy_vacancy.find('.acf-field[data-name="section_on"] input[type="checkbox"]');
            if (check_section_on.is(':checked')) {
                check_section_on.parents('.form-table, .acf-fields').find('.acf-field-flexible-content').removeClass('d-hide');
            } else {
                check_section_on.parents('.form-table, .acf-fields').find('.acf-field-flexible-content').addClass('d-hide');
            }
        }
    }
    $(document).on('change', '.taxonomy-vacancy .acf-field[data-name="section_on"] input[type="checkbox"]', function () {
        change_vacancy();
    });
    change_vacancy();

});