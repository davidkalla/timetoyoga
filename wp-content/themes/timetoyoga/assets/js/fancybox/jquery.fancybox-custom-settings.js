(function( $ ) {
    $.fn.customFancybox = function() {
    
        $(this.selector).fancybox({
            padding  : 0,
            loop     : false,
            closeBtn : false,
            margin   : [0, 20, 0, 20],
            
            beforeShow: function () {
                $.fancybox.wrap.bind("contextmenu", function (e) {
                    return false; 
                });
            },
            
            helpers	: {
                title	: {
                    type: 'over'
                },
                thumbs	: {
                    width	: 50,
                    height	: 50
                },
                buttons	: {
                    position : 'top'
                }
            },

            //effects
            prevEffect	: 'none',
            nextEffect	: 'none',
            openEffect  : 'none',
            closeEffect : 'none'

        });

    };
})( jQuery );

jQuery(document).ready(function() {
    
    jQuery(function() { 
        jQuery('a[data-rel]').each(function() {
            jQuery(this).attr('rel', jQuery(this).data('rel'));
        });

        jQuery("a[rel^='fancybox']").customFancybox();
    }); 
});