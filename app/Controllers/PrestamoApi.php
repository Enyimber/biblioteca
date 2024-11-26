<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PrestamoApi extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Conexión a PostgreSQL
    }

    // Registrar una solicitud de préstamo
    public function registrarSolicitud()
    {
        header('Content-Type: application/json');
        $response = ['status' => false, 'message' => ''];

        try {
            // Validar datos de entrada
            $this->form_validation->set_rules('id_usuario', 'Usuario', 'required|integer');
            $this->form_validation->set_rules('id_libro', 'Libro', 'required|integer');

            if (!$this->form_validation->run()) {
                throw new \Exception(validation_errors('<li>', '</li>'));
            }

            // Preparar los datos para insertar la solicitud de préstamo
            $data = [
                'id_usuario' => $this->request->getPost('id_usuario'),
                'id_libro' => $this->request->getPost('id_libro'),
                'estado' => 'Pendiente'
            ];

            // Insertar solicitud de préstamo
            $this->db->table('solicitud_de_prestamo')->insert($data);

            // Respuesta exitosa
            $response = [
                'status' => true,
                'message' => 'Solicitud de préstamo registrada exitosamente.'
            ];

        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        echo json_encode($response);
    }

    // Aprobar o rechazar una solicitud de préstamo
    public function cambiarEstadoSolicitud()
    {
        header('Content-Type: application/json');
        $response = ['status' => false, 'message' => ''];

        try {
            // Recibir datos del cambio de estado
            $id_solicitud = $this->request->getPost('id_solicitud');
            $estado = $this->request->getPost('estado'); // 'Aprobada' o 'Rechazada'

            // Validar el estado
            if (!in_array($estado, ['Aprobada', 'Rechazada'])) {
                throw new \Exception('Estado no válido.');
            }

            // Actualizar el estado de la solicitud
            $this->db->table('solicitud_de_prestamo')
                ->where('id_solicitud', $id_solicitud)
                ->update(['estado' => $estado]);

            // Notificar al usuario sobre el estado de la solicitud
            $solicitud = $this->db->table('solicitud_de_prestamo')
                ->where('id_solicitud', $id_solicitud)
                ->get()
                ->getRowArray();

            if ($solicitud) {
                // La notificación al usuario ya es manejada por el trigger de PostgreSQL.
            }

            // Respuesta exitosa
            $response = [
                'status' => true,
                'message' => "Solicitud {$estado} correctamente."
            ];

        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        echo json_encode($response);
    }
}
