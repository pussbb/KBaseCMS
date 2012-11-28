
$ ->

  class TDialog
    constructor: (@elem, options)->
      options = $.extend {}, $.fn.tDialog.defaults, options
      @modal = $('<div>').attr 'id', 'modal-'+ new Date().getTime()
      @modal.addClass 'modal'
      $('body').append @modal
      modalHeader = $('<div>').addClass('modal-header')

      modalHeader.append $('<button>')
                    .attr('type', 'button')
                    .addClass('close')
                    .attr('area-hidden', 'true')
                    .text('x')
      modalHeader.append "<h3>#{options.title}</h3>"
      @modal.append modalHeader

      modalHeader.on 'click', 'button.close', { originElem: @elem}, (e)->
        e.data.originElem.tDialog 'close'

      modalHeader = null
      @content = $('<div>').addClass 'modal-body'
      @modal.append @content

      if ! IS.empty options.content
        @content.html options.content
      @footer = $('<div>').addClass 'modal-footer'

      if IS.array options.buttons
        footer = @footer
        $(options.buttons).each ()->
          button = $('<button>').addClass('btn').text(this.title)
          onclick = this.fn
          button.on 'click', ()->
            onclick()
          footer.append button
      @modal.append @footer
      @modal.modal 'show'
      options = null

    close: ()->
      @modal.modal 'hide'
      @elem.data 'tDialog', null
      @modal.remove()
      delete @

    hideButtons: ()->
     @footer.hide()

    showButtons: ()->
      @footer.show()

    showProccess: ()->
      @contentHtml = @content.html()
      @content.pseudoAjaxLoadingProgress {timeout: 500}

    hideProccess: (data = null)->
      if ! IS.empty data
        @content.html data
      else
        @conten.html @contentHtml
        @contentHtml = null

  $.fn.tDialog = (options, optionData = null)->
    this.each (key, value)->
      self = $(this)
      data = self.data 'tDialog'
      if ! data
        data = new TDialog self, options
        self.data 'tDialog', data
      else
        if IS.string options
          data[options](optionData)

  $.fn.tDialog.defaults = {
    title: 'widget',
    content: null,
    url: null,
    buttons: [],
  }
