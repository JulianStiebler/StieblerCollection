$(function () {
  $(document).scroll(function () {
    var $nav = $(".navigation");
      $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
});