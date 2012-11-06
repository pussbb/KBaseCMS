
$ ->

  class TDialog
    constructor: (@elem, options)->
      options = $.extend {}, $.fn.tDialog.defaults, options
      @modal = $('<div>').attr 'id', 'modal-'+ new Date().getTime()
      @modal.addClass 'modal'
      $('body').append @modal
      @modal.append $('<div>').addClass('modal-header').html("<h3>#{options.title}</h3>")
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

    close: ()->
      @modal.modal 'hide'
      @elem.data 'tDialog', null
      @modal.remove()
      delete @


  $.fn.tDialog = (options)->
    this.each (key, value)->
      self = $(this)
      data = self.data 'tDialog'
      if ! data
        data = new TDialog self, options
        self.data 'tDialog', data
      else
        if IS.string options
          data[options]()

  $.fn.tDialog.defaults = {
    title: 'widget',
    content: null,
    url: null,
    buttons: [],
  }