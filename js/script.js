jQuery(function () {
  const $container = jQuery('.c-postcard');
  $container.imagesLoaded(function () {
    $container.masonry({
      itemSelector: '.c-postcard__item',
      columnWidth: '.c-postcard__item',
      isFitWidth: true,
      stagger: 30,
      transitionDuration: 0
    });
  });
  $container.infinitescroll({
    navSelector: '.wp-pagenavi',
    nextSelector: '.nextpostslink',
    itemSelector: '.c-postcard__item',
    loading: {
      finishedMsg: '',
      msgText: '<div class="col-md-12 text-center"><i class="fa fa-spinner fa-spin"></i></div>',//ローディング時のテキストを指定します。
      img: ''
    }
  },
function(newElements) {
    const $newElems = jQuery(newElements).css({ opacity: 0 });
    $newElems.imagesLoaded(function () {
      $newElems.animate({opacity: 1});
      $container.masonry('appended', $newElems, true);
    });
  }
);

  const animData = {
    wrapper: document.getElementById('logosvg'),
    animType: 'svg',
    loop: false,
    prerender: true,
    autoplay: true,
    path: '/wp-content/themes/soon/data.json'
  };
  const anim = bodymovin.loadAnimation(animData);
});