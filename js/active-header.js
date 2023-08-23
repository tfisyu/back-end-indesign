$(document).ready(function(){
    $('header .a_header .opcoes').click(function(){
      $('.a_header .opcoes').removeClass("active");
      $(this).addClass("active");
  });
});