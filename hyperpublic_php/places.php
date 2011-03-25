<?php

if (preg_match("/places\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class Places extends Base {
  
  public $id;
  public $places;
  
  public $consumer;
  public $tags;
  public $name;

  function __construct($consumerKeys){
    $this->consumer = $consumerKeys;
  }

  function find($id){
    $this->get("/places/{$id}{$this->consumer}");
    return $this;
  }

}