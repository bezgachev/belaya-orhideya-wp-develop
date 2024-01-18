//Запоминаем
function remember(form) {
	let inpAct = [];
	let fInp = form.getElementsByTagName('input');
	let z = fInp.length;
	let kl;
	for (let i = 0; i < z; i++) {
		if ((fInp[i].type == 'text') ||
			(fInp[i].type == 'email') ||
			(fInp[i].type == 'number') ||
			(fInp[i].type == 'date') ||
			(fInp[i].type == 'month') ||
			(fInp[i].type == 'range') ||
			(fInp[i].type == 'tel') ||
			(fInp[i].type == 'search') ||
			(fInp[i].type == 'week') ||
			(fInp[i].type == 'datetime-local') ||
			(fInp[i].type == 'time') ||
			(fInp[i].type == 'color') ||
			(fInp[i].type == 'url')) {
			inpAct[inpAct.length] = fInp[i].value;
		} else if ((fInp[i].type == 'radio') ||
			(fInp[i].type == 'checkbox')) {
			if (fInp[i].checked) {
				kl = 1;
			} else {
				kl = 0;
			}
			inpAct[inpAct.length] = kl;
		} else {
			inpAct[inpAct.length] = "";
		}
	}
	localStorage.inpAct = JSON.stringify(inpAct);
	let textAct = [];
	let fText = form.getElementsByTagName('textarea');
	z = fText.length;
	for (let i = 0; i < z; i++) {
		textAct[textAct.length] = fText[i].value;
	}
	localStorage.textAct = JSON.stringify(textAct);
	let selAct = [];
	let fSel = form.getElementsByTagName('select');
	z = fSel.length;
	for (let i = 0; i < z; i++) {
		selAct[selAct.length] = fSel[i].value;
	}
	localStorage.selAct = JSON.stringify(selAct);
	localStorage.setItem('data_lifetime', Date.now());
}

//Вспоминаем
function recollect(form) {
	const data_lifetime = localStorage.getItem('data_lifetime');
	if (!data_lifetime || (+data_lifetime + 600000) < Date.now()) {
		localStorage.removeItem('inpAct');
		localStorage.removeItem('textAct');
		localStorage.removeItem('selAct');
		localStorage.removeItem('data_lifetime');
	}

	if (localStorage.inpAct != undefined) {
		let inpAct = [];
		inpAct = localStorage.inpAct ? JSON.parse(localStorage.inpAct) : [];
		let fInp = form.getElementsByTagName('input');
		let z = fInp.length;
		for (let i = 0; i < z; i++) {
			if ((fInp[i].type == 'text') ||
				(fInp[i].type == 'email') ||
				(fInp[i].type == 'number') ||
				(fInp[i].type == 'date') ||
				(fInp[i].type == 'month') ||
				(fInp[i].type == 'range') ||
				(fInp[i].type == 'tel') ||
				(fInp[i].type == 'search') ||
				(fInp[i].type == 'week') ||
				(fInp[i].type == 'datetime-local') ||
				(fInp[i].type == 'time') ||
				(fInp[i].type == 'color') ||
				(fInp[i].type == 'url')) {
				fInp[i].value = inpAct[i];
			} else if ((fInp[i].type == 'radio') ||
				(fInp[i].type == 'checkbox')) {
				fInp[i].checked = inpAct[i];
			}
		}
	}

	if (localStorage.textAct != undefined) {
		let textAct = [];
		textAct = localStorage.textAct ? JSON.parse(localStorage.textAct) : [];
		let fText = form.getElementsByTagName('textarea');
		let z = fText.length;
		for (let i = 0; i < z; i++) {
			fText[i].value = textAct[i];
		}
	}
	if (localStorage.selAct != undefined) {
		let selAct = [];
		selAct = localStorage.selAct ? JSON.parse(localStorage.selAct) : [];
		let fSel = form.getElementsByTagName('select');
		let z = fSel.length;
		for (let i = 0; i < z; i++) {
			fSel[i].value = selAct[i];
		}
	}
}

$(function () {
	const scrollController = {
		fScrollTop: $('html'),
		header: $('header'),
		disabledScroll() {
			let scrolled = $(window).scrollTop();
			localStorage.setItem('whiteOrchidScrollTop', scrolled);
			scrollController.fScrollTop.scrollTop(scrolled);

			let scrollWidth = window.innerWidth - document.documentElement.clientWidth;
			scrollController.header.css({
				paddingRight: `${scrollWidth}px`
			});
			scrollController.fScrollTop.css({
				overflow: "hidden",
				paddingRight: `${scrollWidth}px`
			});

		},
		startScroll() {
			scrollController.fScrollTop.removeAttr('style');
			scrollController.header.removeAttr('style');
			setTimeout(() => {
				localStorage.removeItem('whiteOrchidScrollTop');
			}, 200);
		}
	}
	//scrollController.startScroll();
	//scrollController.disabledScroll();

	const
		btnOpenPopup = $('.js-popup'),
		popupBody = $('.popup'),
		btnClose = $('.popup .close'),

		title = $('.popup .form-content_title'),
		subtitle = $('.popup .form-content_descr'),
		btn_title = $('.popup .form__submit .btn');

	//открытия попапа

	function popupOpen(event) {


		//*получаю массив значений для попапа
		let arrayValuePopup = $(this).data('settings');
		arrayValuePopup = JSON.parse(atob(arrayValuePopup));
		// console.log(arrayValuePopup);

		const { title: titleText, subtitle: subtitleText, fields, hidden, section_class: sectionClass, btn_title: btnTitleText } = arrayValuePopup;

		const select = fields.select;

		let select_s = {};
		if ((select !== undefined)) {
			select_s = select.options.map((item, index) => {
				return `
					<span data-for="${index + 1}">${item}</span>
				`;
			});
		}

		//*добовляет класс
		popupBody
			.removeClass()
			.addClass('form-block popup')
			.addClass(sectionClass);

		//*удаляем все поля
		$('.popup .form__field').detach();
		$('.popup .sorting').detach();
		$('.popup .score').detach();
		// перебираем элементы массива fields

		$.each(fields, function (key, field) {
			$('.popup .form__hidden').before(function () {
				if (key === 'message') {
					return $(`
						<div class="form__field">
							<textarea type="${field.type}" name="${key}" placeholder='${field.placeholder}'></textarea>
						</div>
						`)
				}
				else if (key === 'select') {
					return $(`
						<div class="sorting">
							<div class="select-css  ">${field.placeholder}</div>
							<div class="select-input">
								${select_s.join('')}
							</div>
							<input type="hidden" name="sorting" />
						</div>
						`)
				}
				else if (key === 'rating') {
					let string = '';
					let i = 5;
					while (i) {
						string += `
							<input id="simple-rating__${i}" type="radio" class="simple-rating__item" name="simple-rating" value="${i}">
							<label for="simple-rating__${i}" class="simple-rating__label"></label>
						`;
						i--;
					}
					return $(`
								<div class="score">
									<div class="score__descr"> <span class="score__descr_title">Оценка:</span>
										<div class="simple-rating">
											<div class="simple-rating__items">
												${string}
											</div>
										</div>
									</div>
								</div>
								`);
				}
				else {
					if (field.required === true) {
						return $(`
							<div class="form__field tooltiper">
								<span class="tooltip">Обязательное поле</span>
								<input type="${field.type}" name="${key}" placeholder="${field.placeholder}">
							</div>
						`)
					} else {
						return $(`
							<div class="form__field">
								<input type="${field.type}" name="${key}" placeholder="${field.placeholder}">
							</div>
						`)
					}
				}
			});
		});

		//*добовляет поля информации
		$('.popup .form__hidden').empty();
		for (const key in hidden) {
			$('.popup .form__hidden').append(function () {
				return $(`
					<input type="hidden" name="${key}" value="${hidden[key]}">
				`)
			})
		}

		//*Выводим поля
		title.text(titleText);
		subtitle.text(subtitleText);
		btn_title.text(btnTitleText);
		scrollController.disabledScroll();
		popupBody.fadeIn(300);

		recollect(document.getElementById('popup-form'));
	}



	//*закрытия попапа
	function popupClose(event) {
		popupBody.fadeOut();
		$('.form-wrapper').css('margin-left', '4px');
		scrollController.startScroll();
		//*удаляем добавленные классы

		setTimeout(() => popupBody.removeClass().addClass('form-block popup'), 500);
		setTimeout(() => $('.form-wrapper').css('margin-left', '0px'), 500);

		remember(document.getElementById('popup-form'));
	}

	//*вызов функциий кликом
	btnOpenPopup.on('click', popupOpen);
	$('.popup > .overlay').on('click', popupClose);
	btnClose.on('click', popupClose);
});