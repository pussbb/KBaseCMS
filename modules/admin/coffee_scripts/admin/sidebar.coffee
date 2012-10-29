
$ ->
  sidebar = $('#sidebar')
  submenus = $('#sidebar li.submenu ul')
  submenus_parents = $('#sidebar li.submenu')
  ul = $('#sidebar > ul')
  $('#sidebar ul:first a').click (e)->
    e.preventDefault()
    if sidebar.hasClass 'open' then sidebar.removeClass 'open' else sidebar.addClass 'open'

    li = $(this).parents 'li'
    $('li.active', ul).removeClass 'active'
    li.addClass 'active'
    submenus.hide()
    submenus_parents.removeClass 'open'
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
      submenus_parents.removeClass 'open'
      li.addClass 'open'