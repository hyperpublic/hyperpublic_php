<?php

if (preg_match("/people\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class People extends Base {
  
  public $id;
  public $people;
  
  public $consumer;
  public $tags;
  public $name;

  function __construct($consumerKeys){
    $this->consumer = $consumerKeys;
  }

  function show($id){
    $this->get("/people/{$id}{$this->consumer}");
    return $this;
  }

  function find($params){
    $this->get("/things" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }


}