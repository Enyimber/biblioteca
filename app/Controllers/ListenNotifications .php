<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ListenNotifications extends Controller
{
    public function listen()
    {
        // Conexión a PostgreSQL
        $conn = pg_connect("host=localhost dbname=mi_base user=mi_usuario password=mi_password");

        if (!$conn) {
            echo "Error: No se pudo conectar a la base de datos.\n";
            exit;
        }

        // Suscribirse a los canales
        pg_query($conn, "LISTEN nueva_solicitud");
        pg_query($conn, "LISTEN solicitud_estado");

        echo "Esperando notificaciones...\n";

        while (true) {
            // Esperar notificaciones
            $result = pg_get_notify($conn, PGSQL_ASSOC);

            if ($result) {
                // Manejar la notificación
                if ($result['channel'] == 'nueva_solicitud') {
                    // Notificar al administrador de la nueva solicitud
                    echo "Nueva solicitud de préstamo registrada (ID: {$result['message']})\n";
                    // Aquí puedes enviar una notificación al administrador, por ejemplo por correo electrónico.
                } elseif ($result['channel'] == 'solicitud_estado') {
                    list($id_usuario, $estado, $id_solicitud) = explode(',', $result['message']);
                    // Notificar al usuario sobre la aprobación o rechazo de su solicitud
                    echo "La solicitud {$id_solicitud} ha sido {$estado} para el usuario {$id_usuario}\n";
                    // Aquí puedes enviar una notificación al usuario, por ejemplo por correo electrónico.
                }
            }

            // Agregar un pequeño retraso para evitar sobrecargar el CPU
            usleep(100000); // 0.1 segundos
        }
    }
}
