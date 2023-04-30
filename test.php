<?php
// Start listening on localhost:8000
$server = new WebSocketServer('0.0.0.0', 8000);

class WebSocketServer
{
    protected $clients = [];
    protected $master;

    public function __construct($address, $port)
    {
        $this->master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Unable to create socket\n");
        socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1) or die("Unable to set socket option\n");
        socket_bind($this->master, $address, $port) or die("Unable to bind socket\n");
        socket_listen($this->master, 20) or die("Unable to listen on socket\n");

        echo "WebSocket server started on port $port\n";

        while (true) {
            $client = socket_accept($this->master);
            $this->clients[] = $client;
            $handshake = $this->handshake($client);
            if ($handshake) {
                echo "Client connected\n";
                $this->broadcast("New client connected");
            }
        }
    }

    protected function handshake($client)
    {
        $data = socket_read($client, 1024);
        if (!$data) {
            return false;
        }
        $headers = [];
        $lines = preg_split("/\r\n/", $data);
        foreach ($lines as $line) {
            if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
                $headers[$matches[1]] = $matches[2];
            }
        }
        $key = base64_encode(pack('H*', sha1($headers['Sec-WebSocket-Key'] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        $upgrade = "HTTP/1.1 101 Switching Protocols\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Upgrade\r\n" .
            "Sec-WebSocket-Accept: $key\r\n\r\n";
        socket_write($client, $upgrade, strlen($upgrade));
        return true;
    }

    protected function broadcast($message)
    {
        foreach ($this->clients as $client) {
            socket_write($client, $message, strlen($message));
        }
    }
}