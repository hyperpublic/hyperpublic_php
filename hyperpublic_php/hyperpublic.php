<?php

/*
 *
 * Library for the Hyperpublic v1-beta API
 * 
 */


if (preg_match("/hyperpublic\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class Hyperpublic {
  
  var $people;
  var $places;
  var $things;

  public $consumer;
  
  function __construct($key = '', $secret = ''){
    $this->consumer = "?client_id=" . $key . "&client_secret=" . $secret;
    
    require_once(dirname(__FILE__) . '/base.php');
    require_once(dirname(__FILE__) . '/people.php');
    require_once(dirname(__FILE__) . '/places.php');
    require_once(dirname(__FILE__) . '/things.php');
    
    $this->people = new People($this->consumer);
    $this->places = new Places($this->consumer);
    $this->things = new Things($this->consumer);
    
  }

}