<?php get_header(); ?>

<main class="SiteMain--root">
  <div class="SiteMain--post Post--root">

    <div class="Post--container">
      <div class="Post--main">
        <?php while ( have_posts() ) : the_post(); ?>
          <article class="Post--article">
            <header class="Post--header">
              <h1 class="Post--title"><?php the_title(); ?></h1>
              <div class="Post--date"><?php the_time('D, F j Y'); ?></div>
            </header>
            <div class="Post--content Content--root">
              <?php the_content(); ?>
            </div>
            <footer class="Post--footer">
              <p class="Post--categories">In <?php the_category(', '); ?></p>
              <div class="Post--author Author--root">
                <?php echo get_avatar(
                    get_the_author_meta('ID'),
                    64,
                    null,
                    get_the_author_meta('display_name'),
                    ['class' => 'Author--avatar']); ?>
                <div class="Author--about">
                  <h3 class="Author--name"><?php echo get_the_author_meta('display_name'); ?></h3>
                  <p class="Author--description">
                    <?php echo get_the_author_meta('description'); ?>
                  </p>
                </div>
              </div>
              <div class="Post--comments Comments--root">
                <?php comments_template();?>
              </div>
            </footer>
          </article>
        <?php endwhile; ?>
      </div>

    <?php get_sidebar(); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>