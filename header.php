<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head prefix="og: http://ogp.me/ns#">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <?php get_template_part('inc/favicons'); ?>
    <?php wp_head() ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="l-wrapper">
      <header id="header" class="header">
        <div class="header-menu">
          <div class="header-hamburger" data-menu-hamburger>
            <span class="header-hamburger__item"></span>
            <span class="header-hamburger__item"></span>
          </div>
          <div class="header-menu__inner">
            <div class="header-menu__logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/common/logo_wh.svg" alt="<?php bloginfo('name'); ?>"></a></div>
            <div class="header-menu__item"><a href="<?php echo home_url(); ?>/about/"><span>About</span><i class="m-arrow__wh"></i></a></div>
            <div class="header-menu__item" data-menu-sub>
              <a href="<?php echo home_url(); ?>/works/">
                <span>Works</span>
                <i class="m-arrow__wh"></i>
              </a>
              <div class="header-menusub">
                <div class="header-menusub-list">
                  <h3 class="header-menusub-list__heading">Works</h3>
                  <div class="header-menusub-list__item"><a href="<?php echo home_url(); ?>/works/works-category/web-design/"><span>Web design</span><i class="m-arrow__wh"></i></a></div>
                  <div class="header-menusub-list__item"><a href="<?php echo home_url(); ?>/works/works-category/graphics-design/"><span>Graphics design</span><i class="m-arrow__wh"></i></a></div>
                  <div class="header-menusub-list__item"><a href="<?php echo home_url(); ?>/works/works-category/logo-design/"><span>Logo design</span><i class="m-arrow__wh"></i></a></div>
                  <div class="header-menusub-list__item"><a href="<?php echo home_url(); ?>/works/works-category/other-works/"><span>Other works</span><i class="m-arrow__wh"></i></a></div>
                </div>
              </div>
            </div>
            <div class="header-menu__item" data-menu-sub>
              <a href="<?php echo home_url(); ?>/links/">
                <span>Links</span>
                <i class="m-arrow__wh"></i>
              </a>
              <div class="header-menusub">
                <div class="header-menusub-list">
                  <h3 class="header-menusub-list__heading">Links</h3>
                  <?php
                  $args = array( 'post_type' => 'link' );
                  $the_query = new WP_Query($args); if($the_query->have_posts()):
                  ?>
                  <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                  <div class="header-menusub-list__item"><a href="<?php the_field('link-url') ?>"><span><?php the_title() ?></span><i class="m-arrow__wh"></i></a></div>
                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>
                  <?php else: ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="header-menu-sns">
            <div class="header-menu-sns__item"><a href="https://www.instagram.com/?hl=ja" target="_blank"><span>Instagram</span><i class="m-arrow__wh"></i></a></div>
          </div>
        </div>
      </header>
      <div class="c-visual">
        <div class="c-visual-overlay"></div>
        <div class="c-visual__inner">
          <div class="c-visual-logo"><div id="logosvg"></div></div>

          <?php if ( is_home() || is_front_page() ) : ?>
          <div class="c-visual-text">A publication on creativity &amp; connected culture.</div>
          <?php endif; ?>
          <?php if(is_page('about')): ?>
          <div class="c-visual-heading">About</div>
          <?php else: ?>
          <?php endif; ?>
          <?php if (is_post_type_archive('works')): ?>
          <div class="c-visual-heading">Works</div>
          <?php endif; ?>
          <?php if(is_tax('works-category', 'web-design')): ?>
          <div class="c-visual-category"><div class="c-visual-category__item"><a href="<?php echo home_url(); ?>/works/">Works</a></div><i class="m-arrow__bk"></i><div class="c-visual-category__item">Web design</div></div>
          <?php elseif (is_tax('works-category', 'graphics-design')): ?>
          <div class="c-visual-category"><div class="c-visual-category__item"><a href="<?php echo home_url(); ?>/works/">Works</a></div><i class="m-arrow__bk"></i><div class="c-visual-category__item">Graphics design</div></div>
          <?php elseif (is_tax('works-category', 'logo-design')): ?>
          <div class="c-visual-category"><div class="c-visual-category__item"><a href="<?php echo home_url(); ?>/works/">Works</a></div><i class="m-arrow__bk"></i><div class="c-visual-category__item">Logo design</div></div>
          <?php elseif (is_tax('works-category', 'other-works')): ?>
          <div class="c-visual-category"><div class="c-visual-category__item"><a href="<?php echo home_url(); ?>/works/">Works</a></div><i class="m-arrow__bk"></i><div class="c-visual-category__item">Other works</div></div>
          <?php else: ?>
          <?php endif; ?>  
        </div>
        <div class="c-visual-anchor"><a href="#bottom"><i class="c-visual-anchor__arrow"></i></a></div>
      </div>
