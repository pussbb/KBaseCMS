
$ ->
  class AppView extends Backbone.View
    el_tag = "#archives"
    el: $(el_tag)

    initialize: =>
      Years.bind "reset", @addAll
      Months.bind "reset", @addAllMonths
      Articles.bind "reset", @addAllArticles
      Years.fetch()

    addOne: (todo) =>
      view = new YearView {model: todo}
      @.$("#years-list").append view.render().el

    addAll: =>
      Years.each(@addOne);

    addOneMonth: (month) =>
      view = new MonthView {model: month}
      @.$("#months-list").append view.render().el

    addAllMonths: =>
        Months.each(@addOneMonth);

    addOneArticle: (article) =>
      view = new ArticlesView {model: article}
      @.$("#articles-list").append view.render().el

    addAllArticles: =>
        Articles.each(@addOneArticle);

  App = new AppView()
