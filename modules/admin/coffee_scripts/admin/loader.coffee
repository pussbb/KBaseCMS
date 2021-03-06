
destroyFormContainer = ()->
  formContainer.formControll 'destroy'
  formContainer.hide().html ''

$ ->

  jxhr = null

  $('body').on 'click', 'a[href!="#"][data-toggle!="confirm"][data-click!=""][data-dismiss!=""]:not([href^="javascript"]):not([href^="#"]):not([target="_blank"])', (e)->
    e.preventDefault()
    $this = $(@)
    return if ! $this.prop 'href'
    content.hide()
    detailsContainer.hide()
    formContainer.hide()
    destroyFormContainer()

    requestInfo.show().pseudoAjaxLoadingProgress {timeout: 500}

    if IS.object jxhr
      jxhr.abort()
    jxhr = $.get( $this.attr('href'), $this.data('request'),(data)->
      requestInfo.hide().html()

      if $this.attr('class')?.match /action_(new|edit)/
        formContainer.show().html data
        formContainer.trigger 'form_loaded'
        formContainer.formControll {
          onCancel: ()->
            destroyFormContainer()
            content.show()
          onSuccess: ()->
            destroyFormContainer()
            findContentLink() if ! contentLinkElement
            contentLinkElement.trigger 'click'
            content.show()
          onLoad: ()->
            $('ul.nav-tabs a:first',formContainer).tab 'show'
            formContainer.trigger 'form_loaded'
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
      $('ul.nav.nav-tabs a:first', container).each ()->
        $(this).tab 'show'
