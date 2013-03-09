ckeditor_config = {
  language: document.documentElement.lang || 'en',
  width: '76%',
  height: 300,
  autoGrow_maxHeight: 300,
  autoGrow_minHeight: 500
}

$ ->

  class formControl
    constructor: (@container, options)->
      @.init()
      @container.on 'click', 'button.cancel-btn', (e)->
        e.preventDefault()
        options.onCancel @container if IS.fn options.onCancel

      $(@container).on 'click', 'button[type="submit"]', (e)=>
        e.preventDefault()
        @deleteCKEditor()
        form = $('form:first', @container)
        container = @container
        $.ajax
          url: form.attr('action'),
          type: form.attr('method')?.toUpperCase() || 'POST' ,
          data: form.serialize(),
          success: (data)->
            if ! data.length
              options.onSuccess(container) if IS.fn options.onSuccess
            else
              container.html data
              container.formControll 'init'
              options.onLoad(container) if IS.fn options.onLoad
          error: ()->
            container.formControll 'init'
            options.onLoad(container) if IS.fn options.onLoad
          complete: ()->
            container.formControll 'init'
            options.onLoad(container) if IS.fn options.onLoad

    deleteCKEditor: ()->
      return if ! CKEDITOR
      $('textarea.editor', @container).each ()->
        editor = $(@).data 'editor'
        return if ! editor
        editor.updateElement()
        editor.destroy()
        $(@).data 'editor', null

    destroy: ()->
      $(@container).off 'click', 'button.cancel-btn'
      @cancelButton = null
      @deleteCKEditor()
      $(@container).off 'click', 'button[type="submit"]'
      @container.data 'formControl', null
      $('.nav-tabs', @container).off 'shown'
      @container = null
      delete @

    init: ()->
      @cancelButton = $('button.cancel-btn', @container)
      if ! @cancelButton.length
        @cancelButton = $('<button>').addClass 'btn btn-warning cancel-btn'
        @cancelButton.attr('type', 'button').text 'Cancel'
        $('.form-actions', @container).append @cancelButton

      if CKEDITOR
        $('textarea.editor', @container).each ()->
          return if $(@).data 'editor'
          editor = CKEDITOR.replace @, ckeditor_config
          $(@).data 'editor', editor


  $.fn.formControll = (options)->
    this.each ->
      $this = $(this)
      data = $this.data 'formControl'
      if ! data
        data = new formControl $this, options
        $this.data 'formControl', data
      if IS.string options
        data[options]()

  $.fn.formControll.defaults = {
    onCancel: null,
    onSubmit: null,
    onSuccess: null,
    onLoad: null
  }
