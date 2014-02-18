<?php 
/*
Plugin Name: WC Adwords Conversion Tracking
Description: Add the Adwords tracking code to the Woocommerce Thank You page
Plugin URI: http://victorfalcon.es/wc-adwords-conversion-tracking
Author: Víctor Falcón
Author URI: http://victorfalcon.es
Version: 1.0
License: GPL2
Text Domain: wact
Domain Path: wact
*/

/*

    Copyright (C) Year  Author  Email

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Add the integration to WooCommerce
function wc_adwords_conversion_tracking( $integrations ) {
  global $woocommerce;

  if ( is_object( $woocommerce ) && version_compare( $woocommerce->version, '2.1', '>=' ) ) {
    include_once( 'includes/wc-adwords-conversion-tracking-code.php' );
    $integrations[] = 'WC_Adwords_Conversion_Tracking';
  }

  return $integrations;
}

add_filter( 'woocommerce_integrations', 'wc_adwords_conversion_tracking', 10 );



