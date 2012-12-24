
$ ->
  formContainer.on 'form_loaded', (e)->
    $('textarea.code', formContainer).each ()->
      editor = CodeMirror.fromTextArea this, {
        lineNumbers: true,
        lineWrapping: true,
        autofocus: true,
        mode: 'php',
        theme: 'monokai',
        tabSize: 4,
        indentUnit: 4,
        indentWithTabs: true,
        autoCloseTags: true,
        tabMode: "indent"
      }
      $(this).data 'editor', editor

    $('[type="submit"]', formContainer).click ()->
      $('textarea.code', formContainer).each ()->
        editor = $(this).data 'editor'
        return if ! editor
        $(this).val editor.getValue()
        editor = null



