(function($) {
  $(window).on("load", function() {
    $('a[href^="#"]').BackToTheTop();
  });

  $.fn.BackToTheTop = function( options ) {

    var defaults = {
      duration: 300,
      easing: 'swing',
      offset: 0,
      scrolloffset: 0,
      fadein: 'slow',
      fadeout: 'slow',
      display: 'bottom-right',
      top: 0,
      bottom: 0,
      left: 0,
      right: 0,
      zIndex: 999,
      position : 'fixed'
    };

    $.extend( defaults, options );

    var init = function() {
      $('a[href^="#"]').click(function() {
        var scrollTop = $(this).data('backtothetop-scrolltop') !== undefined ? $(this).data('backtothetop-scrolltop') : $(this.hash).offset() ? $(this.hash).offset().top : $(this).attr('id') == 'backtothetop-fixed' && $(this).attr('href') == '#' ? 0 : null ;

        if (scrollTop === null)
            return;

        var duration = $(this).data('backtothetop-duration') ? $(this).data('backtothetop-duration') : defaults.duration ;
        var easing = $(this).data('backtothetop-easing') ? $(this).data('backtothetop-easing') : defaults.easing ;
        var offset = $(this).data('backtothetop-offset') !== undefined ? $(this).data('backtothetop-offset') : defaults.offset ;
        $('html,body').animate({ 'scrollTop' : scrollTop + offset }, duration, easing);

        return false;
      });
    };

    var fixed = function() {
      var elem = $('a#backtothetop-fixed');
      if ( !elem )
        return;
      var scrollOffset = elem.data('backtothetop-fixed-scroll-offset') !== undefined ? elem.data('backtothetop-fixed-scroll-offset') : defaults.scrolloffset ;
      var fadeIn = elem.data('backtothetop-fixed-fadein') ? elem.data('backtothetop-fixed-fadein') : defaults.fadein ;
      var fadeOut = elem.data('backtothetop-fixed-fadeout') ? elem.data('backtothetop-fixed-fadeout') : defaults.fadeout ;
      var display = elem.data('backtothetop-fixed-display') ? elem.data('backtothetop-fixed-display') : defaults.display ;
      var top = elem.data('backtothetop-fixed-top') ? elem.data('backtothetop-fixed-top') : defaults.top ;
      var bottom = elem.data('backtothetop-fixed-bottom') ? elem.data('backtothetop-fixed-bottom') : defaults.bottom ;
      var left = elem.data('backtothetop-fixed-left') ? elem.data('backtothetop-fixed-left') : defaults.left ;
      var right = elem.data('backtothetop-fixed-right') ? elem.data('backtothetop-fixed-right') : defaults.right ;
      var zindex = elem.data('backtothetop-fixed-zindex') ? elem.data('backtothetop-fixed-zindex') : defaults.zIndex ;

      if (display == 'top-left') {
        bottom = 'none';
        right = 'none';
      }
      else if (display == 'top-right') {
        bottom = 'none';
        left = 'none';
      }
      else if (display == 'bottom-left') {
        top = 'none';
        right = 'none';
      }
      else if (display == 'bottom-right') {
        top = 'none';
        left = 'none';
      }

      elem.css({ 'display' : 'none' });

      $(window).scroll(function () {
        if ($(this).scrollTop() > scrollOffset) {
          elem.css({
            'top' : top,
            'bottom' : bottom,
            'left' : left,
            'right' : right,
            'zIndex' : zindex,
            'position' : defaults.position
          });

          if (elem.css('display') == 'none' ) {
            elem.fadeIn(fadeIn);
          }

        }
        else if ($(this).scrollTop() <= 0 + scrollOffset) {
          if (elem.css('display') != 'none' ) {
            elem.fadeOut(fadeOut);
          }
        }
      });
    };

    init();
    fixed();

  };
})(jQuery);
