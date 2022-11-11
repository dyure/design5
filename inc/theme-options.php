<?php
    add_action('after_setup_theme', function() {
        load_theme_textdomain('d5_template', get_template_directory() . '/lang');
    });

    // to add theme options
    add_action('admin_menu', 'add_d5_about_page');
    function add_d5_about_page() {
        add_options_page(__('Customizer', 'd5_template'), __('Customizer', 'd5_template'), 'manage_options', 'd5_about_slug', 'd5_about_page_output');
    }
    function d5_about_page_output() {
?>
        <div class="wrap">
            <h2><?php echo get_admin_page_title() ?></h2>
            <form action="options.php" method="post" enctype="multipart/form-data">
<?php
                settings_fields('option_group');
                do_settings_sections('d5_about_page');
                submit_button();
?>
            </form>
        </div>
<?php
    }
    add_action('admin_init', 'common_settings_api_init');
    function common_settings_api_init() {
        register_setting('option_group', 'option_name', 'sanitize_callback');

        add_settings_section('d5_media_section', __('Media', 'd5_template'), '', 'd5_about_page');
        add_settings_field('d5_logo', __('Logo', 'd5_template'), 'logo_field_html', 'd5_about_page', 'd5_media_section');
        register_setting('option_group', 'd5_logo', 'sanitize_callback');

        add_settings_section('d5_setting_section', __('Contacts', 'd5_template'), '', 'd5_about_page');
        add_settings_field('d5_phone', __('Phone', 'd5_template'), 'phone_field_html', 'd5_about_page', 'd5_setting_section');
        add_settings_field('d5_email', __('E-mail', 'd5_template'), 'email_field_html', 'd5_about_page', 'd5_setting_section');
        add_settings_field('d5_vk', __('VK', 'd5_template'), 'vk_field_html', 'd5_about_page', 'd5_setting_section');
        add_settings_field('d5_telegram', __('Telegram', 'd5_template'), 'telegram_field_html', 'd5_about_page', 'd5_setting_section');
        add_settings_field('d5_whatsapp', __('WhatsApp', 'd5_template'), 'whatsapp_field_html', 'd5_about_page', 'd5_setting_section');
        register_setting('option_group', 'd5_phone', 'sanitize_callback');
        register_setting('option_group', 'd5_email', 'sanitize_callback');
        register_setting('option_group', 'd5_vk', 'sanitize_callback');
        register_setting('option_group', 'd5_telegram', 'sanitize_callback');
        register_setting('option_group', 'd5_whatsapp', 'sanitize_callback');
    }
    function logo_field_html() {
        $value = get_option('d5_logo', '');
        echo '<label>' . __('Insert the path from Media', 'd5_template') . '</label><br>';
        echo '<input style="width: 100%;" type="text" id="d5_logo" name="d5_logo" value="' . esc_attr($value) . '" /><br>';
        echo '<img style="width: 50px; height: auto;" src="' . $value . '" alt="">';
    }

    function phone_field_html() {
        $value = get_option('d5_phone', '');
        printf('<input type="text" id="d5_phone" name="d5_phone" value="%s" />', esc_attr($value));
    }
    function email_field_html() {
        $value = get_option('d5_email', '');
        printf('<input type="text" id="d5_email" name="d5_email" value="%s" />', esc_attr($value));
    }
    function vk_field_html() {
        $value = get_option('d5_vk', '');
        printf('<input type="text" id="d5_vk" name="d5_vk" value="%s" />', esc_attr($value));
    }
    function telegram_field_html() {
        $value = get_option('d5_telegram', '');
        printf('<input type="text" id="d5_telegram" name="d5_telegram" value="%s" />', esc_attr($value));
    }
    function whatsapp_field_html() {
        $value = get_option('d5_whatsapp', '');
        printf('<input type="text" id="d5_whatsapp" name="d5_whatsapp" value="%s" />', esc_attr($value));
    }
    function sanitize_callback($options) {
        foreach($options as $name => $val) {
            if ($name == 'input') $val = strip_tags($val);
        }
        return $options;
    }
?>