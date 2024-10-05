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
		$usuario = $this->input->post('usuario');
        $clave = $this->input->post('clave');

        // Verificar si los datos son correctos
        $resultado = $this->loginModel->verificar_usuario($usuario, $clave);

        if ($resultado) {
            // Si el usuario es correcto, redirecciona a la página principal
            redirect('inicio');
        } else {
            // Si falla, redirige al login con un mensaje de error
            $this->session->set_flashdata('error', 'Usuario o contraseña incorrectos.');
            redirect('login');
        }
	}
}