<?php

class Login extends CI_Controller {

	public function index(){
		$this->load->view('loginVista');
	}
	
	public function consultarUsuario(){
    $usuario = $_POST('usuario');
    echo $usuario;
	}
}