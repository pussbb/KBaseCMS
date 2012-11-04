
$ ->

  class TWidget
    constructor: (@elem, options)->
      options = $.extend {}, $.fn.tWidget.defaults, options
      widgetTitle = $('<div>').addClass 'widget-title'
      if options.icon
        widgetTitle.append "<span class=\"icon\">#{options.icon}</span>"
      widgetTitle.append "<h5>#{options.title}</h5>"

      elem.wrap '<div class="widget-content" />'
      @content = elem.parent()
      @content.wrap '<div class="widget-box" />'
      @widget = @content.parent()
      @widget.prepend widgetTitle

    remove: ()->
      @widget.replaceWith @elem
      @elem.data 'TWidget', null
      delete @



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
  }
#   $.fn.tWidget.Constructor = TWidget