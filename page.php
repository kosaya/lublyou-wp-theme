<?php get_header(); ?>

<main class="SiteMain--root">
  <div class="SiteMain--page Page--root">

    <div class="Page--container">
      <div class="Page--main">

        <?php while ( have_posts() ) : the_post(); ?>
          <article class="Page--page">
            <header class="Page--header">
              <h1 class="Page--title"><?php the_title(); ?></h1>
            </header>
            <div class="Page--content Content--root">
              <?php the_content(); ?>
            </div>
          </article>
        <?php endwhile; ?>
        
      </div>

    <?php get_sidebar(); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>