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

  function show($id){
    $this->get("/places/{$id}{$this->consumer}");
    return $this;
  }

  function find($params){
    $this->get("/places" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }


}