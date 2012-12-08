
$ ->
  widget = $('div.some-table').tWidget()
  $('body').on 'mouseover mouseenter', '[rel="tooltip"]', ()->
    $(this).tooltip 'show'
