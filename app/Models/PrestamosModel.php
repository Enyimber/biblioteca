<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestamosModel extends Model
{
    protected $table = 'prestamo';  // Nombre de la tabla
    protected $primaryKey = 'id_prestamo';
    protected $allowedFields = ['id_usuario', 'id_libro', 'fecha_hora', 'fecha_hora_entrega', 'estado'];

    // Obtener todos los préstamos
    public function getPrestamos()
    {
        return $this->select('prestamo.*, usuario.nombre_usuario, libro.nombre_libro')
            ->join('usuario', 'prestamo.id_usuario = usuario.id_usuario')
            ->join('libro', 'prestamo.id_libro = libro.id_libro')
            ->findAll();
    }

    public function obtenerPrestamosPorUsuario($id_usuario)
    {
        return $this->select('prestamo.id_prestamo, prestamo.fecha_hora, prestamo.fecha_hora_entrega, usuario.nombre_usuario, libro.nombre_libro')
            ->join('usuario', 'prestamo.id_usuario = usuario.id_usuario')
            ->join('libro', 'prestamo.id_libro = libro.id_libro')
            ->where('prestamo.id_usuario', $id_usuario)
            ->findAll();
    }

    public function cancelarPrestamo($id_prestamo)
    {
        return $this->delete($id_prestamo);
    }

    // Registrar préstamo
    public function registrarPrestamo($data)
    {
        return $this->insert($data);
    }

    // Obtener préstamo por ID
    public function getPrestamo($id)
    {
        return $this->find($id);
    }

    // Actualizar préstamo
    public function actualizarPrestamo($id, $data)
    {
        return $this->update($id, $data);
    }

    // Eliminar préstamo
    public function eliminarPrestamo($id)
    {
        return $this->delete($id);
    }

    // Función para insertar una solicitud de préstamo
    public function insertSolicitud($solicitud)
    {
        // Inserta la solicitud en la base de datos
        return $this->db->table('solicitud_de_prestamo')->insert($solicitud);
    }

    // Función para obtener una solicitud de préstamo por su ID
    public function obtenerSolicitudPorId($id_solicitud)
    {
        return $this->db->table('solicitud_de_prestamo')->where('id_solicitud', $id_solicitud)->get()->getRowArray();
    }

    // Función para actualizar el estado de una solicitud de préstamo
    public function actualizarEstadoSolicitud($id_solicitud, $estado)
    {
        return $this->db->table('solicitud_de_prestamo')->update(['estado' => $estado], ['id_solicitud' => $id_solicitud]);
    }

    // Función para insertar un préstamo
    public function insertPrestamo($data)
    {
        return $this->db->table('prestamo')->insert($data);
    }
}
