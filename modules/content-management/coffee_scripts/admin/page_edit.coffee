
$ ->
  formContainer.on 'form_loaded', (e)->
    $('textarea.code', formContainer).each ()->
      CodeMirror.fromTextArea this, {
        lineNumbers: true,
        lineWrapping: true,
        autofocus: true,
        mode: 'php',
        theme: 'monokai',
        tabSize: 4,
        indentUnit: 4,
        indentWithTabs: true,
        autoCloseTags: true
      }


