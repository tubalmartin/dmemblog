(function(win, $, undefined){ 

    function Site () {
        this.a=2
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