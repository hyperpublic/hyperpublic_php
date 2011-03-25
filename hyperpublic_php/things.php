<?php

if (preg_match("/things\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class Things extends Base {
  
  public $id;
  public $things;
  
  public $consumer;
  public $tags;
  public $name;

  function __construct($consumerKeys){
    $this->consumer = $consumerKeys;
  }

  function find($id){
    $this->get("/things/{$id}{$this->consumer}");
    return $this;
  }

}