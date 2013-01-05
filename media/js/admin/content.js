// Generated by CoffeeScript 1.3.3
(function() {

  $(function() {
    $('body').on('keypress', 'input.page-uri', function(e) {
      var char, navigation, _ref;
      navigation = (_ref = e.keyCode) === 46 || _ref === 8 || _ref === 9 || _ref === 27 || _ref === 13 || _ref === 35 || _ref === 36 || _ref === 37 || _ref === 38 || _ref === 39;
      if (navigation || (e.keyCode === 65 && e.ctrlKey === true)) {
        return true;
      }
      char = String.fromCharCode(e.which);
      if (/--/.test($(this).val() + char)) {
        return false;
      }
      return /[a-z\-]/.test(String.fromCharCode(e.which));
    });
    return $('body').on('paste', 'input.page-uri', function(e) {
      return e.preventDefault();
    });
  });

  $(function() {
    return formContainer.on('form_loaded', function(e) {
      $('textarea.code', formContainer).each(function() {
        var editor;
        editor = CodeMirror.fromTextArea(this, {
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
        });
        return $(this).data('editor', editor);
      });
      $('.nav-tabs', formContainer).on('shown', function(e) {
        var codeMirror, editor;
        editor = $('div.tab-pane.active textarea.code').data('editor');
        codeMirror = $('div.tab-pane.active .CodeMirror');
        return editor != null ? editor.setSize(codeMirror.width(), codeMirror.height()) : void 0;
      });
      return $('[type="submit"]', formContainer).click(function() {
        return $('textarea.code', formContainer).each(function() {
          var editor;
          editor = $(this).data('editor');
          editor.save();
          $('.nav-tabs', formContainer).off('shown');
          return editor = null;
        });
      });
    });
  });

  $(function() {
    $('body .container').on('click', '.cke_contents a', function(e) {
      e.stopImmediatePropagation();
      e.preventDefault();
      return e.stopPropagation();
    });
    return formContainer.on('form_loaded', function(e) {
      $('textarea.editor', formContainer).each(function() {
        var editor;
        editor = CKEDITOR.replace(this, {
          language: 'ru'
        });
        return $(this).data('editor', editor);
      });
      return $('[type="submit"]', formContainer).click(function() {
        return $('textarea.editor', formContainer).each(function() {
          var editor;
          editor = $(this).data('editor');
          if (editor != null) {
            editor.destroy();
          }
          $('.nav-tabs', formContainer).off('shown');
          return editor = null;
        });
      });
    });
  });

}).call(this);
