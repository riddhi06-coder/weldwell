/***************************************************
==================== JS INDEX ======================
****************************************************
01. al-hero-shop-active
02. ar-testimonial-active
03. text-slider (crp-text-slider-active)
04. dgm-brand-active
****************************************************/

(function ($) {
	"use strict";

	////////////////////////////////////////////////////
	// 01. al-hero-shop-active
	var slider = new Swiper('.al-hero-shop-active', {
		slidesPerView: 1,
		loop: true,
		effect: 'fade',
		speed: 1500, // Smooth transition speed (1.5s)

		fadeEffect: {
			crossFade: true
		},

		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
			waitForTransition: true,
		},

		pagination: {
			el: '.al-hero-shop-dot',
			clickable: true,
		},

		grabCursor: true,
		watchSlidesProgress: true,
		preloadImages: false,
		lazy: {
			loadPrevNext: true,
		},
	});
	////////////////////////////////////////////////////
	    var tp_brand_slide = new Swiper(".tp-text-slider-active", {
        loop: true,
        freemode: true,
        slidesPerView: 'auto',
        spaceBetween: 0,
        centeredSlides: true,
        allowTouchMove: false,
        speed: 8000,
        autoplay: {
            delay: 1,
            disableOnInteraction: true,
        },
    });

	////////////////////////////////////////////////////
	// 02. ar-testimonial-active
	var gallery = new Swiper('.ar-testimonial-active', {
		slidesPerView: 1,
		loop: true,
		autoplay: true,
		arrow: false,
		spaceBetween: 0,
		speed: 1000,
		navigation: {
			prevEl: '.ar-testimonial-prev',
			nextEl: '.ar-testimonial-next',
		},
		pagination: {
			el: '#paginations',
			type: 'custom',
			renderCustom: function (swiper, current, total) {
				let zero = total > 9 ? '' : '0';
				let index = zero + current
				let all = zero + total
				let html = `<div class="shop-slider-pagination">
								<span>${index}</span>
								<span>${all}</span>
							</div>`;
				return html;
			}
		}

	});

	////////////////////////////////////////////////////
	// 03. text-slider (crp-text-slider-active)
	var tp_text_slide = new Swiper(".crp-text-slider-active", {
		loop: true,
		freeMode: true,
		slidesPerView: "auto",
		spaceBetween: 40,
		centeredSlides: true,
		allowTouchMove: false,
		speed: 8000,

		autoplay: {
			delay: 0,
			disableOnInteraction: false,
			pauseOnMouseEnter: false,
			waitForTransition: false,
		},

		freeMode: {
			enabled: true,
			momentum: false,
		},
	});

	////////////////////////////////////////////////////
	// 04. dgm-brand-active
	var dgm_brand_active = new Swiper('.dgm-brand-active', {
		slidesPerView: 6,
		loop: true,
		autoplay: true,
		arrow: false,
		spaceBetween: 0,
		speed: 1000,
		breakpoints: {
			'1600': {
				slidesPerView: 6,
			},
			'1400': {
				slidesPerView: 6,
			},
			'1200': {
				slidesPerView: 6,
			},
			'992': {
				slidesPerView: 4,
			},
			'768': {
				slidesPerView: 3,
			},
			'576': {
				slidesPerView: 3,
			},
			'0': {
				slidesPerView: 2,
			},
		},
		a11y: false,

	});

})(jQuery);