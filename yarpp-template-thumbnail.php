<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>
<?php if ( have_posts() ):?>
<h4>Have you seen these yet?</h4>
<ol>
	<?php while ( have_posts()) : the_post(); ?>
		<?php if ( has_post_thumbnail() ):?>
		<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail("thumbnail"); ?>
		</a>
		</li>
		<?php endif; ?>
	<?php endwhile; ?>
</ol>

<?php else: ?>
<?php endif; ?>
