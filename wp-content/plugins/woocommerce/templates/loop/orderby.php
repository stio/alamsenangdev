<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
?>
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby">
		<?php 
		
		if ($uri_segments[1] !== 'id'){?>

		<?php foreach ( $catalog_orderby_options as $id => $name ) { ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php } ?>
		<?php } else { ?>
			<option value="popularity">Urut berdasarkan popularitas</option>
			<option value="rating">Urut berdasarkan nilai rata-rata</option>
			<option value="date">Urut berdasarkan kebaruan</option>
			<option value="price">Urut berdasarkan harga: rendah ke tinggi</option>
			<option value="price-desc">Urut berdasarkan harga: tinggi ke rendah</option>
		<?php } ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
