<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

namespace Tests\Feature;

use phpDocumentor\Reflection\Types\Integer;
use Tests\TestCase;
use CodersStudio\DadataApi\Facades\DadataApi;

class SuggestionTest extends TestCase
{
    /**
     * Test for suggest city method
     */
    public function testCities()
    {
        $result = DadataApi::suggestCity("Москва");
        $this->assertSuggestion($result, "Россия, г Москва", 10);
    }

    /**
     * Test for suggest country method
     */
    public function testCountries()
    {
        $result = DadataApi::suggestCountry("Россия");
        $this->assertSuggestion($result, "Россия");
    }

    /**
     * Test for suggest street method
     */
    public function testStreet()
    {
        $result = DadataApi::suggestStreet("Мира", "0c5b2444-70a0-4932-980c-b4dc0d3f02b5");
        $this->assertSuggestion($result, "г Москва, пр-кт Мира", 10);
    }

    /**
     * Test for suggest house method
     */
    public function testHouse()
    {
        $result = DadataApi::suggestHouse("1", "6df62ddd-df70-4cd2-9a44-04ed037368d8");
        $this->assertSuggestion($result, "г Москва, ул Мира, д 1", 10);
    }

    /**
     * Test for suggest city id method findById/delivery
     */
    public function testDeliveryId()
    {
        $result = DadataApi::suggestDeliveryId(/*kladr_id*/ "3100400100000");
        $this->assertSuggestion($result, "3100400100000");
    }

    /**
     * Test for suggest address by Id
     */
    public function testAddressById()
    {
        $result = DadataApi::suggestAddressById("6df62ddd-df70-4cd2-9a44-04ed037368d8");
        $this->assertSuggestion($result, "г Москва, ул Мира");
    }

    /**
     * Test for suggest bank information
     */
    public function testBank()
    {
        $result = DadataApi::suggestBank("сбербанк");
        $this->assertSuggestion($result, "СБЕРБАНК РОССИИ", 10);
    }

    /**
     * Test for suggest bank information
     */
    public function testCompany()
    {
        $result = DadataApi::suggestCompany("7707083893");
        $this->assertSuggestion($result, "ПАО СБЕРБАНК", 10);
    }


    /**
     * Assert Suggestion result
     * @param array $result
     * @param string $value
     * @param int $count
     */
    private function assertSuggestion(array $result, string $value, int $count = 1):void
    {
        $this->assertEquals(true, is_array($result));
        $this->assertArrayHasKey('suggestions', $result);
        $this->assertEquals($count, count($result['suggestions']));
        $this->assertArrayHasKey('value', $result['suggestions'][0]);
        $this->assertEquals($value, $result['suggestions'][0]['value']);
    }
}
