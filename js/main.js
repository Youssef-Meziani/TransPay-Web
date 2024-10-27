(function ($) {
	"use strict";

	/*===========================================

                        favicon

    =============================================*/

	// change favicon
	const favicon = document.getElementById("favicon");
	const matcher = window.matchMedia('(prefers-color-scheme: dark)');
	matcher.addEventListener('change', onUpdate);
	onUpdate();

	function onUpdate() {
		favicon.href = matcher.matches ? "images/favicon-light.svg" : "images/favicon.svg";
	}





	/*===========================================

                        Header

    =============================================*/

	// Header Sticky
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 120) {
			$('.navbar-area').addClass("is-sticky");
		} else {
			$('.navbar-area').removeClass("is-sticky");
		}
	});

	// Others Option Responsive JS
	$(".others-option-for-responsive .dot-menu").on("click", function () {
		$(".others-option-for-responsive .container .container").toggleClass("active");
	});


	// Mean Menu
	$('.mean-menu').meanmenu({
		meanScreenWidth: "1199"
	});

	/*===========================================

                       FAQ

    =============================================*/

	// Tabs
	(function ($) {
		$('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
		$('.tab ul.tabs li a').on('click', function (g) {
			var tab = $(this).closest('.tab'),
				index = $(this).closest('li').index();
			tab.find('ul.tabs > li').removeClass('current');
			$(this).closest('li').addClass('current');
			tab.find('.tab-content').find('div.tabs-item').not('div.tabs-item:eq(' + index + ')').slideUp();
			tab.find('.tab-content').find('div.tabs-item:eq(' + index + ')').slideDown();
			g.preventDefault();
		});
	})(jQuery);

	// FAQ Accordion
	$(function () {
		$('.accordion').find('.accordion-title').on('click', function () {
			// Adds Active Class
			$(this).toggleClass('active');
			// Expand or Collapse This Panel
			$(this).next().slideToggle('fast');
			// Hide The Other Panels
			$('.accordion-content').not($(this).next()).slideUp('fast');
			// Removes Active Class From Other Titles
			$('.accordion-title').not($(this)).removeClass('active');
		});
	});

	/*===========================================

                       Testimonial

    =============================================*/

	// testimonial-carousel-1 
	$('.testimonial-carousel-1').owlCarousel({
		loop: true,
		items: 5,
		nav: false,
		dots: true,
		smartSpeed: 500,
		autoplay: false,
		margin: 30,
		autoHeight: true,
		responsive: {
			320: {
				items: 1,
			},
			767: {
				items: 2,
			},
			992: {
				items: 3,
			},
			1025: {
				items: 4,
			},
			1440: {
				items: 5,
			}
		}
	});

	/*===========================================

                    Nice Select JS

    =============================================*/

	$('select').niceSelect();


	/*===========================================

	                    Preloader

	=============================================*/

	$(window).on("load", function () {
		$("#status").fadeOut();
		$("#preloader").fadeOut("slow");
		new WOW().init();
	});

	/*===========================================

	                Parallax

	=============================================*/

	$(".scene").each(function () {
		new Parallax($(this)[0], {
			relativeInput: false,
		});
	});

	/*===========================================

	                Back to top

	=============================================*/
	
	// Scroll Event
	$(window).on('scroll', function () {
		var scrolled = $(window).scrollTop();
		if (scrolled > 300) $('.go-top').addClass('active');
		if (scrolled < 300) $('.go-top').removeClass('active');
	});
	
	// Click Event
	$('.go-top').on('click', function () {
		$("html, body").scrollTop(0);
	});
	
	/*===========================================

					coming-soon

	=============================================*/

	const $comingSoonInner = $('.coming-soon-inner');
	const $countdownElements = $('[data-countdown]');

	if ($comingSoonInner.length !== 0) {
		const second = 1000,
		minute = second * 60,
		hour = minute * 60,
		day = hour * 24;
			
		let countDown = new Date('Jan 1, 2024 00:00:00').getTime();
		
		const updateCountdown = () => {
			let now = new Date().getTime(),
				distance = countDown - now;
			document.getElementById('days').innerText = Math.floor(distance / (day)),
			document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
			document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
			document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
			if (distance < 0) {
				clearInterval(x);
				// do something when date is reached
			} else {
				window.requestAnimationFrame(updateCountdown);
			}
		};
		window.requestAnimationFrame(updateCountdown);
	}

	$countdownElements.each(function () {
	const $this = $(this);
	const finalDate = $this.data('countdown');
	$this.countdown(finalDate, function (event) {
		$this.html(event.strftime('<div class="single-countdown"><span class="single-countdown_time">%D</span><span class="single-countdown_text">Days</span></div><div class="single-countdown"><span class="single-countdown_time">%H</span><span class="single-countdown_text">Hours</span></div><div class="single-countdown"><span class="single-countdown_time">%M</span><span class="single-countdown_text">Min</span></div><div class="single-countdown"><span class="single-countdown_time">%S</span><span class="single-countdown_text">Sec</span></div>'));
	})});
	
	/*===========================================

					news-letter

	=============================================*/

	$('#news-letter').submit(function(event) {
		event.preventDefault();
		$(".warning").addClass("d-none");
		$(".success").addClass("d-none");
		$(".invalid").addClass("d-none");

		var email=$("#email").val();

		if (email.trim() === '' || email.length > 40 || !(new RegExp("[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}").test(email))) {
			$(".invalid").removeClass("d-none");
			return;
		}

		$.ajax({
			type: 'POST',
			url: 'assets/news-letter.php',
			data: { email: email },
			success: function(response) {
				if (response=="exist") {
					$(".warning").removeClass("d-none");
				} else if (response=="done") {
					$(".success").removeClass("d-none");
				}
			}
		});
	});

})(jQuery);