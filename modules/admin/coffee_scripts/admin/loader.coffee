
$ ->
  container = $('.container > .container-fluid')
  content = $(' > div.fluid-content', container)
  requestInfo = $(' > div.request-info', container)
  detailsContainer = $(' > .details-container', container)
  formContainer = $(' > .form-container', container)
  contentLinkElement = null
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
        formContainer.formControll {
          onCancel: ()->
            formContainer.formControll 'destroy'
            formContainer.hide().html ''
            content.show()
          onSuccess: ()->
            formContainer.formControll 'destroy'
            contentLinkElement.trigger 'click'
            content.show()
        }
        return
      if $this.hasClass 'action_details'
        detailsContainer
            .show()
            .html('<a href="#" class="details-close btn btn-info">Back</a>')
            .append data
        return
      contentLinkElement = $this
      content.show().html data
    )
    .error ()->
      if jxhr.status is 403
        location.reload()
        return

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
