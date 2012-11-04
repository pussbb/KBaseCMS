
root = exports ? this

Function::property = (prop, desc) ->
  Object.defineProperty @prototype, prop, desc

ObjProto   = Object.prototype
ArrayProto = Array.prototype
toString   = ObjProto.toString
hasOwn     = ObjProto.hasOwnProperty