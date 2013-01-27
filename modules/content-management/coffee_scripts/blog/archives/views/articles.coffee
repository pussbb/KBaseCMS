
class ArticlesView extends Backbone.View
  tagName:  "li"
  template: _.template "<a href=\"<%= url %>\"><%= title %></a>"

  initialize: ->
    @model.view = @;

  render: =>
    @.$el.html(@.template(@.model.attributes));
    return @;


