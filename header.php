<?php global $d5_options; ?>
<header class="header">
    <div class="header__body">
        <div class="header__logo_phone">
            <div class="header__logo">
                <a href="<?php echo get_home_url(); ?>">
                    <img src="<?php echo $d5_options['d5_media_logo']['url']; ?>" alt="">
                </a>
            </div>
            <div class="header__phone">
                <?php echo $d5_options['d5_contacts_phone']; ?>
            </div>
        </div>
        <div class="header__burger">
            <div class="header__burger_lines"></div>
        </div>
        <nav class="header__menu">
            <div class="header__menu_body">
                <div class="header__menu_menu">
                    <div class="menu_left">
                        <ul class="menu_left_list">
                            <li><a class="menu_link" href="<?php echo get_home_url(); ?>/projects/">Проекты</a></li>
                            <!--li><a class="menu_link" href="">Услуги</a></li-->
                            <li id="menu_order_design">Заказать Дизайн5</li>
                        </ul>
                    </div>
                    <div class="menu_right">
                        <ul class="menu_right_list">
                            <li><a class="menu_link" href="<?php echo get_home_url(); ?>/about_us/">О нас</a></li>
                            <!--li><a class="menu_link" href="">Статьи</a></li-->
                            <li id="menu_contacts">Контакты</li>
                        </ul>
                    </div>
                </div>
                <!--div class="header__menu_features">
                    <ul class="menu_features_list">
                        <li>Фирменный стиль</li>
                        <li>Дизайн упаковки</li>
                        <li>Разработка логотипов</li>
                        <li>Регистрация ТЗ</li>
                        <li>Создание сайта</li>
                        <li>SEO оптимизация</li>
                        <li>Копирайтинг</li>
                    </ul>
                </div-->
                <div class="header__menu_order">
                    <div class="header__menu_order_text">
                        <?php echo $d5_options['d5_misc_field_3']; ?>
                    </div>
                    <div class="header__menu_order_phone">
                        <?php echo $d5_options['d5_contacts_phone']; ?>
                    </div>
                    <div class="header__menu_order_socials">
                        <div class="header__menu_order_socials_left">
                            <div class="header__menu_order_socials_vk">
                                <a href="<?php echo $d5_options['d5_contacts_vk']; ?>">
                                    <img src="<?php echo $d5_options['d5_contacts_vk_logo_white']['url']; ?>" alt="">
                                    <p><?php echo $d5_options['d5_contacts_vk']; ?></p>
                                </a>
                            </div>
                            <div class="header__menu_order_socials_telegram">
                                <a href="<?php echo $d5_options['d5_contacts_telegram']; ?>">
                                    <img src="<?php echo $d5_options['d5_contacts_telegram_logo_white']['url']; ?>" alt="">
                                    <p><?php echo $d5_options['d5_contacts_telegram']; ?></p>
                                </a>
                            </div>
                        </div>
                        <div class="header__menu_order_socials_right">
                            <div class="header__menu_order_socials_whatsapp">
                                <a href="<?php echo $d5_options['d5_contacts_whatsapp']; ?>">
                                    <img src="<?php echo $d5_options['d5_contacts_whatsapp_logo_white']['url']; ?>" alt="">
                                    <p><?php echo $d5_options['d5_contacts_whatsapp']; ?></p>
                                </a>
                            </div>
                            <div class="header__menu_order_socials_email">
                                <a href="mailto:<?php echo $d5_options['d5_contacts_email']; ?>">
                                    <img src="<?php echo $d5_options['d5_contacts_email_logo_white']['url']; ?>" alt="">
                                    <p><?php echo $d5_options['d5_contacts_email']; ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header__menu_contacts">
                    <div class="header__menu_order_phone">
                        <?php echo $d5_options['d5_contacts_phone']; ?>
                    </div>
                    <div class="header__menu_order_socials">
                        <div class="header__menu_order_socials_left">
                            <div class="header__menu_order_socials_vk">
                                <a href="<?php echo $d5_options['d5_contacts_vk']; ?>">
                                    <img src="<?php echo $d5_options['d5_contacts_vk_logo_white']['url']; ?>" alt="">
                                    <p><?php echo $d5_options['d5_contacts_vk']; ?></p>
                                </a>
                            </div>
                            <div class="header__menu_order_socials_telegram">
                                <a href="<?php echo $d5_options['d5_contacts_telegram']; ?>">
                                    <img src="<?php echo $d5_options['d5_contacts_telegram_logo_white']['url']; ?>" alt="">
                                    <p><?php echo $d5_options['d5_contacts_telegram']; ?></p>
                                </a>
                            </div>
                        </div>
                        <div class="header__menu_order_socials_right">
                            <div class="header__menu_order_socials_whatsapp">
                                <a href="<?php echo $d5_options['d5_contacts_whatsapp']; ?>">
                                    <img src="<?php echo $d5_options['d5_contacts_whatsapp_logo_white']['url']; ?>" alt="">
                                    <p><?php echo $d5_options['d5_contacts_whatsapp']; ?></p>
                                </a>
                            </div>
                            <div class="header__menu_order_socials_email">
                                <a href="mailto:<?php echo $d5_options['d5_contacts_email']; ?>">
                                    <img src="<?php echo $d5_options['d5_contacts_email_logo_white']['url']; ?>" alt="">
                                    <p><?php echo $d5_options['d5_contacts_email']; ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<div class="popup-fade">
    <div class="popup"></div>
</div>

<div class="order_button">
    Заказать D5
</div>