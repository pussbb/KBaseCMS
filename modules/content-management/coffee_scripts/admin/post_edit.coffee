
$ ->

  $('body .container').on 'click', '.cke_contents a', (e)->
    e.stopImmediatePropagation()
    e.preventDefault()
    e.stopPropagation()

  formContainer.on 'form_loaded', (e)->
    $('textarea.editor', formContainer).each ()->
      editor = CKEDITOR.replace this, {
        language: 'ru'
      }
      $(this).data 'editor', editor

    $('[type="submit"]', formContainer).click ()->
      $('textarea.editor', formContainer).each ()->
        editor = $(this).data 'editor'
        editor?.destroy()
        $('.nav-tabs', formContainer).off 'shown'
        editor = null
