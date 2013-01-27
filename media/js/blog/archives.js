// Generated by CoffeeScript 1.3.3
(function() {
  var Article, Articles, ArticlesList, ArticlesView, Month, MonthView, Months, MonthsList, Year, YearView, Years, YearsList,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  Article = (function(_super) {

    __extends(Article, _super);

    function Article() {
      return Article.__super__.constructor.apply(this, arguments);
    }

    Article.prototype.clear = function() {
      return this.view.remove();
    };

    return Article;

  })(Backbone.Model);

  ArticlesList = (function(_super) {

    __extends(ArticlesList, _super);

    function ArticlesList() {
      return ArticlesList.__super__.constructor.apply(this, arguments);
    }

    ArticlesList.prototype.model = Article;

    ArticlesList.prototype.url = function() {
      return "" + url_base + "blog/api_archives/articles?year=" + this.year + "&month=" + this.month;
    };

    return ArticlesList;

  })(Backbone.Collection);

  Articles = new ArticlesList;

  Month = (function(_super) {

    __extends(Month, _super);

    function Month() {
      return Month.__super__.constructor.apply(this, arguments);
    }

    Month.prototype.clear = function() {
      return this.view.remove();
    };

    return Month;

  })(Backbone.Model);

  MonthsList = (function(_super) {

    __extends(MonthsList, _super);

    function MonthsList() {
      return MonthsList.__super__.constructor.apply(this, arguments);
    }

    MonthsList.prototype.model = Month;

    MonthsList.prototype.url = function() {
      return "" + url_base + "blog/api_archives/months?year=" + this.year;
    };

    return MonthsList;

  })(Backbone.Collection);

  Months = new MonthsList;

  Year = (function(_super) {

    __extends(Year, _super);

    function Year() {
      return Year.__super__.constructor.apply(this, arguments);
    }

    Year.prototype.clear = function() {
      return this.view.remove();
    };

    return Year;

  })(Backbone.Model);

  YearsList = (function(_super) {

    __extends(YearsList, _super);

    function YearsList() {
      return YearsList.__super__.constructor.apply(this, arguments);
    }

    YearsList.prototype.model = Year;

    YearsList.prototype.url = "" + url_base + "blog/api_archives/years";

    return YearsList;

  })(Backbone.Collection);

  Years = new YearsList;

  ArticlesView = (function(_super) {

    __extends(ArticlesView, _super);

    function ArticlesView() {
      this.render = __bind(this.render, this);
      return ArticlesView.__super__.constructor.apply(this, arguments);
    }

    ArticlesView.prototype.tagName = "li";

    ArticlesView.prototype.template = _.template("<a href=\"<%= url %>\"><%= title %></a>");

    ArticlesView.prototype.initialize = function() {
      return this.model.view = this;
    };

    ArticlesView.prototype.render = function() {
      this.$el.html(this.template(this.model.attributes));
      return this;
    };

    return ArticlesView;

  })(Backbone.View);

  MonthView = (function(_super) {

    __extends(MonthView, _super);

    function MonthView() {
      this.render = __bind(this.render, this);
      return MonthView.__super__.constructor.apply(this, arguments);
    }

    MonthView.prototype.tagName = "li";

    MonthView.prototype.template = _.template("<%= name %><span class=\"count\">(<%= count %>)</span>");

    MonthView.prototype.events = {
      'click': 'showArticles'
    };

    MonthView.prototype.initialize = function() {
      this.model.bind('change', this.render);
      return this.model.view = this;
    };

    MonthView.prototype.render = function() {
      this.$el.html(this.template(this.model.attributes));
      return this;
    };

    MonthView.prototype.showArticles = function() {
      Articles.each(function(m) {
        return m.clear();
      });
      Articles.year = this.model.collection.year;
      Articles.month = this.model.id;
      return Articles.fetch();
    };

    MonthView.prototype.remove = function() {
      return $(this.el).remove();
    };

    MonthView.prototype.clear = function() {
      return this.model.clear();
    };

    return MonthView;

  })(Backbone.View);

  YearView = (function(_super) {

    __extends(YearView, _super);

    function YearView() {
      this.render = __bind(this.render, this);
      return YearView.__super__.constructor.apply(this, arguments);
    }

    YearView.prototype.tagName = "li";

    YearView.prototype.template = _.template("<%= name %><span class=\"count\">(<%= count %>)</span>");

    YearView.prototype.events = {
      'click': 'showMonths'
    };

    YearView.prototype.render = function() {
      this.$el.html(this.template(this.model.attributes));
      return this;
    };

    YearView.prototype.showMonths = function() {
      Months.each(function(m) {
        return m.clear();
      });
      Articles.each(function(m) {
        return m.clear();
      });
      Months.year = this.model.id;
      return Months.fetch();
    };

    return YearView;

  })(Backbone.View);

  $(function() {
    var App, AppView;
    AppView = (function(_super) {
      var el_tag;

      __extends(AppView, _super);

      function AppView() {
        this.addAllArticles = __bind(this.addAllArticles, this);

        this.addOneArticle = __bind(this.addOneArticle, this);

        this.addAllMonths = __bind(this.addAllMonths, this);

        this.addOneMonth = __bind(this.addOneMonth, this);

        this.addAll = __bind(this.addAll, this);

        this.addOne = __bind(this.addOne, this);

        this.initialize = __bind(this.initialize, this);
        return AppView.__super__.constructor.apply(this, arguments);
      }

      el_tag = "#archives";

      AppView.prototype.el = $(el_tag);

      AppView.prototype.initialize = function() {
        Years.bind("reset", this.addAll);
        Months.bind("reset", this.addAllMonths);
        Articles.bind("reset", this.addAllArticles);
        return Years.fetch();
      };

      AppView.prototype.addOne = function(todo) {
        var view;
        view = new YearView({
          model: todo
        });
        return this.$("#years-list").append(view.render().el);
      };

      AppView.prototype.addAll = function() {
        return Years.each(this.addOne);
      };

      AppView.prototype.addOneMonth = function(month) {
        var view;
        view = new MonthView({
          model: month
        });
        return this.$("#months-list").append(view.render().el);
      };

      AppView.prototype.addAllMonths = function() {
        return Months.each(this.addOneMonth);
      };

      AppView.prototype.addOneArticle = function(article) {
        var view;
        view = new ArticlesView({
          model: article
        });
        return this.$("#articles-list").append(view.render().el);
      };

      AppView.prototype.addAllArticles = function() {
        return Articles.each(this.addOneArticle);
      };

      return AppView;

    })(Backbone.View);
    return App = new AppView();
  });

}).call(this);
