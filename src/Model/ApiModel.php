<?php

namespace QontoClient\Model;

use GuzzleHttp\Client;

class ApiModel {

    private $loginApi;
    private $secretKey;

    const API_HOST = "http://thirdparty.qonto.eu/v2/";

    final public function setLoginApi($loginApi) {
        $this->loginApi = $loginApi;
        return $this;
    }

    final public function setSecretKey($secretKey) {
        $this->secretKey = $secretKey;
        return $this;
    }

    public function callApi($method, $uri, Array $data = array()) {
        $client = new Client();

        $fullURL = self::API_HOST . $uri;

        $res = $client->request($method, $uri, [
            'Authorization' => [$this->loginApi, $this->secretKey],
            'body'          => $data
        ]);

        return ($res->getStatusCode() == 200) ? $res->getBody() : null;
    }

}