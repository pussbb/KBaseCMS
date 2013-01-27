class Month extends Backbone.Model
  clear: ->
#     @destroy()
    @view.remove()

class MonthsList extends Backbone.Collection
  model: Month
  url: ->
    "#{url_base}blog/api_archives/months?year=#{@.year}"


Months = new MonthsList
