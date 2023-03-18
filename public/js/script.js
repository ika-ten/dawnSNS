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

  //モーダル
    $('.modalopen').each(function () {
      $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        $(modal).fadeIn();
        return false;
      });
    });
    $('.modalClose').on('click', function () {
      $('.js-modal').fadeOut();
      return false;
    });
});

