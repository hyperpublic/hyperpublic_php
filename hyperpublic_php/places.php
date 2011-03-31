<?php

if (preg_match("/places\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class Places extends Base {

  public $id;  /* integer */
  public $tags;  /* array */
  public $name;  /* string */
  public $description;  /* string */
  public $user_id;  /* intger */
  public $image;  /* object */
  public $locations;  /* array */
  public $phone_number;  /* string */
  public $website;  /* string */
  public $category;  /* string */
  public $subcategory;  /* string */

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
   * Show place by Hyperpublic ID
   *
   * @param integer $id
   * @return string
   *
   */
  function show($id = ''){
    $this->get("/places/{$id}{$this->consumer}");
    return $this;
  }

  /**
   * Find places by search query
   *
   * @param array $params
   * @return string
   *
   */
  function find(array $params){
    $this->get("/places" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }

  /**
   * Create a place on Hyperpublic
   *
   * @param array $params
   * @return string
   *
   */
  function create(array $params){
    $this->post("/places" . $this->consumer . "&" . http_build_query($params));
    return $this;
  }

}