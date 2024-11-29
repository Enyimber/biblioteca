<?php

namespace App\Models;

use Ratchet\Client\WebSocket;
use Ratchet\Client\Connector;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;

class NotificacionesModel
{
    protected $DBGroup          = 'default';
    protected $table            = 'websocket';
    protected $primaryKey       = 'id';

    // Función para conectar y enviar un mensaje a través de WebSocket
    public function sendMessage($message)
    {
        // Crear un loop para la conexión ReactPHP
        $loop = Factory::create();

        // Conectar al servidor WebSocket (ajustar el host y el puerto)
        $connector = new Connector($loop);

        // Aquí ajustas la dirección del WebSocket (en este caso el puerto 8081)
        $connector('ws://localhost:8081')->then(
            function(WebSocket $conn) use ($message) {
                // Cuando se establece la conexión, enviar el mensaje
                echo "Conectado al WebSocket\n";

                // Enviar el mensaje al servidor WebSocket
                $conn->send($message);

                // Cerrar la conexión después de enviar el mensaje
                $conn->close();
            },
            function(\Exception $e) {
                // En caso de error en la conexión, mostrar el error
                echo "Error al conectar: " . $e->getMessage() . "\n";
            }
        );

        // Ejecutar el loop
        $loop->run();
}
