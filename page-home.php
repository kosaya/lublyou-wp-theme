<?php get_header(); ?>

<main class="SiteMain--root">

  <div class="PostTeasers--root">
    <div class="PostTeasers--container">
      <?php 
        $home_query = new WP_Query([
          'post_type' => 'post',
          'posts_per_page' => 3
        ]);
        while ( $home_query->have_posts() ) : $home_query->the_post(); 
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
        $url = $thumb['0'];
        $categories = get_the_category();
 
        if ( ! empty( $categories ) ) {
            $category = esc_html( $categories[0]->name );   
        }
      ?>
        <a href="<?php the_permalink(); ?>" class="PostTeasers--teaser PostTeaser--root">
          <div class="PostTeaser--category"><?php echo $category; ?></div>
          <div class="PostTeaser--image image lazy" data-original="<?php echo $url; ?>" style="background-image: url('');"></div>
          <header class="PostTeaser--header">
            <h2 class="PostTeaser--title"><?php the_title(); ?></h2>
          </header>
        </a>
      <?php endwhile; ?>
    </div>
  </div>

  <div class="HomeFeatures--root">
    <div class="HomeFeatures--container">
      <?php if ( !dynamic_sidebar("home") ) {} ?>
    </div>
  </div>

</main>

<?php get_footer(); ?>