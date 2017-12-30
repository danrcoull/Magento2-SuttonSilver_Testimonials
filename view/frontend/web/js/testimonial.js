define([
    'jquery',
    'jquery/ui',
    'mage/loader',
    'mage/validation' // usually widget can be found in /lib/web/mage dir
], function($){
    "use strict";

    $.widget('mage.testimonial', {
        options: {
            confirmMsg: ('submitting ajax.')
        },
        _create: function () {
            var self = this;
            var form = $(self.options.formElement);

            console.log('started new function');


            form.on('submit', function(e){
                e.preventDefault();
                console.log('form submmited');
                console.log(form.validation() && form.validation('isValid'));
                if(form.validation() && form.validation('isValid'))
                {
                    var data = new FormData(this);
                    $.ajax({
                        url: self.options.submitUrl, // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false,        // To send DOMDocument or non processed data file it is set to false
                        success: function(data)   // A function to be called if request succeeds
                        {
                            if(data.success){
                                form.hide() ;
                                form.prepend("<p>thanks for your testimonial</p>");
                            }
                        }
                    });
                }
            })
        }
    });
    return $.mage.testimonial;
});