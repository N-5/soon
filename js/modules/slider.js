import $ from 'jquery';
import 'slick-carousel';

export default () => {
  $(function () {
    $('.index-hero__slider .index-hero__image').slick({
      infinite: true,
      dots: false,
      slidesToShow: 1,
      autoplay: true
    });
  });
};
