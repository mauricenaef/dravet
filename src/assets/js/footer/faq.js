// jQuery and before image loaded

( function( $ ) {
	$(document).ready(function () {

        $('.card-content').find('.accordion-toggle').on( "click", function(){
            $(this).next().slideToggle('fast').prev().toggleClass('open');      
            //Hide the other panels
            $(".accordion-content").not($(this).next()).slideUp('fast').prev().removeClass('open');
      
        });

        let select = $('#select-faq');
        let cardcontent = $('#card-content');
        let loading = $('#loading-faq');
        

        select.on('change', function(event) {

            loading.removeClass('loaded');
            cardcontent.addClass('fadeout');
            let term_id = this.value;
            
            $.ajax({
                type:       'POST',
                url:        php_vars.ajaxurl,
                data:       { 
                    action: "dravet_faq_ajax", 
                    term: term_id
                },
                success:    function(response) {
                    cardcontent.removeClass('fadeout');
                    cardcontent.html(response);
                    loading.addClass('loaded');
                    return false;
                }
            });
        }).change();
    });

    // When Ajax ready
    $(document).ajaxComplete(function(){
        // Accordion
        $('.card-content').find('.accordion-toggle').on( "click", function(){
            $(this).next().slideToggle('fast').prev().toggleClass('open');      
            //Hide the other panels
            $(".accordion-content").not($(this).next()).slideUp('fast').prev().removeClass('open');
      
        });
    })
} )( jQuery );