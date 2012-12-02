
$ ->
  class formControl
    constructor: (@form, options)->
      @cancelButton = $('button.cancel-btn', @form)
      if ! @cancelButton.length
        @cancelButton = $('<button>').addClass 'btn btn-warning cancel-btn'
        @cancelButton.attr('type', 'button').text 'Cancel'
        $('.form-actions', @form).append @cancelButton
      self = @
      @cancelButton.click (e)->
        e.preventDefault()
        options.onCancel @form if IS.fn options.onCancel
        self.destroy()


      $('button[type="submit"]', @form).click (e)->
        e.preventDefault()

        $.ajax
          url: $(@form).attr('action'),
          type: $(@form).attr('method')?.toUpperCase() || 'POST' ,
          data: $(@form).serialize(),
          success: (data)->
            if ! data
              options.onSuccess($(@form)) if IS.fn options.onSuccess
            else
              options.onLoad($(@form)) if IS.fn options.onLoad
          error: ()->
            options.onLoad($(@form)) if IS.fn options.onLoad

    destroy: ()->
      @cancelButton = null
      @form = null
      delete @



  $.fn.formControll = (options)->
    this.each (key, value)->
      self = $(this)
      data = self.data 'formControl'
      if ! data
        data = new formControl self, options
        self.data 'formControl', data
      else
        if IS.string options
          data[options]()

  $.fn.formControll.defaults = {
    onCancel: null,
    onSubmit: null,
    onSuccess: null,
    onLoad: null
  }
