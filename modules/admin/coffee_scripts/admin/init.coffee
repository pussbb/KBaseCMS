root = exports ? this

$ ->
  widget = $('div.some-table').tWidget()
  root.container = $('.container > .container-fluid')
  root.content = $(' > div.fluid-content', root.container)
  root.requestInfo = $(' > div.request-info', root.container)
  root.detailsContainer = $(' > .details-container', root.container)
  root.formContainer = $(' > .form-container', root.container)
  $('body').on 'mouseover mouseenter', '[rel="tooltip"]', ()->
    $(this).tooltip 'show'
