

class IS
  @string: (s) ->
    (typeof s is 'string') or s instanceof String

  @object: (o)->
    o is Object(o)

  @number: (n)->
    (typeof n is 'number') or n instanceof Number

  @bool: (b)->
    b is !!b or b instanceof Boolean

  @fn: (f)->
    (typeof f is 'function')

  @array: ArrayProto.isArray || (a)->
    toString.call(a) is '[object Array]'

  @regex: (r)->
    !!(r and r.test and r.exec and (r.ignoreCase or r.ignoreCase is false));

  @element: (e)->
    return if typeof HTMLElement isnt 'undefined' then (e instanceof HTMLElement) else !!(e and e.nodeType is 1)

  @numeric: (n)->
    !isNaN(parseFloat(n)) and isFinite(n)

  @hash: (h)->
    return false if ! o or typeof o isnt 'object' or @element(o) or (typeof window isnt 'undefined' and o is window) or (o.constructor and ! hasOwn.call(o, 'constructor') and ! hasOwn.call(o.constructor.prototype, 'isPrototypeOf'))
    key for key of o
    return key is undefined and hasOwn.call(o, key)

  @index_of: (arr, val)->
    if ArrayProto.indexOf
      return arr.indexOf val
    else
      return i for key, i in arr when key is val
      return -1

  @inside: (container, val)->
    if @array container
      return @index_of(container, val) > -1;
    else if @object container
      return true for key of container when hasOwn.call(container, prop) and container[prop] is val
    return false

  @set: (v)->
    v? and v isnt (0)

  @empty: (container)->
    return container.length is 0 if @array container
    if @object container
      return @empty container.valueOf() if @fn container.valueOf and @object container.valueOf()
      return false for x of container when hasOwn.call container, x
      return true
    else
      return !container

root.IS = IS