
class Article extends Backbone.Model
  clear: ->
#     @destroy()
    @view.remove()

class ArticlesList extends Backbone.Collection
  model: Article
  url: ->
    "#{url_base}blog/api_archives/articles?year=#{@.year}&month=#{@.month}"


Articles = new ArticlesList
