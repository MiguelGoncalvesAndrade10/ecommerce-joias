<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
    <div class="title">
        <h1><?php bloginfo('name'); ?></h1>
        <p><?php bloginfo('description'); ?></p>
    </div>

    <?php wp_nav_menu(array(
        'theme_location' => 'header_menu',
        'container' => false ,
        'container_class' => 'header-menu',
        'menu_class' => 'menu',
    )); ?>

</header>