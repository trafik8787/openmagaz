<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 24.12.2015
 * Time: 1:07
 */

class ControllerModuleHelloworld extends Controller {


    public function index(){
        $data['code'] = 'sdfsdfsdfsdfsdfsdfsdf';
        return $this->load->view( $this->config->get('config_template').'/template/module/helloworld_t.tpl', $data);
    }
}