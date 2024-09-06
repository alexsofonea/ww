<?php

require dirname( __FILE__ ) . '/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Sockett implements MessageComponentInterface {

    protected $clients;
    protected $clientChannel = [];
    protected $clientIds = [];

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    // Helper function to broadcast a message to a specific channel
    private function broadcastToChannel($channelId, $message, $exclude = null) {
        foreach ($this->clients as $client) {
            if ($client->resourceId != $exclude && $this->clientChannel[$client->resourceId] == $channelId) {
                $client->send($message);
            }
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Handle new connection, associating a user and channel
        if (!isset($this->clientChannel[$from->resourceId])) {
            $cl = json_decode($msg, true);
            $channelId = $cl['channelId'];
            $userId = $cl['userId'];
            $this->clientChannel[$from->resourceId] = $channelId;
            $this->clientIds[$from->resourceId] = $userId;

            // Notify all clients in the same channel that a user has come online
            $data = array(
                "user" => "system",
                "message" => array(
                    "type" => "status",
                    "status" => "online",
                    "data" => $userId,
                )
            );

            $this->broadcastToChannel($channelId, json_encode($data), $from->resourceId);

            // Notify the new user about other clients online in the same channel
            foreach ($this->clients as $client) {
                if ($client->resourceId != $from->resourceId && 
                    $this->clientChannel[$from->resourceId] == $this->clientChannel[$client->resourceId]) {

                    $onlineData = array(
                        "user" => "system",
                        "message" => array(
                            "type" => "status",
                            "status" => "online",
                            "data" => $this->clientIds[$client->resourceId],
                        )
                    );
                    $from->send(json_encode($onlineData));
                }
            }
        } else {
            // Forward the message to clients in the same channel
            $this->broadcastToChannel($this->clientChannel[$from->resourceId], $msg, $from->resourceId);
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // Notify all clients in the same channel that a user has gone offline
        if (isset($this->clientIds[$conn->resourceId])) {
            $data = array(
                "user" => "system",
                "message" => array(
                    "type" => "status",
                    "status" => "offline",
                    "data" => $this->clientIds[$conn->resourceId],
                )
            );

            $this->broadcastToChannel($this->clientChannel[$conn->resourceId], json_encode($data), $conn->resourceId);

            // Detach the connection and clean up
            $this->clients->detach($conn);
            unset($this->clientIds[$conn->resourceId]);
            unset($this->clientChannel[$conn->resourceId]);
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        // Log error and close the connection
        error_log("Error on connection {$conn->resourceId}: {$e->getMessage()}");
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Sockett()
        )
    ),
    8081
);

$server->run();


?> 