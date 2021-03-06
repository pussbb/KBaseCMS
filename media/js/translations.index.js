(function() {

  $(function() {
    var MOVE_NOT_TRANSLATED, SHOW_NOT_TRANSLATED, SHOW_TRANSLATED, hide_edit_form, records_actions, show_all, translations_table;
    $("a.inline_edit").live('click', function(e) {
      var fields, html, key, parent, translation_text, value;
      e.preventDefault();
      parent = $(this).parent();
      translation_text = $("span.translation", parent).html();
      $(this).remove();
      fields = {
        'identifier': 'identifier',
        'language-id': 'language_id'
      };
      html = "<form class=\"submit_translation\" action=\"" + url_base + "translations/update\" method=\"POST\">";
      for (key in fields) {
        value = fields[key];
        html += "<input name=\"" + value + "\" type=\"hidden\" value=\"" + (parent.data(key)) + "\"/>";
      }
      html += "    <textarea class=\"hidden\" name=\"old-translation\">" + translation_text + "</textarea>    <textarea name=\"translation\">" + translation_text + "</textarea>    <span class=\"label label-success save\"><i class=\"icon-ok\"></i> Save</span>    <span class=\"label label-inverse cancel\"><i class=\"icon-minus-sign\"></i> Cancel</span>    </form>";
      $("span.translation", parent).html(html);
      return $("span.translation textarea", parent).width($("span.translation", parent).width() - 10);
    });
    $("span.save").live("click", function() {
      var area, self;
      self = $(this).closest('form.submit_translation');
      area = self.closest("div.editable-area");
      console.log('save');
      return $(this).closest("form").submit(function() {
        console.log('save');
        hide_edit_form(self);
        area.append("<span class=\"ok\">ok</span>");
        area.find('span.ok').fadeOut(900, function() {
          return $(this).remove();
        });
        return true;
      });
    });
    hide_edit_form = function(object) {
      var area, self, text;
      area = object.closest("div.editable-area");
      self = $('form.submit_translation', area);
      text = $('textarea[name="old-translation"]', area).val();
      if (!text.trim()) text = $('textarea[name="translation"]', area).val();
      area.html("");
      return area.append("<span class=\"translation\">" + text + "</span><a href=\"#\" class=\"inline_edit\">      <span class=\"label label-warning\">        <i class=\"icon-pencil\"></i> Edit      </span>    </a>");
    };
    $("span.cancel").live("click", function() {
      return hide_edit_form($(this));
    });
    translations_table = $('table#translations-table tbody');
    $(".btn-group.right a").on('click', function(event) {
      return event.preventDefault();
    });
    show_all = function() {
      return $("tr", translations_table).show();
    };
    SHOW_TRANSLATED = 1;
    SHOW_NOT_TRANSLATED = 2;
    MOVE_NOT_TRANSLATED = 3;
    records_actions = function(options) {
      show_all();
      return $("tr", translations_table).each(function() {
        var self, tr_obj;
        self = $(this);
        tr_obj = this;
        return $("td", self).each(function() {
          var html, length;
          length = $("span.translation", $(this)).length;
          html = $("span.translation", $(this)).html();
          switch (options.action) {
            case SHOW_TRANSLATED:
              if (length && !html) return self.hide();
              break;
            case SHOW_NOT_TRANSLATED:
              if (length && html) return self.hide();
              break;
            case MOVE_NOT_TRANSLATED:
              if (length && !html) {
                translations_table.prepend(tr_obj.cloneNode(true));
                self.remove();
                return false;
              }
          }
        });
      });
    };
    $('#show-all').on('click', function() {
      return show_all();
    });
    $('#show-translated').on('click', function() {
      return records_actions({
        action: SHOW_TRANSLATED
      });
    });
    $('#show-not-translated').on('click', function() {
      return records_actions({
        action: SHOW_NOT_TRANSLATED
      });
    });
    return $("#move-not-translated-up").on('click', function() {
      return records_actions({
        action: MOVE_NOT_TRANSLATED
      });
    });
  });

}).call(this);
