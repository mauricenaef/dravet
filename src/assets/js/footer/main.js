(function($){
	$(window).on('load', function () {		// Store Full Page Height as a variable
		document.documentElement.style.setProperty('--vh', `${window.innerHeight/100}px`);
	});

	  const shippinginput = $('#ship-to-different-address-checkbox');
	  shippinginput.on( 'change', function() {
		$( 'div.shipping_address' ).hide();
		if ( $( this ).is( ':checked' ) ) {
			$( 'div.shipping_address' ).slideDown();
		}
	  } );

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


	
	

	// Sidebar Navigation
	const parent_container = $('.entry-content');
	const article_navigation = $('#article_navigation');
	const headings = [];
	const loading = article_navigation.find('.loading');

	// Add ID's to H2 tags and generate array
	parent_container.find('h2 , h3').each(function(index) {
		const that = $(this);
		const id_headings = index ; 
		that.attr('id', 'Kapitel_' + id_headings);
		headings.push(this.innerText);
	});

	//console.log(headings);
	// Create Sidebar Article Navigation
	//const index = 1;
	
	const $ul = $('<ul>', {class: "article_nav_list"}).append(
		headings.map( ( heading, index ) => 
		  $('<li>').append($('<a href="#Kapitel_' + index +'">').text(heading))
		)
	);
	
	loading.fadeOut();
	article_navigation.append($ul);
	
	$(document).on('click', 'a[href^="#"]', function (event) {
		event.preventDefault();
	
		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top
		}, 500);
	});
	//console.log($ul);

});

$( document ).ready(function() {
  
	const $sticky = $('.sticky > section');
	const $stickyrStopper = $('#colophon');
	if (!!$sticky.offset()) { // make sure ".sticky" element exists
  
	  const generalSidebarHeight = $sticky.innerHeight();
	  const stickyTop = $sticky.offset().top;
	  const stickOffset = 10;
	  const stickyStopperPosition = $stickyrStopper.offset().top;
	  const stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;
	  const diff = stopPoint + stickOffset;
  
	  $(window).scroll(function(){ // scroll event
		
		const windowTop = $(window).scrollTop(); // returns number
  
		if (stopPoint < windowTop) {
			$sticky.css({ position: 'absolute', top: diff });
		} else if (stickyTop < windowTop+stickOffset) {
			$sticky.css({ position: 'fixed', top: stickOffset });
		} else {
			$sticky.css({position: 'absolute', top: 'initial'});
		}
	  });
	}
  });  
})( jQuery );

