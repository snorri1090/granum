jQuery(function($) {
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
            // grabCursor: true,
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
        $this.find(".dmpro-carousel-main.dmpro_loading").removeClass("dmpro_loading").show();
    });

});