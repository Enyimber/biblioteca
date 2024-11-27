<?php

namespace App\Models;

use GuzzleHttp\Client;

class NotificacionesModel
{
    public function enviarNotificacion($id_usuario, $id_libro)
    {
        // Crear el cliente HTTP para hacer una petición al servidor WebSocket
        $client = new Client();

        // Preparar el mensaje que se enviará
        $mensaje = "El usuario con ID $id_usuario ha solicitado el libro con ID $id_libro.";

        // Enviar la notificación a todos los administradores conectados mediante WebSocket
        $response = $client->post('http://localhost:8081/notifications', [
            'json' => [
                'title' => 'Nueva solicitud de préstamo',
                'message' => $mensaje
            ]
        ]);

        // Devolver el código de estado de la respuesta
        return $response->getStatusCode();
    }
}
