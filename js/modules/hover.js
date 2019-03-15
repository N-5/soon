import $ from 'jquery';

export default () => {
  const hoverImg = '[data-hover-img]';

  $(function () {
    $(hoverImg).each(function () {
      const srcOff = $(this).find('img').attr('src');
      const srcOn = srcOff.replace('_off', '_on');
      $('<img />').attr('src', srcOn);
      $(this).hover(function () {
        $(this).find('img').attr('src', srcOn);
      }, function () {
        $(this).find('img').attr('src', srcOff);
      });
    });
  });
};
