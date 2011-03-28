<?

if (preg_match("/config\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

define('CONSUMER_KEY', '3RiGGtdIlJbVZhlqUvdGg47mwSegIYYHkfsWi0IT');
define('CONSUMER_SECRET', 'IGqb1qcJfnkZJ839lR70PlI0rnP59SjG6BdOtmqI');

?>