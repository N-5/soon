import $ from 'jquery';
import 'bodymovin';

export default () => {
  $(function () {
    const animation = bodymovin.loadAnimation({
      container: document.getElementById(''),
      renderer: 'svg',
      loop: true,
      autoplay: true,
      path: '../inc/data.json'
    })
  });
};