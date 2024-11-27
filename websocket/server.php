<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

include_once dirname(__DIR__) . '/vendor/autoload.php';

class NotificationServer implements MessageComponentInterface {

    protected $clients;

    public function __construct() {
        // Inicializamos la colección de clientes
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection closed! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Message from {$from->resourceId}: {$msg}\n";
        
        // Aquí accedemos a todas las conexiones y enviamos el mensaje
        foreach ($this->clients as $client) {
            // Enviar el mensaje a todos los clientes, excepto al que envió el mensaje
            if ($from !== $client) {
                $client->send("{$msg}");
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = new Ratchet\App('localhost', 8081);
$server->route('/notifications', new NotificationServer, ['*']);
$server->run();
