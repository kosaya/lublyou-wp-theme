<?php	
include('additional_functions/function_library.php');

register_nav_menu( 'top_menu', 'Top Menu' );

register_sidebar(array(
  'id' => 'sidebar',
  'name' => 'Sidebar',
  'description'   => 'Widgets that appear on the sidebar.',
  'before_widget' => '<div class="Sidebar--widget">',
  'after_widget'  => '</div>',
  'before_title'  => '<h3 class="Sidebar--widget-title">',
  'after_title'   => '</h3>'
));

register_sidebar(array(
  'id' => 'home',
  'name' => 'Home Widgets',
  'description'   => 'Homepage widgets.',
  'before_widget' => '<div class="HomeFeatures--widget">',
  'after_widget'  => '</div>',
  'before_title'  => '<h3 class="HomeFeatures--widget-title">',
  'after_title'   => '</h3>'
));

//---------------------------------------- Create field for additional content.
$meta_box['post'] = array(
  'id' => 'addition_content',
  'title' => 'Additional Content',
  'context' => 'normal',
  'priority' => 'high',
  'fields' => array(
  array(
          'name' => 'Left Side Content',
          'desc' => 'Content that appears on the left side of the blog.  Pictures, videos, etc.',
          'id' => 'impressionist_content_left',
          'type' => 'textarea',
          'default' => ''
        ),
      array(
          'name' => 'Large Image',
          'desc' => 'A large image to appear above the rest of the content.  Paste the image URL.',
          'id' => 'impressionist_large_image',
          'type' => 'text',
          'default' => ''
        )
    )
  );

$meta_box['product'] = array(
  'id' => 'software_content',
  'title' => 'Software Content',
  'context' => 'normal',
  'priority' => 'high',
  'fields' => array(
  array(
          'name' => 'Software Demo Link',
          'desc' => 'Demo of functionality/theme for software products',
          'id' => 'software_demo_link',
          'type' => 'text',
          'default' => ''
        ),
      array(
          'name' => 'Software Price',
          'desc' => 'How much does this product cost?',
          'id' => 'software_price',
          'type' => 'text',
          'default' => ''
        ),
    array(
          'name' => 'Software Buy/Download Link',
          'desc' => 'Buy/Download link for software products',
          'id' => 'software_download_link',
          'type' => 'text',
          'default' => ''
        ),
    array(
          'name' => 'Analytics Tracking Code',
          'desc' => 'Google Analytics push code to track link.',
          'id' => 'software_analytics_code',
          'type' => 'textarea',
          'default' => ''
        )
    )
);

//---------------------------------------- Custom Post Type

function create_products_type() {
  $labels = array(
    'name' => 'Products',
    'singular_name' => 'Product',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Product',
    'edit_item' => 'Edit Product',
    'new_item' => 'New Product',
    'all_items' => 'All Products',
    'view_item' => 'View Product',
    'search_items' => 'Search Products',
    'not_found' =>  'No products found',
    'not_found_in_trash' => 'No products found in Trash',
    'menu_name' => 'Products'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 

  register_post_type( 'product', $args );
}

add_action( 'init', 'create_products_type' );

  
//---------------------------------------- Add the content field.
add_action('admin_menu', 'flib_add_box');

//---------------------------------------- Add custom fields to the RSS feed
function fields_in_feed($content) { 
      $post_id = get_the_ID();  
      $output = get_post_meta( $post_id, 'impressionist_content_left', true );
      $content = $output.$content;
    return $content;  
}  
add_filter('the_content_feed','fields_in_feed');

add_theme_support('post-thumbnails');

//---------------------------------------- Shortcode

function recipe_display() {

  $postID = get_the_ID();
  
  $output = "";
  
  if ( get_post_meta($postID, 'wpcf-recipe', true) ) :
  
    $output .= '<div class="Recipe--root">';
      $output .= '<h3>' . get_post_meta($postID, 'wpcf-recipe-title', true) . '</h3>';
      $output .= '<ul class="Recipe--ingredients">';
      
      $ingredients = get_post_meta($postID, 'wpcf-recipe-ingredients');
      if (count($ingredients) <= 1) {
        $ingredients = get_post_meta($postID, 'wpcf-ingredients-list', true);
        $ingredients = explode("\n", $ingredients);
      }
      foreach ( $ingredients as $ingredient ) :
        $output .= '<li>' . $ingredient . '</li>';
      endforeach;
      $output .= '</ul><!--ingredients-->';

      $output .= '<div class="Recipe--directions">';
        $output .= wpautop( do_shortcode( get_post_meta($postID, 'wpcf-recipe-directions', true) ) );
      $output .= '</div><!--directions-->';
    $output .= '</div><!--recipe-->';
    
  endif;
  
  return $output;
}
add_shortcode('recipe', 'recipe_display');

//---------------------------------------- Check for additional posts

function lublyou_scripts() {
  wp_enqueue_script('lublyou-script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'lublyou_scripts');

function main_filter($query) {
  if ($query->is_main_query()) {
    $query->set('posts_per_page', 9);
  }
}
add_action('pre_get_posts', 'main_filter');

function more_posts() {
  global $wp_query;
  return $wp_query->current_post + 1 > $wp_query->post_count;
}

// Filters for global lazy-loading
/*function add_lazyload($content) {
  
  $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
  $dom = new DOMDocument();
  @$dom->loadHTML($content);

  foreach ($dom->getElementsByTagName('img') as $node) {
    $oldsrc = $node->getAttribute('src');
    $node->setAttribute("data-original", $oldsrc );
    $newsrc = '';
    $node->setAttribute("src", $newsrc);
    $classList = $node->getAttribute('class');
    $classList = $classList . " lazy";
    $node->setAttribute("class", $classList);
  }
  
  $newHtml = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML()));
  return $newHtml;
}
add_filter('the_content', 'add_lazyload');*/

// Remove image links
add_filter( 'the_content', 'attachment_image_link_remove_filter' ); function attachment_image_link_remove_filter( $content ) { $content = preg_replace( array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}', '{ wp-image-[0-9]*" /></a>}'), array('<img','" />'), $content ); return $content; }