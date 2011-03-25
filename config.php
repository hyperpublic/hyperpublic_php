<?

if (preg_match("/config\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

define('CONSUMER_KEY', 'your consumer key');
define('CONSUMER_SECRET', 'your consumer secret');

?>