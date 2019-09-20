<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

namespace Tests\Feature;

use Tests\TestCase;
use CodersStudio\DadataApi\Facades\DadataApi;

class SuggestionTest extends TestCase
{
    public function testCities()
    {
        $result = DadataApi::suggestCity("Москва");
        $this->assertArray($result, ['suggestions' => [["value" => "Россия, г Москва"]]]);
    }

    public function testCountries()
    {
        $result = DadataApi::suggestCountry("Россия");
        $this->assertArray($result, ['suggestions' => [["value" => "Россия", "unrestricted_value" => "Россия"]]]);
    }

    /**
     * Method for assert Array
     * @param array $array1
     * @param array $array2
     */
    private function assertArray(Array $array1, Array $array2): void
    {
        $this->assertJson(json_encode($array1), json_encode($array2));
    }

}
