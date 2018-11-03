<?php
  class loadCert {
    private $parsed_url;
    private $cert_info;
    
    public function __construct($url = null) {
      if(!is_null($url)){
        $this->parse_url($url)->load_cert();

      }

      return $this;
    }

    public function parse_url($url) {
        $this->parsed_url = parse_url($url, PHP_URL_HOST);

        return $this;
    }

    public function load_cert() {
      $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
      $read = stream_socket_client("ssl://" . $this->parsed_url . ":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
      $cert = stream_context_get_params($read);

      $this->cert_info = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);

      return $this;
    }

    public function get_cert_detail($detail){
      if($this->cert_info[$detail]) {
        return $this->cert_info[$detail];
      } else {
        return null;
      }
    }

  }
?>
