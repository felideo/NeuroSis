<?php
namespace Controllers;

use Libs;

class Index extends \Libs\Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {

		$this->view->listagem_colaboradores = $this->model->load_active_list('colaborador');
		$this->view->clean_render('index');
	}
}