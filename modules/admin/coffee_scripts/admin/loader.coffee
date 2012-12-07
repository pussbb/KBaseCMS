
$ ->
  container = $('.container > .container-fluid')
  content = $(' > div.fluid-content', container)
  requestInfo = $(' > div.request-info', container)
  detailsContainer = $(' > .details-container', container)
  formContainer = $(' > .form-container', container)

  jxhr = null

  $('body').on 'click', 'a.details-close', (e)->
    detailsContainer.html ''
    detailsContainer.hide()
    content.show()

  $('body').on 'click', 'a[href!="#"][data-toggle!="confirm"][data-click!=""][data-dismiss!=""]', (e)->
    e.preventDefault()
    $this = $(this)
    content.hide()
    detailsContainer.hide()
    formContainer.hide()
    requestInfo.show().pseudoAjaxLoadingProgress {timeout: 500}

    if IS.object jxhr
      jxhr.abort()

    jxhr = $.get( $(this).attr('href'), (data)->
      requestInfo.hide().html()
      if $this.hasClass 'action_new' or $this.hasClass 'action_edit'
        formContainer.show().html data
        $('form', formContainer).formControll {
          onCancel: ()->
            formContainer.hide().html ''
            content.show()
        }
        return
      if $this.hasClass 'action_details'
        detailsContainer
            .show()
            .html('<a href="#" class="details-close btn btn-info">Back</a>')
            .append data
        return
      content.show().html data
    )
    .error ()->
      requestInfo.inlineAlert {
        text: 'Could not load page',
        closable: true,
        onClose: (e) ->
          e.preventDefault()
          e.stopImmediatePropagation()
          requestInfo.hide().html()
          content.show()
      }
    .complete ()->
      jxhr = null
