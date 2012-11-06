
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
              self.tDialog 'close'
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

  $('a[data-toggle="confirm"]').on 'click', (e)->
    e.preventDefault()
    e.stopImmediatePropagation()
    self = $(this)
    $(this).tConfirm {
      title: self.html()
      confirm: {
        fn: ()->
          $.get self.attr 'href'
      }
    }