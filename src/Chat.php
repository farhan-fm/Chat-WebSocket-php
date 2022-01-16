<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use MyApp\Entity\Message;


class Chat implements MessageComponentInterface
{
    protected $clients;

    function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New Connection ! {$conn->resourceId}\n";
    }

    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        if(isset($queryarray['id']))
        {

            $user_object = new \ChatUser;

            $user_object->setUserId($queryarray['id']);

            $user_object->setUserConnectionId($conn->resourceId);

            $user_object->update_user_connection_id();


        }

        parse_str($querystring, $queryarray);

        echo "Connection {$conn->resourceId} has disconnected \n";
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "{$e->getMessage()}";
        $conn->close();
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            if ($client !== $from) {
                $client->send($msg);
            }
        }
        Message::creating([
            'text' => $msg
        ]);
        echo $msg;
    }
}