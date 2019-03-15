import $ from 'jquery';

export default () => {
  const sidemenuTarget = '[data-sidemenu-search], [data-btn-search], [data-sidemenu-search-btn-close]';
  const menuTarget = '[data-menu-hamburger], [data-menu-navigation], main, .header, .header-menu';
  const windowWidth = $(window).width();
  const windowSm = 640;

  $(function () {
    $('[data-menu-hamburger]').on('click', function () {
      $(menuTarget).toggleClass('js-open');
    });

    $('[data-btn-search]').on('click', function () {
      $(sidemenuTarget).toggleClass('js-open');
      return false;
    });

    if (windowWidth <= windowSm) {
      $('[data-menu-sub]').children('a').on('click', function () {
        $(this).next('.header-menusub').slideToggle();
        return false;
      });
    } else {
    }

    $('[data-sidemenu-search-btn-close]').on('click', function () {
      $(sidemenuTarget).removeClass('js-open');
      return false;
    });
  });
};
