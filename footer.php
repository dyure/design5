<?php wp_footer(); ?>
<?php global $d5_options; ?>
<?php
    $arrCharsToDelete = [' ','(', ')'];
    $strPhoneToCall = str_replace($arrCharsToDelete, '', $d5_options['d5_contacts_phone']);
?>

<div class="footer">
    <div class="footer__body">
        <div class="footer__logo">
            <a href="<?php echo get_home_url(); ?>">
                <img src="<?php echo $d5_options['d5_media_logo']['url']; ?>" alt="">
            </a>
        </div>
        <div class="footer__features_menu_phone">
	        <div class="footer__features">
	        	<ul class="footer__lists">
	        		<?php wp_list_categories('title_li='); ?>
	        	</ul>
	        </div>
	        <nav class="footer__menu">
	        	<ul class="footer__lists">
	        		<li><a class="footer_link" href="<?php echo get_home_url(); ?>/projects/">Проекты</a></li>
	        		<li><a class="footer_link" href="<?php echo get_home_url(); ?>/about_us/">О нас</a></li>
	        		<li><a class="footer_link" href="<?php echo get_home_url(); ?>/articles/">Статьи</a></li>
	        		<li id="footer__lists_contacts">Контакты</li>
	        	</ul>
	        </nav>
	        <div class="footer__phone_socials_copy">
	            <div class="footer__phone">
	            	<a style="color: inherit;" href="tel:<?php echo $strPhoneToCall; ?>"><?php echo $d5_options['d5_contacts_phone']; ?></a>
	            </div>
	            <div class="footer__socials">
	            	<div class="footer__socials_vk">
	            		<a href="<?php echo $d5_options['d5_contacts_vk']; ?>">
	            			<img src="<?php echo $d5_options['d5_contacts_vk_logo']['url']; ?>" alt="">
	            		</a>
	            	</div>
	            	<div class="footer__socials_telegram">
	            		<a href="<?php echo $d5_options['d5_contacts_telegram']; ?>">
	            			<img src="<?php echo $d5_options['d5_contacts_telegram_logo']['url']; ?>" alt="">
	            		</a>
	            	</div>
	            	<div class="footer__socials_whatsapp">
	            		<a href="<?php echo $d5_options['d5_contacts_whatsapp']; ?>">
	            			<img src="<?php echo $d5_options['d5_contacts_whatsapp_logo']['url']; ?>" alt="">
	            		</a>
	            	</div>
	            	<div class="footer__socials_email">
	            		<a href="mailto:<?php echo $d5_options['d5_contacts_email']; ?>">
	            			<img src="<?php echo $d5_options['d5_contacts_email_logo']['url']; ?>" alt="">
	            		</a>
	            	</div>
	            </div>
	            <div class="footer__copy">
	            	&copy; 2018 design5
	            </div>
	        </div>
        </div>
    </div>
</div>