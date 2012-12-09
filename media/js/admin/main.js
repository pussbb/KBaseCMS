// Generated by CoffeeScript 1.4.0
(function() {

  $(function() {
    var widget;
    widget = $('div.some-table').tWidget();
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
    var container, content, contentLinkElement, detailsContainer, formContainer, jxhr, requestInfo;
    container = $('.container > .container-fluid');
    content = $(' > div.fluid-content', container);
    requestInfo = $(' > div.request-info', container);
    detailsContainer = $(' > .details-container', container);
    formContainer = $(' > .form-container', container);
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
    return $('body').on('click', 'a[href!="#"][data-toggle!="confirm"][data-click!=""][data-dismiss!=""]:not([href^="#"])', function(e) {
      var $this;
      e.preventDefault();
      $this = $(this);
      content.hide();
      detailsContainer.hide();
      formContainer.hide();
      requestInfo.show().pseudoAjaxLoadingProgress({
        timeout: 500
      });
      if (IS.object(jxhr)) {
        jxhr.abort();
      }
      return jxhr = $.get($(this).attr('href'), function(data) {
        requestInfo.hide().html();
        if ($this.hasClass('action_new' || $this.hasClass('action_edit'))) {
          formContainer.show().html(data);
          formContainer.formControll({
            onCancel: function() {
              formContainer.formControll('destroy');
              formContainer.hide().html('');
              return content.show();
            },
            onSuccess: function() {
              formContainer.formControll('destroy');
              contentLinkElement.trigger('click');
              return content.show();
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
