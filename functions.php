<?php 
    add_action( 'wp_enqueue_scripts', 'add_scripts_and_styles' );
    add_action( 'after_setup_theme', 'add_menu' );

    function add_scripts_and_styles() {
        
        wp_enqueue_style( 'choices-style', get_stylesheet_directory_uri() . '/assets/resources/css/choices.min.css' );
        wp_enqueue_style( 'baguetteBox-style', get_stylesheet_directory_uri() . '/assets/resources/css/baguetteBox.min.css' );

        if (is_page_template( 'index.php' )) {
            wp_enqueue_style( 'swiper-style', get_stylesheet_directory_uri() . '/assets/resources/css/swiper-bundle.min.css' );
            wp_enqueue_script( 'swiper-script', get_template_directory_uri() . '/assets/js/vendors/swiper-bundle.min.js', array(), null, true );            
        }
       
        wp_enqueue_style( 'choices-style', get_stylesheet_directory_uri() . '/assets/resources/css/choices.min.css' );
        wp_enqueue_script( 'choices-script', get_template_directory_uri() . '/assets/js/vendors/choices.min.js', array(), null, true );    

        wp_enqueue_style( 'style', get_stylesheet_uri() );

        wp_enqueue_script( 'baguetteBox-script', get_template_directory_uri() . '/assets/js/vendors/baguetteBox.min.js', array(), null, true );

        wp_enqueue_script( 'inputmask-script', get_template_directory_uri() . '/assets/js/vendors/inputmask.min.js', array(), null, true );

        if (is_page_template('templates/contacts.php')) {
            wp_enqueue_script('yandex-script', 'https://api-maps.yandex.ru/2.1/?apikey=вашAPI-ключ&lang=ru_RU', array(), null, true);
        }

        wc_enqueue_js( '
                    $(".woocommerce .products").on("click", ".quantity input", function() {
                        return false;
                    });
                    $(".woocommerce .products").on("change input", ".quantity .qty", function() {
                        var add_to_cart_button = $(this).parents(".product-item").find(".add_to_cart_button");

                        // For AJAX add-to-cart actions
                        add_to_cart_button.attr("data-quantity", $(this).val());
                        
                        // For non-AJAX add-to-cart actions
                        add_to_cart_button.attr("href", "?add-to-cart=" + add_to_cart_button.attr("data-product_id") + "&quantity=" + $(this).val());
                    });
                    
                    // Trigger on Enter press
                    $(".woocommerce .products").on("keypress", ".quantity .qty", function(e) {
                        if ((e.which||e.keyCode) === 13) {
                            $( this ).parents(".product").find(".add_to_cart_button").trigger("click");
                        }
                    });
                ' );
        
        wp_register_script( 'pastrychef_catalog_filter', get_template_directory_uri() . '/assets/js/components/catalog-filter.js', array( 'jquery' ), '', true );
        wp_localize_script( 'pastrychef_catalog_filter', 'pastrychef_settings', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'pastrychef_catalog_filter' );

        wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js', array(), null, true );

    }

    function add_menu() {
        register_nav_menu( 'top', 'Главное меню' );
        register_nav_menu( 'bottom-info', 'Меню информация' );        
        register_nav_menu( 'bottom-customers', 'Меню для покупателей' );        
    };

    //Add Class Header Menu Item
    add_filter( 'nav_menu_css_class', 'filter_header_menu_item', 10, 4 );
    function filter_header_menu_item($classes, $item, $args, $depth) {
        if ($args->theme_location === 'top') {
            $classes[] = 'bottom-header__item';
        };

        return $classes;
    }

    //Add Class Header Menu Link
    add_filter( 'nav_menu_link_attributes', 'filter_header_menu_link', 10, 3 );
    function filter_header_menu_link($atts, $item, $args) {
        if ($args->theme_location === 'top') {
            $atts['class'] = 'bottom-header__link';
        };

        return $atts;
    }
    
    //Add Class Footer Info Item
    add_filter( 'nav_menu_css_class', 'filter_footerInfo_menu_item', 10, 4 );
    function filter_footerInfo_menu_item($classes, $item, $args, $depth) {
        if ($args->theme_location === 'bottom-info') {
            $classes[] = 'footer-column__item';
        };

        return $classes;
    }

    //Add Class Footer Info link
    add_filter( 'nav_menu_link_attributes', 'filter_footerInfo_menu_link', 10, 3 );
    function filter_footerInfo_menu_link($atts, $item, $args) {
        if ($args->theme_location === 'bottom-info') {
            $atts['class'] = 'footer-column__link icon-cupcake';
        };

        return $atts;
    }

    //Add Class Footer Customers Item
    add_filter( 'nav_menu_css_class', 'filter_footerCustomrs_menu_item', 10, 4 );
    function filter_footerCustomrs_menu_item($classes, $item, $args, $depth) {
        if ($args->theme_location === 'bottom-customers') {
            $classes[] = 'footer-column__item';
        };

        return $classes;
    }

    //Add Class Footer Customers link
    add_filter( 'nav_menu_link_attributes', 'filter_footerCustomers_menu_link', 10, 3 );
    function filter_footerCustomers_menu_link($atts, $item, $args) {
        if ($args->theme_location === 'bottom-customers') {
            $atts['class'] = 'footer-column__link icon-cupcake';
        };

        return $atts;
    }

    
    //Подключение дополнительных .php
    require get_template_directory() . '/inc/functions/woocommerce.php';   
    require get_template_directory() . '/inc/functions/pastrychef-breadcrumbs.php'; 
    require get_template_directory() . '/inc/widgets/widgets.php';   
    require get_template_directory() . '/inc/widgets/widget-category.php';  
     
    
    //Фильтрация товаров в каталоге
    function pastrychef_filter_products(){

        $query_data = $_GET;     

        $paged = (isset($query_data['paged']) ) ? intval($query_data['paged']) : 1;
        
        $posts_per_page = get_option('woocommerce_catalog_columns') * get_option('woocommerce_catalog_rows');

        $cats = ($query_data['category']) ? explode(',',$query_data['category']) : false;

        $tax_query = ($cats) ? array( array(
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $cats
        ) ) : false;

        $args = array(
            'post_type' => 'product',           
            'paged' => $paged, 
            'posts_per_page' => $posts_per_page,
            'tax_query' => $tax_query
        );

        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ) {            

            //Продукты
            echo '<div class="products products-catalog__items columns-4">';

            while ( $loop->have_posts() ) : $loop->the_post();
                wc_get_template_part( 'content', 'product' );
            endwhile;

            echo '</div>';

            //Пагинация
            echo '<nav class="pagination">';

            $big = 999999999; // need an unlikely integer
            
            $paginate_links = paginate_links(                
                array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, $paged ),
                    'prev_text'          => '<',
                    'next_text'          => '>',
                    'total' => $loop->max_num_pages,
                    'end_size'     => 1,
                    'mid_size'     => 1,
                    'type'         => 'array',
                    
                ) );     
                
                if ( is_array( $paginate_links ) ) {
                    ?>
                        <ul class="products-catalog__pagination catalog-pagination">
                        <?php 
                        foreach ($paginate_links as $paginate_link) {
                        ?>
                            
                            <li class="page-item">
                                <?php
                                $paginate_link = str_replace( 'page-numbers', 'catalog-pagination__number btn', $paginate_link );
                                echo wp_kses_post($paginate_link);                
                                ?>
                            </li>
                                
                        <?php
                        }
                        ?>  
                        </ul>
                    <?php
                    }

            echo '</nav>';

        } else {
            echo __( 'Ничего не найдено','pastrychef');
        }        

        wp_reset_postdata(); 

        
    die();
}

add_action('wp_ajax_pastrychef_filter', 'pastrychef_filter_products');
add_action('wp_ajax_nopriv_pastrychef_filter', 'pastrychef_filter_products');

//Изменение текста оповещения
function tb_custom_add_to_cart_message_cart_link( $message, $products ) {

$count = 0;
$titles = array();
foreach ( $products as $product_id => $qty ) {
$titles[] = ( $qty > 1 ? absint( $qty ) . ' &times; ' : '' ) . sprintf( _x( '&ldquo;%s&rdquo;', 'Item name in quotes', 'woocommerce' ), strip_tags( get_the_title( $product_id ) ) );
$count += $qty;
}

$titles     = array_filter( $titles );
$added_text = sprintf( _n(
'%s добавлен в Корзину. Спасибо за покупку!', // Singular
'%s добавлены в Корзину. Спасибо за покупку!', // Plural
$count, // Number of products added
'woocommerce' // Textdomain
), wc_format_list_of_items( $titles ) );
$message    = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View cart', 'woocommerce' ), esc_html( $added_text ) );

return $message;
}
add_filter( 'wc_add_to_cart_message_html', 'tb_custom_add_to_cart_message_cart_link', 10, 2 );



//Post Types

//Study
function pastrychef_create_post_type() {
    register_post_type( 'obuchenie', 
        array(
            'labels' => array(
                'name' => __('Обучение'),
                'singular_name' => __('Курс'),
            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-admin-site',
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
}

add_action('init', 'pastrychef_create_post_type');

//


//Add new fields to registration form

// add_action( 'woocommerce_register_form_start', 'pastrychef_form_registration_fields', 25 );
 
// function pastrychef_form_registration_fields() {
 
// 	// поле "Имя"
// 	$billing_first_name = ! empty( $_POST[ 'billing_first_name' ] ) ? $_POST[ 'billing_first_name' ] : '';
// 	echo '<p class="form-row form-row-first">
// 		<label for="kind_of_name">Имя <span class="required">*</span></label>
// 		<input type="text" class="input-text" name="billing_first_name" id="kind_of_name" value="' . esc_attr( $billing_first_name ) . '" />
// 	</p>';
 
// 	// поле "Фамилия"
// 	$billing_last_name = ! empty( $_POST[ 'billing_last_name' ] ) ? $_POST[ 'billing_last_name' ] : '';
// 	echo '<p class="form-row form-row-last">
// 		<label for="kind_of_l_name">Фамилия <span class="required">*</span></label>
// 		<input type="text" class="input-text" name="billing_last_name" id="kind_of_l_name" value="' . esc_attr( $billing_last_name ) . '" />
// 	</p>';

//     //Номер телефона
// 	$billing_phone = ! empty( $_POST[ 'billing_phone' ] ) ? $_POST[ 'billing_phone' ] : '';
// 	echo '<p class="form-row form-row-last">
// 		<label for="kind_of_phone">Номер телефона: <span class="required">*</span></label>
// 		<input type="tel" class="form-registration__input" name="billing_phone" id="kind_of_phone" value="' . esc_attr( $billing_phone ) . '" />
// 	</p>';
 
// 	// чтобы всё не съехало, ведь у нас "на флоатах"
// 	// echo '<div class="clear"></div>';
 
// }


add_action( 'woocommerce_created_customer', 'pastrychef_save_fields', 25 );
 
function pastrychef_save_fields( $user_id ) {
 
	// сохраняем Имя
	if ( isset( $_POST[ 'billing_first_name' ] ) ) {
		update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
		update_user_meta( $user_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
	}

	// сохраняем Фамилию
	if ( isset( $_POST[ 'billing_last_name' ] ) ) {
		update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
		update_user_meta( $user_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
	}

	// сохраняем номер телефона
	if ( isset( $_POST[ 'billing_phone' ] ) ) {
		update_user_meta( $user_id, 'phone', sanitize_text_field( $_POST['billing_phone'] ) );
		update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
	}

	// сохраняем имя компании
	if ( isset( $_POST[ 'billing_company_name' ] ) ) {
		update_user_meta( $user_id, 'company_name', sanitize_text_field( $_POST['billing_company_name'] ) );
		update_user_meta( $user_id, 'billing_company_name', sanitize_text_field( $_POST['billing_company_name'] ) );
	}

	// сохраняем ИНН компании
	if ( isset( $_POST[ 'billing_inn' ] ) ) {
		update_user_meta( $user_id, 'inn', sanitize_text_field( $_POST['billing_inn'] ) );
		update_user_meta( $user_id, 'billing_inn', sanitize_text_field( $_POST['billing_inn'] ) );
	}

	// сохраняем ОГРН компании
	if ( isset( $_POST[ 'billing_ogrn' ] ) ) {
		update_user_meta( $user_id, 'ogrn', sanitize_text_field( $_POST['billing_ogrn'] ) );
		update_user_meta( $user_id, 'billing_ogrn', sanitize_text_field( $_POST['billing_ogrn'] ) );
	}

	// сохраняем наименование банка компании
	if ( isset( $_POST[ 'billing_bank_name' ] ) ) {
		update_user_meta( $user_id, 'bank_name', sanitize_text_field( $_POST['billing_bank_name'] ) );
		update_user_meta( $user_id, 'billing_bank_name', sanitize_text_field( $_POST['billing_bank_name'] ) );
	}

	// сохраняем расчетный счет компании
	if ( isset( $_POST[ 'billing_account_number' ] ) ) {
		update_user_meta( $user_id, 'account_number', sanitize_text_field( $_POST['billing_account_number'] ) );
		update_user_meta( $user_id, 'billing_account_number', sanitize_text_field( $_POST['billing_account_number'] ) );
	}

	// сохраняем БИК компании
	if ( isset( $_POST[ 'billing_bik' ] ) ) {
		update_user_meta( $user_id, 'bik', sanitize_text_field( $_POST['billing_bik'] ) );
		update_user_meta( $user_id, 'billing_bik', sanitize_text_field( $_POST['billing_bik'] ) );
	}

	// сохраняем юридический адрес компании
	if ( isset( $_POST[ 'billing_company_address' ] ) ) {
		update_user_meta( $user_id, 'company_address', sanitize_text_field( $_POST['billing_company_address'] ) );
		update_user_meta( $user_id, 'billing_company_address', sanitize_text_field( $_POST['billing_company_address'] ) );
	}

}

add_action('woocommerce_save_account_details', 'pastrychef_save_fields');

//

//Redirect after user registration and login
function pastrychef_woocommerce_registration_redirect( $redirect ) {
    $redirect = site_url('spasibo-registracziya');
	return $redirect;
}

function pastrychef_woocommerce_login_redirect( $redirect ) {
    return wc_get_page_permalink( '/');
}

add_filter( 'woocommerce_registration_redirect', 'pastrychef_woocommerce_registration_redirect', 10, 1 );
add_filter( 'woocommerce_login_redirect', 'pastrychef_woocommerce_login_redirect', 10, 1 );









?>