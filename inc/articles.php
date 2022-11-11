<div class="articles">
    <div class="articles_body">
<?php
    $args = array('post_type' => 'articles', 'posts_per_page' => 3);
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            echo '<div class="articles_body_item">';
            echo '<div class="articles_img"><a href="' . get_the_permalink() . '"><img src=' . get_the_post_thumbnail_url($post->ID, 'large') . ' alt=""></a></div>';
            echo '<div class="articles_desc"><h3>' . get_the_title() . '</h3><p>' . get_the_excerpt() . '</p></div>';
            echo '</div>';
        }
        wp_reset_postdata();
    } else {
?>
        <p class="montserrat_400_14_0_20" style="margin-top: 200px;"><?php echo 'Записи не найдены.'; ?></p>
<?php
    }
?>
        <div class="articles_body_go">
            <p>Статьи</p>
            <a href="articles/"><img src="https://blacksea.dm1tr11.ru/wp-content/uploads/2022/09/arrow.png" alt=""></a>
        </div>
    </div>
</div>
