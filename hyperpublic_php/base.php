<?

if (preg_match("/base\.php$/", $_SERVER['PHP_SELF'])){
	exit('No direct script access allowed');
}

class Base {

  public $http_code;
  
  public $url;

  public $request;

  public $host = "https://hyperpublic.com/api/v1";

  public $timeout = 30;

  public $connecttimeout = 30;

  public $http_info;

  public $useragent = "Hyperpublic PHP beta";

  public $ssl_verifypeer = FALSE;

  public function get($url, $params=array()){
    $url = $this->host . $url;
    if (!empty($params)){
      $url .= "?" . http_build_query($params);
    }
    $response = $this->http($url, 'GET');
    $response = json_decode($response);
    foreach ($response as $key => $value) {
      $this->{$key} = $value;    
    }
    return $this;
  }
  
  public function create($request, $parameters) {
    if(is_array($parameters)) {
      $encoded_params = array();
      foreach ($parameters as $key => $value) {
        $encoded_params[] = urlencode($key) . '=' . urlencode($value);
      }        
      $params = implode('&', $encoded_params);
      $url = "{$this->host}{$request}?{$params}&{$this->consumer}";
      $response = $this->http($url, 'POST');    
      return $response;
    } else {
      return false;
    }
  }
    
  /**
   * Make an HTTP request
   *
   * @return API results
   */
  function http($url, $method, $postfields = NULL) {
    $this->http_info = array();
    $ci = curl_init();
    /* Curl settings */
    curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
    curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ci, CURLOPT_HTTPHEADER, array('Expect:'));
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
    curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
    curl_setopt($ci, CURLOPT_HEADER, FALSE);

    switch ($method) {
    case 'POST':
      curl_setopt($ci, CURLOPT_POST, TRUE);
      if (!empty($postfields)) {
        curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
      }
      break;
    case 'DELETE':
      curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
      if (!empty($postfields)) {
        $url = "{$url}?{$postfields}";
      }
    }

    curl_setopt($ci, CURLOPT_URL, $url);
    $response = curl_exec($ci);
    $this->http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
    $this->http_info = array_merge($this->http_info, curl_getinfo($ci));
    $this->url = $url;
    curl_close ($ci);
    return $response;
  }

 /**
   * Get the header info to store.
   */
  function getHeader($ch, $header) {
    $i = strpos($header, ':');
    if (!empty($i)) {
      $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
      $value = trim(substr($header, $i + 2));
      $this->http_header[$key] = $value;
    }
    return strlen($header);
  }

}