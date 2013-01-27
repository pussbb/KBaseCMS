
$ ->
  yearList = $("#years-list")
  mothList = $("#months-list")
  articlesList = $("#articles-list")
  class AppView extends Backbone.View
    el_tag = "#archives"
    el: $(el_tag)

    statsTemplate: _.template "
    <% if (total && month) { %>
      TOTAL <%= total %> ARTICLES DURING <%= month %>
    <% } %>
    "

    initialize: =>
      @yearList = yearList
      @monthList = mothList
      @articlesList =articlesList
      Years.bind "reset", @addAll
      Months.bind "reset", @addAllMonths
      Articles.bind "reset", @addAllArticles
      Articles.bind "all", @render
      Months.bind "all", @render
      Years.bind "all", @render

      Years.fetch()

    render: =>
      id = $('li.active', @monthList).data('id')
      console.log id
      @.$('li#stats').html(@statsTemplate {
          total: Articles.length,
          month: Months.get(id)?.get('name')
        })

    addOne: (todo) =>
      view = new YearView {model: todo}
      @yearList.append view.render().el

    addAll: =>
      Years.each(@addOne);

    addOneMonth: (month) =>
      view = new MonthView {model: month}
      @monthList.append view.render().el

    addAllMonths: =>
        Months.each(@addOneMonth);

    addOneArticle: (article) =>
      view = new ArticlesView {model: article}
      @articlesList.append view.render().el

    addAllArticles: =>
        Articles.each(@addOneArticle);

  App = new AppView()
