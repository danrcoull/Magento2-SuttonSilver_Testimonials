var config = {
    paths:{
        swipper: 'SuttonSilver_Testimonials/js/swipper.min'
    },
    shim: {
        'swipper': {
            deps: ['jquery']
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