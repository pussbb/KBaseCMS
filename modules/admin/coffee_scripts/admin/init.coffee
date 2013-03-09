root = exports ? this
contentLinkElement = null

$ ->
  widget = $('div.some-table').tWidget()
  root.container = $('.container > .container-fluid')
  root.content = $(' > div.fluid-content', root.container)
  root.requestInfo = $(' > div.request-info', root.container)
  root.detailsContainer = $(' > .details-container', root.container)
  root.formContainer = $(' > .form-container', root.container)
  contentLinkElement = null

  $('body').on 'mouseover mouseenter', '[rel="tooltip"]', ()->
    $(this).tooltip 'show'

  $(container).on 'click', 'ul.nav.nav-tabs a', (e)->
    e.preventDefault()
    $(this).tab 'show'

#show details
  $('body').on 'click', 'a.details-close', (e)->
    detailsContainer.html ''
    detailsContainer.hide()
    content.show()

# table item removed so reload page
  $(document).on 'itemremoved', 'table.data-table a.action_destroy', (e)->
    if ! contentLinkElement
      location.reload()
      return
    contentLinkElement.trigger 'click'
