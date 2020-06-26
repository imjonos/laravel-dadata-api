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

        $data = [
            "query" => $query,
            "from_bound" => ["value" => "city"],
            "to_bound" => ["value" => "settlement"],
            "locations"=> $countries,
            "count" => $count
        ];
        $result = $this->getSuggest()->suggest("address",  $data);
        return ($result)?$result:[];
    }

    /**
     * Return street suggestions
     * @param string $query
     * @param string $region
     * @param int $count
     * @return array
     */
    public function suggestStreet(string $query = "", string $fiasId = "", int $count = 10):array
    {

        $data = [
            "query" => $query,
            "from_bound" => ["value" => "street"],
            "to_bound" => ["value" => "street"],
            "locations"=> [[ "city_fias_id" => $fiasId], [ "settlement_fias_id" => $fiasId]],
            "count" => $count
        ];
        $result = $this->getSuggest()->suggest("address", $data);
        return ($result)?$result:[];
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
        $result = $this->getSuggest()->suggest("address",  $data);
        return ($result)?$result:[];
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
     * Clean phone number
     * @param string $address
     * @return array
     */
    public function cleanPhone(string $phone):array
    {
        $result = $this->getClean()->clean("phone", $phone);
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
            "locations"=> [
                ["country_iso_code" => "*"]
            ],
            "count" => $count
        ];
        $result = $this->getSuggest()->suggest("address",  $data);
        return ($result)?$result:[];
    }

    /**
     * Return addresses suggestions
     * @param string $query
     * @param string $fiasId
     * @return array
     */
    public function suggestAddress(string $query, ?string $fiasId = null):array
    {
        $data = [
            "query" => $query
        ];
        if ($fiasId) {
            $data["locations"] = [
                [ "city_fias_id" => $fiasId],
                [ "settlement_fias_id" => $fiasId]
            ];
        }
        $result = $this->getSuggest()->suggest("address",  $data);
        return ($result)?$result:[];
    }

    /**
     * Return bank suggestions
     * @param string $query
     * @return array
     */
    public function suggestBank(string $query):array
    {
        $data = [
            "query" => $query
        ];
        $result = $this->getSuggest()->suggest("bank",  $data);
        return ($result)?$result:[];
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
        
        $result = $this->getSuggest()->findById("delivery", $data);
        return ($result)?$result:[];
    }

    /**
     *Suggest address by fias Id
     * @param string $fiasId
     * @return array
     */
    public function suggestAddressById(string $fiasId):array
    {
        $data = [
            "query" => $fiasId
        ];
        $result = $this->getSuggest()->findById("address", $data);
        return ($result)?$result:[];
    }

    /**
     * Suggest company by inn
     * @param string $inn
     * @return array
     */
    public function suggestCompany(string $inn):array
    {
        $data = [
            "query" => $inn
        ];
        $result = $this->getSuggest()->findById("party", $data);
        return ($result)?$result:[];
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
