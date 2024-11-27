<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class MyController extends Controller
{
    protected $session;
    protected $userData;

    /**
     * Inicialización común para todos los controladores hijos.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Llama al constructor del padre
        parent::initController($request, $response, $logger);

        // Inicia la sesión
        $this->session = \Config\Services::session();

        // Cargar los datos del usuario desde la sesión
        $this->userData = [
            'id_usuario' => $this->session->get('id_usuario'),
            'nombre_usuario' => $this->session->get('nombre_usuario'),
            'logged_in' => $this->session->get('logged_in'),
        ];

        // Depuración: Verificar los datos de sesión
        log_message('debug', 'Datos de sesión: ' . print_r($this->userData, true));

        // Validar la sesión solo si el controlador no es el de login
        $this->validateSession();
    }

    /**
     * Verifica si el usuario está autenticado.
     * Si no está autenticado, redirige al login.
     */
    protected function validateSession()
    {
        $currentController = service('router')->controllerName(); // Obtiene el nombre del controlador actual

        // Depuración: Verificar el controlador actual
        log_message('debug', 'Controlador actual: ' . $currentController);

        // Si el controlador actual es Login, no validamos la sesión (para permitir el acceso al login)
        if ($currentController === 'App\Controllers\Login') {
            log_message('debug', 'Accediendo al controlador Login, validación omitida.');
            return;
        }

        // Si el usuario no está autenticado, redirige al login
        if (empty($this->userData['logged_in'])) {
            log_message('debug', 'Usuario no logueado. Redirigiendo al login.');
            return redirect()->to(base_url('login'))->send();
            exit; // Detiene la ejecución del código posterior
        }

        log_message('debug', 'Usuario autenticado.');
    }
}
