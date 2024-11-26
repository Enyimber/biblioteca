<?php

namespace App\Controllers;

class MyController extends BaseController
{
    protected $userData;

    public function __construct()
    {
        parent::__construct();

        // Iniciar sesión
        $this->session = \Config\Services::session();

        // Cargar datos del usuario desde la sesión
        $this->userData = [
            'id_usuario' => $this->session->get('id_usuario'),
            'nombre_usuario' => $this->session->get('nombre_usuario'),
            'id_rol' => $this->session->get('id_rol'),
            'logged_in' => $this->session->get('logged_in'),
        ];

        // Verificar si el usuario está autenticado
        $this->checkAuthentication();
    }

    /**
     * Verifica si el usuario está autenticado.
     * Redirige al login si no está autenticado.
     */
    protected function checkAuthentication()
    {
        $currentClass = $this->router->controllerName();

        if (!$this->userData['logged_in'] && $currentClass !== 'Login') {
            return redirect()->to(base_url('login'))->send();
        }
    }

    /**
     * Verifica si el usuario tiene el rol requerido.
     * @param int $role_id
     */
    protected function requireRole(int $role_id)
    {
        if ($this->userData['id_rol'] != $role_id) {
            throw new \CodeIgniter\Exceptions\PageForbiddenException('No tienes permisos para acceder a esta página.');
        }
    }
}
