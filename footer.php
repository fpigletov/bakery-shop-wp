<footer class="footer">
    <div class="footer__container container">
        <div class="footer__body">
            <div class="footer__column footer-column">
                <h3 class="footer-column__title">Информация</h3>

                <nav class="footer-column__menu">
                    <?php
                        wp_nav_menu([
                            'theme_location' => 'bottom-info',
                            'container' => '',  
                            'menu_class' => 'footer-column__list',
                            'fallback_cb' => 'wp_page_menu',
                            'depth' => 1        
                        ]);
                    ?>
                </nav>
            </div>

            <div class="footer__column footer-column">
                <h3 class="footer-column__title">Для покупателей</h3>
                <nav class="footer-column__menu">
                    <?php
                        wp_nav_menu([
                            'theme_location' => 'bottom-customers',
                            'container' => '',  
                            'menu_class' => 'footer-column__list',
                            'fallback_cb' => 'wp_page_menu',
                            'depth' => 1        
                        ]);
                    ?>
                </nav>
            </div>
            <div class="footer__column footer-column">
                <h3 class="footer-column__title">Контакты</h3>
                <ul class="footer-column__list">
                    <li class="footer-column__item">
                        <a href="tel:<?= CFS()->get('info_phone-1_link', 8); ?>" class="footer-column__link icon-phone">
                            <?= CFS()->get('info_phone-1', 8); ?>
                        </a>
                    </li>
                    <li class="footer-column__item">
                        <a href="tel:<?= CFS()->get('info_phone-2_link', 8); ?>" class="footer-column__link icon-phone">
                            <?= CFS()->get('info_phone-2', 8); ?>
                        </a>
                    </li>
                    <li class="footer-column__item">
                        <a href="mailto:<?= CFS()->get('info_email', 8); ?>" class="footer-column__link icon-paper-plane">
                            <?= CFS()->get('info_email', 8); ?>
                        </a>
                    </li>
                    <li class="footer-column__item">
                        <a href="<?php echo esc_url(home_url( '/kontakty' )); ?>" class="footer-column__link icon-world">
                            <?= CFS()->get('info_address', 8); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer__column footer-column">
                <h3 class="footer-column__title">Подпишитесь на наши новости:</h3>

                <?php echo do_shortcode( '[contact-form-7 id="282" title="Подпишитесь на наши новости"] ')?>

                <ul class="footer-column__social footer-social">
                    <li class="footer-social__item"><a href="<?= CFS()->get('info_facebook', 8); ?>" target="_blank"
                            class="footer-social__link icon-facebook" aria-label="Facebook"></a></li>
                    <li class="footer-social__item"><a href="<?= CFS()->get('info_vk', 8); ?>" target="_blank"
                            class="footer-social__link icon-vk" aria-label="Вконтакте"></a></li>
                    <li class="footer-social__item"><a href="<?= CFS()->get('info_instagram', 8); ?>" target="_blank"
                            class="footer-social__link icon-instagram" aria-label="Instagram"></a></li>
                    <li class="footer-social__item"><a href="<?= CFS()->get('info_telegram', 8); ?>" target="_blank"
                            class="footer-social__link icon-telegram" aria-label="Telegram"></a></li>
                </ul>
            </div>
        </div>
        <div class="footer__credit">© 2022 <a href="/">Pastrychef.pro</a> г.Санкт-Петербург</div>
    </div>
</footer>
</div>
<div class="modal modal-login">
    <button type="button" class="modal__close icon-close" aria-label="Закрыть окно"></button>
    <div class="modal__content">

        <form class="woocommerce-form woocommerce-form-login login modal__form modal__form_login form-modal" method="post">

            <h2 class="form-modal__title">Личный кабинет</h2>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input type="text" required class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </p>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
            </p>

            <div class="form-modal__bottom">
                <p class="form-row">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme form-modal__item">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox form-modal__checkbox checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span class="form-modal__tag checkbox-tag"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                    </label>
                </p>

                <p class="woocommerce-LostPassword lost_password">
                    <a href="<?php echo esc_url(home_url( '/my-account/lost-password' )); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                </p>
            </div>
            
            
            <div class="form-modal__btns">
                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                <button type="submit" class="form-modal__btn btn woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>

                <a href="<?php echo esc_url(home_url( '/registracziya' )); ?>" class="form-modal__btn btn">РЕГИСТРАЦИЯ</a>
            </div>
        </form>
        <div class="modal__form modal__form_callback form-modal">
            <?php echo do_shortcode( '[contact-form-7 id="283" title="ЗАКАЗАТЬ ЗВОНОК"] ')?>
        </div>
        <div class="modal__registration modal__registration_individual registration-modal">
            <p class="registration-modal__text">Спасибо! Письмо для подтверждения регистрации отправлено на ваш Email!
            </p>
        </div>
        <div class="modal__registration modal__registration_company registration-modal">
            <p class="registration-modal__text">Спасибо! Мы свяжемся с вами для заключения договора!</p>
        </div>
    </div>
</div>

<div class="preloader">
    <img src="<?php echo bloginfo('template_url'); ?>/assets/resources/preloader/preloader.gif" alt="preloader">
</div>


<?php wp_footer(); ?>
</body>

</html>                 