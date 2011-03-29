<?php

error_reporting(E_ALL); 
ini_set("display_errors", 1); 

require_once("hyperpublic_php/hyperpublic.php");
require_once("config.php");

$hyperpublic = new Hyperpublic(CONSUMER_KEY,CONSUMER_SECRET);
?>
<!doctype html>
<html>
  <head>
    <title>Hyperpublic PHP Library Test</title>
  </head>
  <body>
    <table>
      <tr><th>Testing</th><th>Response</th></tr>
      <?php
        
        class Test extends Hyperpublic {
          public $class;
          public $endpoint;
          public $params;
          
          function __construct($class, $endpoint, $params){
            echo $class;
            echo $endpoint;
            echo $params;
            $this->class = $class;
            $this->endpoint = $endpoint;
            $this->params = $params;            
            
            echo $this;
            //            echo $this->class->endpoint(params);          
          }
          
          
          function test(){

          }

        }
        
        function test($class, $endpoint, $params){
          new Hyperpublic(CONSUMER_KEY,CONSUMER_SECRET)::$class->$endpoint($params);
            }

            test('people', 'show', 4);
        //        function test($class, $endpoint, $params){
        //$tmp = $hyperpublic->$class->$endpoint($params);
        //echo "<tr>" . $tmp . "</tr>";
        //}

        //        new Test('people', 'show', 4);
        //new Test('people','find', array('location[neighborhood]' => 'williamsburg'));
        //        new Test('people','create');
        //new Test('places','show', 682);
        //new Test('places', 'find', array('location[neighborhood]' => 'williamsburg') );
        //        new Test('places', 'create');
        // new Test('things', 'show', 1);
        //new Test('things', 'find', array('location[neighborhood]' => 'williamsburg'));
        //new Test('things', 'create');


        ?>
    </table>
  </body>
</html>

<?php


$person= $hyperpublic->people->show(1);
$people= $hyperpublic->people->find(array('location[neighborhood]' => 'williamsburg'));

$place= $hyperpublic->places->show(1);
$places= $hyperpublic->places->find(array('location[neighborhood]'=>'williamsburg'));

$thing= $hyperpublic->things->show(200);
$things= $hyperpublic->things->find(array('location[neighborhood]'=>'williamsburg'));

$newThing = $hyperpublic->things->create(array('title'=>'my new socks', 'price'=>'4', 'zipcode'=>'11211'));



echo "New Testing Get People Endpoints<br/>";
echo "Name: " . $person->headline;
echo "<br>";
echo "ID: " . $people->id;
echo "<br>";

echo "New Testing Get Places Endpoints<br/>";
echo "Name: " . $place->name;
echo "<br>";
echo "ID: " . $place->id;
echo "<br>";

echo "New Testing Get Things Endpoints<br/>";
echo "Name: " . $thing->title;
echo "<br>";
echo "ID: " . $thing->id;
echo "<br>";

//print_r($newThing);
echo "New Testing Create Thing Endpoints<br/>";
//echo "Name: " . $newThing;
echo "<br>";
echo "ID: " . $newThing->id;
echo "<br>";
