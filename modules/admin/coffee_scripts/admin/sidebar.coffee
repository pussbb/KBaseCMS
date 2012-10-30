
$ ->
  sidebar = $('#sidebar')
  submenus = $('#sidebar li.submenu ul')
  submenus_parents = $('#sidebar li.submenu')
  ul = $('#sidebar > ul')

  $('#sidebar ul:first a').on 'click', (e)->
    e.preventDefault()
    if sidebar.hasClass 'open' then sidebar.removeClass 'open' else sidebar.addClass 'open'
    li = $(this).parents 'li'
    #checks if li is a submenu item
    if li.closest('li.open').length
      #reset previouse active submenu item and set new
      $('li.active', submenus).removeClass 'active'
      li.addClass 'active'
      return
    #reset previous state and set new active element
    $('li.active', ul).removeClass 'active'
    $('li.open', ul).removeClass 'open'
    li.addClass 'active'
    submenus.hide()

    submenu = $('ul', li)
    return if ! submenu.length

    if li.hasClass 'open'
      if ($(window).width() > 768) || ($(window).width() < 479)
        submenu.slideUp()
      else
        submenu.fadeOut 250
      li.removeClass 'open'
    else
      if ($(window).width() > 768) || ($(window).width() < 479)
        submenus.slideUp()
        submenu.slideDown()
      else
        submenus.fadeOut 250
        submenu.fadeIn 250
      li.addClass 'open'