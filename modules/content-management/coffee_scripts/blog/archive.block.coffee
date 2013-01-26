
$ ->
  $('ul.archive-list li:first ol').removeClass 'hidden'

  $('ul.archive-list > li').hover ()->
    $('ul.archive-list li ol[class!="hidden"]').addClass 'hidden'
    $('ol:first', this).removeClass 'hidden'
