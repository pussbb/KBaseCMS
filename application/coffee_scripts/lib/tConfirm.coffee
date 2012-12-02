
$ ->

  $.fn.tConfirm = (options)->
    this.each (key, value)->
      self = $(this)
      options = $.extend true, $.fn.tConfirm.defaults, options
      self.tDialog {
        title: options.title,
        content: options.content,
        buttons: [
          {
            title: options.confirm.title
            fn: ()->
              if IS.fn options.confirm.fn
                options.confirm.fn(self)
              self.tDialog 'close' if ! self.attr 'href'
              self.tDialog 'showProccess'
              self.tDialog 'hideButtons'
              $.ajax {
                url: self.attr('href'),
                type: 'DELETE',
                #data: self.data() || {},
                success: (data)->
                  if ! IS.empty data
                    self.tDialog 'hideProccess', 'Opps some error ocured'
                  self.tDialog 'close'
                  parent = self.parent('td')
                  if parent.length
                    parent.closest('tr').remove()

                error: ()->
                  self.tDialog 'hideProccess', 'Opps some error ocured'
              }

          },
          {
            title: options.reject.title
            fn: ()->
              self.tDialog 'close'
              if IS.fn options.reject.fn
                options.reject.fn(self)
          }
        ]
      }

  $.fn.tConfirm.defaults = {
    title: 'confirm dialog',
    content: 'Are you sure to do it?',
    confirm: {
      title: 'Yes',
      fn: null
    },
    reject: {
      title: 'No',
      fn: null
    },
  }

  $(document).on 'click', '[data-toggle="confirm"]', {}, (e)->
    e.stopImmediatePropagation()
    e.preventDefault()
    self = $(this)
    self.tConfirm {
      title: self.data('title') || self.html()
      content: self.data('content') || $.fn.tConfirm.defaults.content
    }
