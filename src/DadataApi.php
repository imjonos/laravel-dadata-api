<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

namespace CodersStudio\DadataApi;

use CodersStudio\DadataApi\Classes\Suggestions;

/**
 * DadataApi
 * @package CodersStudio\DadataApi
 */
class DadataApi
{
    protected $suggest;

    /**
     * Return cities suggestions
     * @param string $query
     * @param array $countryCodeISO ["RU", "BY"]
     * @return array
     */
    public function suggestCity(String $query = "", Array $countryCodeISO = ["*"]):array
    {
        $countries = array_map (function ($item){
           return  ["country_iso_code" => $item];
        }, $countryCodeISO);

        $data = [
            "query" => $query,
            "from_bound" => ["value" => "city"],
            "to_bound" => ["value" => "city"],
            "locations"=> $countries
        ];
        return $this->getSuggest()->suggest("address", $data);
    }

    /**
     * Return countries suggestions
     * @param string $query
     * @return array
     */
    public function suggestCountry(string $query):array
    {
        $data = [
            "query" => $query,
            "from_bound" => ["value" => "country"],
            "to_bound" => ["value" => "country"],
            "locations"=> ["country_iso_code" => "*"]
        ];
        return $this->getSuggest()->suggest("address", $data);
    }

    /**
     * Return addresses suggestions
     * @param string $query
     * @return array
     */
    public function suggestAddress(string $query):array
    {
        $data = [
            "query" => $query
        ];
        return $this->getSuggest()->suggest("address", $data);
    }

    /**
     * Return city id for courier service (СДЭК, Boxberry, DPD)
     * @param string $kladrId
     * @return array
     */
    public function suggestDeliveryId(string $kladrId):array
    {
        $data = [
            "query" => $kladrId
        ];
        return $this->getSuggest()->findById("delivery", $data);
    }

    /**
     * Get the Suggestions instance
     * @return Suggestions
     */
    private function getSuggest(): Suggestions
    {
        if (!$this->suggest) {
            $this->suggest = new Suggestions(config("dadataapi.token", ""));
            $this->suggest->init();
        }
        return $this->suggest;
    }
}
