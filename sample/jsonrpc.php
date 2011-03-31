<?php
	echo '<pre>';
	
	include('../tivoka.php');																			//STEP 1
	
	$jsonrpc = new Tivoka_ClientConnection('http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/jsonrpcserver.php');	//STEP 2
	
	$response = $jsonrpc->send(new Tivoka_ClientRequestBatch(array(								//STEP 3
		new Tivoka_ClientRequestRequest('65498','demo.substract',array(43,1)),
		new Tivoka_ClientRequestRequest('65499','demo.sayHello')
	)));
	
	$errors = array(Tivoka_ClientResponse::ERROR_NO_RESPONSE => 'No Response received!',
				Tivoka_ClientResponse::ERROR_INVALID_JSON => 'Invalid json response',
				Tivoka_ClientResponse::ERROR_INVALID_RESPONSE => 'Invalid JSON-RPC response',
				Tivoka_ClientResponse::ERROR_CONNECTION_FAILED => 'Connection failed',
				Tivoka_ClientResponse::ERROR_HTTP_NOT_FOUND => 'HTTP: 404 Not found');
				
	
	if($response['65499']->isError()) //an error for request 65499?
	{
		var_dump($errors[$response['65499']->process_error]);
		var_dump($response['65499']->error);
		var_dump($response['65499']->response);
	}else
	{
		var_dump($response['65499']->result);
	}
	if($response['65498']->isError()) //an error for request 65499?
	{
		var_dump($errors[$response['65498']->process_error]);
		var_dump($response['65498']->error);
		var_dump($response['65498']->response);
	}else
	{
		var_dump($response['65498']->result);
	}
	
	echo '</pre>';
?>