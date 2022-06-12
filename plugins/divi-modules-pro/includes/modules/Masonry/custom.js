jQuery(function($) {
    $.fn.lockScroll=function(e) {
        e.preventDefault();
    }
    $.fn.dmpro_masonry_gallery = function(params) {
        let $this = $(this);
        if (typeof $.magnificPopup === "undefined") {
            setTimeout(function() {
                $this.dmpro_masonry_gallery(params);
            }, 300);
            return;
        }

        var masonry = $this.masonry({
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true,
            gutter: '.gutter-sizer',
        });

        $this.find('.grid-item .img-container').magnificPopup({
            type: 'image',
            removalDelay: 500,
            fixedContentPos: false,
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                tCounter: '%curr% / %total%'
            },
            mainClass: 'mfp-fade',
            zoom: {
                enabled: true,
                duration: 500,
                opener: function(element) {
                    return element.find('img');
                }
            },
            autoFocusLast: false,
            image: {
                verticalFit: true,
                titleSrc: function(item) {
                    let title = "";
                    if (item.el.attr('data-title')) {
                        title += item.el.attr('data-title');
                    }
                    if (item.el.attr('data-caption')) {
                        title += "<small class='dmpro_masonry_gallery_caption'>" + item.el.attr('data-caption') + "</small>";
                    }
                    return title;
                }
            },
            disableOn: function() {
                if (window.matchMedia("(max-width: 767px)").matches) {
                    return $this.hasClass("show_lightbox_phone")
                } else if (window.matchMedia("(max-width: 980px)").matches) {
                    return $this.hasClass("show_lightbox_tablet");
                }
                else {
                    return $this.hasClass("show_lightbox");
                }           
            },
            callbacks: {
                open: function() {
                    var swidth=(window.innerWidth-$(window).width());
                    jQuery('body').addClass('noscroll');
                    /* To fix jumping, need to set scroll width as margin-right */
                    jQuery('body').css('margin-right', swidth + 'px');
                },
                close: function() {
                    jQuery('body').removeClass('noscroll');
                    jQuery('body').css('margin-right', 0);
                }
            }
        });

        $this.find('.grid-item .img-container').on('click', function(e) {
            e.preventDefault();
            return true;
        });

        var layout = $.debounce(250, function() {
            masonry.masonry('layout');
        });

        if ($this.attr("data-lazy") === "true") {
            var observer = new MutationObserver(layout);
            var config = { attributes: true, childList: true, subtree: true };
            observer.observe($this[0], config);
        }

        masonry.imagesLoaded().progress(layout);

        return masonry.masonry('layout');
    };

    $(".dmpro_masonry_gallery").each(function() {
        var clazz = $(this).attr("class").replace(/ /g, ".");
        $("." + clazz + " .grid").dmpro_masonry_gallery();
    });

    $('.dmpro_masonry_gallery .grid .grid-item').hover(
        function() { //handlerIn
            const icon_element = $(this).find(".dmpro-mansonry-gallery-icon");
            icon_element.replaceWith(icon_element.clone());

            const title_element = $(this).find(".dmpro-mansonry-gallery-title");
            title_element.replaceWith(title_element.clone());
            
            const caption_element = $(this).find(".dmpro-mansonry-gallery-caption");
            caption_element.replaceWith(caption_element.clone());
        }, 
    );
});
