// Generated by CoffeeScript 1.3.3
(function() {
  var root;

  root = typeof exports !== "undefined" && exports !== null ? exports : this;

  $(function() {
    var widget;
    widget = $('div.some-table').tWidget();
    root.container = $('.container > .container-fluid');
    root.content = $(' > div.fluid-content', root.container);
    root.requestInfo = $(' > div.request-info', root.container);
    root.detailsContainer = $(' > .details-container', root.container);
    root.formContainer = $(' > .form-container', root.container);
    return $('body').on('mouseover mouseenter', '[rel="tooltip"]', function() {
      return $(this).tooltip('show');
    });
  });

  $(function() {
    var sidebar, submenus, submenus_parents, ul;
    sidebar = $('#sidebar');
    submenus = $('#sidebar li.submenu ul');
    submenus_parents = $('#sidebar li.submenu');
    ul = $('#sidebar > ul');
    return $('#sidebar ul:first a').on('click', function(e) {
      var li, submenu;
      e.preventDefault();
      if (sidebar.hasClass('open')) {
        sidebar.removeClass('open');
      } else {
        sidebar.addClass('open');
      }
      li = $(this).parents('li');
      if (li.closest('li.open').length) {
        $('li.active', submenus).removeClass('active');
        li.addClass('active');
        return;
      }
      $('li.active', ul).removeClass('active');
      $('li.open', ul).removeClass('open');
      li.addClass('active');
      submenus.hide();
      submenu = $('ul', li);
      if (!submenu.length) {
        return;
      }
      if (li.hasClass('open')) {
        if (($(window).width() > 768) || ($(window).width() < 479)) {
          submenu.slideUp();
        } else {
          submenu.fadeOut(250);
        }
        return li.removeClass('open');
      } else {
        if (($(window).width() > 768) || ($(window).width() < 479)) {
          submenus.slideUp();
          submenu.slideDown();
        } else {
          submenus.fadeOut(250);
          submenu.fadeIn(250);
        }
        return li.addClass('open');
      }
    });
  });

  $(function() {
    var contentLinkElement, jxhr;
    contentLinkElement = null;
    jxhr = null;
    $(container).on('click', 'ul.nav.nav-tabs a', function(e) {
      e.preventDefault();
      return $(this).tab('show');
    });
    $('body').on('click', 'a.details-close', function(e) {
      detailsContainer.html('');
      detailsContainer.hide();
      return content.show();
    });
    return $('body').on('click', 'a[href!="#"][data-toggle!="confirm"][data-click!=""][data-dismiss!=""]:not([href^="javascript"]):not([href^="#"]):not([target="_blank"])', function(e) {
      var $this;
      e.preventDefault();
      $this = $(this);
      if (!$this.prop('href')) {
        return;
      }
      content.hide();
      detailsContainer.hide();
      formContainer.hide();
      if (!formContainer.is(':empty')) {
        formContainer.formControll('destroy');
        formContainer.hide().html('');
      }
      requestInfo.show().pseudoAjaxLoadingProgress({
        timeout: 500
      });
      if (IS.object(jxhr)) {
        jxhr.abort();
      }
      return jxhr = $.get($(this).attr('href'), function(data) {
        var _ref;
        requestInfo.hide().html();
        if ((_ref = $this.attr('class')) != null ? _ref.match(/action_[new|edit]/) : void 0) {
          formContainer.show().html(data);
          formContainer.trigger('form_loaded');
          formContainer.formControll({
            onCancel: function() {
              formContainer.formControll('destroy');
              formContainer.hide().html('');
              return content.show();
            },
            onSuccess: function() {
              formContainer.formControll('destroy');
              formContainer.hide().html('');
              contentLinkElement.trigger('click');
              return content.show();
            },
            onLoad: function() {
              $('ul.nav-tabs a:first', formContainer).tab('show');
              return formContainer.trigger('form_loaded');
            }
          });
          return;
        }
        if ($this.hasClass('action_details')) {
          detailsContainer.show().html('<a href="#" class="details-close btn btn-info">Back</a>').append(data);
          return;
        }
        contentLinkElement = $this;
        return content.show().html(data);
      }).error(function() {
        if (jxhr.status === 403) {
          location.reload();
          return;
        }
        return requestInfo.inlineAlert({
          text: 'Could not load page',
          closable: true,
          onClose: function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            requestInfo.hide().html();
            return content.show();
          }
        });
      }).complete(function() {
        jxhr = null;
        return $('ul.nav.nav-tabs a:first', container).each(function() {
          return $(this).tab('show');
        });
      });
    });
  });

}).call(this);
