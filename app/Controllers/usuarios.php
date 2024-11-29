<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\RolModel;
use Config\Services;

class Usuarios extends MyController
{
    protected $usuarioModel;
    protected $rolModel;

    public function __construct()
    {
        // Instanciamos los modelos
        $this->usuarioModel = new UsuarioModel();
        $this->rolModel = new RolModel();
        helper(['url', 'form']);
        $this->validation = Services::validation();
    }

    // Listar usuarios
    public function index()
    {
        // Obtener todos los usuarios
        $data['usuarios'] = $this->usuarioModel->obtenerUsuarios();

        // Obtener todos los roles
        $data['roles'] = $this->rolModel->findAll();

        // Mostrar vista con los datos de los usuarios y roles
        echo view('header');
        echo view('usuarios', $data);

        // Mostrar alertas (si existen)
        $successMessage = session()->getFlashdata('success');
        $errorMessage = session()->getFlashdata('error');

        if ($successMessage) {
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "¡Éxito!",
                    text: "' . $successMessage . '"
                });
            </script>';
        }

        if ($errorMessage) {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "' . $errorMessage . '"
                });
            </script>';
        }
    }

    // Crear usuario
    public function crear()
    {
        // Definir reglas de validación
        $this->validation->setRules([
            'nombre' => 'required',
            'usuario' => 'required',
            'clave' => 'required',
            'rol' => 'required'
        ]);
        $datos = [
            'nombre' => $this->request->getPost('nombre'),
            'usuario' => $this->request->getPost('usuario'),
            'clave' => $this->request->getPost('clave'),
            'rol' => $this->request->getPost('rol'),
        ];

        // Validar datos del formulario
        if (!$this->validation->run($datos)) {
            // Si la validación falla, redirigir con un mensaje de error
            session()->setFlashdata('error', 'Por favor completa todos los campos.');
            return redirect()->to(base_url('usuarios'));
        }

        // Datos del formulario
        $data = [
            'nombre_usuario' => $this->request->getPost('nombre'),
            'usuario_login' => $this->request->getPost('usuario'),
            'clave' => $this->request->getPost('clave'),
            'id_rol' => $this->request->getPost('rol'),
        ];

        // Verificar si el usuario ya existe
        if ($this->usuarioModel->existeUsuario($data['usuario_login'])) {
            // Si el usuario ya existe, redirigir con mensaje de error
            session()->setFlashdata('error', 'El nombre de usuario ya está en uso. Por favor elige otro.');
            return redirect()->to(base_url('usuarios'));
        }

        // Crear el usuario
        $this->usuarioModel->crearUsuario($data);
        session()->setFlashdata('success', 'Usuario creado exitosamente.');
        return redirect()->to(base_url('usuarios'));
    }

    // Editar usuario
    public function editar()
    {
        // Obtener datos del formulario
        $id_usuario = $this->request->getPost('id_usuario');
        $clave = $this->request->getPost('clave');
        $rol = $this->request->getPost('rol');

        if ($id_usuario && $clave && $rol) {
            // Datos a actualizar
            $data = [
                'clave' => $clave,
                'id_rol' => $rol,
            ];

            // Actualizar usuario en la base de datos
            $this->usuarioModel->actualizarUsuario($id_usuario, $data);
            session()->setFlashdata('success', 'Usuario actualizado correctamente.');
        } else {
            session()->setFlashdata('error', 'Error al actualizar el usuario.');
        }

        return redirect()->to('usuarios'); // Redirigir a la lista de usuarios
    }

    // Eliminar usuario
    public function eliminar()
    {
        $id = $this->request->getPost('id_usuario');
        // Intentar eliminar el usuario
        $deleteStatus = $this->usuarioModel->eliminarUsuario($id);

        if ($deleteStatus) {
            // Si la eliminación es exitosa
            session()->setFlashdata('success', 'Usuario eliminado correctamente.');
        } else {
            // Si ocurre un error al eliminar
            session()->setFlashdata('error', 'Hubo un problema al eliminar el usuario.');
        }

        return redirect()->to('usuarios');
    }
}
