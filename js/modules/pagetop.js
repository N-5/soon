import $ from 'jquery';

export default () => {
  const pagetop = '[data-pagetop]';

  $(function () {
    $(pagetop).hide();
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        $(pagetop).fadeIn();
      } else {
        $(pagetop).fadeOut();
      }
    });

    $(pagetop).click(function () {
      $('html,body').animate({
        scrollTop: 0
      }, 300);
      return false;
    });

    $('a[href^="#"]').click(function () {
      const speed = 1000;
      const href = $(this).attr('href');
      const target = $(href === '#' || href === '' ? 'html' : href);
      const position = target.offset().top;
      $('html, body').animate({scrollTop: position}, speed, 'swing');
      return false;
    });
  });
};
