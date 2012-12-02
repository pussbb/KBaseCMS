
$ ->
  container = $('.container .container-fluid')
  jxhr = null

  $('body').on 'click', 'a[href!="#"][data-toggle!="confirm"][!data-click]',(e)->
    e.preventDefault()
    container.pseudoAjaxLoadingProgress {timeout: 500}

    if IS.object jxhr
      jxhr.abort()

    jxhr = $.get( $(this).attr('href'), (data)->
      container.html data
    )
    .error ()->
      container.inlineAlert {text: 'Could not load page', closable: false}
    .complete ()->
      jxhr = null
