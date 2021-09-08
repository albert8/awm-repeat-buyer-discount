<?php
class AWM_WC_Settings_Tab {
    /*
     * Bootstraps the class and hooks required actions & filters.
     *
     */
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_settings_tab_demo', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_settings_tab_demo', __CLASS__ . '::update_settings' );
    }
    
    
    /*
	 * Add a new settings tab to the WooCommerce settings tabs array.
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
     * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
     */
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_tab_demo'] = __( 'Repeat Buyer Discount', 'awm-woorepeatbuyer-settings-tab' );
        return $settings_tabs;
    }


    /*
     * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    public static function settings_tab() {
        woocommerce_admin_fields( self::get_settings() );
    }


    /*
     * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    public static function update_settings() {
        woocommerce_update_options( self::get_settings() );
    }


    /*
     * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
     *
     * @return array Array of settings for @see woocommerce_admin_fields() function.
     */
    public static function get_settings() {
        $settings = array(
            'section_title' => array(
                'name'     => __( 'Settings', 'awm-woorepeatbuyer-settings-tab' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc_settings_tab_demo_section_title'
            ),
            'discount_label' => array(
                'name' => __( 'Discount type', 'awm-woorepeatbuyer-settings-tab' ),
                'type' => 'text',
                'desc' => __( 'This is the label of the discount displayed on the cart.', 'awm-woorepeatbuyer-settings-tab' ),
                'id'   => 'awmrb_discountlabel',
            ),
            'discount_type' => array(
                'name' => __( 'Discount type', 'awm-woorepeatbuyer-settings-tab' ),
                'type' => 'select',
                'desc' => __( 'This determines the type of discount to apply on customer\'s order', 'awm-woorepeatbuyer-settings-tab' ),
                'id'   => 'awmrb_discounttype',
                'options' => array('flatrate'=>'Flat Rate','percentage'=>'Percentage')
                
            ),
            'discount_percentage' => array(
                'name' => __( 'Discount in percent', 'awm-woorepeatbuyer-settings-tab' ),
                'type' => 'text',
                'desc' => __( 'This is the percentage discount to apply to users\' order', 'awm-woorepeatbuyer-settings-tab' ),
                'id'   => 'awmrb_discountpercentage',
                
            ),
            'discount_flatrate' => array(
                'name' => __( 'Discount in flat rate', 'awm-woorepeatbuyer-settings-tab' ),
                'type' => 'text',
                'desc' => __( 'This is the amount of discount in flat rate', 'awm-woorepeatbuyer-settings-tab' ),
                'id'   => 'awmrb_discountflatrate'
            ),
            'minimum_orders' => array(
                'name' => __( 'Minimum Orders', 'awm-woorepeatbuyer-settings-tab' ),
                'type' => 'text',
                'desc' => __( 'This is the no. of orders before the discount is applied to order of the user.', 'awm-woorepeatbuyer-settings-tab' ),
                'id'   => 'awmrb_minorders'
            ),
            'section_end' => array(
                'type' => 'sectionend',
                'id' => 'awmrb_section_end'
           )
        );
        
        return apply_filters( 'wc_settings_tab_demo_settings', $settings );
    }

}

AWM_WC_Settings_Tab::init();