/***************************************************
==================== JS INDEX ======================
****************************************************
01. PreLoader Js
02. mobile menu Js
03. Sticky Header Js
04. Sidebar Js
05. Search Js
06. Common Js (data-width / data-bg-color)
07. Smooth Scroll Js (ScrollSmoother)
08. Counter Js
09. section-triger-slicer (image reveal)
10. Button Move Animation
11. backToTop
12. panel pin section
13. Text Invert With Scroll
14. fade-class-active (onscroll fade-in — .tp_fade_anim)
15. rotate-text-anim
16. Text Effect Animation
17. tp-video-img-wrap
****************************************************/

(function ($) {
	"use strict";

	var windowOn = $(window);

	// Get Device width
	let device_width = window.innerWidth;

	////////////////////////////////////////////////////
	// 01. PreLoader Js

	windowOn.on('load', function () {
		var body = $('body');
		body.addClass('loaded');
		setTimeout(function () {
			body.removeClass('loaded');
		}, 1500);
	});

	document.addEventListener("DOMContentLoaded", () => {
		const svg = document.getElementById("svg");
		if (!svg) return;

		const tls = gsap.timeline();
		const curve = "M0 502S175 272 500 272s500 230 500 230V0H0Z";
		const flat = "M0 2S175 1 500 1s500 1 500 1V0H0Z";

		// Loader heading text
		if (document.querySelector(".loader-wrap-heading")) {
			tls.to(".loader-wrap-heading .load-text , .loader-wrap-heading .cont", {
				delay: 0.5,
				y: -100,
				opacity: 0,
			});
		}

		// SVG animation
		tls.to(svg, {
			duration: 0.5,
			attr: { d: curve },
			ease: "power2.in",
		}).to(svg, {
			duration: 0.5,
			attr: { d: flat },
			ease: "power2.out",
		});

		// Loader wrap
		if (document.querySelector(".loader-wrap")) {
			tls.to(".loader-wrap", { y: -1500 })
				.to(".loader-wrap", { zIndex: -1, display: "none" });
		}

		// Pre-header animation (safe check)
		const preHeader = document.querySelector(".pre-header");
		if (preHeader) {
			tls.from(preHeader, { y: 200 }, "-=1.5");

			const preHeaderCont = preHeader.querySelector(".containers");
			if (preHeaderCont) {
				tls.from(preHeaderCont, {
					y: 40,
					opacity: 0,
					delay: 0.1,
				}, "-=1.5");
			}
		}
	});


	////////////////////////////////////////////////////
	// 02. mobile menu Js
	var tpMenuWrap = $('.tp-mobile-menu-active > ul').clone();
	var tpSideMenu = $('.tp-offcanvas-menu nav');
	tpSideMenu.append(tpMenuWrap);
	if ($(tpSideMenu).find('.tp-submenu, .mega-menu').length != 0) {
		$(tpSideMenu).find('.tp-submenu, .mega-menu').parent().append('<button class="tp-menu-close"><i class="far fa-chevron-right"></i></button>');
	}
	var sideMenuList = $('.tp-offcanvas-menu nav > ul > li button.tp-menu-close, .tp-offcanvas-menu nav > ul li.has-dropdown > a, .tp-offcanvas-menu nav > ul li.has-dropdown > ul > li.menu-item-has-children > a');
	$(sideMenuList).on('click', function (e) {
		e.preventDefault();
		if (!($(this).parent().hasClass('active'))) {
			$(this).parent().addClass('active');
			$(this).siblings('.tp-submenu, .mega-menu').slideDown();
		} else {
			$(this).siblings('.tp-submenu, .mega-menu').slideUp();
			$(this).parent().removeClass('active');
		}
	});


	///////////////////////////////////////////////////
	// 03. Sticky Header Js
	$(window).on('scroll', function () {
		let scroll = $(window).scrollTop();
		if (scroll < 20) {
			$("#header-sticky").removeClass("header-sticky");
		} else {
			$("#header-sticky").addClass("header-sticky");
		}
	});


	////////////////////////////////////////////////////
	// 04. Sidebar Js
	$(".tp-menu-bar").on("click", function () {
		$(".tp-offcanvas").addClass("opened");
		$(".body-overlay").addClass("apply");
	});
	$(".close-btn").on("click", function () {
		$(".tp-offcanvas").removeClass("opened");
		$(".body-overlay").removeClass("apply");
	});
	$(".body-overlay").on("click", function () {
		$(".tp-offcanvas").removeClass("opened");
		$(".body-overlay").removeClass("apply");
	});


	////////////////////////////////////////////////////
	// 05. Search Js
	$(".tp-search-close,.tp-search-body-overlay").on("click", function () {
		$(".tp-search-form-toggle,.tp-search-body-overlay").removeClass("active");
	});


	////////////////////////////////////////////////////
	// 06. Common Js
	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});

	////////////////////////////////////////////////////
	// 07. Smooth Scroll Js
	gsap.registerPlugin(ScrollTrigger, ScrollSmoother, ScrollToPlugin);
	if ($('#smooth-wrapper').length && $('#smooth-content').length) {
		ScrollSmoother.create({
			smooth: 1.35,
			effects: true,
			smoothTouch: .1,
			ignoreMobileResize: false
		});
		ScrollTrigger.refresh(true);
	}

	////////////////////////////////////////////////////
	// 08. Counter Js
	new PureCounter();

	////////////////////////////////////////////////////
	// 09. section-triger-slicer (image reveal on scroll)
	gsap.registerPlugin(ScrollTrigger);

	const triggerSlices = [...document.querySelectorAll('.section-triger')];

	triggerSlices.forEach((section) => {
		const slices = section.querySelectorAll(".uncover_slice");
		const image = section.querySelector(".myimg");

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: section,
				start: "50% bottom",
				markers: false,
			}
		});

		tl.to(slices, {
			height: 0,
			ease: 'power6.inOut',
			duration: 0.6,
			stagger: { each: 0.3 }
		}, 'start')
		.to(image, {
			scale: 1.3,
			duration: 1.5,
			ease: 'power6.inOut'
		}, 'start');
	});

	/////////////////////////////////////////////////////
	// 10. Button Move Animation
	// const all_btn = gsap.utils.toArray(".btn_wrapper, #btn_wrapper");
	// const all_btn_circle = gsap.utils.toArray(".btn-item");

	// if (all_btn.length && all_btn_circle.length) {
	// 	all_btn.forEach((btn, i) => {
	// 		const circle = all_btn_circle[i];

	// 		// Mouse move = parallax effect
	// 		$(btn).on("mousemove", function (e) {
	// 			const $this = $(this);
	// 			const relX = e.pageX - $this.offset().left;
	// 			const relY = e.pageY - $this.offset().top;
	// 			gsap.to(circle, {
	// 				duration: 0.5,
	// 				x: ((relX - $this.width() / 2) / $this.width()) * 80,
	// 				y: ((relY - $this.height() / 2) / $this.height()) * 80,
	// 				ease: "power2.out",
	// 			});
	// 		});

	// 		// Mouse leave = reset effect
	// 		$(btn).on("mouseleave", function () {
	// 			gsap.to(circle, {
	// 				duration: 0.5,
	// 				x: 0,
	// 				y: 0,
	// 				ease: "power2.out",
	// 			});
	// 		});
	// 	});
	// }


	/////////////////////////////////////////////////////
	// 11. backToTop
	let windowHeight = 0;
	let documentHeight = 0;
	function updateDimensions() {
		windowHeight = window.innerHeight;
		documentHeight = document.documentElement.scrollHeight - windowHeight;
	}
	updateDimensions();
	$(window).on('resize', updateDimensions);

	let $box = $(".scrollToTop");
	if ($box.length) {
		let $water = $box.find(".water");

		$(window).on('scroll', function () {
			let scrollPosition = $(window).scrollTop();
			let percent = Math.min(
				Math.floor((scrollPosition / documentHeight) * 100),
				100
			);

			$water.css("transform", "translate(0," + (100 - percent) + "%)");

			if (scrollPosition >= 200) {
				$box.addClass("active-progress");
			} else {
				$box.removeClass("active-progress");
			}
		});

		// Scroll to top
		$box.on('click', function () {
			$('html, body').animate({ scrollTop: 0 }, 'smooth');
		});
	}


	/////////////////////////////////////////////////////
	// 12. panel pin section
	gsap.registerPlugin(ScrollTrigger);

	let mm = gsap.matchMedia();

	mm.add("(min-width: 1199px)", () => {

		// ===============================
		// Pin Sections
		// ===============================
		let panels = document.querySelectorAll(".tp-panel-pin");

		panels.forEach((section) => {
			gsap.timeline({
				scrollTrigger: {
					trigger: section,
					pin: true,
					scrub: 1,
					start: "top 10%",
					end: "bottom 99%",
					endTrigger: ".tp-panel-pin-area",
					pinSpacing: false,
					markers: false
				}
			});
		});


		// ===============================
		// Previous Card Move Away Effect
		// ===============================
		let productPanels = gsap.utils.toArray(".tp-portfolio-pp-item-wrap .tp-panel-pin");

		productPanels.forEach((panel, index) => {

			if (index === 0) return;

			let prevPanel = productPanels[index - 1];
			let overlay = prevPanel.querySelector(".tp-portfolio-overlay");

			let tl = gsap.timeline({
				scrollTrigger: {
					trigger: panel,
					start: "top 90%",
					end: "top 15%",
					scrub: true,
					markers: false
				}
			});

			tl.to(prevPanel, {
				scale: 0.85,
				y: -60,
				rotationX: 8,
				z: -200,
				opacity: 0.55,
				filter: "blur(9px)",
				transformOrigin: "center center",
				ease: "none"
			}, 0);

			if (overlay) {
				tl.to(overlay, {
					opacity: 0.65,
					ease: "none"
				}, 0);
			}
		});

	});

	/////////////////////////////////////////////////////
	// 13. Text Invert With Scroll
	function tp_text_invert() {
		const invertEls = document.querySelectorAll(".tp_text_invert");
		if (!invertEls.length || typeof SplitText === "undefined") return;

		const split = new SplitText(".tp_text_invert", { type: "lines" });
		split.lines.forEach((target) => {
			gsap.to(target, {
				backgroundPositionX: 0,
				ease: "none",
				scrollTrigger: {
					trigger: target,
					scrub: 1,
					start: 'top 85%',
					end: "bottom center"
				}
			});
		});
	}
	$(function () {
		tp_text_invert();
	});

	///////////////////////////////////////////////////
	// 14. fade-class-active — onscroll fade-in effect (.tp_fade_anim)
	// Add class="tp_fade_anim" to any element to fade it in as it scrolls into view.
	// Optional data attributes let you tune each element individually:
	//   data-fade-from="bottom|top|left|right" (default: bottom)
	//   data-fade-offset="40"      -> distance (px) it travels in
	//   data-duration="0.75"       -> animation duration (s)
	//   data-delay="0.15"          -> delay before it starts (s)
	//   data-ease="power2.out"     -> GSAP easing
	//   data-on-scroll="1"         -> set to 0 to play once on load instead of on scroll
	if ($(".tp_fade_anim").length > 0) {
		gsap.utils.toArray(".tp_fade_anim").forEach((item) => {
			let tp_fade_offset = item.getAttribute("data-fade-offset") || 40,
				tp_duration_value = item.getAttribute("data-duration") || 0.75,
				tp_fade_direction = item.getAttribute("data-fade-from") || "bottom",
				tp_onscroll_value = item.getAttribute("data-on-scroll") || 1,
				tp_delay_value = item.getAttribute("data-delay") || 0.15,
				tp_ease_value = item.getAttribute("data-ease") || "power2.out",
				tp_anim_setting = {
					opacity: 0,
					ease: tp_ease_value,
					duration: tp_duration_value,
					delay: tp_delay_value,
					x: (tp_fade_direction == "left" ? -tp_fade_offset : (tp_fade_direction == "right" ? tp_fade_offset : 0)),
					y: (tp_fade_direction == "top" ? -tp_fade_offset : (tp_fade_direction == "bottom" ? tp_fade_offset : 0)),
				};
			if (tp_onscroll_value == 1) {
				tp_anim_setting.scrollTrigger = {
					trigger: item,
					start: 'top 85%',
				};
			}
			gsap.from(item, tp_anim_setting);
		});
	}

	///////////////////////////////////////////////////
	// 15. rotate-text-anim
	const rotateText = document.querySelector(".rotate-text-anim");

	if (rotateText && typeof SplitText !== "undefined") {
		let headingTitle = new SplitText(rotateText, { type: "chars" });
		let headingChars = headingTitle.chars;

		let tHero = gsap.timeline({
			scrollTrigger: {
				trigger: rotateText,
				start: "top 80%",
				toggleActions: "play none none none",
			}
		});

		tHero.from(headingChars, {
			rotate: 20,
			ease: "back.out",
			opacity: 0,
			duration: 1,
			stagger: 0.1
		});
	}


	/////////////////////////////////////////////////////
	// 16. Text Effect Animation
	if ($(".text-anim").length && typeof SplitText !== "undefined") {
		let staggerAmount = 0.03,
			translateXValue = 20,
			delayValue = 0.1,
			easeType = "power2.out",
			animatedTextElements = document.querySelectorAll(".text-anim");

		animatedTextElements.forEach((element) => {
			let animationSplitText = new SplitText(element, { type: "chars, words" });
			gsap.from(animationSplitText.chars, {
				duration: 1,
				delay: delayValue,
				x: translateXValue,
				autoAlpha: 0,
				stagger: staggerAmount,
				ease: easeType,
				scrollTrigger: { trigger: element, start: "top 85%" },
			});
		});
	}

	$('.tp-btn-rounded').on('mouseenter', function (e) {
		var x = e.pageX - $(this).offset().left;
		var y = e.pageY - $(this).offset().top;

		$(this).find('.tp-btn-circle-dot').css({
			top: y,
			left: x
		});
	});
	////////////////////////////////////////////////////
	// 17. tp-video-img-wrap
	if ($('.tp-video-brand-img-wrap-2').length > 0) {
		let ms = gsap.matchMedia();
		ms.add("(min-width: 768px)", () => {
			gsap.fromTo("#video video",
				{
					scale: 0.14,
					y: -334.66,
					borderRadius: '50rem'
				},
				{
					scale: 1,
					y: 0,
					ease: "power2.out",
					borderRadius: '0rem',
					scrollTrigger: {
						trigger: "#video",
						start: "top 80%",
						end: "top 20%",
						scrub: true,
					}
				}
			);
		});
	}
        (function () {
            var panels = document.querySelectorAll('.tsp-panel');
            if (!panels.length) return;

            if (!('IntersectionObserver' in window)) {
                panels.forEach(function (p) { p.classList.add('is-in-view'); });
                return;
            }

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry, i) {
                    if (entry.isIntersecting) {
                        var panel = entry.target;
                        var delay = Array.prototype.indexOf.call(panels, panel) % 2 === 0 ? 0 : 90;
                        setTimeout(function () {
                            panel.classList.add('is-in-view');
                        }, delay);
                        observer.unobserve(panel);
                    }
                });
            }, { threshold: 0.25, rootMargin: '0px 0px -60px 0px' });

            panels.forEach(function (panel) { observer.observe(panel); });
        })();

})(jQuery);