<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

namespace CodersStudio\DadataApi\Classes;

class Clean
{
    private $base_url = "https://dadata.ru/api/v2/clean";
    private $token;
    private $secret;
    private $handle;

    public function __construct($token, $secret)
    {
        $this->token = $token;
        $this->secret = $secret;
    }

    public function init()
    {
        $this->handle = curl_init();
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Token " . $this->token,
            "X-Secret: " . $this->secret,
        ));
        curl_setopt($this->handle, CURLOPT_POST, 1);
    }

    public function clean($type, $value)
    {
        $url = $this->base_url . "/$type";
        $fields = array($value);
        return $this->executeRequest($url, $fields);
    }

    public function cleanRecord($structure, $record)
    {
        $url = $this->base_url;
        $fields = array(
            "structure" => $structure,
            "data" => array($record)
        );
        return $this->executeRequest($url, $fields);
    }

    public function close()
    {
        curl_close($this->handle);
    }

    private function executeRequest($url, $fields)
    {
        curl_setopt($this->handle, CURLOPT_URL, $url);
        curl_setopt($this->handle, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($this->handle);
        $result = json_decode($result, true);
        return $result;
    }
}


