<?php
class EbayCall {
  public $_template = '';
  public $DevID = "";
  public $AppID = "";
  public $CertID = "";
  public $CompatLevel = "";
  public $SiteID = '';
  public $EndPoint = '';
  public $ebayAuthToken = "";
  public $headers = array();
  public $_attributes = array();
  public $_last_xml_response = "";
  function __construct($name,$config_file) {
    if (file_exists($config_file)) {
      include $config_file;
    } else {
      throw new Exception("You must specify a config file");
    }
    $this->_template = dirname(__FILE__) . "/templates/$name.php";
    $this->headers = array(
      'X-EBAY-API-COMPATIBILITY-LEVEL: ' . $this->CompatLevel,
      'X-EBAY-API-DEV-NAME: ' . $this->DevID,
      'X-EBAY-API-APP-NAME: ' . $this->AppID,
      'X-EBAY-API-CERT-NAME: ' . $this->CertID,
      'X-EBAY-API-CALL-NAME: ' . $name, 
      'X-EBAY-API-SITEID: ' . $this->SiteID,
    );
  }
  public function send() {
    $xml = $this->parse($this->_template);
    $connection = curl_init();
    curl_setopt($connection, CURLOPT_URL, $this->EndPoint);
    curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($connection, CURLOPT_HTTPHEADER, $this->headers);
    curl_setopt($connection, CURLOPT_POST, 1);
    curl_setopt($connection, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($connection);
    $this->_last_xml_response = $response;
    curl_close($connection);
    return simplexml_load_string($response);
  }
  public function parse($template) {
    ob_start();
      include $template;
    $output = '<?xml version="1.0" encoding="utf-8"?>' . "\n" . ob_get_clean();
    return $output;
  }
  public function __set($name,$value) {
    $this->_attributes[$name] = $value;
  }
  public function __get($name) {
    return $this->_attributes[$name];
  }
  
}
?>