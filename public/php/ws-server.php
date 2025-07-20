<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . '/php/vendor/autoload.php';

class ChatWs implements MessageComponentInterface
{
  protected $clients;

  public function __construct()
  {
    $this->clients = new \SplObjectStorage;
  }

  function onOpen(ConnectionInterface $conn)
  {
    $this->clients->attach($conn);
  }

  function onMessage(ConnectionInterface $from, $msg)
  {
    print_r($msg);
    // $msg — данные от фронта (может быть json) с message, ticket_id и т.д.
    foreach ($this->clients as $client) {
      $client->send($msg); // просто отсылаем всем для примера
    }
  }

  function onClose(ConnectionInterface $conn)
  {
    $this->clients->detach($conn);
  }

  function onError(ConnectionInterface $conn, \Exception $e)
  {
    $conn->close();
  }
}

$server = \Ratchet\Server\IoServer::factory(
  new \Ratchet\Http\HttpServer(
    new \Ratchet\WebSocket\WsServer(
      new ChatWs()
    )
  ),
  8080 // порт
);

$server->run();
