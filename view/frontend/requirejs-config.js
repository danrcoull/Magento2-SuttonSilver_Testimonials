var config = {
    paths:{
        slick: 'SuttonSilver_Testimonials/js/slick.min'
    },
    shim: {
        "slick" : {
            deps: ['jquery'],
            exports: 'jQuery.fn.slick'
        },
    },
    map: {
        '*': {
            testimonial: 'SuttonSilver_Testimonials/js/testimonial',
            imagevalidation: 'SuttonSilver_Testimonials/js/image-validation',
            slider: 'SuttonSilver_Testimonials/js/slider',

        }
    }
};