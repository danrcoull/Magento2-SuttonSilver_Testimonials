require([
    'jquery',
    'jquery/ui',
    'mage/validation',
    'mage/translate'
], function ($) {


   var rules = {
        'validate-filesize': [ function (v, elm) {
            var maxSize = 5 * 102400;
            if (navigator.appName == "Microsoft Internet Explorer") {
                if (elm.value) {
                    var oas = new ActiveXObject("Scripting.FileSystemObject");
                    var e = oas.getFile(v);
                    var size = e.size;
                }
            } else {
                if (elm.files[0] != undefined) {
                    size = elm.files[0].size;
                }
            }
            if (size != undefined && size > maxSize) {
                return false;
            }
            return true;
        }, $.mage.__('The file size should not exceed 5MB') ],
        'validate-fileextensions': [ function (v, elm) {

            console.log('here');
            var extensions = ['jpeg', 'jpg', 'png', 'gif'];
            if (!v) {
                return true;
            }
            with (elm) {
                var ext = value.substring(value.lastIndexOf('.') + 1);
                for (i = 0; i < extensions.length; i++) {
                    if (ext == extensions[i]) {
                        return true;
                    }
                }
            }
            return false;
        }, $.mage.__('Disallowed file type.')],
        'validate-image-height-width':[ function (v, elm) {

            if (!v) {
                return true;
            }
            with (elm) {
                var file, img;
                if ((file = elm.files[0])) {
                    img = new Image();
                    img.onload = function () {
                        var height = this.height,
                            width = this.width;
                        if (height > 2056 || width > 2056) {
                            return false;
                        }

                        return true;
                    };
                }
            }
            return false;
        }, $.mage.__('Height and Width must not exceed 2056px.') ]

    };

    $.each(rules, function (i, rule) {
        rule.unshift(i);
        $.validator.addMethod.apply($.validator, rule);
    });



});