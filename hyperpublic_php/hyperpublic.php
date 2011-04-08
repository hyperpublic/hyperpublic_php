<?php

/**
 *
 * Library for the Hyperpublic v1-beta API
 *
 * @author Jonathan Vingiano (@jgv | jonathan@hyperpublic.com)
 *
 */

if (preg_match("/hyperpublic\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class Hyperpublic {

  public $people; /* object */ 
  public $places; /* object */ 
  public $things; /* object */
  private $consumer; /* string */ 

  /**
   * Construct the class 
   * Instantiate people, place, thing 
   *
   * @params string $key string $secret
   * @return void
   */  
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