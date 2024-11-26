<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario'; // Nombre de la tabla
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['usuario_login', 'nombre_usuario', 'clave', 'email', 'id_rol']; // Agrega los campos según la estructura de tu tabla

    // Método para verificar si un usuario ya existe
    public function existeUsuario($usuario_login)
    {
        return $this->where('usuario_login', $usuario_login)->countAllResults() > 0;
    }

    // Obtener todos los usuarios
    public function obtenerUsuarios()
    {
        return $this->findAll();
    }

    // Obtener un usuario por ID
    public function obtenerUsuario($id)
    {
        return $this->find($id);
    }

    // Crear un usuario
    public function crearUsuario($data)
    {
        return $this->insert($data);
    }

    // Actualizar un usuario
    public function actualizarUsuario($id, $data)
    {
        return $this->update($id, $data);
    }

    // Eliminar un usuario
    public function eliminarUsuario($id)
    {
        return $this->delete($id);
    }
}
