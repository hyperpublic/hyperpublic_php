<?php

error_reporting(E_ALL); 
ini_set("display_errors", 1); 

require_once("hyperpublic_php/hyperpublic.php");
require_once("config.php");

$hyperpublic = new Hyperpublic(CONSUMER_KEY,CONSUMER_SECRET);

$person= $hyperpublic->people->show(1);
$people= $hyperpublic->people->find(array('location[neighborhood]' => 'williamsburg'));

$place= $hyperpublic->places->show(1);
$places= $hyperpublic->places->find(array('location[neighborhood]'=>'williamsburg'));

$thing= $hyperpublic->things->show(200);
$things= $hyperpublic->things->find(array('location[neighborhood]'=>'williamsburg'));

echo "Testing Get People Endpoints<br/>";
echo "Name: " . $person->headline;
echo "<br>";
echo "ID: " . $people->id;
echo "<br>";

echo "Testing Get Places Endpoints<br/>";
echo "Name: " . $place->name;
echo "<br>";
echo "ID: " .$place->id;
echo "<br>";

echo "Testing Get Things Endpoints<br/>";
echo "Name: " . $thing->title;
echo "<br>";
echo "ID: " .$thing->id;
echo "<br>";