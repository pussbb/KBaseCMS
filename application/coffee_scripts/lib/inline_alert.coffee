
defaultOptions = {
  text: 'Oops some error occured',
  closable: true,
  append: false,
  type: 'alert-error',
  onClose: null
}
$ ->
#   alert 'dfd'
  $.fn.inlineAlert = (options = {})->
    options = $.extend defaultOptions, options
    alert = $('<div></div>').addClass 'alert'
    alert.addClass options.type
    if options.closable
      close = $('<a></a>').addClass 'close'
      close.attr 'data-dismiss', 'alert'
      close.text 'x'
      alert.append close
    alert.append options.text
    if options.append
      $(this).append alert
    else
      $(this).html alert
    if IS.fn options.onClose
      close.click options.onClose
