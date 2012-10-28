
$ ->
  sidebar = $('#sidebar')
  ul = $('#sidebar > ul')
  $('#sidebar > a').click (e)->
    e.preventDefault()
    if sidebar.hasClass 'open'
      sidebar.removeClass 'open'
      ul.slideUp 250
    else
      sidebar.addClass 'open'
      ul.slideDown 250

  $('.submenu > a').click (e)->
    e.preventDefault()
    submenu = $(this).siblings 'ul'
    li = $(this).parents 'li'
    submenus = $('#sidebar li.submenu ul')
    submenus_parents = $('#sidebar li.submenu')
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