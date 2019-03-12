/*! Lazy Load 1.9.7 - MIT license - Copyright 2010-2015 Mika Tuupola */
!function(a,b,c,d){var e=a(b);a.fn.lazyload=function(f){function g(){var b=0;i.each(function(){var c=a(this);if(!j.skip_invisible||c.is(":visible"))if(a.abovethetop(this,j)||a.leftofbegin(this,j));else if(a.belowthefold(this,j)||a.rightoffold(this,j)){if(++b>j.failure_limit)return!1}else c.trigger("appear"),b=0})}var h,i=this,j={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!1,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return f&&(d!==f.failurelimit&&(f.failure_limit=f.failurelimit,delete f.failurelimit),d!==f.effectspeed&&(f.effect_speed=f.effectspeed,delete f.effectspeed),a.extend(j,f)),h=j.container===d||j.container===b?e:a(j.container),0===j.event.indexOf("scroll")&&h.bind(j.event,function(){return g()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,(c.attr("src")===d||c.attr("src")===!1)&&c.is("img")&&c.attr("src",j.placeholder),c.one("appear",function(){if(!this.loaded){if(j.appear){var d=i.length;j.appear.call(b,d,j)}a("<img />").bind("load",function(){var d=c.attr("data-"+j.data_attribute);c.hide(),c.is("img")?c.attr("src",d):c.css("background-image","url('"+d+"')"),c[j.effect](j.effect_speed),b.loaded=!0;var e=a.grep(i,function(a){return!a.loaded});if(i=a(e),j.load){var f=i.length;j.load.call(b,f,j)}}).attr("src",c.attr("data-"+j.data_attribute))}}),0!==j.event.indexOf("scroll")&&c.bind(j.event,function(){b.loaded||c.trigger("appear")})}),e.bind("resize",function(){g()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&e.bind("pageshow",function(b){b.originalEvent&&b.originalEvent.persisted&&i.each(function(){a(this).trigger("appear")})}),a(c).ready(function(){g()}),this},a.belowthefold=function(c,f){var g;return g=f.container===d||f.container===b?(b.innerHeight?b.innerHeight:e.height())+e.scrollTop():a(f.container).offset().top+a(f.container).height(),g<=a(c).offset().top-f.threshold},a.rightoffold=function(c,f){var g;return g=f.container===d||f.container===b?e.width()+e.scrollLeft():a(f.container).offset().left+a(f.container).width(),g<=a(c).offset().left-f.threshold},a.abovethetop=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollTop():a(f.container).offset().top,g>=a(c).offset().top+f.threshold+a(c).height()},a.leftofbegin=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollLeft():a(f.container).offset().left,g>=a(c).offset().left+f.threshold+a(c).width()},a.inviewport=function(b,c){return!(a.rightoffold(b,c)||a.leftofbegin(b,c)||a.belowthefold(b,c)||a.abovethetop(b,c))},a.extend(a.expr[":"],{"below-the-fold":function(b){return a.belowthefold(b,{threshold:0})},"above-the-top":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-screen":function(b){return a.rightoffold(b,{threshold:0})},"left-of-screen":function(b){return!a.rightoffold(b,{threshold:0})},"in-viewport":function(b){return a.inviewport(b,{threshold:0})},"above-the-fold":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-fold":function(b){return a.rightoffold(b,{threshold:0})},"left-of-fold":function(b){return!a.rightoffold(b,{threshold:0})}})}(jQuery,window,document);

(function() {

  // Utility
  function listenFor(events, onElement, thenDo) {
    if ( document.addEventListener ) {
      onElement.addEventListener(events, thenDo); 
    } else if ( document.attachEvent ) {
      onElement.attachEvent(events, thenDo);
    }
  }

  // Nav Menu
  function MicroNav(nav) {
    this.nav = nav;
    this.toggle = this.nav.getElementsByClassName("Nav--mobile-toggle")[0];
    this.menu = this.nav.getElementsByClassName("menu")[0];
    this.toggling();
  }
  MicroNav.prototype.toggling = function() {
    var menu = this.menu;
    listenFor("click", this.toggle, function(e) {
      if (menu.classList.contains('open')) e.preventDefault();
      menu.classList.toggle("open");
    });
  };
  function loadMicroNavs() {
    var navs = document.getElementsByClassName("Nav--root");
    for ( i = 0; i < navs.length; ++i ) {
      new MicroNav(navs[i]);
    } 
  }

  // Inline Inputs
  function MicroInline(element) {
    this.element = element;
    this.field = this.element.getElementsByClassName("field")[0];
    console.log(this.field);
    this.button = this.element.getElementsByClassName("button")[0];
    var width = this.button.offsetWidth;
    this.field.style.paddingRight = width + "px";
  }
  function loadMicroInlines() {
    var inlines = document.getElementsByClassName("inlined");
    var inline;
    for ( i = 0; i < inlines.length; ++i ) {
      inline = new MicroInline(inlines[i]);
    }
  }

  // Lazy Load
  function loadMicroDeferred() {
    var images = document.getElementsByClassName("deferred");
    var image, offscreen;
    for ( i = 0; i < images.length; ++i ) {
      image = images[i];
      image.style.paddingBottom = 0;
      image.style.width = "auto";
      image.src = image.getAttribute("data-src");
    }
  }

  // Document Load States
  var documentElement = document;
  listenFor("readystatechange", documentElement, function(){
    if ( document.readyState == "interactive" ) {
      documentInteractive();
    }

    if ( document.readyState == "complete") {
      documentComplete();
    }
  });

  // Document is Interactive
  function documentInteractive() {
    loadMicroNavs();
    loadMicroInlines();
  }

  // Document is Complete
  function documentComplete() {
    jQuery('.lazy').lazyload({effect: "fadeIn"});
  }

  // On Scroll
  listenFor("scroll", documentElement, function() {
    loadMicroDeferred();
  });
  
})();

WebFontConfig = {
  google: { families: [ 'Playfair+Display:400,400i,700,700i', 'Libre+Baskerville:400,400italic,700:latin' ] }
};
(function() {
  var wf = document.createElement('script');
  wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();