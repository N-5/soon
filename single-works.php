<?php get_header(); ?>
<main id="works">
  <div class="c-sidehome"><a href="<?php echo home_url(); ?>"><div id="logosvg"></div></a></div>
  <div class="l-container__small">
    <div class="works-single">
      <div class="c-backbtn"><a href="<?php echo home_url(); ?>/works/"><i class="m-arrow__bk"></i><span>Back to Works</span></a></div>
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <header>
        <div class="works-header">
          <time class="works-header__time"><?php echo get_post_time('jS F, Y'); ?></time>
          <h1 class="works-header__heading"><?php the_title() ?></h1>
<!--
          <div class="topics-header__category">
            <?php $custom_post_tag = 'works-category';
            $custom_post_tag_terms = wp_get_object_terms($post->ID, $custom_post_tag);
            if(!empty($custom_post_tag_terms)){
              if(!is_wp_error( $custom_post_tag_terms )){
                foreach($custom_post_tag_terms as $term){
                  $tag_term_link = get_term_link($term->slug, $custom_post_tag);
                  $tag_term_name = $term->name;
                  echo '<div class="item"><a href="'.$tag_term_link.'">'.$tag_term_name.'</a></div>';
                }
              }
            }
            ?>
          </div>
-->
        </div>
      </header>
      <div class="c-postarea">
        <?php if( have_rows('works_article') ): ?>
        <?php while ( have_rows('works_article') ) : the_row(); ?>
        <?php if( get_row_layout() == 'works-layout-img' ): ?>
        <div class="c-postarea__img"><img src="<?php the_sub_field('img'); ?>"></div>
        <?php elseif( get_row_layout() == 'works-layout-text' ): ?>
        <p class="c-postarea__text"><?php the_sub_field('text'); ?></p>
        <?php elseif( get_row_layout() == 'works-layout-movie' ): ?>
        <p class="c-postarea__text"><?php the_sub_field('iframe'); ?></p>
        <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <div class="c-paging">
        <div class="c-paging__prev">
        <?php $next_post = get_next_post();  
          if (!empty( $next_post )):  
          echo '<a href="',get_permalink( $next_post->ID ),'"><i class="m-arrow__bk"></i><span>Previous</span></a>';  
          endif; ?>
        </div>
        <div class="c-paging__next">
          <?php $prev_poxt = get_previous_post();  
          if (!empty( $prev_poxt  )):  
          echo '<a href="',get_permalink( $prev_poxt->ID ),'"><span>Next</span><i class="m-arrow__bk"></i></a>';  
          endif; ?>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>
