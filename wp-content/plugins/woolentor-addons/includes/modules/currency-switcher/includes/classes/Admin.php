<?php
namespace Woolentor\Modules\CurrencySwitcher;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Admin handlers class
 */
class Admin {

    /**
     * [$_instance]
     * @var null
     */
    private static $_instance = null;

    /**
     * [instance] Initializes a singleton instance
     * @return [Admin]
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Initialize the class
     */
    private function __construct() {
        $this->includes();
        $this->init();
    }

    /**
     * Load Required files
     *
     * @return void
     */
    private function includes(){
        require_once( __DIR__. '/Admin/Fields.php' );
        require_once( __DIR__. '/Admin/Actions.php' );
    }

    /**
     * Initialize
     *
     * @return void
     */
    public function init(){
        Admin\Fields::instance();
        if( ENABLED ){
            Admin\Actions::instance();
        }
    }

    /**
     * Get Currency Rate
     * @param [type] $args
     */
    public function get_exchange_rate( $args ){
        $base_code = $args['depend_value'];
        $response = wp_remote_get('https://open.er-api.com/v6/latest/'.$base_code, 
            array(
                'sslverify' => false,
                'timeout'   => 45
            )
        );

        if ( !is_wp_error( $response ) ) {
            $rates = $response['body'];
            if( !empty( $rates ) ){
                $rates = json_decode( $rates );
                return ( isset( $rates->rates ) ) ? $rates->rates : 1;
            }
        }

        return 0;
    }

}