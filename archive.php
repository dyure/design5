<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php single_term_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
<?php get_header(); ?>

<?php
    if ( is_single() ) {
        $cats = get_the_category();
        $cat = $cats[0];
    } else {
        $cat = get_category( get_query_var( 'cat' ) );
    }
    $cat_slug = $cat->slug;
    $cat_name = $cat->name;
    $cat_id = $cat->cat_ID;
?>

<div class="content">
    <div class="content__body">
        <h2 class="content__body_title"><?php echo $cat_name; ?></h2>
        <ul class="content__body_categories">
            <li><a href="<?php echo get_home_url(); ?>/projects/">Все</a></li>
            <?php wp_list_categories('exclude=' . $cat_id . '&title_li='); ?>
        </ul>
        <div class="items">
            <?php echo do_shortcode('[ajax_load_more posts_per_page="6" container_type="div" post_type="post" category="' . $cat_slug . '" scroll="true"]'); ?>
        </div>
    </div>
</div>

<?php get_template_part('inc/want_design'); ?>

<?php //get_template_part('inc/articles'); ?>


<?php get_footer(); ?>
</body>
</html>