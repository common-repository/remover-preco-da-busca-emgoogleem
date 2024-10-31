<?php
/*
/**
 * Plugin Name: Remover Preço da busca Google
 * Plugin URI: https://www.comparandopreco.com/
 * Description: Com este plugin remove o preço da busca Google para sites de comparação de Preços.
 * Version: 1.1
 * Author: André Carvalho
 * Author URI: https://www.comparandopreco.com/
 
 */
function cl_product_delete_meta_price( $product = null ) {
	if ( ! is_object( $product ) ) {
		global $product;
	}
	if ( ! is_a( $product, 'WC_Product' ) ) {
		return;
	}
	if ( '' !== $product->get_price() ) {
		$shop_name = get_bloginfo( 'name' );
		$shop_url  = home_url();
		$markup_offer = array(
			'@type'         => 'Offer',
			'availability'  => 'https://schema.org/' . $stock = ( $product->is_in_stock() ? 'InStock' : 'OutOfStock' ),
			'sku'           => $product->get_sku(),
			'image'         => wp_get_attachment_url( $product->get_image_id() ),
			'description'   => $product->get_description(),
			'seller'        => array(
				'@type' => 'Organization',
				'name'  => $shop_name,
				'url'   => $shop_url,
			),
		);
	}
	return $markup_offer;
}
add_filter( 'woocommerce_structured_data_product_offer', 'cl_product_delete_meta_price' );