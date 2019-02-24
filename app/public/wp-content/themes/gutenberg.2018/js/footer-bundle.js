'use strict';

var test = 'Babel is doing the job. Test';

$(window).on('load', function () {
	console.log(test);
});

var header = $('.site-header');

$(window).on('load', function () {
	$(window).scrollTop(0);
	setTimeout(function () {
		$(window).scroll(function () {
			var scroll = $(window).scrollTop();
			if (scroll >= 50) {
				header.addClass('scrolled');
			} else {
				header.removeClass('scrolled');
			}
		});
	}, 2000);
});
//# sourceMappingURL=footer-bundle.js.map
