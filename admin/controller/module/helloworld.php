<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 24.12.2015
 * Time: 1:04
 */

class ControllerModuleHelloworld extends ControllerAdminCore{

    private $error = array();


////    public function install() {
//
//        $this->load->model('extension/event');
//        $this->model_extension_event->addEvent('helloworld', 'pre.admin.product.edit', 'module/helloworld/on_product_die');
//
//    }

    public function on_product_die($data){
        //$data['product_description'][2]['meta_title'] = 'hhhhhhhhhhh';
        //$data['product_description'][1]['meta_title'] = 'jjjjjjjjjjjjj';
        //dd($data['product_description'][2]['meta_title'], true);
        //return $data;

    }


    public function ShowEdit ($data)
    {

        $this->data['name'] = $data['name'];
        $this->data['deskription'] = $data['deskription'];
        $this->data['status'] = $data['status'];

        $this->data['text_edit'] = $this->language->get('text_edit');
        $this->data['heading_title'] = $this->language->get('entry_code');
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

    }


    public function index() {
        //вид для модуля
        $this->views = 'helloworld_t.tpl';
        //включаем код класса
        parent::IndexImplement($this);

        //текст в списке модулей
        $this->document->setTitle($this->language->get('heading_title'));

        //
        if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {

            if (!isset($this->request->get['module_id'])) {
                $this->model_extension_module->addModule('helloworld', $this->request->post);
            } else {
                $this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
            }

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }


        //подклчаем крошки
        $this->breadcrumbs();

    }

    protected function validate() {

        if (!$this->user->hasPermission('modify', 'module/helloworld')) {
            $this->error['warning'] = 'Ошибка warning';
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = 'Ошибка name';
        }

        return !$this->error;
    }
}