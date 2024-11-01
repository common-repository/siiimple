/**
* Salient toTop rewrited functions.
*
* @since 3.0.5
*/
(function($, window, document) {
    "use strict";
    var $window = $(window),
        $body = $('body'),
        $offCanvasEl = $('#slide-out-widget-area');
    setTimeout(function () {
        if ($('.nectar-social.fixed').length == 0) {
            iiiShowToTop();
        }
        $('.container-wrap').removeClass('no-shadow');
    }, 500);
    setTimeout(function () {
        if ($('.nectar-social.fixed').length == 0) {
            iiiShowToTop();
        }
    }, 600);
    if ($('.nectar-social.fixed').length == 0) {
        iiiHideToTop();
    }
    function iiiToTopBind() {
        if ($('#to-top, #to-iii_01, #to-iii_02').length > 0 && $window.width() > 1020 || 
        $('#to-top, #to-iii_01, #to-iii_02').length > 0 && $('#to-top.mobile-enabled, #to-iii_01.mobile-enabled, #to-iii_02.mobile-enabled').length > 0) {
            if (nectarDOMInfo.scrollTop > 350) {
                $window.on('scroll', iiiHideToTop);
            } else {
                $window.on('scroll', iiiShowToTop);
            }
        }
    }
    function iiiShowToTop() {
        if (nectarDOMInfo.scrollTop > 350 && !$offCanvasEl.is('.fullscreen.open') ) {
            $('#to-top').stop().transition({
                'transform': 'translateY(-50%)'
            }, 350, 'easeInOutCubic');
            $('#to-iii_01').stop().transition({
                'transform': 'translateY(-150%)'
            }, 350, 'easeInOutCubic');
            $('#to-iii_02').stop().transition({
                'transform': 'translateY(-285%)'
            }, 350, 'easeInOutCubic');
            $window.off('scroll', iiiShowToTop);
            $window.on('scroll', iiiHideToTop);
        }
    }
    function iiiHideToTop() {
        if (nectarDOMInfo.scrollTop < 350 || $offCanvasEl.is('.fullscreen.open') ) {
            var $animationTiming = ($('#slide-out-widget-area.fullscreen.open').length > 0) ? 1150 : 350;
            $('#to-top').stop().transition({
                'transform': 'translateY(105%)'
            }, $animationTiming, 'easeInOutQuint');
            $('#to-iii_01, #to-iii_02').stop().transition({
                'transform': 'translateY(105%)'
            }, $animationTiming, 'easeInOutQuint');
            $window.off('scroll', iiiHideToTop);
            $window.on('scroll', iiiShowToTop);
        }
    }
    function iiiScrollToTopInit() {
        if ($('.nectar-social.fixed').length == 0) {
            iiiToTopBind();
        }
        // Scroll up click event
        $body.on('click', '#to-iii_01, a[href="#iii_01"]', function () {
            $('body,html').stop().animate({
                scrollTop: $("#iii_01").offset().top
            }, 800, 'easeOutQuad', function () {
                if ($('.nectar-box-roll').length > 0) {
                    $body.trigger('mousewheel', [1, 0, 0]);
                }
            });
            return false;
        });
        // Scroll up click event
        $body.on('click', '#to-iii_02, a[href="#iii_02"]', function () {
            $('body,html').stop().animate({
                scrollTop: $("#iii_02").offset().top
            }, 800, 'easeOutQuad', function () {
                if ($('.nectar-box-roll').length > 0) {
                    $body.trigger('mousewheel', [1, 0, 0]);
                }
            });
            return false;
        });
    }
    jQuery(document).ready(function ($) {
        iiiScrollToTopInit();
    });
}(window.jQuery, window, document));