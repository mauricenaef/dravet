const test = 'Babel is doing the job. Test';
const test2 = 22;

$(window).on('load', function () {
	console.log(test);
	// Store Full Page Height as a variable
	document.documentElement.style.setProperty('--vh', `${window.innerHeight/100}px`);
});


const header = $('.site-header');

$(window).on('load', function () {
	$(window).scrollTop(0);
	setTimeout(function () {
		$(window).scroll(function () {
			let scroll = $(window).scrollTop();
			if (scroll >= 50) {
				header.addClass('scrolled');
			} else {
				header.removeClass('scrolled');
			}
		});

	}, 2000);
});