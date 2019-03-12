<?php get_header(); ?>

<main class="SiteMain--root">

  <div class="PostTeasers--root">

    <h1 class="PostTeasers--category"><?php single_cat_title(); ?></h1>
    <?php if ($paged > 1): ?>
      <h2 class="PostTeasers--page"><?php echo "page $paged"; ?></h2>
    <?php endif; ?>

    <div class="PostTeasers--container">
      <?php 
        $count = 0;
        while ( have_posts() ) : the_post(); 
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
        $url = $thumb['0']; 
        $count++;
      ?>

        <a href="<?php the_permalink(); ?>" class="PostTeasers--teaser PostTeaser--root">
          <div class="PostTeaser--image image lazy" data-original="<?php echo $url; ?>" style="background-image: url('');"></div>
          <header class="PostTeaser--header">
            <h2 class="PostTeaser--title"><?php the_title(); ?></h2>
            <div class="PostTeaser--date"><?php the_time('D, F j Y'); ?></div>
          </header>
        </a>

      <?php endwhile; ?>
    </div>
  </div>

  <ul class="PostTeasers--nav">
    <li class="PostTeasers--nav-prev"><?php previous_posts_link('&larr; Newer'); ?></li>
    <li class="PostTeasers--nav-next"><?php next_posts_link('Older &rarr;'); ?></li>
  </ul>

</main>

<?php get_footer(); ?>