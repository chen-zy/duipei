window._ = require('lodash');
window.md5 = require('js-md5');
window.URI = require('urijs');
window.Swal = require('sweetalert2');

_window = (self == top) ? window : parent.window;
_document = (self == top) ? document : parent.document;

window.$$ = {};
$$.ajax = function (url, options) {
    if (typeof url === "object") {
        options = url;
        url = undefined;
    }
    var settings = {};
    if (options.success) {
        settings.success = options.success;
    }
    var options = $.extend(options, {
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        error: function (jqXHR, textStatus, errorThrown) {
            switch (jqXHR.status) {
                case 422:
                    var message = Object.values(jqXHR.responseJSON.errors)[0][0];
                    if (Object.keys(jqXHR.responseJSON.errors).length > 1) {
                        message = '';
                        $.each(jqXHR.responseJSON.errors, function () {
                            message += this[0] + '<br />';
                        });
                    }
                    Swal({
                        type: 'warning',
                        title: '请完善以下信息',
                        html: message
                    });
                    break;
                default:
                    Swal({
                        type: 'info',
                        title: '很抱歉,网络系统繁忙',
                        text: jqXHR.responseJSON.message
                    });
            }

        },
        success: function (data, textStatus, jqXHR) {
            settings.success(data, textStatus, jqXHR);
        }
    });
    $.ajax(url, options);
};
$$.toast = _window.Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});