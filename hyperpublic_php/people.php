<?php

if (preg_match("/people\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class People extends Base {
  
  public $id;  /* integer */
  public $tags;  /* array */
  public $headline;  /* string */
  public $locations;  /* array */
  public $image;  /* string */

  /**
   * Contruct the subclass.    
   *
   * @param string $consumer_keys
   *
   */
  function __construct($consumer_keys = ''){
    $this->consumer = $consumer_keys;
  }

  /**
   * Show person by Hyperpublic ID 
   *
   * @param integer $id
   * @return string
   *
   */
  function show($id = ''){
    $this->get("/people/$id}{$this->consumer}");
    return $this;
  }

  /**
   * Find people by search query 
   *
   * @param array $params
   * @return string
   *
   */
  function find(array $params){
    $this->get("/people" . $this->consumer . "&" . http_build_query($params));
    return $this;
  } 

  /**
   * Create user on Hyperpublic
   *
   * @param array $params
   * @return string
   *
   */
  function create(array $params){
    $this->post("/people" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }

}