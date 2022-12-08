<?php
    // to remove admin bar
    add_filter('show_admin_bar', '__return_false');

    // to define some root directories
    define('D5_THEME_ROOT', get_template_directory_uri());
    define('D5_CSS_DIR', D5_THEME_ROOT . '/css');
    define('D5_JS_DIR', D5_THEME_ROOT . '/js');

    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_style('theme', get_stylesheet_uri());
        wp_enqueue_style('main', D5_CSS_DIR . '/styles.css');
        wp_enqueue_style('responsive', D5_CSS_DIR . '/responsive.css');
        wp_enqueue_style('responsive_big', D5_CSS_DIR . '/responsive_big.css');
        //wp_enqueue_style('owl_css', D5_CSS_DIR . '/owl.carousel.min.css');
        //wp_enqueue_style('owl_theme_css', D5_CSS_DIR . '/owl.theme.default.min.css');

        wp_deregister_script('jquery-core');
        wp_register_script('jquery-core', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js');
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js', array(), false, true );
        wp_register_script('inputmask', D5_JS_DIR . '/jquery.inputmask.min.js');
        wp_enqueue_script('inputmask');
        wp_register_script('validate', D5_JS_DIR . '/jquery.validate.min.js');
        wp_enqueue_script('validate');
        wp_register_script('my_jquery_scripts', D5_JS_DIR . '/scripts.js');
        wp_enqueue_script('my_jquery_scripts');
        // wp_register_script('owl_scripts', D5_JS_DIR . '/owl.carousel.js');
        // wp_enqueue_script('owl_scripts');
    });

    require_once get_template_directory() . '/inc/redux-options.php';

    add_action('init', function() {
        // to add an image to any post
        add_theme_support('post-thumbnails');

        /* to add menu areas
        if(function_exists('register_nav_menus')){
            register_nav_menus(
                array(
                  'top_menu' => 'Меню в шапке',
                  'bottom_menu_1' => 'Меню в подвале 1',
                  'bottom_menu_2' => 'Меню в подвале 2',
                  'bottom_menu_3' => 'Меню в подвале 3',
                  'bottom_menu_4' => 'Меню в подвале 4'
                )
            );
        }*/
    });

    // to add new posttype
    /*function wpschool_create_chosenone_posttype() {
        $labels = array(
            'name' => 'Избранные', 'Тип записей Избранные',
            'menu_name' => 'Избранные',
            'all_items' => 'Все избранные',
            'view_item' => 'Смотреть',
            'add_new' => 'Добавить новый',
            'edit_item' => 'Редактировать',
            'update_item' => 'Обновить',
        );

        $args = array(
            'label' => 'chosenone',
            'description' => 'Каталог избранных работ',
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields',),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 4,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );

        register_post_type('chosenone', $args);

    }
    add_action('init', 'wpschool_create_chosenone_posttype', 0);

    // to let show chosenone posttype on main page
    function wpschool_add_chosenone_to_query( $query ) {
        if ( is_home() && $query->is_main_query() )
            $query->set( 'post_type', array( 'post', 'chosenone' ) );
        return $query;
    }
    add_action('pre_get_posts', 'wpschool_add_chosenone_to_query');*/

    // Колонка миниатюры в списке записей админки
    add_filter('manage_posts_columns', 'posts_columns', 5);
    add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
    function posts_columns($defaults){
        $defaults['riv_post_thumbs'] = 'Миниатюра';
        return $defaults;
    }
    function posts_custom_columns($column_name, $id){
     if($column_name === 'riv_post_thumbs'){
            the_post_thumbnail( array(100, 100) );
        }
    }

    // to send the mail
    add_action('wp_ajax_nopriv_ajax_order', 'ajax_form');
    add_action('wp_ajax_ajax_order', 'ajax_form');

    function ajax_form(){
        $name = $_REQUEST['name'];
        $tel = $_REQUEST['tel'];
        $int_tel = preg_replace("/[^0-9]/", '', $tel);
        $len_tel = strlen($int_tel);
        $response = '';
        $thm  = 'Заказ звонка';
        $thm  = "=?utf-8?b?" . base64_encode($thm) . "?=";
        $msg = "Имя: " . $name . "<br/>
            Телефон: " . $tel . "<br/>";
        $mail_to = 'sobranieinfo@yandex.ru';
        $headers = "Content-Type: text/html; charset=utf-8\n";
        $headers .= 'From: sobranieinfo@yandex.ru' . "\r\n";
    // Отправляем почтовое сообщение
        if ($len_tel == 11) {
            if (mail($mail_to, $thm, $msg, $headers)) {
                $response = '<p class="text">Ваша заявка принята</p>';
            } else {
                $response = '<div class="popup-red"><p class="text-red">Ошибка при отправке</p></div>';
            }
        } else {
           $response = '<div class="popup-red"><p class="text-red">Пожалуйста, заполните форму с&nbsp;номером телефона!</p></div>';
        }
    // Сообщение о результате отправки почты
        if (defined('DOING_AJAX') && DOING_AJAX) {
            echo $response;
            wp_die();
        }
    }
    
    // to load posts by pressing "more posts" button
    /*function true_load_posts() { 
        $args = unserialize (stripslashes($_POST['query']));
        $args['paged'] = $_POST['page'] + 1;
        $args['post_status'] = 'publish';
        query_posts ($args);
        if (have_posts()) {
            while(have_posts()) {
                the_post();
                echo 'these are the next 10 posts';
            }
        }
        die();
    }
    add_action('wp_ajax_loadmore', 'true_load_posts');
    add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');*/
?>