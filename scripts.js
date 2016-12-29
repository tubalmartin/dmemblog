window.matchMedia||(window.matchMedia=function(){"use strict";var a=window.styleMedia||window.media;if(!a){var b=document.createElement("style"),c=document.getElementsByTagName("script")[0],d=null;b.type="text/css",b.id="matchmediajs-test",c.parentNode.insertBefore(b,c),d="getComputedStyle"in window&&window.getComputedStyle(b,null)||b.currentStyle,a={matchMedium:function(a){var c="@media "+a+"{ #matchmediajs-test { width: 1px; } }";return b.styleSheet?b.styleSheet.cssText=c:b.textContent=c,"1px"===d.width}}}return function(b){return{matches:a.matchMedium(b||"all"),media:b||"all"}}}()),function(a,b,c){function d(){this.$win=b(a),this.$body=b("body"),this.$primaryMenuWrapper=b("#primary-menu-wrapper"),this.$primaryMenuOpener=b("#primary-menu-opener"),this.$primaryMenuCloser=b("#primary-menu-closer"),this.primaryMenuOpenClassName="primary-menu-open",this.gridBreakpoints={sm:576,md:768,lg:992,xl:1200}}d.prototype={init:function(){this.update=this.bindMethod(this.update),this.togglePrimaryMenuSubMenu=this.bindMethod(this.togglePrimaryMenuSubMenu),this.togglePrimaryMenuOpenClassName=this.bindMethod(this.togglePrimaryMenuOpenClassName),this.$win.on("resize orientationchange",this.update),this.$primaryMenuOpener.on("click",this.togglePrimaryMenuOpenClassName),this.$primaryMenuCloser.on("click",this.togglePrimaryMenuOpenClassName),this.$primaryMenuWrapper.on("click",".sub-menu-toggler",this.togglePrimaryMenuSubMenu)},bindMethod:function(a){var b=this;return function(){var c=Array.apply(null,arguments);return c.unshift(this),a.apply(b,c)}},isBreakpointUp:function(b){return a.matchMedia("(min-width: "+this.gridBreakpoints[b]+"px)").matches},isBreakpointDown:function(b){return a.matchMedia("(max-width: "+(this.gridBreakpoints[b]-1)+"px)").matches},togglePrimaryMenuOpenClassName:function(){this.$body.toggleClass(this.primaryMenuOpenClassName)},togglePrimaryMenuSubMenu:function(a){this.isBreakpointDown("md")&&b(a).closest(".menu-item").andSelf().toggleClass("open")},update:function(){this.isBreakpointUp("md")&&this.$body.removeClass(this.primaryMenuOpenClassName)}},b(function(){(new d).init()})}(window,jQuery);