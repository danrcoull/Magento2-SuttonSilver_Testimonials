define([
    'jquery',
    'jquery/ui',
    'slick',
    "domReady!"
], function($){
    "use strict";

    $.widget('mage.slider', {
        options: {
            confirmMsg: ('submitting ajax.')
        },
        _create: function () {
            var self = this;
            var element =self.element;


            element.slick({
                infinite: true,
                slidesToShow: 3,
                lazyLoad: 'ondemand',
                dots: false,
                speed: 400,
                responsive: [
                    {
                        breakpoint: 1280,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            dots: true,
                            slidesToScroll: 2
                        }
                    }, {

                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1,
                            dots: true,
                            slidesToScroll: 1
                        }
                    }, {
                        breakpoint: 300,
                        settings: "unslick" // destroys slick
                    }]
            });

        }


    });
    return $.mage.slider;
});