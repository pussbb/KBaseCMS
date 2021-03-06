
class YearView extends Backbone.View
  tagName:  "li"
  template: _.template "<%= name %><span class=\"count\">(<%= count %>)</span>"

  events:
    'click' : 'showMonths'

  render: =>
    @.$el.html(@.template(@.model.attributes));
    return @;

  showMonths: ->
    this.$el.addClass 'active'
    Months.clear()
    Articles.clear()
    Months.year = @model.id
    Months.fetch()
