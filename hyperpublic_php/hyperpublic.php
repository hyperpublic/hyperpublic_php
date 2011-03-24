<?

/*
 * Library for the Hyperpublic v1-beta API
 * 
 * Modeled after Abraham Williams' twitteroauth
 * https://github.com/abraham/twitteroauth
 *
 */

require_once("lib/oauth.php");

class Hyperpublic {

  public $http_code;

  public $url;

  public $request;

  public $host = "http://localhost:3000/api/v1/";

  public $timeout = 30;

  public $connecttimeout = 30;

  public $http_info;

  public $useragent = "Hyperpublic PHP beta";


  /**
   * Set API URLS
   */
  function accessTokenURL()  { return 'http://localhost:3000/oauth/access_token'; }
  function authorizeURL()    { return 'http://localhost:3000/oauth/authorize'; }
  function requestTokenURL() { return 'http://localhost:3000/oauth/request_token'; }

  function __construct($client_key, $client_secret) {
    $this->consumer = "client_id=" . $client_key . "&client_secret=" . $client_secret;
  }

  function get($request, $parameters){
    if ($parameters && is_array($parameters) ) {
      $encoded_params = array();
      foreach ($parameters as $key => $value) {
        $encoded_params[] = urlencode($key) . '=' . urlencode($value);
      }        
      $params = implode('&', $encoded_params);
      $url = "{$this->host}{$request}?{$params}&{$this->consumer}";
      $response = $this->http($url, 'GET');
      return $response;  
    } else {
      $url = "{$this->host}{$request}/{$parameters}?{$this->consumer}";
      $response = $this->http($url, 'GET');
      return $response;
    }    
  }
  
  function create($request, $parameters) {
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
