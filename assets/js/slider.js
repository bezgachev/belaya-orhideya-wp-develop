
if (document.querySelector('.first-swiper')) {
	let firstSlider = new Swiper('.first-swiper', {
		navigation: {
			nextEl: '.first-next',
			prevEl: '.first-prev',
			clickable: true
		},
		pagination: {
			el: '.first-dots',
			type: 'bullets',
			clickable: true
		},
		slidesPerView: 1,
		slidesPerGroup: 1,
		watchOverflow: true,
		delay: 800,

		loop: true,
		autoplay: {
			delay: 4000, // Пауза между прокруткой
			stopOnLastSlide: false, // Закончить на последнем слайде
			disableOnInteraction: false // Отключить после ручного переключения
		}
	});

	let sliderBlock = document.querySelector('.first-swiper');

	sliderBlock.addEventListener("mouseenter", function (e) {
		firstSlider.autoplay.stop();
	});

	sliderBlock.addEventListener("mouseleave", function (e) {
		firstSlider.autoplay.start();
	});
}




if (document.querySelector('.promo__slider')) {
	let saleSlider = new Swiper('.promo__slider', {
		navigation: {
			nextEl: '.promo-next',
			prevEl: '.promo-prev',
			clickable: true
		},
		grabCursor: true,
		slidesPerView: 1,
		slidesPerGroup: 1,
		watchOverflow: true,
		autoHeight: false,
		loop: true,
		autoplay: {
			delay: 3000, // Пауза между прокруткой
			stopOnLastSlide: false, // Закончить на последнем слайде
			disableOnInteraction: false // Отключить после ручного переключения
		},
	});
}

const sliderThree = document.querySelector('.slider-block.three .slider-block-swiper');
const sliderFour = document.querySelector('.slider-block.four .slider-block-swiper');

if (sliderThree) {
	new Swiper(sliderThree, {
		navigation: {
			nextEl: '.slider-block.three .slider-block-next',
			prevEl: '.slider-block.three .slider-block-prev',
			clickable: true
		},
		grabCursor: true,
		slidesPerView: 'auto',
		slidesPerGroup: 1,
		spaceBetween: 24,
		breakpoints: {
			300: {
				slidesPerView: 1.5,
				spaceBetween: 16,
			},
			456: {
				slidesPerView: 'auto',
			},
			976: {
				slidesPerView: 3,
			}
		},
	});
}
if (sliderFour) {
	new Swiper(sliderFour, {
		navigation: {
			nextEl: '.slider-block.four .slider-block-next',
			prevEl: '.slider-block.four .slider-block-prev',
			clickable: true
		},
		grabCursor: true,
		slidesPerView: 'auto',
		slidesPerGroup: 1,
		spaceBetween: 16,
		breakpoints: {
			575: {
				spaceBetween: 24,
			},
			976: {
				slidesPerView: 4,
			}
		},
	});
}


if (document.querySelector('.clinic-swiper')) {
	let clinicSlider = new Swiper('.clinic-swiper', {
		pagination: {
			el: '.clinic-pagination',
			type: 'bullets',
			clickable: true
		},
		slidesPerView: 1,
		slidesPerGroup: 1,
		watchOverflow: true,
		spaceBetween: 18,
		centeredSlides: true,
		// delay: 800,
		loop: true,
		autoplay: {
			delay: 3000, // Пауза между прокруткой
			stopOnLastSlide: false, // Закончить на последнем слайде
			disableOnInteraction: false // Отключить после ручного переключения
		},
		breakpoints: {
			575: {
				slidesPerView: 1,
			},
			770: {
				slidesPerView: 2,
			},
			992: {
				slidesPerView: 4,
			}
		},
	});
}
if (document.querySelector('.reviews__slider')) {
	//Слайдер отзывы --Вот как отзываются клиенты о нас--
	let sliderRreviews = new Swiper('.reviews__slider', {
		slidesPerView: 'auto',
		spaceBetween: 20,
		slidesPerGroup: 1,
		navigation: {
			nextEl: '.reviews-next',
			prevEl: '.reviews-prev',
		},
		breakpoints: {
			310: {
				spaceBetween: 0,
				slidesPerView: '1',
			},
			575: {
				slidesPerView: 'auto',
				spaceBetween: 20,
			},
		},
		on: {
			// Событие смены слайда
			slideChange: function () {
				$('.feedback-card__descr p').css("-webkit-line-clamp", "6");
			}
		}
	})
}
if (document.querySelector('.info-doctors__body')) {
	//Слайдер cпециалисты --Виртуозы своего дела--
	let sliderDoctors = new Swiper('.info-doctors__body', {
		slidesPerView: 4,
		spaceBetween: 24,
		slidesPerGroup: 1,
		grabCursor: true,
		slideClass: 'doctor-card',
		watchOverflow: true, // Отключение функционала если слайдов меньше чем нужно
		navigation: {
			nextEl: '.doctors-next',
			prevEl: '.doctors-prev',
			clickable: true,
		},
		observer: true,
		observeParents: true,
		breakpoints: {
			300: {
				slidesPerView: 'auto',
				spaceBetween: 12,
			},
			390: {
				slidesPerView: 'auto',
				spaceBetween: 20,
			},
			992: {
				slidesPerView: 4,
				spaceBetween: 20,
			},
		},
	})

}
if (document.querySelector('.silder-doctors__swiper')) {
	let firstSlider = new Swiper('.silder-doctors__swiper', {
		// Стрелки
		navigation: {
			nextEl: '.doctor-next',
			prevEl: '.doctor-prev'
		},
		// Навигация
		// Буллеты, текущее положение, прогрессбар
		pagination: {
			el: '.swiper-pagination',
			// Фракция
			type: 'fraction'
		},

		grabCursor: true,
		slidesPerView: 1,
		watchOverflow: true,
		slidesPerGroup: 1,
		// effect: 'fade',
		thumbs: {
			// Свайпер с мениатюрами и его настройки
			swiper: {
				el: '.doctors-thumbs',
				slidesPerView: 2,
				direction: 'vertical',
				spaceBetween: 14,
				initialSlide: 0,
				slidesPerGroup: 1,
				centeredSlides: false,
				breakpoints: {
					320: {
						direction: 'horizontal',
					},
					992: {
						direction: 'vertical',
					}
				},
			}
		},

	});
}
if (document.querySelector('.examples__slider')) {
	let examplesSlider = new Swiper('.examples__slider', {
		navigation: {
			nextEl: '.examples-next',
			prevEl: '.examples-prev',
			clickable: true
		},
		slideClass: 'example',
		grabCursor: true,
		spaceBetween: 74,
		slidesPerView: 'auto',
		slidesPerGroup: 1,
		watchOverflow: true,
		centeredSlides: true,
		simulateTouch: false,
		allowTouchMove: false,
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			992: {
				slidesPerView: 'auto',
			}
		},
	});
}
if (document.querySelector('.chinese-medicine__slider')) {
	new Swiper('.chinese-medicine__slider', {
		slidesPerGroup: 1,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		slidesPerView: 1,
		// effect: 'fade',
		grabCursor: true,
		loop: true,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false
		},

	});
}
if (document.querySelector('.specialist__slider')) {
	let specialistSlider = new Swiper('.specialist__slider', {
		navigation: {
			nextEl: '.specialist-next',
			prevEl: '.specialist-prev'
		},

		// grabCursor: true,
		spaceBetween: 24,
		slidesPerView: 'auto',
		breakpoints: {
			320: {
				slidesPerView: 'auto'
			},
			1175: {
				spaceBetween: 24,
				slidesPerView: 6,
			}
		},
	});
}

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

if (document.querySelector('.gallery')) {
	// !Слайдер popup ======================================
	const btnPopupOpen = document.querySelectorAll('.gallery__item');
	const btnCloseModalImg = $('.btn-close');

	btnPopupOpen.forEach(function (slider, index) {
		slider.addEventListener("click", function (e) {
			$('.gallery-full').fadeIn(300);
			let slideId = index;
			openFullscreenSwiper(slideId);
			scrollController.disabledScroll();
		});
	});

	btnCloseModalImg.click(function () {
		$('.gallery-full').fadeOut(300);
		scrollController.startScroll();
	});
	// закрыть попап Escape
	$(document).on('keydown', function (e) {
		if (e.key === 'Escape') {
			btnCloseModalImg.click();
		}
	});

	// !Слайдер popup ======================================
	function openFullscreenSwiper(initialSlideNumber) {
		var swiper = new Swiper(".mySwiper", {
			initialSlide: initialSlideNumber,
			spaceBetween: 8,
			slidesPerView: 7,
			freeMode: true,
			watchSlidesProgress: true,
			breakpoints: {
				320: {
					slidesPerView: 5,
				},
				575: {
					slidesPerView: 7,
				}
			},
		});

		var swiper2 = new Swiper(".mySwiper2", {
			initialSlide: initialSlideNumber,
			spaceBetween: 8,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			thumbs: {
				swiper: swiper,
			},
		});
	}
}
