
$ ->
  $('body').on 'keypress', 'input.page-uri', (e)->
    navigation = e.keyCode in [46, 8, 9, 27, 13, 35, 36, 37, 38, 39]
    return true if navigation or (e.keyCode is 65 and e.ctrlKey is true)
    char = String.fromCharCode(e.which)
    return false if /--/.test $(this).val()+char
    /[a-z\-]/.test String.fromCharCode(e.which)

  $('body').on 'paste', 'input.page-uri', (e)->
    e.preventDefault()
