
$ ->

  class formControl
    constructor: (@formContainer, options)->
      @.init()
      @formContainer.on 'click', 'button.cancel-btn', (e)->
        e.preventDefault()
        options.onCancel @formContainer if IS.fn options.onCancel

      $(@formContainer).on 'click', 'button[type="submit"]', {"formContainer": @formContainer}, (e)->
        e.preventDefault()
        form = $('form:first', formContainer)
        $.ajax
          url: form.attr('action'),
          type: form.attr('method')?.toUpperCase() || 'POST' ,
          data: form.serialize(),
          success: (data)->
            if ! data.length
              options.onSuccess(formContainer) if IS.fn options.onSuccess
            else
              formContainer.html data
              formContainer.formControll 'init'
              options.onLoad(formContainer) if IS.fn options.onLoad
          error: ()->
            formContainer.formControll 'init'
            options.onLoad(formContainer) if IS.fn options.onLoad

    destroy: ()->
      $(@formContainer).off 'click', 'button.cancel-btn'
      @cancelButton = null
      $(@formContainer).off 'click', 'button[type="submit"]'
      @formContainer.data 'formControl', null
      @formContainer = null

      delete @

    init: ()->
      @cancelButton = $('button.cancel-btn', @formContainer)
      if ! @cancelButton.length
        @cancelButton = $('<button>').addClass 'btn btn-warning cancel-btn'
        @cancelButton.attr('type', 'button').text 'Cancel'
        $('.form-actions', @formContainer).append @cancelButton


  $.fn.formControll = (options)->
    this.each (key, value)->
      $this = $(this)
      data = $this.data 'formControl'
      if ! data
        data = new formControl $this, options
        $this.data 'formControl', data
      else
        if IS.string options
          data[options]()

  $.fn.formControll.defaults = {
    onCancel: null,
    onSubmit: null,
    onSuccess: null,
    onLoad: null
  }
