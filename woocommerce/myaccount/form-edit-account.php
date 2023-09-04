<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<div class="info-private__wrapper">
		<div class="info-private__column">

			<label class="info-private__label">
				<span class="info-private__name">Имя пользователя:<span class="required">*</span></span>                            
				<input class="info-private__input" autocomplete="account_display_name" type="text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>">
			</label>

			<label class="info-private__label">
				<span class="info-private__name">Фамилия:<span class="required">*</span></span>                            
				<input class="info-private__input" autocomplete="billing_last_name" type="text" name="billing_last_name" id="reg_billing_last_name" value="<?php echo esc_attr( $user->billing_last_name ); ?>">
			</label>

			<label class="info-private__label">
				<span class="info-private__name">Имя:<span class="required">*</span></span>                            
				<input class="info-private__input" autocomplete="billing_first_name" type="text" name="billing_first_name" id="reg_billing_first_name" value="<?php echo esc_attr( $user->billing_first_name ); ?>">
			</label>

			<label class="info-private__label">
				<span class="info-private__name">Номер телефона:<span class="required">*</span></span>                            
				<input class="info-private__input" autocomplete="billing_phone" type="tel" name="billing_phone" id="reg_billing_phone" value="<?php echo esc_attr( $user->billing_phone ); ?>">
			</label>

			<label class="info-private__label">
				<span class="info-private__name">E-mail:<span class="required">*</span></span>                            
				<input class="info-private__input" autocomplete="email" type="email" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>">
			</label>  

			<label class="info-private__label">
				<span class="info-private__name">Полное наименование компании:</span>
				<input class="info-private__input" autocomplete="billing_company_name" type="text" name="billing_company_name" id="billing_company_name" value="<?php echo esc_attr( $user->billing_company_name ); ?>">
			</label>

		</div>
		<div class="info-private__column">

			<label class="info-private__label">
				<span class="info-private__name">ИНН:</span>                            
				<input class="info-private__input" autocomplete="billing_inn" type="text" name="billing_inn" id="billing_inn" value="<?php echo esc_attr( $user->billing_inn ); ?>">
			</label>

			<label class="info-private__label">
				<span class="info-private__name">ОГРН:</span>                            
				<input class="info-private__input" autocomplete="billing_ogrn" type="text" name="billing_ogrn" id="billing_ogrn" value="<?php echo esc_attr( $user->billing_ogrn ); ?>">
			</label>

			<label class="info-private__label">
				<span class="info-private__name">Полное наименование банка:</span>
				<input class="info-private__input" autocomplete="billing_bank_name" type="text" name="billing_bank_name" id="billing_bank_name" value="<?php echo esc_attr( $user->billing_bank_name ); ?>">
			</label>

			<label class="info-private__label">
				<span class="info-private__name">Расчетный счет:</span>                            
				<input class="info-private__input" autocomplete="billing_account_number" type="text" name="billing_account_number" id="billing_account_number" value="<?php echo esc_attr( $user->billing_account_number ); ?>">
			</label>

			<label class="info-private__label">
				<span class="info-private__name">БИК:</span>                            
				<input class="info-private__input" autocomplete="billing_bik" type="text" name="billing_bik" id="billing_bik" value="<?php echo esc_attr( $user->billing_bik ); ?>">
			</label> 

			<label class="info-private__label">
				<span class="info-private__name">Адрес юридический:</span>                            
				<input class="info-private__input" autocomplete="billing_company_address" type="text" name="billing_company_address" id="billing_company_address" value="<?php echo esc_attr( $user->billing_company_address ); ?>">
			</label>

		</div>
	</div>

	<div class="info-private__add">
		<p class="info-private__text">
			<span>*</span> Поля обязательные для заполнения
		</p>                        
	</div>    

	<div class="info-private__hidden-block">
		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
			<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
			<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</p>
		<div class="clear"></div>
	</div>
	

	<fieldset class="info-private__change-password change-password-private">
		<legend class="change-password-private__title"><?php esc_html_e( 'Password change', 'woocommerce' ); ?></legend>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_current" class="change-password-private__label"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="change-password-private__input woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
		</p>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_1" class="change-password-private__label"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="change-password-private__input woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
		</p>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="password_2" class="change-password-private__label"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
			<input type="password" class="change-password-private__input woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
		</p>

	</fieldset>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="info-private__save-btn btn <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
