
$ ->

  class TWidget
    constructor: (@elem, options)->
      options = $.extend {}, $.fn.tWidget.defaults, options
      widgetTitle = $('<div>').addClass 'widget-title'
      if options.icon
        widgetTitle.append "<span class=\"icon\">#{options.icon}</span>"
      widgetTitle.append "<h5>#{options.title}</h5>"
      if options.wrap
        elem.wrap '<div class="widget-content" />'
        @content = elem.parent()
      else
        elem.append '<div class="widget-content" />'
        @content = $('div.widget-content', elem)

      @content.wrap '<div class="widget-box" />'
      @widget = @content.parent()
      @widget.prepend widgetTitle

    remove: ()->
      @widget.replaceWith @elem
      @elem.data 'TWidget', null
      delete @

    show: ()->
      widget.show()

    hide: ()->
      widget.hide()


  $.fn.tWidget = (options)->
    this.each (key, value)->
      self = $(this)
      data = self.data 'TWidget'
      if ! data
        data = new TWidget self, options
        self.data 'TWidget', data
      else
        if IS.string options
          data[options]()

  $.fn.tWidget.defaults = {
    title: 'widget',
    url: null,
    icon: null,
    wrap: true
  }
#   $.fn.tWidget.Constructor = TWidget
