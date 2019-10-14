<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

namespace CodersStudio\DadataApi;

use CodersStudio\DadataApi\Classes\Clean;
use CodersStudio\DadataApi\Classes\Suggestions;

/**
 * DadataApi
 * @package CodersStudio\DadataApi
 */
class DadataApi
{
    protected $suggest;
    protected $clean;

    /**
     * Return cities suggestions
     * @param string $query
     * @param array $countryCodeISO ["RU", "BY"]
     * @param int $count
     * @return array
     */
    public function suggestCity(string $query = "", array $countryCodeISO = ["*"], int $count = 10):array
    {
        $countries = array_map (function ($item){
           return  ["country_iso_code" => $item];
        }, $countryCodeISO);

        $dataSettlementQuery = [
            "query" => $query,
            "from_bound" => ["value" => "settlement"],
            "to_bound" => ["value" => "settlement"],
            "locations"=> $countries,
            "count" => $count
        ];

        $dataCityQuery = [
            "query" => $query,
            "from_bound" => ["value" => "settlement"],
            "to_bound" => ["value" => "settlement"],
            "locations"=> $countries,
            "count" => $count
        ];

        $dataSettlement = $this->getSuggest()->suggest("address",  $dataSettlementQuery);
        $dataCity = $this->getSuggest()->suggest("address",  $dataCityQuery);
        $data = array_merge($dataCity, $dataSettlement);

        return $data;
    }

    /**
     * Return street suggestions
     * @param string $query
     * @param string $region
     * @param int $count
     * @return array
     */
    public function suggestStreet(string $query = "", string $region = "", int $count = 10):array
    {

        $data = [
            "query" => $query,
            "from_bound" => ["value" => "street"],
            "to_bound" => ["value" => "street"],
            "locations"=> [[ "region" => $region]],
            "count" => $count
        ];
        return $this->getSuggest()->suggest("address", $data);
    }

    /**
     * Return house suggestions
     * @param string $query
     * @param string $street_fias_id
     * @param int $count
     * @return array
     */
    public function suggestHouse(string $query = "", string $street_fias_id = "", int $count = 10):array
    {
        $data = [
            "query" => $query,
            "from_bound" => ["value" => "house"],
            "to_bound" => ["value" => "house"],
            "locations" => [[ "street_fias_id" => $street_fias_id]],
            "count" => $count
        ];
        return $this->getSuggest()->suggest("address", $data);
    }


    /**
     * Clean address
     * @param string $address
     * @return array
     */
    public function cleanAddress(string $address):array
    {
        $result = $this->getClean()->clean("address", $address);
        return $result;
    }

    /**
     * Return countries suggestions
     * @param string $query
     * @param int $count
     * @return array
     */
    public function suggestCountry(string $query, int $count = 10):array
    {
        $data = [
            "query" => $query,
            "from_bound" => ["value" => "country"],
            "to_bound" => ["value" => "country"],
            "locations"=> ["country_iso_code" => "*"],
            "count" => $count
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
     * {
     *       "suggestions": [
     *           {
     *               "value": "3100400100000",
     *               "unrestricted_value": "fe7eea4a-875a-4235-aa61-81c2a37a0440",
     *               "data": {
     *                   "kladr_id": "3100400100000",
     *                   "fias_id": "fe7eea4a-875a-4235-aa61-81c2a37a0440",
     *                   "boxberry_id": "01929",
     *                   "cdek_id": "344",
     *                   "dpd_id": "196006461"
     *               }
     *           }
     *       ]
     *   }
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

    /**
     * Get the Clean instance
     * @return Suggestions
     */
    private function getClean(): Clean
    {
        if (!$this->clean) {
            $this->clean = new Clean(config("dadataapi.token", ""), config("dadataapi.secret", ""));
            $this->clean->init();
        }
        return $this->clean;
    }
}
