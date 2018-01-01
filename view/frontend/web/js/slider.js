define([
    'jquery',
    'jquery/ui',
    'swipper',
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

            var mySwiper = new Swiper(element.className, {

                spaceBetween: 100,
                centeredSlides:true,
                effect:'coverflow',
                direction:'vertical',
                speed:600,
                coverflowEffect:{slideShadows:false}
            });
        }


    });
    return $.mage.slider;
});