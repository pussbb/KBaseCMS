
$ ->
  container = $('.container .container-fluid')
  jxhr = null
  $('#sidebar a, ul.nav a').on 'click', (e)->

    return if $(this).data 'click'
    e.preventDefault()
    href = $(this).attr 'href'
    return if /#/.test href
    container.pseudoAjaxLoadingProgress {timeout: 500}
    $.get( href, (data)->
      container.html data
    )
    .error ()->
      container.inlineAlert {text: 'Could not load page', closable: false}
