
class MonthView extends Backbone.View
  tagName:  "li"
  template: _.template "<%= name %><span class=\"count\">(<%= count %>)</span>"

  events:
    'click' : 'showArticles'

  initialize: ->
    @model.bind('change', @.render);
    @model.view = @;

  render: =>
    @.$el.data('id', @model.id).html(@.template(@.model.attributes));
    return @;

  showArticles: ->
    $('li.active', mothList).removeClass 'active'
    this.$el.addClass 'active'
    Articles.clear()
    Articles.year = @model.collection.year
    Articles.month = @model.id
    Articles.fetch()

  remove: ->
    $(@el).remove()

  clear: () ->
    @model.clear()
