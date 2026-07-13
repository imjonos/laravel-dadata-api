<?php

declare(strict_types=1);

namespace Tests\Unit;

use Nos\DadataApi\DTO\AddressDTO;
use PHPUnit\Framework\TestCase;

class AddressDTOTest extends TestCase
{
    public function testItFallsBackToValueForSuggestionPayloads(): void
    {
        $dto = AddressDTO::fromArray([
            'source' => 'Москва',
            'value' => 'г Москва, ул Тверская, д 1',
            'unrestricted_value' => 'г Москва, ул Тверская, д 1, Россия',
            'country' => 'Россия',
            'country_iso_code' => 'RU',
            'region_fias_id' => '',
            'region_kladr_id' => '',
            'region_with_type' => '',
            'region_type' => '',
            'region' => '',
            'street_fias_id' => '',
            'street_kladr_id' => '',
            'street_with_type' => '',
            'street_type' => '',
            'street' => '',
            'house_fias_id' => '',
            'house_kladr_id' => '',
            'house_type' => '',
            'house' => '',
            'fias_id' => '',
            'fias_level' => '',
            'fias_actuality_state' => '',
            'kladr_id' => '',
            'qc_geo' => 0,
            'qc_complete' => 0,
            'qc_house' => 0,
            'qc' => 0,
        ]);

        self::assertSame('г Москва, ул Тверская, д 1', $dto->result);
    }
}
