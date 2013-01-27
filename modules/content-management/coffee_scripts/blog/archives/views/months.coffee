
class MonthView extends Backbone.View
  tagName:  "li"
  template: _.template "<%= name %><span class=\"count\">(<%= count %>)</span>"

  events:
    'click' : 'showArticles'

  initialize: ->
    @model.bind('change', @.render);
    @model.view = @;

  render: =>
    @.$el.html(@.template(@.model.attributes));
    return @;

  showArticles: ->
#     this.$el.addClass 'active'
    Articles.each (m)->
      m.clear()
    Articles.year = @model.collection.year
    Articles.month = @model.id
    Articles.fetch()

  remove: ->
    $(@el).remove()

  clear: () ->
    @model.clear()
