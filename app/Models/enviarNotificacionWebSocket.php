<?php

namespace App\Models;

use Ratchet\Client\WebSocket;
use Ratchet\Client\Connector;
use React\EventLoop\Factory;
use GuzzleHttp\Exception\RequestException;

class EnviarNotificacionesWebSocketModel
{
    private $loop;
    private $connector;
    private $socket;

    public function __construct()
    {
        $this->loop = Factory::create();
        $this->connector = new Connector($this->loop);
    }

    public function enviarNotificacion($mensaje)
    {
        // Conecta al servidor WebSocket
        $this->connector('ws://localhost:8081/notifications')->then(
            function (WebSocket $conn) use ($mensaje) {
                // Cuando la conexión es exitosa, enviamos el mensaje
                $conn->send($mensaje);
                $conn->close();
            },
            function (RequestException $e) {
                echo "Error al conectar al servidor WebSocket: {$e->getMessage()}\n";
            }
        );

        // Ejecuta el loop de eventos
        $this->loop->run();
    }
}

