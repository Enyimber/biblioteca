<?php

class Login extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            header('location:' . base_url('home'));
            exit;
        }
        $this->load->view('loginVista');
    }

    public function consultarUsuario()
    {
        $json = array('status' => false, 'title' => 'error', 'icono' => 'error', 'mensaje' => null);
        try {

            $this->form_validation->set_rules('usuario', 'usuario', 'required|alpha_numeric', array(
                'required' => 'El campo %s es obligatorio.',
                'alpha_numeric' => 'El campo %s debe ser un alfanumerico.'
            ));
            $this->form_validation->set_rules('clave', 'clave', 'required', array(
                'required' => 'El campo %s es obligatorio.'
            ));

            if (! $this->form_validation->run()) {
                $error = $this->form_validation->error_array();
                $mensaje = '<ol>';
                foreach ($error as $key => $value) {
                    $mensaje .= '<li>' . $value . '</li>';
                }
                $mensaje .= '</ol>';
                throw new Exception($mensaje);
            } else {

                $usuario = $this->input->post('usuario');
                $clave = $this->input->post('clave');

                $usuarioValidado = $this->LoginModel->validarUsuario($usuario, $clave);

                if ($usuarioValidado) {
                    // Establecer datos de sesión al iniciar sesión
                    $this->session->set_userdata('usuario', $usuarioValidado->usuario_login);
                    $this->session->set_userdata('logged_in', TRUE);
                    $this->session->set_userdata('rol',  $usuarioValidado->id_rol);
                    // El usuario existe, proceder con el login (puedes iniciar una sesión, etc.)
                    $json['mensaje'] = "¡Login exitoso! Usuario: " . $usuarioValidado->usuario_login;
                    $json['title'] = 'exito';
                    $json['icono'] = 'success';
                    $json['status'] = true;
                    // Redireccionar o cargar otra vista según sea necesario
                } else {
                    // Si el usuario no existe o la contraseña es incorrecta, mostrar un mensaje de error
                    $json['mensaje'] = "Usuario o contraseña incorrectos.";
                }
            }
        } catch (\Throwable $th) {
            $json['mensaje'] = $th->getMessage();
        }
        echo json_encode($json);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
