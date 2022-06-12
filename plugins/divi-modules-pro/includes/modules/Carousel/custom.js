jQuery(function($) {
	
    $('.dmpro_carousel').each(function(index, value) {
		
        let $this = $(this)
        , selector = "." + $this.attr('class').split(' ').join('.') + " .swiper";
		
		var data = value.querySelector('.dmpro-carousel-main').dataset
        , navigation = "on" === data.navigation && {
            nextEl: ".dmpro_carousel .dmpro-sbn" + data.ordernumber,
            prevEl: ".dmpro_carousel .dmpro-sbp" + data.ordernumber
        }
        , dynamicbullets = ('on' === data.dynamicbullets) ? true : false
        , pagination = "on" === data.pagination && {
            el: ".dmpro_carousel .dmpro-sp" + data.ordernumber,
            clickable: true,
            dynamicBullets: dynamicbullets,
            dynamicMainBullets: 1
        }
		, coverflowParams = {
            rotate: Number(parseInt(data.rotate)),
            stretch: 5, // Default is 0
            slideShadows: data.shadow,
        };
		
        $this.find(".dmpro-carousel-main.dmpro_loading").removeClass("dmpro_loading").show();
		
		const swiper = new Swiper( selector, {
            slidesPerView: Number(data.columnsphone),
            spaceBetween: Number(data.spacebetween_phone),
			speed: Number(data.speed),
			loop: "on" === data.loop,
            autoplay: "on" === data.autoplay && {
                delay: data.autoplayspeed,
				pauseOnMouseEnter: 'on' === data.pauseonhover
            },
			effect: data.effect,
			coverflowEffect: "coverflow" === data.effect ? coverflowParams : null,
			pagination: pagination,
			navigation: navigation,
			centeredSlides: "on" === data.centered,
			slideClass: "dmpro_carousel_child",
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

    });

});