
$ ->

  formContainer.on 'form_loaded', (e)->
    $('textarea.code', formContainer).each ()->
      return if $(this).data 'codeEditor'
      codeEditor = CodeMirror.fromTextArea this, {
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
      $(this).data 'codeEditor', codeEditor

    $('.nav-tabs', formContainer).on 'shown', (e)->
      codeEditor = $('div.tab-pane.active textarea.code').data 'codeEditor'
      codeMirror = $('div.tab-pane.active .CodeMirror')
      codeEditor?.setSize codeMirror.width(), codeMirror.height()


    $('[type="submit"]', formContainer).click ()->
      $('textarea.code', formContainer).each ()->
        codeEditor = $(this).data 'codeEditor'
        codeEditor.save()
        $('.nav-tabs', formContainer).off 'shown'
        codeEditor = null



