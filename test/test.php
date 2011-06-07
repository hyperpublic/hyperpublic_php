<?php 

require 'php_unit_test_framework/php_unit_test.php';
require 'php_unit_test_framework/text_test_runner.php';

class HyperpublicTest extends TestCase {
  public function SetUp() {
    require_once("../hyperpublic_php/hyperpublic.php");
    require_once("../config.php");
    
    $hyperpublic = new Hyperpublic(CONSUMER_KEY,CONSUMER_SECRET);
    $this->showPerson = $hyperpublic->people->show(4);
    $this->findPerson = $hyperpublic->people->find(array('location' => '11211', 'limit' => '1'));
    $this->showPlace = $hyperpublic->places->show(100);
    $this->findPlace = $hyperpublic->places->find(array('location' => '11211', 'limit' => '1'));
    $this->showThing = $hyperpublic->things->show(420);
    $this->findThing = $hyperpublic->things->find(array('location' => '11211', 'limit' => '1'));
  }
  public function Run() {
    // first lets make sure its an object
    $this->AssertEquals(is_object($this->showPerson), true, $message = 'show person');
    $this->AssertEquals(is_object($this->findPerson), true, $message = 'find person');
    $this->AssertEquals(is_object($this->showPlace), true, $message = 'show place');
    $this->AssertEquals(is_object($this->findPlace), true, $message = 'find place');
    $this->AssertEquals(is_object($this->showThing), true, $message = 'show thing');
    $this->AssertEquals(is_object($this->showThing), true, $message = 'find thing');
    // then lets make sure it returns with a 200 status code
    $this->AssertEquals($this->showPerson->http_code, 200, $message = 'show person status code');
    $this->AssertEquals($this->findPerson->http_code, 200, $message = 'find person status code');
    $this->AssertEquals($this->showPlace->http_code, 200, $message = 'show place status code');
    $this->AssertEquals($this->findPlace->http_code, 200, $message = 'find place status code');
    $this->AssertEquals($this->showThing->http_code, 200, $message = 'show thing status code');
    $this->AssertEquals($this->showThing->http_code, 200, $message = 'find thing status code');
    // finally lets check the content type
    $this->AssertEquals($this->showPerson->http_info['content_type'], 'application/json; charset=utf-8', $message = 'show person content type');
    $this->AssertEquals($this->findPerson->http_info['content_type'], 'application/json; charset=utf-8', $message = 'find person content type');
    $this->AssertEquals($this->showPlace->http_info['content_type'], 'application/json; charset=utf-8', $message = 'show place content type');
    $this->AssertEquals($this->findPlace->http_info['content_type'], 'application/json; charset=utf-8', $message = 'find place content type');
    $this->AssertEquals($this->showThing->http_info['content_type'], 'application/json; charset=utf-8', $message = 'show thing content type');
    $this->AssertEquals($this->showThing->http_info['content_type'], 'application/json; charset=utf-8', $message = 'find thing content type');
  }
  public function TearDown(){
    unset($hyperpublic);
  }
}

$suite = new TestSuite;
$suite->AddTest('HyperpublicTest');

$runner = new TextTestRunner;
$runner->Run($suite, 'result');