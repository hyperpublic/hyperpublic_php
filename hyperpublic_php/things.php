<?php

if (preg_match("/things\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class Things extends Base {
  
  public $id;
  public $things;
  public $tags;
  public $title;
  public $image;
  public $locations;
  public $price;
  public $user_id;
  public $zipcode;
  public $lat;
  public $lon;

  function __construct($consumer_keys = ''){
    $this->consumer = $consumer_keys;
  }

  function show($id = ''){
    $this->get("/things/{$id}{$this->consumer}");
    return $this;
  }

  function find(array $params){
    $this->get("/things" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }
  
  function create(array $params){
    $this->post("/things" . $this->consumer  . "&" . http_build_query($params));
    return $this;
  }

}