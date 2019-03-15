<?php
/*
Template Name: top
*/
?>
<?php get_header(); ?>

<main id="index">
  <section class="index-post">
    <div class="index-post__container">
      <div class="c-postcard">
        <?php query_posts('post_type=works&posts_per_page=10&paged='.$paged); ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="c-postcard__item">
          <a href="">
            <div class="c-postcard__thumbnail"><img src="<?php the_field('top_visual') ?>" alt=""></div>
            <div class="c-postcard__detail">
              <div class="c-postcard__time"><time><?php the_time() ?></time></div>
              <h3 class="c-postcard__title"><?php the_title() ?></h3>
              <div class="c-postcard__description"><?php the_field('top_text') ?></div>
              <div class="c-postcard__category">Web design</div>
            </div>
          </a>
        </article>
        <?php endwhile; else : ?>
        <?php endif; ?>
      </div>
      <span class="next_posts_link">
        <?php next_posts_link(); ?>
      </span>
    </div>
  </section>
</main>
<script>
  jQuery(function () {
    const $container = jQuery('.c-postcard');
    $container.imagesLoaded(function () {
      $container.masonry({
        itemSelector: '.c-postcard__item',
        columnWidth: '.c-postcard__item',
        isAnimated: true,
        transitionDuration: 0
      });
    });
    var infScroll = new InfiniteScroll( '.c-postcard', { // 記事を追加するブロックのclassを指定
      append: '.c-postcard__item',             // 記事ブロックを指定
      path: '.next_posts_link a',  // 次のページリンクを指定
      hideNav: '.next_posts_link', // 次のページリンクを非表示にする
      button: '.view-more-button', // 次のページの記事ブロックを読み込むボタンを指定
      scrollThreshold: false,      // スクロールで自動的に読み込まれる動作を解除
      status: '.page-load-status', // ステータスのブロックを指定
      history: 'false'             // ブラウザのアドレスを変更しない
    });
  });
</script>
<?php get_footer(); ?>
