<?php

declare(strict_types=1);

namespace Tests\Feature;

use Nos\DadataApi\Facades\DadataApi;
use Nos\DadataApi\DTO\AddressSuggestionCollection;
use Nos\DadataApi\DTO\AddressSuggestionDTO;
use Nos\DadataApi\DTO\CompanySuggestionCollection;
use Nos\DadataApi\DTO\CompanySuggestionDTO;
use Tests\TestCase;

class SuggestionTest extends TestCase
{
    public function testCities(): void
    {
        $result = DadataApi::suggestCity('Москва');
        self::assertInstanceOf(AddressSuggestionCollection::class, $result);
        self::assertGreaterThanOrEqual(1, $result->count());

        $first = $result->first();
        self::assertInstanceOf(AddressSuggestionDTO::class, $first);
        self::assertEquals('Россия, г Москва', $first->value);
    }

    public function testCountries(): void
    {
        $result = DadataApi::suggestCountry('Россия');
        self::assertInstanceOf(AddressSuggestionCollection::class, $result);

        $first = $result->first();
        self::assertInstanceOf(AddressSuggestionDTO::class, $first);
        self::assertEquals('Россия', $first->value);
    }

    public function testStreet(): void
    {
        $result = DadataApi::suggestStreet('Мира', '0c5b2444-70a0-4932-980c-b4dc0d3f02b5');
        self::assertInstanceOf(AddressSuggestionCollection::class, $result);

        $first = $result->first();
        self::assertInstanceOf(AddressSuggestionDTO::class, $first);
        self::assertEquals('г Москва, пр-кт Мира', $first->value);
    }

    public function testHouse(): void
    {
        $result = DadataApi::suggestHouse('1', '6df62ddd-df70-4cd2-9a44-04ed037368d8');
        self::assertInstanceOf(AddressSuggestionCollection::class, $result);

        $first = $result->first();
        self::assertInstanceOf(AddressSuggestionDTO::class, $first);
        self::assertEquals('г Москва, ул Мира, д 1', $first->value);
    }

    public function testDeliveryId(): void
    {
        $result = DadataApi::suggestDeliveryId('3100400100000');
        self::assertInstanceOf(AddressSuggestionCollection::class, $result);

        $first = $result->first();
        self::assertInstanceOf(AddressSuggestionDTO::class, $first);
        self::assertEquals('3100400100000', $first->value);
    }

    public function testAddressById(): void
    {
        $result = DadataApi::suggestAddressById('6df62ddd-df70-4cd2-9a44-04ed037368d8');
        self::assertInstanceOf(AddressSuggestionCollection::class, $result);

        $first = $result->first();
        self::assertInstanceOf(AddressSuggestionDTO::class, $first);
        self::assertEquals('г Москва, ул Мира', $first->value);
    }

    public function testBank(): void
    {
        $result = DadataApi::suggestBank('сбербанк');
        self::assertInstanceOf(AddressSuggestionCollection::class, $result);

        $first = $result->first();
        self::assertInstanceOf(AddressSuggestionDTO::class, $first);
        self::assertEquals('СБЕРБАНК РОССИИ', $first->value);
    }

    public function testCompany(): void
    {
        $result = DadataApi::suggestCompany('7707083893');
        self::assertInstanceOf(CompanySuggestionCollection::class, $result);

        $first = $result->first();
        self::assertInstanceOf(CompanySuggestionDTO::class, $first);
        self::assertEquals('ПАО СБЕРБАНК', $first->value);
        self::assertNotEmpty($first->kpp);
        self::assertEquals('7707083893', $first->inn ?? null);
        self::assertNotEmpty($first->okpo);
    }
}
