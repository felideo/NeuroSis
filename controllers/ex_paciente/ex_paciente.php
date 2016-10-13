<?php
namespace Controllers;

use Libs;

class Ex_Paciente extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'ex_paciente',
		'name'		=> 'Ex Pacientes',
		'send'		=> 'Ex paciente'
	];

	function __construct() {

		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();

		$this->view->modulo = $this->modulo;
	}

	public function index() {

		$this->view->listagem_ex_pacientes = $this->load_external_model('paciente')->load_pacientes_list(2);
		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function editar($id) {
		$this->view->cadastro = $this->load_external_model('paciente')->load_paciente($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');

	}

	public function create() {
		$insert_db = carregar_variavel($this->modulo['modulo']);
		$retorno = $this->model->create('modulo', $insert_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'modulo');
	}

	public function update($id) {
		$update_db = carregar_variavel('modulo');
		$retorno = $this->model->update('modulo', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'modulo');
	}

	public function delete($id) {
		$retorno = $this->model->delete('modulo', $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'modulo');
	}
}