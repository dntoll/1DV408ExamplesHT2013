<?php

class SocketTest {
	/**
	 * Simple HTTP1.0 Client
	 *
	 * Taken from
	 * http://www.php.net/manual/en/sockets.examples.php
	 * Removed output and parameterized arguments
	 * uses Exception for error handling
	 * 
	 * @param  String $host ex. www.example.com
	 * @param int $port ex. 80
	 * @param  String $document ex. index.html
	 * 
	 * @return void but echo to ob
	 */
	public static function socketClient($host, $port, $document) {
		$service_port = $port;

		// Get the IP address for the target host. 
		$address = gethostbyname($host);

		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ($socket === false) {
		    throw new Exception("socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n");
		}

		$result = socket_connect($socket, $address, $service_port);
		if ($result === false) {
		    throw new Exception("socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n");
		}

		$in = "GET $document HTTP/1.0\r\n";
		$in .= "Connection: Close\r\n\r\n";
		$out = '';

		socket_write($socket, $in, strlen($in));
		while ($out = socket_read($socket, 2048)) {
		    echo $out;
		}

		socket_close($socket);
		
	}
}

SocketTest::socketClient("localhost", 8888, "/php2013/1DV408ExamplesHT2013/Lectures/Lecture%202.%20A%20View/tests/data/index.php");