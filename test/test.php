<?php 

require 'php_unit_test_framework/php_unit_test.php';
require 'php_unit_test_framework/text_test_runner.php';

class HyperpublicTest extends TestCase {
  public function SetUp() {
    require_once("../hyperpublic_php/hyperpublic.php");
    require_once("../config.php");
    
    if (!CONSUMER_KEY || !CONSUMER_SECRET) {
      throw new Error('You need to provide API keys.');
    }
    
    $hyperpublic = new Hyperpublic(CONSUMER_KEY,CONSUMER_SECRET);
    $this->showPerson = $hyperpublic->people->show('4dd2c928a0b7f9146800a923');
    $this->findPerson = $hyperpublic->people->find(array('postal_code' => '11211', 'limit' => '1'));
    $this->createPerson = $hyperpublic->people->create(array('email' => 'jonathan' . time() . '@hyperpublic.com', 'password' => 'openSesame', 'postal_code' => '11211'));
    $this->showPlace = $hyperpublic->places->show('4de6914dcf8c121126000029');
    $this->findPlace = $hyperpublic->places->find(array('postal_code' => '11211', 'limit' => '1'));
    $this->createPlace = $hyperpublic->places->create(array('display_name' => 'php', 'postal_code' => '11211'));
    $this->showThing = $hyperpublic->things->show('4defadbbcf8c1246c2000063');
    $this->findThing = $hyperpublic->things->find(array('postal_code' => '11211', 'limit' => '1'));
    $this->createThing = $hyperpublic->things->create(array('display_name' => 'arbys', 'address' => 'san francisco, ca', 'tags' => 'kreayshawn'));

  }
  public function Run() {
    // first lets make sure its an object
    $this->AssertEquals(is_object($this->showPerson), true, $message = 'show person');
    $this->AssertEquals(is_object($this->findPerson), true, $message = 'find person');
    $this->AssertEquals(is_object($this->createPerson), true, $message = 'create person');
    $this->AssertEquals(is_object($this->showPlace), true, $message = 'show place');
    $this->AssertEquals(is_object($this->findPlace), true, $message = 'find place');
    $this->AssertEquals(is_object($this->createPlace), true, $message = 'create place');
    $this->AssertEquals(is_object($this->showThing), true, $message = 'show thing');
    $this->AssertEquals(is_object($this->findThing), true, $message = 'find thing');
    $this->AssertEquals(is_object($this->createThing), true, $message = 'create thing');
    // then lets make sure it returns with a 200 status code    
    $this->AssertEquals($this->showPerson->http_code, 200, $message = 'show person status code');
    $this->AssertEquals($this->findPerson->http_code, 200, $message = 'find person status code');
    $this->AssertEquals($this->createPerson->http_code, 200, $message = 'create person status code');
    $this->AssertEquals($this->showPlace->http_code, 200, $message = 'show place status code');
    $this->AssertEquals($this->findPlace->http_code, 200, $message = 'find place status code');
    $this->AssertEquals($this->createPlace->http_code, 200, $message = 'create place status code');
    $this->AssertEquals($this->showThing->http_code, 200, $message = 'show thing status code');
    $this->AssertEquals($this->findThing->http_code, 200, $message = 'find thing status code');
    $this->AssertEquals($this->createThing->http_code, 200, $message = 'create thing status code');
    // finally lets check the content type
    $this->AssertEquals($this->showPerson->http_info['content_type'], 'application/json; charset=utf-8', $message = 'show person content type');
    $this->AssertEquals($this->findPerson->http_info['content_type'], 'application/json; charset=utf-8', $message = 'find person content type');
    $this->AssertEquals($this->createPerson->http_info['content_type'], 'application/json; charset=utf-8', $message = 'create person content type');
    $this->AssertEquals($this->showPlace->http_info['content_type'], 'application/json; charset=utf-8', $message = 'show place content type');
    $this->AssertEquals($this->findPlace->http_info['content_type'], 'application/json; charset=utf-8', $message = 'find place content type');
    $this->AssertEquals($this->createPlace->http_info['content_type'], 'application/json; charset=utf-8', $message = 'create place content type');
    $this->AssertEquals($this->showThing->http_info['content_type'], 'application/json; charset=utf-8', $message = 'show thing content type');
    $this->AssertEquals($this->findThing->http_info['content_type'], 'application/json; charset=utf-8', $message = 'find thing content type');
    $this->AssertEquals($this->createThing->http_info['content_type'], 'application/json; charset=utf-8', $message = 'create thing content type');
    
  }
  public function TearDown(){
    unset($hyperpublic);
  }
}

$suite = new TestSuite;
$suite->AddTest('HyperpublicTest');

$runner = new TextTestRunner;
$runner->Run($suite, 'result');