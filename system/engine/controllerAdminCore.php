<?php
abstract class ControllerAdminCore  extends Controller {

	public $moduleName;
	private $debug;
	protected $data;
	public $views = null;


	public function __destruct()
	{
		$this->data['header'] = $this->load->controller('common/header');
		$this->data['column_left'] = $this->load->controller('common/column_left');
		$this->data['footer'] = $this->load->controller('common/footer');

		$views = $this->moduleName;
		if ($this->views != null) {
			$views = $this->views;
		}

		$this->response->setOutput($this->load->view('module/'.$views, $this->data));
	}


	public function IndexImplement($obj)
	{
		$this->debug = debug_backtrace(2);
		$this->moduleName = basename($this->debug[0]['file'], ".php");
		//подключаем язык
		$this->load->language('module/'.$this->moduleName);
		//подключаем модель для получения настроек модуля
		$this->load->model('extension/module');

		//открыть и загрузить данные на страницу редактирования
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);

			call_user_func_array(array($obj ,'ShowEdit'), array($module_info, $this));

		}


		if (!isset($this->request->get['module_id'])) {
			$this->data['action'] = $this->url->link('module/helloworld', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('module/helloworld', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');


	}


	public function breadcrumbs()
	{

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$this->data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_module'),
				'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$this->data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/'.$this->moduleName, 'token=' . $this->session->data['token'], 'SSL')
		);
	}
	
	
}