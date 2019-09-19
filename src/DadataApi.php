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
     * @return array
     */
    public function suggestCity(string $query):array
    {
        $data = [
            "query" => $query,
            "from_bound" => ["value" => "city"],
            "to_bound" => ["value" => "city"]
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
            "to_bound" => ["value" => "country"]
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
