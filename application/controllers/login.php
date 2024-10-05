<?php

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('loginModel');
    }

	public function index(){
		$this->load->view('loginVista');
	}
	
	public function validarUsuario(){

	}
}