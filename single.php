<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>

<?php get_header(); ?>

<?php $cat = get_the_category(); ?>

<div class="content">
    <div class="content__body">
        <p><a href="<?php echo get_home_url(); ?>/projects/">Проекты</a> / <?php echo $cat[0]->cat_name; ?></p>
        <div class="content__body_single">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<?php get_template_part('inc/want_design'); ?>

<?php //get_template_part('inc/articles'); ?>

<?php get_footer(); ?>

</body>
</html>