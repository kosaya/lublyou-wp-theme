<!DOCTYPE html>
<html>
  <head>
    <title><?php bloginfo('name'); ?> : <?php bloginfo('description');?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/screen.css"/>
    <link ref="icon" type="image/png" href="http://lublyou.com/wp-content/themes/lublyou/images/berry.png">
    <link rel="shortcut icon" href="http://lublyou.com/favicon.ico?v=2" />
    <?php wp_head();?>
  </head>
  <body>
    <?php if (is_front_page()): ?>
      <?php get_template_part('header', 'front'); ?>
    <?php else: ?>
      <?php get_template_part('header', 'normal'); ?>
    <?php endif; ?>