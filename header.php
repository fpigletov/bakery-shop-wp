<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>
        <?php the_title(); ?>
    </title>
    <link rel="apple-touch-icon" sizes="180x180"
        href="<?php echo bloginfo('template_url'); ?>/assets/resources/icons/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/x-icon" sizes="48x48"
        href="<?php echo bloginfo('template_url'); ?>/assets/resources/icons/favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="192x192"
        href="<?php echo bloginfo('template_url'); ?>/assets/resources/icons/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?php echo bloginfo('template_url'); ?>/assets/resources/icons/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?php echo bloginfo('template_url'); ?>/assets/resources/icons/favicon/favicon-16x16.png">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="wrapper">
        <header class="header">
            <div class="header__container container">
                <div class="header__body"><a href="/" class="header__logo">PASTRYCHEF <span>PRO</span></a>
                    <div class="header__content">
                        <div class="header__top top-header"> 
                            <div class="top-header__search search-header">
                                <?php aws_get_search_form( true ); ?> 
                            </div>
                            <div class="top-header__phones">
                                <a href="tel:<?= CFS()->get('info_phone-1_link', 8); ?>" class="top-header__phone icon-phone" aria-label="Позвонить">
                                    <?= CFS()->get('info_phone-1', 8); ?>
                                </a>
                                <a href="tel:89312559486" class="top-header__phone icon-phone" aria-label="Позвонить">+7(931)255-94-86
                                </a>
                            </div>
                            <button type="button" class="top-header__search-btn icon-search btn" aria-label="Показать поиск"></button>
                        </div>
                        <div class="header__bottom bottom-header">

                            <?php
                                wp_nav_menu([
                                    'theme_location' => 'top',
                                    'container' => 'nav',
                                    'container_class' => 'bottom-header__menu',
                                    'menu_class' => 'bottom-header__list',
                                    'menu_id' => ''
                                ]);
                            ?>

                            <div class="bottom-header__actions">
                                <?php if ('yes' === get_option( 'woocommerce_enable_myaccount_registration')) { 
                                        if (is_user_logged_in()) { ?>

                                            <button style="display:none" type="button" aria-label="Логин" class="bottom-header__login icon-user">
                                                <span>Войти</span>
                                            </button> 
                                            <a style="display:none" href="<?php echo esc_url(home_url( '/registracziya' )); ?>" aria-label="Регистрация"
                                            class="bottom-header__registration icon-register">
                                                <span>Регистрация</span> 
                                            </a>

                                            <a href="<?php echo esc_url(home_url( '/my-account' )); ?>" aria-label="Войти в личный кабинет"
                                            class="bottom-header__account icon-user">
                                                <span>Кабинет</span> 
                                            </a>
                                            <a href="<?php echo wp_logout_url(home_url()); ?>" aria-label="Выйти из личного кабинета"
                                            class="bottom-header__exit icon-register">
                                                <span>Выход</span> 
                                            </a>

                                        <?php } else { ?>

                                            <button type="button" aria-label="Логин" class="bottom-header__login icon-user">
                                                <span>Войти</span>
                                            </button> 
                                            <a href="<?php echo esc_url(home_url( '/registracziya' )); ?>" aria-label="Регистрация"
                                            class="bottom-header__registration icon-register">
                                                <span>Регистрация</span> 
                                            </a>

                                        <?php }
                                    }
                                ?>

                                <?php global $woocommerce; ?>

                                    <a href="<?php echo esc_url(home_url( '/cart' )); ?>" aria-label="Корзина" 
                                    class="cart-contents bottom-header__cart icon-cart">
                                        <span class="bottom-header__cart-span">
                                            <?php echo esc_attr(WC()->cart->get_cart_contents_total()) ?>
                                            <span class="bottom-header__cart-ruble">₽</span>
                                        </span>
                                    </a>
                                <button class="bottom-header__callback icon-callback btn">Обратный звонок</button> 
                                <button type="button" aria-label="Открыть меню" class="bottom-header__burger">
                                    <span class="bottom-header__burger-span"></span>
                                    <span class="bottom-header__burger-span"></span>
                                    <span class="bottom-header__burger-span"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>