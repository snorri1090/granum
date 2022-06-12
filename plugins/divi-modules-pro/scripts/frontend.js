jQuery(function($) {

    if (window.ETBuilderBackend && window.ETBuilderBackend.defaults) {
        window.ETBuilderBackend.defaults.dmpro_before_after_slider = {
            before_image: window.DiviModulesProBuilderData.defaults.image,
            after_image: window.DiviModulesProBuilderData.defaults.image
        };
    }

    $.fn.dmpro_before_after_slider = function() {
        const container = $(this); 

        const options = $.extend({
            default_offset_pct: 0.5,
            orientation: 'horizontal',
            before_label: false,
            after_label: false,
            move_slider_on_hover: false,
            move_with_handle_only: false,
            click_to_move: true
        }, container.data("options"));


        var sliderPct = options.offset / 100;
        var beforeDirection = (options.direction === 'vertical') ? 'down' : 'left';
        var afterDirection = (options.direction === 'vertical') ? 'up' : 'right';

        const innerWrapper = $(`<div class="dmpro_before_after_slider_wrapper dmpro_before_after_slider_${options.direction}"></div>`)


        const beforeImage = $(`<img src="${options.before_image}" alt="${options.before_image_alt}" class="dmpro_before_after_slider_before"/>`);
        innerWrapper.append(beforeImage);

        const afterImage = $(`<img src="${options.after_image}" alt="${options.after_image_alt}" class="dmpro_before_after_slider_after"/>`);
        innerWrapper.append(afterImage);

        beforeImage.on("load", function() {
            adjustSlider(sliderPct);
        });

        const overlay = $("<div class='dmpro_before_after_slider_overlay'></div>");
        const beforeLabel = $(`<div class='dmpro_before_after_slider_before_label dmpro_before_after_slider_label' data-content="${options.before_label}"></div>`);
        const afterLabel = $(`<div class='dmpro_before_after_slider_after_label dmpro_before_after_slider_label' data-content="${options.after_label}"></div>`);
        overlay.append(beforeLabel);
        overlay.append(afterLabel);
        innerWrapper.append(overlay);

   
        const slider = $("<div class='dmpro_before_after_slider_handle'></div>");
        slider.append(`<span class="dmpro_before_after_slider_${beforeDirection}_arrow"></span>`);
        slider.append(`<span class="dmpro_before_after_slider_${afterDirection}_arrow"></span>`);
        innerWrapper.append(slider);

        container.html(innerWrapper);

 
        var calcOffset = function(dimensionPct) {
            let width = Math.ceil(beforeImage[0].getBoundingClientRect().width);
            let height = Math.ceil(beforeImage[0].getBoundingClientRect().height);
            return {
                mh: Math.floor(beforeImage[0].getBoundingClientRect().height),
                w: width + "px",
                h: height + "px",
                cw: Math.ceil(dimensionPct * width) + "px",
                ch: Math.ceil(dimensionPct * height) + "px"
            };
        };


        function adjustInnerWrapper(offset) {
            if (options.direction === 'vertical') {
                beforeImage.css("clip", `rect(0, ${offset.w}, ${offset.ch}, 0)`);
                afterImage.css("clip", `rect(${offset.ch}, ${offset.w}, ${offset.h}, 0)`);

                beforeLabel.css("clip", `rect(0, ${offset.w}, ${offset.ch}, 0)`);
                afterLabel.css("clip", `rect(${offset.ch}, ${offset.w}, ${offset.h}, 0)`);
            } else {
                beforeImage.css("clip", `rect(0, ${offset.cw}, ${offset.h}, 0)`);
                afterImage.css("clip", `rect(0, ${offset.w}, ${offset.h}, ${offset.cw})`);

                beforeLabel.css("clip", `rect(0, ${offset.cw}, ${offset.h}, 0)`);
                afterLabel.css("clip", `rect(0, ${offset.w}, ${offset.h}, ${offset.cw})`);
            }

            innerWrapper.css("height", offset.h);
        };

        function adjustSlider(pct) {
            const offset = calcOffset(pct);

            if (options.direction === "vertical") {
                slider.css("top", offset.ch);
            } else {
                slider.css("left", offset.cw);
            }

            adjustInnerWrapper(offset);
        };


        var minMaxNumber = function(num, min, max) {
            return Math.max(min, Math.min(max, num));
        };


        var getSliderPercentage = function(positionX, positionY) {
            var sliderPercentage = (options.direction === 'vertical') ?
                (positionY - offsetY) / imgHeight :
                (positionX - offsetX) / imgWidth;

            return minMaxNumber(sliderPercentage, 0, 1);
        };

        var offsetX = 0;
        var offsetY = 0;
        var imgWidth = 0;
        var imgHeight = 0;
        var onMoveStart = function(e) {
            if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && options.direction !== 'vertical') {
                e.preventDefault();
            } else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && options.direction === 'vertical') {
                e.preventDefault();
            }
            container.addClass("active");
            offsetX = container.offset().left;
            offsetY = container.offset().top;
            imgWidth = beforeImage.width();
            imgHeight = beforeImage.height();
        };
        var onMove = function(e) {
            if (container.hasClass("active")) {
                sliderPct = getSliderPercentage(e.pageX, e.pageY);
                adjustSlider(sliderPct);
            }
        };
        var onMoveEnd = function() {
            container.removeClass("active");
        };

        var moveTarget = options.move_with_handle_only ? slider : container;
        moveTarget.on("movestart", onMoveStart);
        moveTarget.on("move", onMove);
        moveTarget.on("moveend", onMoveEnd);

        if (options.move_slider_on_hover) {
            container.on("mouseenter", onMoveStart);
            container.on("mousemove", onMove);
            container.on("mouseleave", onMoveEnd);
        }

        slider.on("touchmove", function(e) {
            e.preventDefault();
        });

        container.find("img").on("mousedown", function(event) {
            event.preventDefault();
        });

        if (options.click_to_move) {
            container.on('click', function(e) {
                offsetX = container.offset().left;
                offsetY = container.offset().top;
                imgWidth = beforeImage.width();
                imgHeight = beforeImage.height();

                sliderPct = getSliderPercentage(e.pageX, e.pageY);
                adjustSlider(sliderPct);
            });
        }


        adjustSlider(sliderPct);

        $(window).on("resize", function() {
            adjustSlider(sliderPct);
        });
    };


    $('.dmpro_carousel').each(function(index, value) {
        let $this = $(this);
        var data = value.querySelector('.dmpro-carousel-main').dataset;
        let selector = "." + $this.attr('class').split(' ').join('.') + " .swiper-container";
        var navigation = "on" === data.navigation && {
            nextEl: ".dmpro_carousel .dmpro-sbn" + data.ordernumber,
            prevEl: ".dmpro_carousel .dmpro-sbp" + data.ordernumber
        };

        var dynamicbullets = ('on' == data.dynamicbullets) ? true : false;
        var pagination = "on" === data.pagination && {
            el: ".dmpro_carousel .dmpro-sp" + data.ordernumber,
            clickable: true,
            dynamicBullets: dynamicbullets,
            dynamicMainBullets: 1
        };

        var cfe = {
            rotate: Number(parseInt(data.rotate)),
            stretch: 5,
            depth: 100,
            modifier: 1,
            slideShadows: data.shadow,
        };

        let mySwiper = new Swiper(selector, {
            slidesPerView: Number(data.columnsphone),
            spaceBetween: Number(data.spacebetween_phone),
            speed: Number(data.speed),
            loop: "on" === data.loop,
            autoplay: "on" === data.autoplay && {
                delay: data.autoplayspeed
            },
            effect: data.effect,
            coverflowEffect: "coverflow" === data.effect ? cfe : null,
            navigation: navigation,
            pagination: pagination,
            centeredSlides: "on" === data.centered,
            slideClass: "dmpro_carousel_child",
            wrapperClass: "dmpro-carousel-wrapper",
            setWrapperSize: true,
            observer: true,
            observeParents: true,
            observeSlideChildren: true,
            breakpoints: {
                768: {
                    slidesPerView: Number(data.columnstablet),
                    spaceBetween: Number(data.spacebetween_tablet) > 0 ? Number(data.spacebetween_tablet) : Number(0),
                },
                981: {
                    slidesPerView: Number(data.columnsdesktop),
                    spaceBetween: Number(data.spacebetween) > 0 ? Number(data.spacebetween) : Number(0),
                }
            }
        });

        if ('on' === data.pauseonhover && 'on' === data.autoplay) {
            $this.find('.swiper-container').on('mouseenter', function(e) {
                mySwiper.autoplay.stop();
            });

            $this.find('.swiper-container').on('mouseleave', function(e) {
                mySwiper.autoplay.start();
            });
        }
    });



    $(document).ready(function() {
        $(".dmpro-lottie-icon").each(function() {
        
            let $this = $(this);
            let $data = $this.data("options");
            lottie.searchAnimations();

            let $lottie = lottie.loadAnimation({
                container: this,
                renderer: 'svg',
                loop: $data.loop,
                autoplay: $data.autoplay,
                path: $data.path,
                rendererSettings: {
                    progressiveLoad: false
                }
            });
            
            if(!$data.autoplay){
                $lottie.addEventListener('DOMLoaded', function(){
                    $lottie.goToAndStop(parseInt($data.start_frame) , true)
                })
            }

            if($data.autoplay && $data.stop_on_hover === 'on') {
                $(this).parent().mouseenter( function() {
                    $lottie.pause();
                });

                $(this).parent().mouseleave( function() {
                    $lottie.play();
                });
            } else if(!$data.autoplay && $data.play_on_hover === 'on') {
                $(this).parent().mouseenter( function() {
                    $lottie.play();
                });

                $(this).parent().mouseleave( function() {
                    $lottie.pause();
                });
            }

            $lottie.setSpeed($data.speed);
            $lottie.setDirection($data.direction);
            

        });
    });

    $(document).ready(function() {

        $('.dmpro_flip_box').parents('.et_pb_row').css("-webkit-transform", "translateZ(0)");

        $(".dmpro_image_accordion").each(function() {
            $(this).dmpro_image_accordion();
        });

        $('.dmpro_scroll_image').each(function(index, value) {

            let $this = $(this),
                data = value.querySelector('.dmpro-scroll-image').dataset,
                direction = data.direction,
                type = data.type,
                reverse = data.reverse,
                scroll_element = $this.find(".dmpro-image-scroll-container"),
                scroll_image = scroll_element.find('.dmpro-image-scroll-image img'),
                scroll_vertical = scroll_element.find(".dmpro-image-scroll-vertical"),
                scroll_overlay = scroll_element.find(".dmpro-image-scroll-overlay"),
                scroll_value = null,
                translate = '';

            function start_scroll_image() {
                scroll_image.css("transform", translate + "(-" + scroll_value + "px)");
            }

            function end_scroll_image() {
                scroll_image.css("transform", translate + "(0px)");
            }

            function set_scroll_image() {
                if (direction === "vertical") {
                    scroll_value = scroll_image.height() - scroll_element.height();
                    translate = "translateY";
                } else {
                    scroll_value = scroll_image.width() - scroll_element.width();
                    translate = "translateX";
                }
            }

            if (type === "on_hover") {

                if (reverse === 'on') {
                    set_scroll_image();
                    start_scroll_image();
                }

                scroll_element.mouseenter(function() {
                    scroll_element.removeClass("dmpro-container-scroll-anim-reset");
                    set_scroll_image();
                    reverse === 'on' ? end_scroll_image() : start_scroll_image();
                });

                scroll_element.mouseleave(function() {
                    reverse === 'on' ? start_scroll_image() : end_scroll_image();
                });

            } else {
                if (direction !== "vertical") {
                    let scroll_animate = false;
                    scroll_element.on('mousewheel DOMMouseScroll', function(e){
                        disable_body_scroll(e, scroll_element);
                        if(scroll_animate) return;
                        scroll_animate = true;
                        let scroll_value = scroll_element.scrollLeft() + (e.originalEvent.deltaY * 2)
                        scroll_element.animate({scrollLeft: scroll_value  }, 500,function(){
                            scroll_animate = false;
                        })
                    })
                    scroll_overlay.css({
                        "width": scroll_image.width(),
                        "height": scroll_image.height()
                    });
                }
            }
            function disable_body_scroll(e, ele) {
                var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
                ele.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
                e.preventDefault();
            }
        });
    });

    $(window).load(function() {
        $('.dmpro_before_after_slider').each(function() {
            let $wrapper = $(this).find(".dmpro_before_after_slider_container");
            $wrapper.dmpro_before_after_slider();
        });

        $('.dmpro_hover_box').each(function() {
            let $this = $(this);
            let $container = $this.find('.dmpro-hover-box-container');
            let $content = $container.find('.dmpro-hover-box-content');
            let $hover = $container.find('.dmpro-hover-box-hover');
            if ('on' === $container.attr('data-force_square')) {
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

        $('.dmpro_flip_box').each(function() {
            let $this = $(this);
            if ('on' === $this.find('.dmpro-flip-box-container').attr('data-dynamic_height')) {
                let $wrapper = $this.find(".dmpro-flip-box-inner-wrapper");
                let $front = $this.find('.dmpro-flip-box-front-side-innner');
                let $back = $this.find('.dmpro-flip-box-back-side-innner');

                function calculateHeight($element) {
                    var height = 0;
                    $element.children().each(function() {
                        height = height + $(this).outerHeight(true);
                    });

                    return $element.outerHeight(true) - $element.height() + height;
                }

                function setWrapperHeight($wrapper) {
                    let height = Math.max(calculateHeight($front), calculateHeight($back));
                    $wrapper.height(height);
                }

                new ResizeSensor($this, function() {
                    setWrapperHeight($wrapper);
                });

                setWrapperHeight($wrapper);
            }

            if ('on' === $this.find('.dmpro-flip-box-container').attr('data-force_square')) {
                let $wrapper = $this.find(".dmpro-flip-box-inner-wrapper");
                new ResizeSensor($this, function() {
                    $wrapper.height($wrapper.width());
                });
                $wrapper.height($wrapper.width());
            }
        });

    });

});