<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.01.2016
 * Time: 1:02
 */

class ControllerProductAjax extends Controller {


    public function index ()
    {
        echo $this->load->view($this->config->get('config_template') . '/template/module/filter_price.tpl');
    }
}