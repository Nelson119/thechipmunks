<?php
  error_reporting(E_ALL); // or E_STRICT
  ini_set("display_errors",1);
  ini_set("memory_limit","1024M");
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/upload.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);



/*------------------------------------*\
    要移除的功能
\*------------------------------------*/
function html5_style_remove($tag){return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);}                           // 移除 text/css
function my_wp_nav_menu_args($args = ''){$args['container'] = false;return $args;}                                          // 移除選單的div
function my_css_attributes_filter($var){return is_array($var) ? array() : '';}                                              // 移除選單多餘的ID
function remove_category_rel_from_category_list($thelist){return str_replace('rel="category tag"', 'rel="tag"', $thelist);} // 移除分類invalid rel
function my_remove_recent_comments_style() {                                                                                // 移除最新留言style
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}
function remove_thumbnail_dimensions( $html ) {                                                                             // 移除特色圖片長寬屬性
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

add_filter('show_admin_bar', '__return_false');


// add_rewrite_rule('^section/(\w+)/chipmunks/(\w+)/?','index.php?page_id=4&section=$matches[1]&cm=$matches[2]');
// add_rewrite_rule('^section/(\w+)/films/(\S+)/?','index.php?page_id=4&section=$matches[1]&vid=$matches[2]');
function custom_rewrite_basic() {
  // add_rewrite_rule('^slick/([^/]+)/?', 'index.php?pagename=term&slick=$matches[1]', 'top');
  add_rewrite_rule('^slick/([^/]+)/cm/([^/]+)/?', '?slick=$matches[1]&cm=$matches[2]', 'top');
  add_rewrite_rule('^slick/([^/]+)/vid/([^/]+)/?', '?slick=$matches[1]&vid=$matches[2]', 'top');
}
add_action('init', 'custom_rewrite_basic');
function custom_rewrite_tag() {
  add_rewrite_tag('%slick%', '([^&]+)');
  add_rewrite_tag('%cm%', '([^&]+)');
  add_rewrite_tag('%vid%', '([^&]+)');
}
add_action('init', 'custom_rewrite_tag', 10, 0);


add_filter('the_title','set_title');
function set_title(){
    global $post;
    // where $data would be string(#) "current title"
    // Example:
    // (you would want to change $post->ID to however you are getting the book order #,
    // but you can see how it works this way with global $post;)
    return '鼠來寶-鼠喉大作戰 之 明星選拔賽';
}