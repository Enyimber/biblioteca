<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'rol'; // Nombre de tu tabla de roles
    protected $primaryKey = 'id_rol';
    protected $allowedFields = ['nombre_rol']; // Actualiza según las columnas de tu tabla
}
