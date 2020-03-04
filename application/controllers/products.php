<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/wc-api-php-master/vendor/autoload.php';
use Automattic\WooCommerce\Client;

class Products extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        
    }
    public function myProducts()
    {
        echo "Hello";
    }
    public function productRequest()
    {
        $vendor=$this->session->userdata('vendor');
        if(empty($vendor))
            redirect('vendors/login');
        $woocommerce = new Client(
            WOO_URL, 
            WOO_CONSUMER, 
            WOO_SECRET,
            [
                'version' => 'wc/v3',
            ]
        );
        $products=$woocommerce->get('products');
        
        $template_data=array(
            'main_content'=>'products/productRequest',
            'products'=>$products,
        );
        $this->load->view('templates/vendor/index',$template_data);
    }
    public function selectProduct($id){
        $vendor=$this->session->userdata('vendor');
        if(empty($vendor))
            redirect('vendors/login');
        if(empty($id))
            redirect('products/productRequest');
        
        //get the product information here
        $woocommerce = new Client(
            WOO_URL, 
            WOO_CONSUMER, 
            WOO_SECRET,
            [
                'version' => 'wc/v3',
            ]
        );
        $product=$woocommerce->get('products/'.$id);
        echo "<pre>";
        print_r($product);
        die;

    }
}