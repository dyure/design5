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
        <?php the_content(); ?>
        <div class="items">
<?php
    $args = array('post_type' => 'topics', 'posts_per_page' => 6);
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
?>
            <div class="items_1">
<?php
        $intPostCount = 0;
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $intPostCount++;
            $strBG_Overlay_Start = get_field('bg_overlay_start');
            $strBG_Overlay_End = get_field('bg_overlay_end');
?>
                <div class="no_mobile boxes item_<?php echo $intPostCount; ?>1">
                    <div class="overlay_topics" style="background: linear-gradient(to bottom, <?php echo $strBG_Overlay_Start; ?>, <?php echo $strBG_Overlay_End; ?>);">
                        <h3><?php echo get_the_title(); ?></h3>
                        <?php echo get_the_content(); ?>
                    </div>
                    <img class="da-image" src="<?php echo get_the_post_thumbnail_url($post->ID, 'large'); ?>" alt="">
                </div>
                <div class="no_descktop item_<?php echo $intPostCount; ?>1">
                    <img class="da-image" src="<?php echo get_the_post_thumbnail_url($post->ID, 'large'); ?>" alt="">
                    <div class="description">
                        <h3><?php echo get_the_title(); ?></h3>
                        <?php echo get_the_content(); ?>
                    </div>
                </div>
<?php
        }
        wp_reset_postdata();
?>
            </div>
<?php
    }
?>
            <div class="misc_field_1"><?php echo $d5_options['d5_misc_field_1']; ?></div>
<?php
    $args = array('post_type' => 'post', 'posts_per_page' => 10);
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
?>
            <div class="items_2">
<?php
        $intPostCount = 0;
        $intContainerCount = 2;
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $intItemsCount = 1;
            $intItems = 6;
            $intPostCount++;
            $strBG_Overlay = get_field('bg_overlay');
?>
                <div class="no_mobile boxes item_<?php echo $intPostCount . $intContainerCount; ?>">
                    <div class="overlay_posts" onclick="window.location='<?php echo get_the_permalink(); ?>';">
                        <h3><?php echo get_the_title(); ?></h3>
                    </div>
                    <img class="da-image" src="<?php echo get_the_post_thumbnail_url($post->ID, 'large'); ?>" alt="">
                </div>
                <div class="no_descktop item_<?php echo $intPostCount . $intContainerCount; ?>">
                    <a href="<?php echo get_the_permalink(); ?>">
                        <img class="da-image" src="<?php echo get_the_post_thumbnail_url($post->ID, 'large'); ?>" alt="">
                    </a>
                    <div class="description no_mobile">
                        <h3><?php echo get_the_title(); ?></h3>
                    </div>
                </div>
<?php
            if ($intPostCount == 6) {
                if ($intContainerCount == 2) {
                    if ($intItems == $intItemsCount) break;
                    $intItemsCount++;
                    echo '</div>';
                    echo '<div class="items_3">';
                    $intContainerCount = 3;
                } else {
                    $intContainerCount = 2;
                    if ($intItems == $intItemsCount) break;
                    echo '</div>';
                }
                $intPostCount = 0;
            }
        }
        wp_reset_postdata();
?>
                <div class="item_53">
                    <p><a href="<?php echo get_home_url(); ?>/projects/">В портфолио</a></p>
                    <a href="<?php echo get_home_url(); ?>/projects/"><img src="https://blacksea.dm1tr11.ru/wp-content/uploads/2022/09/arrow.png" alt=""></a>
                </div>
            </div>
<?php
    }
?>
        </div>
    </div>
</div>

<?php get_template_part('inc/want_design'); ?>

<?php //get_template_part('inc/articles'); ?>

<?php get_footer(); ?>

</body>
</html>