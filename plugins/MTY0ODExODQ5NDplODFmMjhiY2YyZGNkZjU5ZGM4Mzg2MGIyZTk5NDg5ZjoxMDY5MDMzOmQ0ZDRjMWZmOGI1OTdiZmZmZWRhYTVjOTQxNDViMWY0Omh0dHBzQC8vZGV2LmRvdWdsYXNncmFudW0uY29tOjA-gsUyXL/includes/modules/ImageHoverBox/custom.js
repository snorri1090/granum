jQuery(function($) {
    function force_is_square () {
        $('.dmpro_hover_box').each(function() {
            let $this = $(this);
            let $container = $this.find('.dmpro-hover-box-container');
            let $content = $container.find('.dmpro-hover-box-content');
            let $hover = $container.find('.dmpro-hover-box-hover');
            if ( $container.attr('data-force_square') === 'on' ) {
                new ResizeSensor($this, function() {
                    let width = $container.width();
                    $container.height(width);
                    $content.outerHeight(width);
                    $hover.outerHeight(width);
                });
                let width = $container.width();
                $container.height(width);
                $content.outerHeight(width);
                $hover.outerHeight(width);
            }
        });
    }
    $(document).ready(function(){
        force_is_square()
    });
    window.addEventListener("load", function() {
        force_is_square()
    });
    window.onload = function() {
        force_is_square()
    }
});