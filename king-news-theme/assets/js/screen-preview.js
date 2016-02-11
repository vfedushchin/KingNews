jQuery(document).ready(function($){



/* start for screenshort image - developing 
=============================================*/ 
// ------------------------------------------------------------------------
function setCookie(name, value, options) {
    options = options || {};
    var expires = options.expires;
    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }
    value = encodeURIComponent(value);
    var updatedCookie = name + "=" + value;
    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }
    document.cookie = updatedCookie;
};

// ------------------------------------------------------------------------
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
};
// ------------------------------------------------------------------------
function deleteCookie(name) {
    setCookie(name, "", {
        expires: -1
    });
};
// ------------------------------------------------------------------------
var _display_screen_class;
_display_screen_class = getCookie('_display_screen_class');


;(function ($) { 
    $("body").prepend("<div class='preview-container pr-bg-1'><div class='preview-container_bg'></div></div>");
    $('.preview-container').addClass(_display_screen_class);
    addEventListener("keydown", function(event) {
        if (event.keyCode == 81 && event.ctrlKey) {
            //press Ctl+q to show/hide screenshort
            // $('.preview-container').toggleClass('display');
            if ($('.preview-container').hasClass("display")) {
                $('.preview-container').removeClass('display');
                setCookie('_display_screen_class', '');
            } else {
                $('.preview-container').addClass('display');
                setCookie('_display_screen_class', 'display');
            }
        }
    });
})(jQuery);
/* end for screenshort image - developing 
=============================================*/



});