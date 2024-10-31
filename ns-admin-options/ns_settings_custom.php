<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

	?>
	<h2><?php _e('NS WooCommerce Catalog settings', 'ns-woocommerce-catalog'); ?></h2>
	

		<div class="ns-div-container-settings">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th class="titledesc" scope="row">
							<label for="wcf_enabled_plugin"><?php _e('Enabled Plugin', 'ns-woocommerce-catalog'); ?></label>
							<div class="ns-tooltip">?<span class="ns-tooltiptext"><?php _e('Unselect to disabled plugin', 'ns-woocommerce-catalog'); ?></span></div>
						</th>
						<td class="forminp">
							<?php $checked = (get_option('wcf_enabled_plugin') AND get_option('wcf_enabled_plugin') == 'on') ? ' checked="checked"' : ''; ?>
							<input type="checkbox" name="wcf_enabled_plugin" id="wcf_enabled_plugin" <?php echo $checked; ?>>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top">
						<th class="titledesc" scope="row">
							<label for="wcf_hide_cart_button_single_product"><?php _e('Hide cart in product detail page', 'ns-woocommerce-catalog'); ?></label>
							<div class="ns-tooltip">?<span class="ns-tooltiptext"><?php _e('Hide "Add to Cart" button in product detail page', 'ns-woocommerce-catalog'); ?></span></div>
						</th>
						<td class="forminp">
							<?php $checked = (get_option('wcf_hide_cart_button_single_product') AND get_option('wcf_hide_cart_button_single_product') == 'on') ? ' checked="checked"' : ''; ?>
							<input type="checkbox" name="wcf_hide_cart_button_single_product" id="wcf_hide_cart_button_single_product" <?php echo $checked; ?>>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top">
						<th class="titledesc" scope="row">
							<label for="wcf_hide_cart_button_all_product"><?php _e('Hide cart in other page', 'ns-woocommerce-catalog'); ?></label>
							<div class="ns-tooltip">?<span class="ns-tooltiptext"><?php _e('Hide "Add to Cart" button in the other pages of the site', 'ns-woocommerce-catalog'); ?></span></div>
						</th>
						<td class="forminp">
							<?php $checked = (get_option('wcf_hide_cart_button_all_product') AND get_option('wcf_hide_cart_button_all_product') == 'on') ? ' checked="checked"' : ''; ?>
							<input type="checkbox" name="wcf_hide_cart_button_all_product" id="wcf_hide_cart_button_all_product" <?php echo $checked; ?>>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top">
						<th class="titledesc" scope="row">
							<label for="wcf_hide_cart_checkout_page"><?php _e('Hide cart and checkout page', 'ns-woocommerce-catalog'); ?></label>
							<div class="ns-tooltip">?<span class="ns-tooltiptext"><?php _e('If select the cart and checkout page redirect to home', 'ns-woocommerce-catalog'); ?></span></div>
						</th>
						<td class="forminp">
							<?php $checked = (get_option('wcf_hide_cart_checkout_page') AND get_option('wcf_hide_cart_checkout_page') == 'on') ? ' checked="checked"' : ''; ?>
							<input type="checkbox" name="wcf_hide_cart_checkout_page" id="wcf_hide_cart_checkout_page" <?php echo $checked; ?>>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top">
						<th class="titledesc" scope="row">
							<label for="wcf_show_more_info_button"><?php _e('Show "more info" button', 'ns-woocommerce-catalog'); ?></label>
							<div class="ns-tooltip">?<span class="ns-tooltiptext"><?php _e('If select instead of "add to cart" button will appear "More Info" button', 'ns-woocommerce-catalog'); ?></span></div>
						</th>
						<td class="forminp">
							<?php $checked = (get_option('wcf_show_more_info_button') AND get_option('wcf_show_more_info_button') == 'on') ? ' checked="checked"' : ''; ?>
							<input type="checkbox" name="wcf_show_more_info_button" id="wcf_show_more_info_button" <?php echo $checked; ?>>
							<span class="description"></span>
						</td>
					</tr>

					<tr valign="top">
						<th class="titledesc" scope="row"></th>
						<td class="forminp">
							<?php
							if(class_exists( 'WooCommerce' )){
							?>			
								<p><input type="submit" class="button-primary ns-rac-submit-button" id="submit" name="submit" value="<?php _e('Save Changes') ?>" /></p>			
							<?php
							}
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
<?php settings_fields('woocommerce_catalog_free_options'); ?>
