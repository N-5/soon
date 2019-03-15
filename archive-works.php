<?php get_header(); ?>
<main id="bottom">
  <section class="works-archive">
    <div class="index-post__container">
      <ul class="c-postcard">
       <?php
       $args= array(
         'post_type' => 'works',
         'posts_per_page' => 15,
         'paged' => $paged
       );
       ?>
       <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="c-postcard__item">
          <a href="<?php permalink_link() ?>">
            <div class="c-postcard__thumbnail">
              <span class="c-postcard__mesh"></span>
              <img src="<?php the_field('top_visual') ?>" alt="">
            </div>
            <div class="c-postcard__detail">
              <div class="c-postcard__time"><time><?php echo get_post_time('jS F, Y'); ?></time></div>
              <h3 class="c-postcard__title"><?php the_title() ?></h3>
              <div class="c-postcard__description"><?php the_field('top_text') ?></div>
              <div class="c-postcard__category">Web design</div>
            </div>
          </a>
        </article>
       <?php endwhile; ?>
       <?php endif; ?>
      </ul>
    </div>
  </section>
  <div><?php wp_pagenavi(); ?></div>
  </main>
<?php get_footer(); ?>
