(function($) {
  'use strict';
  $(function() {
    var $fullText = $('.admin-fullText');
    $('#admin-fullscreen').on('click', function() {
      $.AMUI.fullscreen.toggle();
    });

    $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function() {
      $fullText.text($.AMUI.fullscreen.isFullscreen ? '全屏' : '全屏');
    });

    $('.select-cont').click(function() {
      $(this).focus();
      $(this).select();
    });
  });
})(jQuery);