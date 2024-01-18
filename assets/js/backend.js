function ajax_select() {
    $(document).on('click', '.js-sorting span', function () {
        let th = $(this);
        const ajax_url = "/wp-admin/admin-ajax.php";
        const parent = th.parents('.sorting');
        let block_print, data;
        let taxonomy = parent.data('taxonomy');
        if (!th.hasClass('selected')) {
            const type_filter = parent.data('type-filter');
            let terms = th.data('for');
            let count_from = parent.attr('data-count');
            let upload = parent.attr('data-upload');
            if (parent.data('type-filter') == 'doctors') {
                block_print = th.parents('section').find('.js-list-doctors');
                data = {
                    action: 'filter_action',
                    type_filter: type_filter,
                    terms: terms,
                    check_nonce: backend_object.check_nonce
                };
            } else if (parent.data('type-filter') == 'services') {

                if (taxonomy == 'category') {
                    let term_id = parent.data('term-id');
                    let index_row = parent.data('index-row');
                    block_print = $('.js-services');
                    data = {
                        action: 'filter_action',
                        type_filter: type_filter,
                        terms: terms,
                        check_nonce: backend_object.check_nonce,
                        taxonomy: taxonomy,
                        term_id: term_id,
                        index_row: index_row
                    };
                }
                else if (taxonomy == 'portfolio') {
                    block_print = $('.js-portfolio');
                    let uploaded = parent.attr('data-terms-uploaded');
                    let clear = 'false';
                    if (terms !== uploaded) {
                        clear = 'true';
                        parent.attr('data-clear', 'true');
                        parent.attr('data-count', 0);
                    } else {
                        clear = 'false';
                        parent.attr('data-clear', 'false');
                    }
                    data = {
                        action: 'filter_action',
                        type_filter: type_filter,
                        terms: terms,
                        check_nonce: backend_object.check_nonce,
                        taxonomy: taxonomy,
                        count: count_from,
                        upload: upload,
                        clear: clear
                    };
                }


            }
            $.ajax({
                beforeSend: function () {
                    th.addClass('loading');
                    parent.find('div:first').addClass('loading');
                },
                type: 'POST',
                url: ajax_url,
                dataType: 'json',
                data: data,
                success: function (data) {
                    let json_data = data.frontend_filter_message;
                    if (json_data !== 'ERROR-NONCE') {
                        if (parent.data('type-filter') == 'doctors') {
                            // if (json_data !== 'ERROR-NONCE') {
                            if (json_data.length !== 0) {
                                block_print.find('a').remove();
                                json_data.map(item => {
                                    let name = item['name'];
                                    let surname = item['surname'];
                                    let slug = item['slug'];
                                    let img = item['img'];
                                    let experience = item['experience'];
                                    let professions = item['professions'];
                                    let professions_array = [];
                                    professions.map(value => {
                                        professions_array += `<span data-for="${value['slug']}" class="doctor-card__nav_item">${value['title']}</span>`;
                                    });
                                    let content = `
                                        <a href="/doctors/${slug}" data-url-doctor="/doctors/${slug}" data-url-reviews="/doctors/${slug}/#reviews" class="doctor-card">
                                            <div class="doctor-card__wrapper">
                                                <div class="doctor-card__title">
                                                    <h2>${name} ${surname}</h2>
                                                </div>
                                                <div class="doctor-card__body">
                                                        <img class="doctor-card__body_img" src="${img}" alt="${name}"> 
                                                    <div class="doctor-card__body_info doctor-info js-reviews">
                                                        <span>${experience}</span>
                                                        <span class="doctor-info__reviews">Отзывы</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="doctor-card__nav">${professions_array}</div>
                                        </a>`;

                                    let selected_text = th.text();
                                    let selected_terms = item['selected-terms'];


                                    parent.find('div:first').text(selected_text);


                                    parent.find('span').removeClass('selected');
                                    // parent.find('span').removeAttr('class');
                                    parent.find(`span[data-for=${selected_terms}]`).addClass('selected');
                                    block_print.append(content);
                                });
                            }
                            else {
                                th.css({ 'display': 'none' });
                            }
                        }
                        if (parent.data('type-filter') == 'services') {
                            if (taxonomy == 'category') {
                                let link_html = '';
                                let link = '';
                                json_data.map(item => {
                                    let title_filter = item['title_filter'];
                                    let title = item['title'];
                                    link = item['link'];
                                    let img = item['img'];
                                    let editor = item['editor'];
                                    let selected_terms = item['selected-terms'];
                                    if (link !== null) {
                                        link_html = `<a href="${link}" class="btn-line">Подробнее</a>`;
                                    }
                                    let content = `<div class="block__img">
                                                <img src="${img}" alt="${title}">
                                            </div>
                                            <div class="block__descr">
                                                <h3>${title}</h3>
                                                ${editor}
                                                ${link_html}
                                            </div>`;
                                    // let selected_text = th.text();
                                    parent.find('div:first').text(title_filter);
                                    // parent.find('span').removeAttr('class');
                                    parent.find('span').removeClass('selected');
                                    parent.find(`span[data-for= ${selected_terms}]`).addClass('selected');
                                    block_print.html(content);
                                });
                            }
                            else if (taxonomy == 'portfolio') {
                                let btn_load = $('.js-load-portfolio'),
                                    clear_get = json_data['clear'],
                                    terms_uploaded = json_data['terms-uploaded'],
                                    list = json_data['list'],
                                    content_array = [],
                                    count_list = list.length;

                                list.map(item => {
                                    let doctors = item['doctors'],
                                        visits = item['visits'],
                                        cost = item['cost'],
                                        title = item['title'],
                                        editor = item['editor'],
                                        img_before = item['img_before'],
                                        img_after = item['img_after'],
                                        category_link = item['category_link'],
                                        category_title = item['category_title'];


                                    let doctors_content = [];
                                    doctors.map(value => {
                                        doctors_content += `
                                            <a href="${value['url']}" class="example__descr_item">
                                                <img src="${value['img']}" alt="${value['name']}">
                                                <div>
                                                    <h5>${value['name']}</h5>
                                                    <p>${value['term']}</p>
                                                </div>
                                            </a>
                                        `;
                                    });



                                    let content = `
                                        <div class="example">
                                            <div class="example__descr">
                                                <a class="example__descr_link" href="${category_link}">${category_title}</a>
                                                <h3>${title}</h3>
                                                <div class="example__descr_text">${editor}</div>
                                                <div class="example__descr_icon icon">
                                                    <span class="icon__clock">${visits}</span>
                                                    <span class="icon__price">${cost}</span>
                                                </div>
                                                <div class="example__descr_items">

                                                    ${doctors_content}



                                                </div>
                                            </div>
                                            <div class="example__img slider-before-after">
                                                <div class="slider-before-after__slider">
                                                    <div class="slider-before-after__before"><span></span>
                                                        <img src="${img_before}" alt="${title} до" style="width: 462px;">
                                                    </div>
                                                    <div class="slider-before-after__after">
                                                        <img src="${img_after}" alt="${title} после">
                                                    </div>
                                                    <div class="slider-before-after__change change">
                                                        <span class="change__before">до</span>
                                                        <span class="change__after">после</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    `;
                                    //doctors_content.length = 0;
                                    content_array += content;
                                });
                                if (clear_get == 'true') {
                                    block_print.find('div').remove();
                                    block_print.html(content_array);
                                    btn_load.removeClass('d-hide');
                                    if (parent.attr('data-count') == 0) {
                                        parent.attr('data-count', upload);
                                    }
                                } else {
                                    let new_count_from = parseFloat(count_from) + parseFloat(count_list);
                                    block_print.find('.example.last-item').after(content_array);
                                    parent.attr('data-count', new_count_from);
                                }

                                if (count_list == 0) {
                                    btn_load.addClass('d-hide');
                                }

                                parent.find('span').removeClass('selected');
                                parent.attr('data-terms-uploaded', terms_uploaded);
                                parent.find(`span[data-for= ${terms_uploaded}]`).addClass('selected');
                                if (btn_load.hasClass('loading')) {
                                    btn_load.removeClass('loading');
                                }
                                if (parseFloat(upload) !== count_list) {
                                    btn_load.addClass('d-hide');
                                }
                                change_portfolio();
                                //content_array.length = 0;
                                sliderBeforeAfter();
                            }

                        }
                    }

                    return true;
                },
                error: function () {
                    console.log('ERROR-FILE-NOT-UPLOADED-AJAX');
                    return false;
                }
            });
            setTimeout(function () {
                th.removeClass('loading');
                parent.find('div:first').removeClass('loading');
            }, 300);
        }
    });

    $(document).on('click', '.js-load-portfolio', function () {
        let th = $(this);
        th.addClass('loading');
        let filter = th.parents('main').find('.js-sorting[data-taxonomy="portfolio"]');
        filter.attr('data-clear', false);
        let terms_uploaded = filter.attr('data-terms-uploaded');
        filter.find(`.select-input span[data-for="${terms_uploaded}"]`).removeClass('selected');
        filter.find(`.select-input span[data-for="${terms_uploaded}"]`).trigger('click');
    });
}


ajax_select();

function change_portfolio() {
    let portfolio = $('.js-portfolio');
    if (portfolio.length) {
        portfolio.find('.example').removeClass('last-item');
        portfolio.find('.example:last').addClass('last-item');
    }
}
change_portfolio();


function change_feedback() {
    globaFeedbackEls();
    changeEl();
}

function ajax_load_content() {
    $(document).on('click', '.js-load-reviews', function () {
        let th = $(this);
        const ajax_url = "/wp-admin/admin-ajax.php";
        let block_print = th.parent().find('.js-wrapper-load-reviews');
        let count_from = th.parent().attr('data-count');
        let upload = th.parent().attr('data-upload');
        const data = {
            action: 'load_content_action',
            terms: 'reviews',
            count: count_from,
            upload: upload,
            check_nonce: backend_object.check_nonce
        };
        $.ajax({
            beforeSend: function () {
                th.addClass('loading');
                $('.full-feedback').addClass('loading');
            },
            type: 'POST',
            url: ajax_url,
            dataType: 'json',
            data: data,
            success: function (data) {
                let json_data = data.frontend_load_content;
                // console.log(json_data);
                if (json_data !== 'ERROR-NONCE') {
                    let count_json_data = json_data.length;
                    let new_count_from = parseFloat(count_from) + parseFloat(count_json_data);
                    if (count_json_data) {
                        json_data.map(item => {
                            let content_doctor = '';
                            let name = item['name'];
                            let doctor = item['doctor'];
                            let data = item['data'];
                            let count = item['count'];
                            let comment = item['comment'];
                            let source = item['source'];
                            let name_first_symbol = item['name_first_symbol'];
                            if (doctor) {
                                content_doctor = `<div class="feedback-card__descr_title line"><span>Лечащий врач:</span> ${doctor}</div>`;
                            }
                            let content = `
                                <div class="feedback-card js-feedback swiper-slide">
                                    <div class="feedback-card__title title">
                                        <div class="title__img" data-source="${source.value}>" data-text="${name_first_symbol}"></div>
                                        <h4 class="title__name">${name}</h4>
                                        <div class="title__star">
                                            <span class="title__star_content" data-count="${count}"></span>
                                            <span class="title__star_data">${data}</span>
                                        </div>
                                        <div class="title__source">${source.label}</div>
                                    </div>
                                    <div class="feedback-card__descr">
                                        ${content_doctor}
                                        <p class="line">${comment}</p>
                                    </div>
                                    <button class="feedback-card__btn">Показать полностью</button>
                                    <button class="feedback-card__popup">Показать полностью</button>
                                </div>`;
                            block_print.append(content);
                        });
                        block_print.find('div').removeClass('loading-item');
                        block_print.find('.feedback-card:last').addClass('loading-item');
                        th.parent().attr('data-count', new_count_from);
                        if (parseFloat(upload) !== count_json_data) {
                            th.addClass('d-hide');
                            block_print.find('div').removeClass('last-item loading-item');
                            block_print.find('.feedback-card:last').addClass('last-item');
                        }
                    }
                    change_feedback();
                }

                return true;
            },
            error: function () {
                // console.log('ERROR-FILE-NOT-UPLOADED-AJAX');
                return false;
            }
        });
        setTimeout(function () {
            th.removeClass('loading');
            $('.full-feedback').removeClass('loading');
        }, 300);
    });
}
ajax_load_content();

function my_redirect_url() {
    let my_redirect_url = $(document).find('.my_redirect_url');
    if (my_redirect_url.length) {
        let url_redirect = my_redirect_url.data('url');
        if (url_redirect) {
            window.location.replace(url_redirect);
        }
    }
}
my_redirect_url();

function mask_input() {
    $('input[type="tel"]').mask("+7 (999) 999-99-99", {
        autoclear: false
    });

}
mask_input();


function ajax_form() {

    function success_send(th, main, btn_return_text) {
        let el = th.find('.btn');
        let popup = th.parents('.popup');
        if (main) {
            if (el.hasClass('error-img')) {
                el.removeClass('error-img');
            }
            el.text('Отправлено');
            el.addClass('success');
            el.removeClass('preloader min-width');
            setTimeout(function () {
                th.trigger("reset");
                if (th.find('.input-file-list-img').length) {
                    $('.input-file-list-remove').trigger('click');
                }
            }, 1000);
            setTimeout(function () {
                el.text(btn_return_text);
                el.removeClass('success');
                el.removeAttr('style');
            }, 10000);
        } else {
            popup.find('.img-ok').removeClass('d-hide');
            popup.find('.img-err').addClass('d-hide');
            setTimeout(function () {
                el.removeClass('preloader');
                popup.find('.response .title').text('Заявка отправлена');
                popup.find('.response .subtitle').text('Совсем скоро мы свяжемся с вами');
                popup.find('.form-block__container').fadeOut(300);
                popup.find('.response').fadeIn(300);
                th.trigger("reset");
            }, 1000);
            setTimeout(function () {
                popup.find('.close').trigger('click');
                popup.find('.overlay').removeAttr('style');
                el.removeAttr('style');
            }, 5000);
            setTimeout(function () {
                popup.find('.form-block__container').fadeIn(300);
                popup.find('.response').fadeOut(300);
            }, 6000);
        }
        recollect(th);
    }

    function error_send(th, main, btn_return_text) {
        let el = th.find('.btn');
        let popup = th.parents('.popup');
        el.removeAttr('style');
        if (main) {
            setTimeout(function () {
                el.addClass('error');
                el.text('Ошибка');
                el.removeClass('preloader min-width');
                el.addClass('error-img');
            }, 1000);
            setTimeout(function () {
                el.text(btn_return_text);
                el.removeClass('error error-img');
            }, 10000);
        } else {
            popup.find('.img-ok').addClass('d-hide');
            popup.find('.img-err').removeClass('d-hide');
            setTimeout(function () {
                el.removeClass('preloader');
                popup.find('.response .title').text('Что-то пошло не так');
                popup.find('.response .subtitle').text('Не удалось отправить заявку. Пожалуйста, попробуйте снова');
                popup.find('.form-block__container').fadeOut(300);
                popup.find('.response').fadeIn(300);
            }, 1000);
            setTimeout(function () {
                popup.find('.form-block__container').fadeIn(300);
                popup.find('.response').fadeOut(300);
                popup.find('.overlay').removeAttr('style');
            }, 3000);

        }
    }

    let form = $('.form');
    if (form.length) {

        form.on("submit", function (e) {
            e.preventDefault();
            let th = $(this),
                btn = th.find('.btn'),
                btn_return_text = btn.attr('data-return-text'),
                main = false,
                form_comment = 'false',
                file = th.find('.input-file-list-img').attr('src');
            if (th.hasClass('form-main')) {
                main = true;
            }

            if (th.hasClass('form-comment')) {
                form_comment = 'true';
            }
            if (!file) {
                file = null;
            }



            let action = th.attr('action');
            const ajax_url = "/wp-admin/admin-ajax.php";
            $.ajax({
                beforeSend: function () {
                    th.find('.form__field').removeClass('error');
                    btn.addClass((main) ? 'preloader min-width' : 'preloader');
                    btn.css('pointer-events', 'none');
                    if (main) {
                        if (btn.hasClass('error-img')) {
                            btn.text(btn_return_text);
                            btn.removeClass('error-img');
                        }
                    } else {
                        th.parents('.popup').find('.overlay').css('pointer-events', 'none');
                    }

                },
                type: 'POST',
                url: ajax_url,
                dataType: 'json',
                data: th.serialize() + '&action=' + action + '&form_comment=' + form_comment + '&file=' + file,
                success: function (request, xhr, status, error) {
                    if (request.success == false) {
                        let data = request.data;
                        if (data) {
                            $.each(data, function (key) {
                                // console.log('key ' + key);
                                th.find(`[name = "${key}"]`).parent().addClass('error');
                            });

                            btn.removeAttr('style');
                        }
                        setTimeout(function () {
                            btn.removeClass((main) ? 'preloader min-width' : 'preloader');
                            th.find('.form__field.error:first input').focus();
                        }, 1000);
                    }
                    let json_data = request.frontend_form_message;
                    if (json_data !== 0) {
                        if ((json_data == 'OK')) {
                            let metrica_key = request.metrica_key;
                            let metrica_key_int = parseInt(metrica_key);
                            let metrica_value = request.metrica_value;
                            success_send(th, main, btn_return_text);
                            ym(metrica_key_int, 'reachGoal', metrica_value);
                        }
                        if (json_data == 'OK-COMMENT') {
                            let comment = th.find('textarea[name="message"]').val();
                            let post_id = th.find('input[name="comment_post_ID"]').val();
                            let email = th.find('input[name="email"]').val();
                            let name = th.find('input[name="name"]').val();
                            let phone = th.find('input[name="tel"]').val();
                            const data_comment = {
                                action: 'sendcomment',
                                comment: comment,
                                comment_post_ID: post_id,
                                email: email,
                                author: name,
                                phone: phone,
                                file: file,
                                comment_parent: 0,
                            };
                            $.ajax({
                                beforeSend: function () {
                                },
                                type: 'POST',
                                url: '/wp-admin/admin-ajax.php',
                                dataType: 'json',
                                data: data_comment,
                                success: function (request, xhr, status, error) {
                                    let json_data = request.frontend_form_message;
                                    if (json_data !== 0) {
                                        if ((json_data == 'OK')) {
                                            let metrica_key = request.metrica_key;
                                            let metrica_key_int = parseInt(metrica_key);
                                            let metrica_value = request.metrica_value;
                                            success_send(th, main, btn_return_text);
                                            ym(metrica_key_int, 'reachGoal', metrica_value);
                                        }
                                        if (json_data == 'ERROR') {
                                            // console.log(json_data);
                                            error_send(th, main, btn_return_text);
                                        }
                                    }
                                },
                                error: function () {
                                    console.log('ERROR-FILE');
                                    error_send(th, main, btn_return_text);
                                }
                            });
                        }
                        if (json_data == 'ERROR' || json_data == 'ERROR-NONCE') {
                            // console.log(json_data);
                            error_send(th, main, btn_return_text);
                        }
                    }
                },
                error: function () {
                    console.log('ERROR-FILE');
                    error_send(th, main, btn_return_text);
                }
            });
        });

        $(document).on('keyup', '.form input, .form textarea', function () {
            let th = $(this);
            let parent = th.parent('.form__field');
            if (parent.hasClass('error')) {
                parent.removeClass('error');
            }
        });



        function translationInput() {
            //Скрипт по мгновенному переводу с англ. на русс. язык
            var keyboard_layout = {
                "q": "й", "w": "ц", "e": "у", "r": "к", "t": "е", "y": "н", "u": "г", "i": "ш", "o": "щ", "p": "з", "[": "х", "]": "ъ", "a": "ф", "s": "ы", "d": "в", "f": "а", "g": "п", "h": "р", "j": "о", "k": "л", "l": "д", ";": "ж", "\'": "э", "z": "я", "x": "ч", "c": "с", "v": "м", "b": "и", "n": "т", "m": "ь", "Q": "Й", "W": "Ц", "E": "У", "R": "К", "T": "Е", "Y": "Н", "U": "Г", "I": "Ш", "O": "Щ", "P": "З", "{": "Х", "}": "Ъ", "A": "Ф", "S": "Ы", "D": "В", "F": "А", "G": "П", "H": "Р", "J": "О", "K": "Л", "L": "Д", ":": "Ж", "\"": "Э", "Z": "Я", "X": "Ч", "C": "С", "V": "М", "B": "И", "N": "Т", "M": "Ь", "<": "Б", ">": "Ю",
            };
            var search_input = $('input[type="text"], textarea[name="message"]');
            if (search_input.length > 0) {
                search_input.on('input', function () {
                    var val = '';
                    var ss = this.selectionStart;
                    for (var i = 0; i < this.value.length; i++) {
                        if (keyboard_layout[this.value[i]]) {
                            val += keyboard_layout[this.value[i]];
                        } else {
                            val += this.value[i];
                        }
                    }
                    this.value = val;
                    this.selectionStart = ss;
                    this.selectionEnd = ss;
                });
            }

        }
        translationInput();

    }
}
ajax_form();


function change_date_last_update() {
    let startDate = new Date('2022-05-01');  //устанавливаем дату начала интервала 
    let now = new Date(); //определяем текущую дату
    let delta = Math.trunc((+now - +startDate) / 7 / 24 / 3600 / 1000); // вычисляем количество трёхдневных интервалов которые прошли с момента startDate
    let resDate = startDate;
    resDate.setDate(resDate.getDate() + delta * 7);
    //итоговая дата -- это стартовая дата + количево вычислиных трёхдневных интервалов, вычисленных на предыдущем шаге, умноженые на 3
    let dateTag = document.querySelector('.price-prosthetics__time .js-last-update'); //находим тег, в котором должна оказаться новая дата
    dateTag.textContent = resDate.toLocaleString('ru', { day: '2-digit', month: '2-digit', year: 'numeric' });
}
if ($('.price-prosthetics__time .js-last-update').length) { change_date_last_update(); }

function change_date_ending_stocks() {
    let startDate = new Date('2022-05-01');
    let now = new Date();
    let delta = Math.trunc((+now - +startDate) / 10 / 24 / 3600 / 1000);
    let resDate = startDate;
    resDate.setDate(resDate.getDate() + delta * 10 + 23);
    //итоговая дата -- это стартовая дата + количево вычислиных трёхдневных интервалов, вычисленных на предыдущем шаге, умноженые на 3
    let dateTag = document.querySelectorAll('.table__value_data .js-ending-stocks'); //находим тег, в котором должна оказаться новая дата
    for (let elem of dateTag) {
        elem.textContent = resDate.toLocaleString('ru', { day: '2-digit', month: 'long' });
    }
}
if ($('.table__value_data .js-ending-stocks').length) { change_date_ending_stocks(); }
setTimeout(function () {
    let wpadminbar = $('div#wpadminbar');
    if (wpadminbar.length) {
        $('header').css('margin-top', '32px');
        $(window).on("load resize scroll", function (e) {
            let modal_height = $('div#wpadminbar').height();
            let check_header = $('header').attr('class');
            if ((!check_header) || (check_header == 'active')) {
                $('header').css('margin-top', modal_height);
                $('div#wpadminbar').css('position', 'fixed');
            } else { $('header').removeAttr('style'); }
        });
    }
}, 1000);



