// Generated by CoffeeScript 1.4.0
(function() {

  $(function() {
    var authbox, login, recover, speed;
    login = $('#loginform');
    recover = $('#recoverform');
    authbox = $('#authbox');
    speed = 400;
    $('#to-recover').click(function() {
      $('a.close', authbox).click();
      login.fadeTo(speed, 0.01).hide();
      return recover.fadeTo(speed, 1).show();
    });
    return $('#to-login').click(function() {
      $('a.close', authbox).click();
      recover.fadeTo(speed, 0.01).hide();
      return login.fadeTo(speed, 1).show();
    });
  });

}).call(this);
