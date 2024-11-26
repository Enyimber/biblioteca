<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'usuario';

    /**
     * Método para validar usuario
     * 
     * @param string $usuario Nombre de usuario
     * @param string $clave Contraseña
     * @return mixed El objeto del usuario si es válido, `false` si no es válido
     */
    public function validarUsuario($usuario, $clave)
    {
        return $this->asArray()
                    ->where(['usuario_login' => $usuario, 'clave' => $clave])
                    ->first();
    }
}

