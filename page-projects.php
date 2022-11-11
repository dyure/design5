<?php global $d5_options; ?>
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

<div class="content">
    <div class="content__body">
        <h2 class="content__body_title">Проекты</h2>
        <ul class="content__body_categories">
            <?php wp_list_categories('title_li='); ?>
        </ul>
        <div class="items">
            <?php echo do_shortcode('[ajax_load_more posts_per_page="6" container_type="div" post_type="post" scroll="true"]'); ?>
        </div>
    </div>
</div>

<?php get_template_part('inc/want_design'); ?>

<?php //get_template_part('inc/articles'); ?>

<?php get_footer(); ?>

</body>
</html>