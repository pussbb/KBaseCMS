
$ ->
  container = $('.container .container-fluid')
  $('#sidebar a, ul.nav a').on 'click', (e)->
    e.preventDefault()
    href = $(this).attr 'href'
    return if /#/.test href
    container.pseudoAjaxLoadingProgress {timeout: 500}
    $.get( href, (data)->
      container.html data
    )
    .error ()->
      container.inlineAlert {text: 'Could not load page', closable: false}
