<?php

if (preg_match("/people\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class People extends Base {
  
  public $id;
  public $people;
  public $tags;
  public $name;
  public $locations;
  public $image;
  public $image_url;
  public $address;
  public $zipcode;
  public $lat;
  public $lon;
  public $email;

  function __construct($consumer_keys = ''){
    $this->consumer = $consumer_keys;
  }

  function show($id = ''){
    $this->get("/people/$id}{$this->consumer}");
    return $this;
  }

  function find(array $params){
    $this->get("/people" . $this->consumer . "&" . http_build_query($params));
    return $this;
  } 

  function create(array $params){
    $this->post("/people" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }

}