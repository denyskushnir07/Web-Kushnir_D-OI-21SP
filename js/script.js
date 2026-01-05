
;(function ($) {

	'use strict';
	
 // SCROLL TO TOP
  
  $(window).on('scroll', function () {
    if ($(window).scrollTop() > 70) {
        $('.backtop').addClass('reveal');
    } else {
        $('.backtop').removeClass('reveal');
    }
});
 
	$('.portfolio-single-slider').slick({
		infinite: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000

	});

	$('.clients-logo').slick({
		infinite: true,
		arrows: false,
		autoplay: true,
		slidesToShow: 6,
		slidesToScroll: 6,
		autoplaySpeed: 6000,
		responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow:6,
		        slidesToScroll: 6,
		        infinite: true,
		        dots: true
		      }
		    },
		    {
		      breakpoint: 900,
		      settings: {
		        slidesToShow:4,
		        slidesToScroll: 4
		      }
		    },{
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 4,
		        slidesToScroll: 4
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    }
		  
  		]
	});

	$('.testimonial-wrap').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		dots: true,
		arrows: false,
		autoplay: true,
		vertical:true,
		verticalSwiping:true,
		autoplaySpeed: 6000,
		responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow:1,
		        slidesToScroll: 1,
		        infinite: true,
		        dots: true
		      }
		    },
		    {
		      breakpoint: 900,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },{
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		  
  		]
	});

	$('.testimonial-wrap-2').slick({
		slidesToShow: 2,
		slidesToScroll: 2,
		infinite: true,
		dots: true,
		arrows:false,
		autoplay: true,
		autoplaySpeed: 6000,
		responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow:2,
		        slidesToScroll:2,
		        infinite: true,
		        dots: true
		      }
		    },
		    {
		      breakpoint: 900,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },{
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		  
  		]
	});


// Counter

// Використання плагіна counterUp для анімації числових показників

// Вибираємо всі елементи з класом 'counter-stat' і всередині них 'span'
$('.counter-stat span').counterUp({ //викликаємо плагін
    // Налаштовуємо затримку між анімаційними кроками у мілісекундах
    delay: 10, 
    // Вказуємо тривалість анімації в мілісекундах
    time: 1000
});

		
// Shuffle js filter and masonry

// Оголошення змінних Shuffle і jQuery, які посилаються на глобальні об'єкти Shuffle та jQuery відповідно.
var Shuffle = window.Shuffle;
var jQuery = window.jQuery;

// Створення екземпляру Shuffle з об'єктом DOM, що має клас 'shuffle-wrapper'.
// Використовується .shuffle-item як селектор елементів та buffer: 1 для налаштування покращення производительності.
var myShuffle = new Shuffle(document.querySelector('.shuffle-wrapper'), {
    itemSelector: '.shuffle-item',
    buffer: 1
});

// Налаштування обробника події change для всіх введень з іменем 'shuffle-filter'.
// При зміні вибору фільтра відбувається фільтрація елементів Shuffle відповідно до вибраного значення вводу.
jQuery('input[name="shuffle-filter"]').on('change', function (evt) {
    var input = evt.currentTarget;
    if (input.checked) {
        myShuffle.filter(input.value); // Виклик методу filter для об'єкту Shuffle з використанням значення вибраного фільтру.
    }
});

// Завершення безіменної функції з параметром jQuery.
})(jQuery);
