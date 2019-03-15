import $ from 'jquery';
import Masonry from 'masonry-layout';
import jQueryBridget from 'jquery-bridget';
import imagesLoaded from 'imagesLoaded';

export default () => {
  jQueryBridget('masonry', Masonry, $);
  jQueryBridget('imagesLoaded', imagesLoaded, $);

  $(function () {
    const $container = $('.c-postcard');
    $container.imagesLoaded(function () {
      $container.masonry({
        itemSelector: '.c-postcard__item',
        isAnimated: true,
        fitWidth: true
      });
    });
  });
};
