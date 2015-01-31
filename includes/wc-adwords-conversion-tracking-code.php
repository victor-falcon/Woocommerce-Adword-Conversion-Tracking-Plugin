<?php

/**
 * Google Analytics Integration
 *
 * Allows tracking code to be inserted into store pages.
 *
 * @class     WC_Google_Analytics
 * @extends   WC_Integration
 */
class WC_Adwords_Conversion_Tracking extends WC_Integration {

  /**
   * Init and hook in the integration.
   *
   * @access public
   * @return void
   */
  public function __construct() {
    $this->id         = 'google_adwords_conversion';
    $this->method_title       = __( 'Google Adwords Conversion', 'wact' );
    $this->method_description = __( 'Add the Google Adwords Conversion Tracking Code to the Thank You page.', 'wact' );

    // Load the settings.
    $this->init_form_fields();
    $this->init_settings();

    // Define user set variables
    $this->conversion_label = $this->get_option( 'conversion_label' );
    $this->conversion_id    = $this->get_option( 'conversion_id' );

    // Actions
    add_action( 'woocommerce_update_options_integration_google_adwords_conversion', array( $this, 'process_admin_options') );

    // Tracking code
    add_action( 'woocommerce_thankyou', array( $this, 'adwords_tracking_code' ) );

  }


    /**
     * Initialise Settings Form Fields
     *
     * @access public
     * @return void
     */
    function init_form_fields() {

      $this->form_fields = array(
        'conversion_label' => array(
          'title'       => __( 'Conversion Label', 'wact' ),
          'description'     => __( 'Ad the label of the conversion code you want to track. Example: "a7trSDB3dGoQq8OD0AM"', 'wact' ),
          'type'        => 'text',
            'default'       => ''
        ),
        'conversion_id' => array(
          'title'       => __( 'Conversion Id', 'wact' ),
          'description'     => __( 'Example: 987654321', 'wact' ),
          'type'        => 'text',
          'default'       => ''
        )
      );

    } // End init_form_fields()


  /**
   * Google Adwords Conversion Tracking Code
   *
   * @access public
   * @param mixed $order_id
   * @return void
   */
  function adwords_tracking_code( $order_id ) {
    global $woocommerce;

    if ($this->conversion_id && $this->conversion_label) {
      // Lets grab the order total amount
      $order = new WC_Order( $order_id );
       
      ?>
      <div style="display:none">
      <!-- Google Code for Pedido realizado Conversion Page -->
      <script type="text/javascript">
      /* <![CDATA[ */
      var google_conversion_id = <?=$this->conversion_id?>;
      var google_conversion_language = "es";
      var google_conversion_format = "3";
      var google_conversion_color = "ffffff";
      var google_conversion_label = "<?=$this->conversion_label?>";
      var google_conversion_value = <?=$order->get_total()?>;
      var google_remarketing_only = false;
      /* ]]> */
      </script>
      <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
      </script>
      <noscript>
      <div style="display:inline;">
      <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/<?=$this->conversion_id?>/?value=<?=$order->get_total()?>&amp;label=<?=$this->conversion_label?>&amp;guid=ON&amp;script=0"/>
      </div>
      </noscript>
      </div>
      <?php
    } // if
  }
}
