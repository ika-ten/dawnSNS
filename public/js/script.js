//ドロワーナビゲーション
$(function () {
  $('.menu-trigger').click(function () {
    $(this).toggleClass('active');
    $('#accordion-content').css('display', 'block');
    if ($(this).hasClass('active')) {
      $('#accordion-content').addClass('active');
    } else {
      $('#accordion-content').removeClass('active');
    }
  });
});
