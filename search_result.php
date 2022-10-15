<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
  </head>
  <body>
    <ul id="loop-list"></ul>
    <script>
    $(function(){
      for (var i = 1; i <= 10; i++){
        $('#loop-list').append('<li><img class="lazy" src="../lazyload/dummy.gif" data-original="images/'+i+'.jpg" alt="'+i+'" /><p class="caption">'+i+'</p></li>');
      }
      });
      $(window).load(function () {
      $('.lazy').lazyload({
        effect: 'fadeIn',
        effectspeed: 1000
      });
      });
    </script>
    
  </body>
</html>
