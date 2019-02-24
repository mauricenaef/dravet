const test = 'Babel is doing the job. Test';

$(window).on('load', function () {
	console.log(test);
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


