//ドロワーナビゲーション
$(function () {
  $('.menu-trigger').click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('#accordion-content').addClass('active');
    } else {
      $('#accordion-content').removeClass('active');
    }
  });
});
