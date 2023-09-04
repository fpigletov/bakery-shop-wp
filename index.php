<?php 
/* 
Template Name: Главная
*/
get_header();
?>

<main class="main">
    <section class="main__home home">
        <div class="home__container container">    
            <?php echo wc_print_notices(); ?>        
            <div class="home__slider slider-home">
                <div class="slider-home__body swiper">
                    <ul class="slider-home__wrapper swiper-wrapper">
                        <?php
                            $loop = CFS()->get('slide');
                            foreach ($loop as $row) {
                                ?>
                                <li class="slider-home__slide swiper-slide slide-home">
                                    <div class="slide-home__image">
                                        <picture>
                                            <source srcset="<?= $row['slide_img_webp']; ?>" type="image/webp">
                                            <img loading="lazy"
                                                src="<?= $row['slide_img_jpg']; ?>" alt="<?= $row['slide_title']; ?>">
                                        </picture>
                                    </div>
                                    <div data-swiper-parallax-opacity="0" data-swiper-parallax-x="100%"
                                        class="slide-home__content">
                                        <h2 class="slide-home__title"><?= $row['slide_name']; ?></h2>
                                        <p class="slide-home__descr"><?= $row['slide_descr']; ?></p>
                                        <a href="<?= $row['slide_link']; ?>" class="slide-home__btn btn"><?= $row['slide_btn']; ?></a>
                                    </div>
                                </li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
                <div class="slider-home__arrows"><button type="button"
                        class="slider-home__arrow slider-home__arrow_prev icon-chevron-left btn"
                        aria-label="Предыдущий слайд"></button> <button type="button"
                        class="slider-home__arrow slider-home__arrow_next icon-chevron-right btn"
                        aria-label="Следующий слайд"></button></div>
                <div class="slider-home__dotts"></div>
            </div>
        </div>
    </section>

    <section class="main__new new">
        <div class="new__container container">
            
            <div class="new__title-body title-body">
                <h2 class="new__title title"><?= CFS()->get('new_title'); ?></h2>
            </div>
            <div class="new__slider swiper">
                
                <ul class="new__wrapper swiper-wrapper">
                    <?php 
                        $args = array(
                            'post_type' => 'product', 
                            'posts_per_page' => 6,
                            'orderby' => 'date',  
                        );
 
                        // создаем новый объект
                        $q = new WP_Query( $args );
                        
                        // проверяем, существуют ли посты по заданным параметрам
                        if( $q->have_posts() ) :
 
                            // затем запускаем цикл
                            while( $q->have_posts() ) : $q->the_post(); ?>

                                <li class="popular__slide swiper-slide">
                                    <?php wc_get_template_part( 'content', 'product' ); ?>
                                </li>
                                
                            <?php endwhile;
                        endif;
                        
                        // восстанавливаем глобальную переменную $post
                        wp_reset_postdata();
                    ?>

                </ul>
                <div class="slider-home__arrows">
                    <button type="button" class="new__arrow new__arrow_prev icon-chevron-left btn" aria-label="Предыдущий слайд"></button>
                    <button type="button" class="new__arrow new__arrow_next icon-chevron-right btn"
                    aria-label="Следующий слайд"></button>
                </div>
            </div>
            <div class="new__view-all"><a href="<?= CFS()->get('new_link'); ?>" class="new__btn btn">Смотреть все</a></div>
        </div>
    </section>

    <section class="main__benefits benefits">
        <div class="benefits__container container">
            <div class="benefits__title-body title-body">
                <h2 class="benefits__title title"><?= CFS()->get('why_title'); ?></h2>
            </div>
            <ul class="benefits__body">
                <?php
                    $loop = CFS()->get('why');
                    foreach ($loop as $row) {
                        ?>
                        <li class="benefits__item item-benefits">
                            <div class="item-benefits__icon">
                                <picture>
                                    <source srcset="<?= $row['why_img_webp']; ?>" type="image/webp">
                                    <img loading="lazy" src="<?= $row['why_img_png']; ?>" alt="<?= $row['why_name']; ?>">
                                </picture>
                            </div>
                            <h3 class="item-benefits__title"><?= $row['why_name']; ?></h3>
                            <p class="item-benefits__descr"><?= $row['why_descr']; ?></p>
                        </li>               
                        <?php
                    }
                ?>                
            </ul>
        </div>
    </section>

    <section class="main__popular popular">
        <div class="popular__container container">
            <div class="popular__title-body title-body">
                <h2 class="popular__title title"><?= CFS()->get('popular_title'); ?></h2>
            </div>
            <div class="popular__slider swiper">
                <ul class="popular__wrapper swiper-wrapper">

                    <?php 
                        $args = array(
                            'post_type' => 'product', 
                            'posts_per_page' => 6,
                            'orderby' => 'popularity',  
                            'visibility' => 'featured'
                        );
 
                        // создаем новый объект
                        $q = new WP_Query( $args );
                        
                        // проверяем, существуют ли посты по заданным параметрам
                        if( $q->have_posts() ) :
 
                            // затем запускаем цикл
                            while( $q->have_posts() ) : $q->the_post(); ?>

                                <li class="new__slide swiper-slide">
                                    <?php wc_get_template_part( 'content', 'product' ); ?>
                                </li>
                                
                            <?php endwhile;
                        endif;
                        
                        // восстанавливаем глобальную переменную $post
                        wp_reset_postdata();
                    ?>
                    
                </ul>
                <div class="slider-home__arrows"><button type="button"
                        class="popular__arrow popular__arrow_prev icon-chevron-left btn"
                        aria-label="Преддущий слайд"></button> <button type="button"
                        class="popular__arrow popular__arrow_next icon-chevron-right btn"
                        aria-label="Следующий слайд"></button></div>
            </div>
            <div class="popular__view-all"><a href="<?= CFS()->get('popular_link'); ?>" class="popular__btn btn">Смотреть все</a></div>
        </div>
    </section>

    <section class="main__partners partners">
        <div class="partners__container container">
            <div class="partners__title-body title-body">
                <h2 class="partners__title title"><?= CFS()->get('partners_title'); ?></h2>
            </div>
            <div class="partners__slider swiper">
                <div class="partners__wrapper swiper-wrapper">
                    <?php
                        $loop = CFS()->get('partner');
                        foreach ($loop as $row) {
                            ?>
                            <div class="partners__slide swiper-slide">
                                <a href="<?= $row['partner_link']; ?>" target="_blank" class="partners__link">
                                    <picture>
                                        <source srcset="<?= $row['partner_img_webp']; ?>" type="image/webp">
                                        <img loading="lazy" src="<?= $row['partner_img_png']; ?>" alt="<?= $row['partner_name']; ?>">
                                    </picture>
                                </a>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="main__categories categories">
        <div class="categories__container container">
            <div class="categories__title-body title-body">
                <h2 class="categories__title title"><?= CFS()->get('categories_title'); ?></h2>
            </div>
            <div class="categories__body">
                <?php
                    $loop = CFS()->get('category');
                    foreach ($loop as $row) {
                        ?>
                        <article class="categories__item item-categories">
                            <a href="<?= $row['category_link']; ?>" class="item-categories__image">
                                <picture>
                                    <source srcset="<?= $row['category_img_webp']; ?>" type="image/webp">
                                    <img loading="lazy" src="<?= $row['category_img_png']; ?>" alt="<?= $row['category_name']; ?>">
                                </picture>
                            </a>
                            <a href="<?= $row['category_link']; ?>" class="item-categories__title"><?= $row['category_name']; ?></a>
                            <a href="<?= $row['category_link']; ?>" class="item-categories__btn btn"><?= $row['category_btn']; ?></a>
                        </article>
                        <?php
                    }
                ?>
            </div>
        </div>
    </section>

    <section class="main__clients clients">
        <div class="clients__container container">
            <div class="clients__title-body title-body">
                <h2 class="clients__title title"><?= CFS()->get('clients_title'); ?></h2>
            </div>
            <ul class="clients__items">                
                <?php
                    $loop = CFS()->get('clients');
                    foreach ($loop as $row) {
                        ?>
                        <li class="clients__item">
                            <picture>
                                <source srcset="<?= $row['clients_img_webp']; ?>" type="image/webp">
                                <img loading="lazy" src="<?= $row['clients_img_jpg']; ?>" alt="<?= $row['clients_name']; ?>">
                            </picture>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </section>

</main>

<?php get_footer(); ?>