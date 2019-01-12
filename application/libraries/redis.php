<?php 
/**
* 
*/
class Redis{
	function config()
	{
	$client = new Predis\Client([
    'scheme' 	=> 'tcp',
    'host'   	=> '172.17.6.45',
    'port'   	=> 6379,
    'database'	=> 1
]);
	return $client;
	}
}

 ?>