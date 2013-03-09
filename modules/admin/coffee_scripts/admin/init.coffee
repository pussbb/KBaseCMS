root = exports ? this
contentLinkElement = null
findContentLink = ->
  contentLinkElement = $("a[href*=\"#{location.pathname}\"]")

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

# table manipulations
  $(document).on 'itemremoved', 'table.data-table a.action_destroy', (e)->
    table = $(e.target).closest 'table'
    if ! contentLinkElement
      findContentLink()

    if $('tbody tr', table).length <= 1 and $('select.offset option:last', table).is ':selected'
      $('select.limit', table ).trigger 'change'
      return
    contentLinkElement.trigger 'click'

  $(document).on 'change', 'table.data-table tfoot select', (e)->
    data = {}
    if $(@).hasClass 'limit'
      data[@name] = $(@).val()
    else
      parent = $(e.target).closest 'tfoot'
      $('select', parent).each ()->
        data[@name] = $(@).val()

    if ! contentLinkElement
      location.search = $.param data
      document.location = location
      return

    contentLinkElement.data 'request', data
    contentLinkElement.trigger 'click'

