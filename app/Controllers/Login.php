<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
    protected $session;
    protected $userData;
    protected $loginModel;

    public function __construct()
    {
        // Cargar servicios y modelos
        $this->session = \Config\Services::session();
        $this->loginModel = new LoginModel();

        // Cargar datos del usuario desde la sesión
        $this->userData = [
            'id_usuario' => $this->session->get('id_usuario'),
            'nombre_usuario' => $this->session->get('nombre_usuario'),
            'id_rol' => $this->session->get('id_rol'),
        ];
    }

    public function index()
    {
        // Verificar si el usuario ya está autenticado
        if ($this->session->get('logged_in')) {
            return redirect()->to(base_url('home'));
        }

        // Cargar la vista de login
        return view('loginVista');
    }

    public function consultarUsuario()
    {
        $response = ['status' => false, 'title' => 'Error', 'icono' => 'error', 'mensaje' => null];
    
        try {
            // Cargar el servicio de validación
            $validation = \Config\Services::validation();
    
            // Definir las reglas de validación
            $validation->setRules([
                'usuario' => [
                    'label' => 'Usuario',
                    'rules' => 'required|alpha_numeric',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'alpha_numeric' => 'El campo {field} solo debe contener letras y números.',
                    ],
                ],
                'clave' => [
                    'label' => 'Clave',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                    ],
                ],
            ]);
    
            // Realizar la validación de los datos del formulario
            if (!$this->validate($validation->getRules())) {
                // Si la validación falla, pasar los errores de validación a la vista
                return view('LoginVista', [
                    'validation' => $this->validator
                ]);
            }
    
            // Obtener los datos del formulario
            $usuario = $this->request->getPost('usuario');
            $clave = $this->request->getPost('clave');
    
            // Llamar al modelo para validar el usuario
            $usuarioValidado = $this->loginModel->validarUsuario($usuario, $clave);
    
            if ($usuarioValidado) {
                // Si el usuario es válido, guardar los datos en la sesión
                $this->session->set([
                    'id_usuario' => $usuarioValidado['id_usuario'],
                    'nombre_usuario' => $usuarioValidado['nombre_usuario'],
                    'id_rol' => $usuarioValidado['id_rol'],
                    'logged_in' => true,
                ]);
    
                // Redirigir al Home después de una autenticación exitosa
                return redirect()->to(base_url('home')); // Redirigir al Home
            } else {
                throw new \Exception('Usuario o contraseña incorrectos.');
            }
        } catch (\Exception $e) {
            // Si hay un error, mostrar el mensaje
            $response['mensaje'] = $e->getMessage();
            return redirect()->back()->with('error', $e->getMessage());  // Enviar el error a la vista
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}

