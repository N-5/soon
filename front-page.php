<?php get_header(); ?>

<main id="bottom">
  <section class="index-post">
    <div class="index-post__container">
      <div class="c-postcard">
        <?php 
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args = array(
          'post_type' => 'works',
          'paged' => $paged
        );
        $the_query = new WP_Query($args);
        ?>
        <?php if($the_query->have_posts()): ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <article class="c-postcard__item">
          <a href="<?php permalink_link() ?>">
            <div class="c-postcard__thumbnail">
              <span class="c-postcard__mesh"></span>
              <img src="<?php the_field('top_visual') ?>">
            </div>
            <div class="c-postcard__detail">
              <div class="c-postcard__time"><time><?php echo get_post_time('jS F, Y'); ?></time></div>
              <h3 class="c-postcard__title"><?php the_title() ?></h3>
              <div class="c-postcard__description"><?php the_field('top_text') ?></div>
              <div class="c-postcard__category">
                <?php $terms = get_the_terms($post->ID,'works-category');
                foreach( $terms as $term ) {
                  echo $term->name;
                }
                ?>
              </div>
            </div>
          </a>
        </article>
        <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <div><?php wp_pagenavi(); ?></div>
</main>
<?php get_footer(); ?>
