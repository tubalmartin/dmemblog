/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas, David Knight. Dual MIT/BSD license */

window.matchMedia || (window.matchMedia = function() {
    "use strict";

    // For browsers that support matchMedium api such as IE 9 and webkit
    var styleMedia = (window.styleMedia || window.media);

    // For those that don't support matchMedium
    if (!styleMedia) {
        var style       = document.createElement('style'),
            script      = document.getElementsByTagName('script')[0],
            info        = null;

        style.type  = 'text/css';
        style.id    = 'matchmediajs-test';

        script.parentNode.insertBefore(style, script);

        // 'style.currentStyle' is used by IE <= 8 and 'window.getComputedStyle' for all other browsers
        info = ('getComputedStyle' in window) && window.getComputedStyle(style, null) || style.currentStyle;

        styleMedia = {
            matchMedium: function(media) {
                var text = '@media ' + media + '{ #matchmediajs-test { width: 1px; } }';

                // 'style.styleSheet' is used by IE <= 8 and 'style.textContent' for all other browsers
                if (style.styleSheet) {
                    style.styleSheet.cssText = text;
                } else {
                    style.textContent = text;
                }

                // Test if media query is true or false
                return info.width === '1px';
            }
        };
    }

    return function(media) {
        return {
            matches: styleMedia.matchMedium(media || 'all'),
            media: media || 'all'
        };
    };
}());
;(function(win, $, undefined){

    function Site () {
        this.$win = $(win)
        this.$body = $('body')
        this.$primaryMenuWrapper = $('#primary-menu-wrapper')
        this.$primaryMenuOpener = $('#primary-menu-opener')
        this.$primaryMenuCloser = $('#primary-menu-closer')
        this.primaryMenuOpenClassName = 'primary-menu-open'
        this.gridBreakpoints = {
            sm: 576,
            md: 768,
            lg: 992,
            xl: 1200
        }
    }

    Site.prototype = {
        init: function () {
            this.update = this.bindMethod(this.update)
            this.togglePrimaryMenuSubMenu = this.bindMethod(this.togglePrimaryMenuSubMenu)
            this.togglePrimaryMenuOpenClassName = this.bindMethod(this.togglePrimaryMenuOpenClassName)
            this.$win.on('resize orientationchange', this.update);
            this.$primaryMenuOpener.on('click', this.togglePrimaryMenuOpenClassName);
            this.$primaryMenuCloser.on('click', this.togglePrimaryMenuOpenClassName);
            this.$primaryMenuWrapper.on('click', '.sub-menu-toggler', this.togglePrimaryMenuSubMenu)
        },

        bindMethod: function (method) {
            var self = this;
            return function() {
                var args = Array.apply(null, arguments);
                args.unshift(this)
                return method.apply(self, args)
            }
        },

        isBreakpointUp: function (breakpoint) {
            return win.matchMedia('(min-width: '+ this.gridBreakpoints[breakpoint] +'px)').matches
        },

        isBreakpointDown: function (breakpoint) {
            return win.matchMedia('(max-width: '+ (this.gridBreakpoints[breakpoint] - 1) +'px)').matches
        },

        togglePrimaryMenuOpenClassName: function () {
            this.$body.toggleClass(this.primaryMenuOpenClassName)
        },

        togglePrimaryMenuSubMenu: function (thisEl) {
            this.isBreakpointDown('md') && $(thisEl).closest('.menu-item').andSelf().toggleClass('open');
        },

        update: function () {
            if (this.isBreakpointUp('md')) {
                this.$body.removeClass(this.primaryMenuOpenClassName)
            }
        }
    }

    $(function(){
        (new Site).init()
    })

}(window, jQuery))