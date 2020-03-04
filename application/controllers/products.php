<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/wc-api-php-master/vendor/autoload.php';
use Automattic\WooCommerce\Client;

class Products extends CI_Controller {
    public function __construct(){
        parent::__construct();
        
    }
    public function myProducts(){
        echo "Hello";
    }
    public function productRequest(){
        echo "Hi";
        /*
         $woocommerce = new Client(
            'http://localhost/clients/theyardco/code/wp', 
            WOO_CONSUMER, 
            WOO_SECRET,
            [
                'version' => 'wc/v3',
            ]
        );
        $products=$woocommerce->get('products');
        echo "<pre>";
        print_r($products);
        die;
        */

    }
}