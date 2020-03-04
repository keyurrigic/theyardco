<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_vendor extends Mdl_base {

    public function __construct(){
        parent::__construct();
        $this->table="vendors";
    }
}