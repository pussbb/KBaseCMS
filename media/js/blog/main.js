// Generated by CoffeeScript 1.3.3
(function() {

  $(function() {
    $('ul.archive-list li:first ol').removeClass('hidden');
    return $('ul.archive-list > li').hover(function() {
      $('ul.archive-list li ol[class!="hidden"]').addClass('hidden');
      return $('ol:first', this).removeClass('hidden');
    });
  });

}).call(this);