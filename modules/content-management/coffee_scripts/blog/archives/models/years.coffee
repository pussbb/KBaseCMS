
class Year extends Backbone.Model
  clear: ->
#     @destroy()
    @view.remove()

class YearsList extends Backbone.Collection
  model: Year
  url: "#{url_base}blog/api_archives/years"

Years = new YearsList
