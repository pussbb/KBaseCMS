
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

    $('.nav-tabs', formContainer).on 'shown', (e)->
      editor = $('div.tab-pane.active textarea.code').data 'editor'
      codeMirror = $('div.tab-pane.active .CodeMirror')
      editor?.setSize codeMirror.width(), codeMirror.height()


    $('[type="submit"]', formContainer).click ()->
      $('textarea.code', formContainer).each ()->
        editor = $(this).data 'editor'
        editor.save()
        $('.nav-tabs', formContainer).off 'shown'
        editor = null



