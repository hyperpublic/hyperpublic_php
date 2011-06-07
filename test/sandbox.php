<?php

require_once("../hyperpublic_php/hyperpublic.php");
require_once("../config.php");

$hyperpublic = new Hyperpublic(CONSUMER_KEY,CONSUMER_SECRET);

$hp = $hyperpublic->people->find(array('location' => '11211', 'limit' => '1'));

print_r($hp);

if (is_object($hp) == true) {
  echo 'yup';
} else {
  echo 'nope';
}
