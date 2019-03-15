<?php


//remove Emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function update_nag_hide() {
  remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action( 'admin_init', 'update_nag_hide' );

function remove_menus () {
    remove_menu_page( 'index.php' );
    remove_menu_page( 'edit.php' );
    remove_menu_page( 'upload.php' );
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'tools.php' );
}
add_action('admin_menu', 'remove_menus');


function my_scripts() {
  if ( !is_admin() ) {
    $dir = get_stylesheet_directory_uri();
    wp_enqueue_script('jquery-masonry', $dir . '/js/masonry.pkgd.min.js', array('jquery'));
    wp_enqueue_script('jquery-imagesloaded', $dir . '/js/imagesloaded.pkgd.min.js', array('jquery'));
    wp_enqueue_script('jquery-infinite', $dir . '/js/infinite-scroll.pkgd.min.js', array('jquery'));
    wp_enqueue_script('lottie', $dir . '/js/lottie.min.js', array('jquery'));
    wp_enqueue_script('script', $dir . '/js/script.js', array('jquery'));
  }
}
add_action( 'wp_enqueue_scripts', 'my_scripts', 50 );

//remove embed
function crave_disable_embeds() {

  // Remove the REST API endpoint.
  remove_action( 'rest_api_init', 'wp_oembed_register_route' );
  // Turn off oEmbed auto discovery.
  add_filter( 'embed_oembed_discover', '__return_false' );
  // Don't filter oEmbed results.
  remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
  // Remove oEmbed discovery links.
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action( 'wp_head', 'wp_oembed_add_host_js' );
  add_filter( 'tiny_mce_plugins', 'crave_disable_embeds_tiny_mce_plugin' );
  // Remove all embeds rewrite rules.
  add_filter( 'rewrite_rules_array', 'crave_disable_embeds_rewrites' );
  // Remove filter of the oEmbed result before any HTTP requests are made.
  remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}
add_action( 'init', 'crave_disable_embeds', 9999 );

function crave_disable_embeds_tiny_mce_plugin($plugins) {
  return array_diff($plugins, array('wpembed'));
}

function crave_disable_embeds_rewrites($rules) {
  foreach($rules as $rule => $rewrite) {
    if(false !== strpos($rewrite, 'embed=true')) {
      unset($rules[$rule]);
    }
  }
  return $rules;
}

// AIOSEO <link rel="prev/next">削除
add_filter('aioseop_prev_link', '__return_empty_string' );
add_filter('aioseop_next_link', '__return_empty_string' );

// include CSS, JS
if (!is_admin()) {
  function register_style()
  {
    wp_register_style('style', get_stylesheet_uri());
    wp_register_style('all', get_stylesheet_directory_uri().'/css/all.css', array(), '');
  }

  function add_stylesheet()
  {
    register_style();
    wp_enqueue_style('style');
    wp_enqueue_style('all');
  }

  function register_script()
  {
    wp_register_script('main', get_stylesheet_directory_uri().'/js/main.js', array(), '', true);
  }

  function add_script()
  {
    register_script();
    wp_enqueue_script('main');
  }

  add_action('wp_print_styles', 'add_stylesheet');
  add_action('wp_print_scripts', 'add_script');
}

// Hide useless admin menu
function remove_admin_menu() {
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
  //  remove_menu_page('themes.php');
}
add_action('admin_menu', 'remove_admin_menu');

// title
function theme_slug_setup() {
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_slug_setup');
function title_separator($sep) {
  $sep = '|';
  return $sep;
}
add_filter('document_title_separator', 'title_separator');

//eyecatch img
add_theme_support('post-thumbnails');
  set_post_thumbnail_size(264, 184 );

//custom img size
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'custom_small', 300, 180, true );
  add_image_size( 'custom_medium', 600, 360, true );
}

// Hide admin bar
add_filter( 'show_admin_bar', '__return_false' );

//pager
function  pageNavigation () {
  global $wp_rewrite;
  global $wp_query;
  global $paged;
  $paginate_base = get_pagenum_link(1);
  if (strpos($paginate_base, '?') || !$wp_rewrite -> using_permalinks()) {
    $paginate_format = '';
    $paginate_base = add_query_arg ('page', '%#%');
  } else {
    $paginate_format = (substr($paginate_base, - 1, 1) == '/' ? '' : '/') .
      untrailingslashit('?page=%#%', 'paged' );
    $paginate_base .=  '%_%';
  }
  $result = paginate_links (array (
    'base'     => $paginate_base,
    'format'   => $paginate_format,
    'total'    => $wp_query -> max_num_pages,
    'mid_size' => 4,
    'current'  => ($paged ? $paged : 1),
    'prev_text' => 'PREVIOUS',
    'next_text' => 'NEXT',
  ));
  return $result;
}

//custom-post-type
function implement_custom_posts($value='') {
  $link = (object) array(
    "slug" => "link",
    "name" => "links",
    "has_archive" => true,
  );
  $works = (object) array(
    "slug" => "works",
    "name" => "works",
    "has_archive" => true,
  );
  $contents_array = [
    $link,
    $works
  ];
  foreach ($contents_array as $key => $value) {
    add_custom($value);
    implement_custom_posts_category($value);
    implement_custom_posts_category($value);
  }
}

//custom-post-type category
function implement_custom_posts_category($value) {
  $labels = array(
    "name" => _x( $value -> name . "カテゴリ", "" ),
  );
  $args = array(
    "hierarchical"      => true,
    "labels"            => $labels,
    "show_ui"           => true,
    "show_in_rest"      => true,
    "show_admin_column" => true,
    "query_var"         => true,
  );
  register_taxonomy(
    $value -> slug . "-category",
    array( $value -> slug ),
    $args
  );
}

//post type setting
function add_custom($value) {
  register_post_type($value -> slug, array(
    'label' => $value -> name,
    'menu_position' => 5,
    'hierarchical' => true,
    'public' => true,
    'supports' => array(
      'title',
      'editor',
      'thumbnail'//アイキャッチ画像
    ),
    'has_archive' => $value -> has_archive,
    'rewrite' => array(
      'slug' => $value -> slug,
      'with_front' => false
    )
  ));
}

add_action( "init", "implement_custom_posts", 0 );

// wp_titleの半角除去
function my_title_fix($title, $sep, $seplocation){
  if(!$sep || $sep == "｜"){
    $title = str_replace(' '.$sep.' ', $sep, $title);
  }
  return $title;
}
add_filter('wp_title', 'my_title_fix', 10, 3);

function change_posts_per_page($query) {
  if ( is_admin() || ! $query->is_main_query() ) return;

  if ( is_front_page() ) {
    $query -> set( 'post_type', 'works' );
    $query -> set( 'posts_per_page', '10' );
  }
}
add_action( 'pre_get_posts', 'change_posts_per_page' );
