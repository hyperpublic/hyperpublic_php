<?php

if (preg_match("/things\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class Things extends Base {

  public $id;  /* integer */
  public $tags;  /* array */
  public $title;  /* string */
  public $image;  /* object */
  public $locations;  /* array */
  public $price;  /* string */
  public $user_id;  /* integer */

  /**
   * Contruct the subclass
   *
   * @param string $consumer_keys
   *
   */
  function __construct($consumer_keys = ''){
    $this->consumer = $consumer_keys;
  }

  /**
   * Show thing by Hyperpublic ID 
   *
   * @param integer $id
   * @return string
   *
   */
  function show($id = ''){
    $this->get("/things/{$id}{$this->consumer}");
    return $this;
  }

  /**
   * Find things by search query 
   *
   * @param array $params
   * @return string
   *
   */
  function find(array $params){
    $this->get("/things" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }

  /**
   * Create a thing on Hyperpublic
   *
   * @param array $params
   * @return string
   *
   */  
  function create(array $params){
    $this->post("/things" . $this->consumer  . "&" . http_build_query($params));
    return $this;
  }

}