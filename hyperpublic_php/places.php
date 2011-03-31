<?php

if (preg_match("/places\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class Places extends Base {
  
  public $id;
  public $plaecs;
  public $tags;
  public $name;
  public $description;
  public $user_id;
  public $image;
  public $locations;
  public $phone_number;
  public $website;
  public $category;
  public $subcategory;
  public $address;
  public $zipcode;
  public $lat;
  public $lon;
   

  function __construct($consumer_keys = ''){
    $this->consumer = $consumer_keys;
  }

  function show($id = ''){
    $this->get("/places/{$id}{$this->consumer}");
    return $this;
  }

  function find(array $params){
    $this->get("/places" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }

  function create(array $params){
    $this->post("/places" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }

}