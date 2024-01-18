//функция изменения ширины экрана
function checkingMatchMedia(minScreenWidths = 991, trueFuncName, falseFuncName) {
	// const mediaQuery = window.matchMedia('(min-width: 991px)');
	const mediaQuery = window.matchMedia(`(min-width: ${minScreenWidths}px)`);
	function handleTabletChange(e) {
		// Проверить, что media query будет true
		if (e.matches) {
			trueFuncName();
			// //console.log(`функция работае до ${minScreenWidths}`);
		}
		else {
			// //console.log(`мобилка - меньше ${minScreenWidths}`);
			falseFuncName();
		}
	}
	mediaQuery.addListener(handleTabletChange); // Слушать события
	handleTabletChange(mediaQuery); // Начальная проверка
}
//определяем устройство
let isMobile = false; //initiate as false
// device detection
if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
	|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
	isMobile = true;
	// //console.log('телефон');
}

// let el = $('.feedback-card');

// function funChangeEl() {
// 	el.each(function () {
// 		th = $(this)
// 		function changeEl() {
// 			const elValName = th.find(elName).text()[0];
// 			const elValSource = th.find(elSource).text();

// 			th.find(elImg).text(elValName);
// 			// изменение даta атрибута в зависимости от запроса
// 			switch (elValSource) {
// 				case 'ПроДокторов':
// 					th.find(elImg).attr('data-source', 'prodoctors');
// 					break;
// 				case 'Google':
// 					th.find(elImg).attr('data-source', 'google');
// 					break;
// 				case '2gis':
// 					th.find(elImg).attr('data-source', 'gis');
// 					break;
// 				case 'Yandex':
// 					th.find(elImg).attr('data-source', 'yandex');
// 					break;
// 			}
// 		} changeEl();
// 	});
// }

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

	function maskeinput() {
		$('input[type="tel"]').mask("+7 (999) 999-99-99", {
			autoclear: false
		});

		$('.js-popup').on('click', function () {
			setTimeout(function () {
				$('input[type="tel"]').mask("+7 (999) 999-99-99", {
					autoclear: false
				});
			}, 500);
		});


		$(document).on('click', 'input[type=tel]', function () {
			$('input[type=tel]').removeClass('invalid');
			$('input[type=tel]').on("blur", function () {
				var phone_val = $(this).val();
				var clean_str_phone = phone_val.replace(/[^0-9]/g, '');
				if (+clean_str_phone.length === 11) {
					// ////console.log('отправка');
					$(this).removeClass('invalid');
				} else {
					// ////console.log('ошибка');
					$(this).addClass('invalid');
				}
			});
		});
	} maskeinput();

	function translationInput() {
		//Скрипт по мгновенному переводу с англ. на русс. язык
		$(document).ready(function () {
			var keyboard_layout = {
				"q": "й", "w": "ц", "e": "у", "r": "к", "t": "е", "y": "н", "u": "г", "i": "ш", "o": "щ", "p": "з", "[": "х", "]": "ъ", "a": "ф", "s": "ы", "d": "в", "f": "а", "g": "п", "h": "р", "j": "о", "k": "л", "l": "д", ";": "ж", "\'": "э", "z": "я", "x": "ч", "c": "с", "v": "м", "b": "и", "n": "т", "m": "ь", ",": "б", ".": "ю", "Q": "Й", "W": "Ц", "E": "У", "R": "К", "T": "Е", "Y": "Н", "U": "Г", "I": "Ш", "O": "Щ", "P": "З", "{": "Х", "}": "Ъ", "A": "Ф", "S": "Ы", "D": "В", "F": "А", "G": "П", "H": "Р", "J": "О", "K": "Л", "L": "Д", ":": "Ж", "\"": "Э", "Z": "Я", "X": "Ч", "C": "С", "V": "М", "B": "И", "N": "Т", "M": "Ь", "<": "Б", ">": "Ю",
			};
			var search_input = $('form input[type=text], form textarea');
			search_input.on('input', function () {
				var val = '';
				var ss = this.selectionStart;
				for (var i = 0; i < this.value.length; i++) {
					if (keyboard_layout[this.value[i]]) {
						val += keyboard_layout[this.value[i]];
					}
					else {
						val += this.value[i];
					}
				}
				this.value = val;
				this.selectionStart = ss;
				this.selectionEnd = ss;
			});
		});
	}
	//translationInput();


	function btnUp() {
		$(window).scroll(function () {
			if ($(this).scrollTop() >= 1000) {
				$('#scroll_top').fadeIn();
			} else {
				$('#scroll_top').fadeOut();
			}
		});
		$('#scroll_top').click(function () {
			$('body,html').animate({ scrollTop: 0 }, 800);
		});
	}; btnUp();


	function addAndRemoveClassActiveFunc() {
		$(this)
			.addClass('active')
			.siblings()
			.removeClass('active');
	}

	const tabsFunc = function (tab, tabs, content) {
		// const tab = '.tab';
		// const content = $('.content');
		const setTabs = $(tab);

		tabs.on('click', tab, function () {
			// //console.log('click tab')
			let indexTab = setTabs.index(this);
			$(this)
				.addClass('active')
				.siblings()
				.removeClass('active');
			content.each(function (index) {
				if (indexTab === index) {
					$(this)
						.addClass('active')
						.siblings()
						.removeClass('active');
				}
			});
		});
	}

	const triggerClickFirsEl = function (el) {
		el.first().trigger('click');
	}

	function headerTabsMenu() {
		const btnNavHeader = $('.header__link, .burger');
		const tabs = $('.tab-header');
		const allContent = $('.content-header');
		const btnCloseMenu = $('.close-menu');
		const overlayHeader = $('.header-overlay');

		function tabsFindСlick() {
			if (!$(this).hasClass('link')) {
				overlayHeader.fadeIn(300);
			}

			$(this)
				.addClass('active')
				.siblings()
				.removeClass('active');
			let indexTab = tabs.index(this);

			allContent.each(function (index) {
				if (indexTab === index) {
					$(this)
						.addClass('active')
						.siblings()
						.removeClass('active');
				}
			});
		}

		function btnCloseMenuFun(event) {
			event.stopPropagation();
			btnNavHeader.removeClass('active');
			overlayHeader.fadeOut(300);
			if ($('.burger').hasClass('active')) {
				$('.burger').removeClass('active');
			}
		}


		tabs.on('mouseenter click', tabsFindСlick);
		btnNavHeader.on('mouseenter click', tabsFindСlick);
		overlayHeader.on('mouseenter click', btnCloseMenuFun);

		btnCloseMenu.on('click', btnCloseMenuFun);


		$('.header__body').on('mouseenter', function () {
			if (btnNavHeader.hasClass('active')) {
				btnNavHeader.removeClass('active');
				overlayHeader.fadeOut(300);
				if ($('.burger').hasClass('active')) {
					$('.burger').removeClass('active');
				}
			}
		});

	} headerTabsMenu();

	function headerMob() {
		const
			mobileBurger = $('.mobile-burger'),
			mobileBody = $('.header-mobile__nav');

		function burgerOpen() {
			mobileBody.fadeIn(300);
			mobileBurger.addClass('open');
			scrollController.disabledScroll();
		}

		const burgerClose = () => {
			mobileBody.fadeOut(300);
			scrollController.startScroll();
			mobileBurger.removeClass('open');
			$('.mob-tabs').removeClass('active');
		}

		function burger() {
			if (mobileBurger.hasClass('open')) {
				burgerClose();
			} else {
				burgerOpen();
			}
		}
		mobileBurger.on('click', burger);
		checkingMatchMedia(575, burgerClose, burgerClose);
	} headerMob();

	function headerMobInside() {
		const
			mobTabs = $('.mob-tabs li'),
			mobContents = $('.mob-contents > ul'),
			mobContentFind = $('.mob-contents ul li'),
			btnBack = $('.back');

		let indexTab;

		mobTabs.on('click', function () {
			$(this).parent().addClass('active');
			$(this).addClass('active');
			indexTab = mobTabs.index(this);
			mobContents.each(function (index) {
				if (indexTab === index) {
					$(this)
						.addClass('active')
						.siblings()
						.removeClass('active');
				}
			});
		});

		mobContentFind.on('click', function () {
			$(this)
				.addClass('active')
				.siblings()
				.removeClass('active');
		});

		function back() {
			mobTabs.parent().removeClass('active');
			mobContentFind.removeClass('active');
			$(this).parents('ul').removeClass('active');
		}
		btnBack.on('click', back);
	} headerMobInside()

	function headerOpenTel() {
		const btnTel = $('.header__tel.icon');
		function openTel() {
			if (isMobile = true) {
				btnTel.toggleClass('active');
			}
		}
		btnTel.on('click', openTel);
		$(window).scroll(function () {
			if ($(this).scrollTop() >= 500) {
				btnTel.removeClass('active');
			}
		});
	} headerOpenTel();

	function footerNav() {
		const addClassActiveFooter = () => {
			$('.footer__item').click(function () {
				// //console.log('click')
				$(this).addClass('active');
				$('.footer__item').not(this).removeClass('active');
			})
		}
		const removeClassActiveFooter = () => {
			$('.footer__item').removeClass('active');
		}
		checkingMatchMedia(575, removeClassActiveFooter, addClassActiveFooter);
	} footerNav();

	function showHeaderWhenScrolling() {
		// Показ и скрытие header
		const header = $('header');
		let windowHeight = window.pageYOffset;
		scrollPrev = 0;

		$(window).on('ready load scroll', function () {
			const scrolled = $(window).scrollTop();

			if (windowHeight > 100) {
				header.addClass('hide');
				$('.header__link').removeClass('active');
			}

			// if ((windowHeight > 100) || (scrolled > 15 && scrolled > scrollPrev)) {
			if (scrolled > 15 && scrolled > scrollPrev) {
				header.addClass('hide');
				$('.header__link').removeClass('active');
			} else {
				header.removeClass('hide');
			}

			scrollPrev = scrolled;
			if (scrolled < 60) {
				header.removeClass('active');
			} else {
				header.addClass('active');
			};

		});




	} showHeaderWhenScrolling();

	//изменение nav header
	function resizeHeaderNav() {
		const headerNav = $('.header__link');
		let elBurger = $('.burger .dropdown ul li').last();

		headerNav.each(function (el) {
			if (!$(this).children().hasClass('dropdown') && !$(this).parents().hasClass('burger')) {
				$(this).addClass('link');
			}
		});

		const navs = $('.header__link.link');
		navs.clone().insertAfter(elBurger);

		let elBurgers = $('.burger .dropdown ul li');

		elBurgers.each(function (el) {
			if ($(this).hasClass('header__link')) {
				$(this).removeClass('header__link link')
			}
		});
	} resizeHeaderNav();

	// Tabs главная страница -- комплекс услуг в одном месте --
	function tabsContent() {
		let Tubs = function () {

			const setTabContent = $('.complex-services__tabs_content .tab-content');
			const tab = '.tab-title';
			const setTabs = $(tab);
			const tabs = $('.tabs');


			$(window).on('load resize', function () {
				triggerClickFirsEl(setTabs);
			});

			tabsFunc(tab, tabs, setTabContent);
		};

		let Akardion = function () {
			const lists = $('.tabs');
			const content = $('.tab-content');

			lists.find('div').removeClass('active');

			$(window).on('load resize', function () {
				content.first().trigger('click');
			});

			content.click(function () {
				$(this).addClass('active');
				content.not(this).removeClass('active');
			})
		};

		checkingMatchMedia(675, Tubs, Akardion);
	} tabsContent();

	function showTooltiper() {
		$('.table__icon').on('click', function () {
			$(this).toggleClass('active');
		})

		$(window).scroll(function () {
			if ($('.table__icon').hasClass('active')) {
				$('.table__icon').removeClass('active');
			}
		});
	} if ($('.table__icon').length > 0) { showTooltiper(); }


	//страница вакансий, если вакансий нет, добовляется класс для отступов
	if ($('.page-screen__alert').length > 0) {
		$('.page-screen').addClass('margin');
	}
	//перемещение блока
	$(window).on('load resize', function () {
		if (document.documentElement.clientWidth < 992) {
			$('.reviews__title').insertAfter('.reviews__nav');
		}
		else {
			$('.reviews__title').insertAfter('.reviews__wrapper');
		}

		if (document.documentElement.clientWidth < 780) {
			$('.specialist__image').insertAfter('.specialist__title .btn');
		}
		else {
			$('.specialist__image').insertAfter('.specialist__body');
		}
	});

	if ($('.doctor-info__reviews').length > 0) {
		$(".js-list-doctors .doctor-info__reviews").hover(function () {
			// задаем функцию при наведении курсора на элемент
			let th_card = $(this).parents('a.doctor-card');
			th_card.attr('href', th_card.attr('data-url-reviews'));
		}, function () {
			// задаем функцию, которая срабатывает, когда указатель выходит из элемента
			let th_card = $(this).parents('a.doctor-card');
			th_card.attr('href', th_card.attr('data-url-doctor'));
		});
	}

	function onScrollAnimate() {
		$("a.scroll-to").on("click", function (e) {
			e.preventDefault();
			var anchor = $(this).attr('href');
			$('html, body').stop().animate({
				scrollTop: $(anchor).offset().top
			}, {
				duration: 1000,   // по умолчанию «400»
				easing: "linear" // по умолчанию «swing»
			});
		});
	}

	function onScroll(event) {
		var scrollPos = $(document).scrollTop();
		if ($('.nav__item').length) {
			const element = $('.anchor');
			element.each(function () {
				let refElement = $(this);
				if (refElement.offset().top - 200 <= scrollPos && refElement.offset().top + refElement.height() > scrollPos) {
					let clickId = $(this).attr('id');

					let getIdEl = clickId.split('');
					getIdEl = ['#', ...getIdEl];
					getIdEl = getIdEl.join('');

					const elementLink = $('.scroll-to');

					elementLink.each(function () {
						let refElementLink = $(this).attr('href');
						if (refElementLink == getIdEl) {
							$('.nav__item ul li').removeClass('active');
							$(this).parent().addClass('active');
							$(this).parents('.nav__item')
								.addClass('active')
								.siblings()
								.removeClass('active');
						}
					});
				}
			});
		}
	}

	// навигация в странице цены до 992 комп
	function priseNav() {
		// //console.log('комп');
		onScrollAnimate();
		$(document).on('scroll', onScroll);

		$('.nav__item ul li').on('click', addAndRemoveClassActiveFunc);
		$('.nav__item').on('click', addAndRemoveClassActiveFunc);

		const header = $('.price-catalog__nav');
		scrollPrev = 0;

		$(window).on('ready load scroll', function () {
			const scrolled = $(window).scrollTop();
			if (scrolled > 15 && scrolled > scrollPrev) {
				header.removeClass('active');
			} else {
				header.addClass('active');
			}
		});
	}

	//Страница цен - выбрать услугу мобилка
	function chooseService() {
		onScrollAnimate();

		// setTimeout(onScrollAnimate, 2000);
		let indexTab;
		const
			btn = $('.price-catalog-nav > button'),
			tab = $('.nav__item'),
			contents = $('.nav-mob__content ul'),
			content = $('.nav-mob__content ul li a'),
			body = $('.price-catalog-nav');

		function roll() {
			body.removeClass('active');
		}

		function toggleChooseService() {
			console.log('click');

			if (!body.hasClass('roll') && body.hasClass('active')) {
				// console.log('не имеет roll и есть active');
				body.removeClass('active');
			}
			else if (!body.hasClass('roll')) {
				// console.log('не имеет roll');
				body.removeClass('roll');
				body.addClass('active');
			}
			else {
				// console.log('иначе');
				body.toggleClass('active');
				body.removeClass('roll');
			}
		}

		tab.on('click', function (e) {
			e.stopPropagation();
			e.preventDefault();
			indexTab = $(this).index();
			contents.each(function (index) {
				if (indexTab === index) {
					$(this)
						.addClass('active')
						.siblings()
						.removeClass('active');
				}
			});
		});

		btn.on('click', toggleChooseService);
		tab.on('click', addAndRemoveClassActiveFunc);
		content.on('click', roll);
		$(window).scroll(function () {
			if ($(this).scrollTop() >= 1000 && !body.hasClass('active')) {
				body.addClass('roll');
			}
		});
	}


	if ($('.price-catalog-nav').length > 0) {
		checkingMatchMedia(992, priseNav, chooseService);
	}


	//---------------------------------------------------

	//функия показать еще фото в фотогалереи
	function showPhoto() {
		$('.gallery__item').slice(0, 10).addClass('active');
		const a = $('.gallery__item').length
		let b = $('.gallery__item.active').length

		if (a == b) {
			$('.show-photo').addClass('d-hide')
		}

		$('.show-photo').on('click', function () {
			$('.gallery__item:not(.active)').slice(0, 10).addClass('active');
			b = $('.gallery__item.active').length
			if (a == b) {
				$('.show-photo').addClass('d-hide')
			}
		});
	}
	if ($('.gallery').length) { showPhoto(); }


	function askSocial() {
		const
			btnAskSocial = $('.ask-social__btn'),
			bodyAskSocial = $('.ask-social__body'),
			overlayAskSocial = $('.ask-social__overlay'),
			btnClose = $('.ask-social .close');

		function closeAskSocial() {
			$('.ask-social__overlay').fadeOut(300);
			$('.ask-social__body').fadeOut(300);
		}
		function openAskSocial() {
			$('.ask-social__overlay').fadeIn(300);
			$('.ask-social__body').fadeIn(300);
		}

		btnAskSocial.on('mouseenter click', openAskSocial);
		btnClose.on('click', closeAskSocial);
		overlayAskSocial.on('click', closeAskSocial);
	}
	if ($('.ask-social').length) { askSocial(); }



	// ************************ select ***************** //
	function select() {

		$(document).mouseup(function (e) { // событие клика по веб-документу
			var div = $(".sorting .select-css"); // тут указываем ID элемента
			if (!div.is(e.target) // если клик был не по нашему блоку
				&& div.has(e.target).length === 0) { // и не по его дочерним элементам
				$('.select-input').removeClass('show');
				$('.select-css').removeClass('active');
			}
		});

		$(document).on('click', '.sorting .select-css', function () {
			$(this).parent().find('.select-input').toggleClass('show');
			$(this).toggleClass('active');

			if ($('.sorting').parents().hasClass('popup') && $('.select-input').hasClass('show')) {
				$('.popup').on('click', function (event) {

					let selectTitle = event.target.getAttribute('data-for');
					if (selectTitle !== null) {
						let textContent = $(`[data-for="${selectTitle}"]`).text();
						$(this).find('.select-css').text(textContent);
						$(this).find('[name="option_select"]').val(textContent);
						$('.popup .select-css').addClass('color');

					}
				});
			}
		});


		const sortingBlockChanges = () => {
			if ($('.sorting').parent().hasClass('nav-block')) {
				$('.sorting').addClass('grid');
				$('.select-input').addClass('show');
				$('.select-css').addClass('d-hide');
			} else {
				$('.sorting').removeClass('grid');
				$('.select-input').removeClass('show');
				$('.select-css').removeClass('d-hide');
			}
		}

		const addClass = () => {
			$('.filter').addClass('nav-block');
			sortingBlockChanges();
		}

		const removeClass = () => {
			$('.filter').removeClass('nav-block');
			sortingBlockChanges();
		}
		checkingMatchMedia(575, addClass, removeClass);
	}
	select();



	//карточка отзыва убираем и показываем кнопку показать полностью в зависимости от велечены отзыва
	// if ($('.feedback-card__descr').length) {

	//определяем с какой буквы начинается имя и вставляем данную букву в кружочек
	globaFeedbackEls = function () {
		el = $('.feedback-card');
		elClose = $('.full-feedback-close');
		elFull = $('.full-feedback');
		elImg = $('.title__img');
		elName = $('.title__name');
		elStar = $('.title__star_content');
		elData = $('.title__star_data');
		elSource = $('.title__source');
		elText = $('.feedback-card__descr p');
		elTextTitle = $('.feedback-card__descr_title');
	}
	globaFeedbackEls();

	//буквы
	changeEl = function () {
		el.each(function () {
			th = $(this)
			// const elValName = th.find(elName).trim().text()[0];
			const elValName = th.find(elImg).attr('data-text');
			const elValSource = th.find(elSource).text();



			th.find(elImg).text(elValName);
			// изменение даta атрибута в зависимости от запроса
			switch (elValSource) {
				case 'ПроДокторов':
					th.find(elImg).attr('data-source', 'prodoctors');
					break;
				case 'Google':
					th.find(elImg).attr('data-source', 'google');
					break;
				case '2gis':
					th.find(elImg).attr('data-source', 'gis');
					break;
				case 'Yandex':
					th.find(elImg).attr('data-source', 'yandex');
					break;
			}
		});
	}
	changeEl();

	function clearElFull() {
		elFull.find(elImg).empty();
		elFull.find(elName).empty();
		elFull.find(elStar).empty();
		elFull.find(elStar).removeData();
		elFull.find(elData).empty();
		elFull.find(elSource).empty();
		elFull.find(elTextTitle).empty();
	}

	let feedbackCardDesktop = function () {
		const items = $('.feedback-card__descr');
		items.each(function () {
			th = $(this).find('div');

			if ($('main').hasClass('page-18')) {
				heightFeedback = $(this).find('p').height();
				if (heightFeedback < 99) {
					$(this).parent('.feedback-card').find('button').css("display", "none");
				} else {
					$(this).parent('.feedback-card').find('button').removeAttr('style');
				}
				// $(window).on('load resize', function () {});
				if (th.length) {
					$(this).find('p').css("-webkit-line-clamp", "5");
					if (heightFeedback < 110) {
						$(this).parent('.feedback-card').find('button').css("display", "none");
					} else {
						$(this).parent('.feedback-card').find('button').removeAttr('style');
					}
				}
			} else {
				heightFeedbackSlaider = $(this).find('p.line').text().length;
				if (heightFeedbackSlaider < 200) {
					$(this).parent('.feedback-card').find('button').css("display", "none");
				} else {
					$(this).parent('.feedback-card').find('button').removeAttr('style');
				}
				// $(window).on('load resize', function () {});
				if (th.length) {
					$(this).find('p').css("-webkit-line-clamp", "5");
					if (heightFeedbackSlaider < 201) {
						$(this).parent('.feedback-card').find('button').css("display", "none");
					} else {
						$(this).parent('.feedback-card').find('button').removeAttr('style');
					}
				}
			}
		});


		let copyEl;
		// $('.js-feedback').on('click', function () {
		$(document).on('click', '.js-feedback', function () {
			$('.full-feedback .feedback-card__descr p').css("-webkit-line-clamp", "inherit");

			if ($(this).hasClass('full-feedback-next')) {
				clearElFull();
				copyEl = $('.feedback-card.active').next();
				el.removeClass('active');
			}
			else if ($(this).hasClass('full-feedback-prev')) {
				clearElFull();
				copyEl = $('.feedback-card.active').prev();
				el.removeClass('active');
			}
			else {
				clearElFull();
				scrollController.disabledScroll();
				$('header').css('z-index', '10');
				elFull.show();
				copyEl = $(this);
			}
			copyEl.addClass('active');

			if (copyEl.hasClass('first-item')) {
				$('.full-feedback-prev')
					.css('opacity', '.3')
					.css('pointer-events', 'none');
			} else {
				$('.full-feedback-prev')
					.css('opacity', '1')
					.css('pointer-events', 'auto');
			}

			if (copyEl.hasClass('last-item')) {
				$('.full-feedback-next')
					.css('opacity', '.3')
					.css('pointer-events', 'none');


			} else {
				$('.full-feedback-next')
					.css('opacity', '1')
					.css('pointer-events', 'auto');
			}

			if (copyEl.hasClass('loading-item')) {
				$('.js-load-reviews').trigger('click');
			}

			elFull.swipe({
				swipeStatus: function (event, phase, direction) {
					if (phase == "end") {
						if (direction == 'left') {
							if (!copyEl.hasClass('last-item')) {
								$(".js-feedback.full-feedback-next").trigger("click");
							}
						}
						if (direction == 'right') {
							if (!copyEl.hasClass('first-item')) {
								$(".js-feedback.full-feedback-prev").trigger("click");
							}
						}
					}
					threshold: 0 // сработает через 20 пикселей
				}
			});

			let changeEl = {
				img: copyEl.find(elImg).data('source'),
				iconName: copyEl.find(elImg).text(),
				name: copyEl.find(elName).text(),
				star: copyEl.find(elStar).data('count'),
				data: copyEl.find(elData).text(),
				source: copyEl.find(elSource).text(),
				textTitle: copyEl.find(elTextTitle).text(),
				text: copyEl.find(elText).text(),
				class: copyEl.attr("class")
			}

			elFull.find(elImg).text(changeEl.iconName).attr('data-source', changeEl.img);
			elFull.find(elName).text(changeEl.name);
			elFull.find(elStar).attr('data-count', changeEl.star);
			elFull.find(elData).text(changeEl.data);
			elFull.find(elSource).text(changeEl.source);
			elFull.find(elTextTitle).text(changeEl.textTitle);
			elFull.find(elText).text(changeEl.text);
			elFull.find(el).attr("class", changeEl.class);
		});

		elClose.on('click', function () {
			elFull.hide();
			$('header').css('z-index', '100');
			scrollController.startScroll();

			el.removeClass('active');

			$(this).parent().find('p').text(' ');
			$(this).parent().find('.feedback-card__descr_title').text(' ');
		});

	}
	let feedbackCardMob = function () {


		const items = $('.feedback-card__descr');
		items.each(function () {
			th = $(this).find('div');

			if ($('main').hasClass('page-18')) {
				heightFeedback = $(this).find('p').height();
				if (heightFeedback < 99) {
					$(this).parent('.feedback-card').find('button').css("display", "none");
				} else {
					$(this).parent('.feedback-card').find('button').removeAttr('style');
				}
				// $(window).on('load resize', function () {});
				if (th.length) {
					$(this).find('p').css("-webkit-line-clamp", "5");
					if (heightFeedback < 110) {
						$(this).parent('.feedback-card').find('button').css("display", "none");
					} else {
						$(this).parent('.feedback-card').find('button').removeAttr('style');
					}
				}
			} else {
				heightFeedbackSlaider = $(this).find('p.line').text().length;
				if (heightFeedbackSlaider < 200) {
					$(this).parent('.feedback-card').find('button').css("display", "none");
				} else {
					$(this).parent('.feedback-card').find('button').removeAttr('style');
				}
				// $(window).on('load resize', function () {});
				if (th.length) {
					$(this).find('p').css("-webkit-line-clamp", "5");
					if (heightFeedbackSlaider < 201) {
						$(this).parent('.feedback-card').find('button').css("display", "none");
					} else {
						$(this).parent('.feedback-card').find('button').removeAttr('style');
					}
				}
			}
		});

		$('.feedback-card__popup').hide();
		elFull.hide();
		$('header').css('z-index', '100');
		scrollController.startScroll();
		$('.feedback-card__btn').on('click', function () {
			// //console.log('click');
			$(this).parent().find('.feedback-card__descr p').css("-webkit-line-clamp", "inherit");
			$(this).hide();
		});
	}

	if ($('main').hasClass('page-18')) {
		checkingMatchMedia(575, feedbackCardDesktop, feedbackCardMob);
	} else {
		feedbackCardDesktop();
	}
	// }



	// !Слайдер popup ======================================
	function swiperFullscreenPopUp() {
		const swiperSliderImg = $(".specialist__slider img");

		var arrSlideSwiper = swiperSliderImg.map(function () {
			return $(this).attr("src");
		});

		let mySlider = document.querySelector('.fullscreen-swiper');

		let fullscreenSwiper = new Swiper(mySlider, {
			initialSlide: 0,
			slidesPerView: 1,
			navigation: {
				nextEl: '.fullscreen .swiper-button-next',
				prevEl: '.fullscreen .swiper-button-prev'
			},
			grabCursor: true,
			// Cмена прозрачности
			effect: 'fade',

			// Lazy Loading
			// lazy: {
			// 	// Подгружать на старте переключения слайда
			// 	loadOnTransitionStart: true,
			// 	// Подгрузить предыдущую и следующую картинки
			// 	loadPrevNext: false,
			// },

			// Слежка за видимыми слайдами
			watchSlidesProgress: true,
			// Добавление класса видимым слайдам
			watchSlidesVisibility: true,
			// Обновить свайпер при изменении родительских элементов слайдера
			observeParents: true,
			// Обновить свайпер при изменении дочерних элементов слайда
			observeSlideChildren: true,
			virtual: {
				// slides: arrSlideSwiper,
				slides: (function () {
					let slide = arrSlideSwiper;
					for (let i = 0; i < 50; i++) {
						slide.push(`${slide[i]}`);
					}
					return slide;
				}()),
				renderSlide: function (slide, index) {
					return `
						<div class="swiper-slide">
							<img src="${slide}" alt="Картинка">
						</div>
					`;
				},
			},
		});
		// <div class="swiper-slide">
		// 	<img data-src="${slide}" src="assets/img/pixel.png" class="swiper-lazy" alt="Картинка">
		// 		<div class="swiper-lazy-preloader"></div>
		// </div>
		// открытия || закрытия попапа
		const btnOpenPopup = $('.specialist__slider .swiper-slide');
		const btnClosePopup = $('.fullscreen-close');
		const overlayPopupSlider = $('.fullscreen-overlay');
		const bodyPopup = $('.fullscreen');

		btnOpenPopup.on("click", function () {
			$('header, .ask-social').css('z-index', '1');
			scrollController.disabledScroll();
			bodyPopup.show();

			slideId = +$(this).attr('data-id'); //узнаю дата-id у нажатого слайда
			//при открытии слайдер переходит на указанный слайд
			fullscreenSwiper.slideTo(slideId, 200, true);
		});

		btnClosePopup.on("click", function () {
			scrollController.startScroll();
			bodyPopup.hide();
			$('header, .ask-social').removeAttr('style');
		});

		overlayPopupSlider.on("click", function () {
			btnClosePopup.trigger("click");
		});

	} swiperFullscreenPopUp();

});


//slider-before-after
function sliderBeforeAfter() {

	const sliders = document.querySelectorAll('.slider-before-after__slider');
	const body = document.body;


	sliders.forEach(function (slider) {

		const before = slider.querySelector('.slider-before-after__before');
		const beforeImage = before.querySelector('img');
		const beforeSpan = before.querySelector('.slider-before-after__before span');
		const change = slider.querySelector('.slider-before-after__change');
		const opacityMax = 0;


		let isActive = false;

		document.addEventListener('DOMContentLoaded', () => {
			let width = slider.offsetWidth;
			beforeImage.style.width = `${width}px`;
		});

		change.addEventListener('mousedown', () => {
			isActive = true;
		});

		body.addEventListener('mouseup', () => {
			isActive = false;
		});

		body.addEventListener('mouseleave', () => {
			isActive = false;
		});


		const beforeAfterSlider = (x) => {
			let shift = Math.max(61, Math.min(x, slider.offsetWidth));
			before.style.width = `${shift}px`;
			const a = (Math.abs((shift * 100 / slider.offsetWidth) - 100) * 0.01);

			beforeSpan.style.opacity = `${a}`;
			change.style.left = `calc(${shift}px - 75px)`;
		};

		const pauseEvents = (e) => {
			e.stopPropagation();
			e.preventDefault();
			return false;
		};

		body.addEventListener('mousemove', (e) => {
			if (!isActive) {
				return;
			}

			let x = e.pageX;
			x -= slider.getBoundingClientRect().left;
			beforeAfterSlider(x);
			pauseEvents(e);
		});

		change.addEventListener('touchstart', () => {
			isActive = true;
		});

		body.addEventListener('touchend', () => {
			isActive = false;
		});

		body.addEventListener('touchcancel', () => {
			isActive = false;
		});

		body.addEventListener('touchmove', (e) => {
			if (!isActive) {
				return;
			}

			let x;

			let i;
			for (i = 0; i < e.changedTouches.length; i++) {
				x = e.changedTouches[i].pageX;
			}

			x -= slider.getBoundingClientRect().left;

			beforeAfterSlider(x);
			pauseEvents(e);
		});

	});
} sliderBeforeAfter();
