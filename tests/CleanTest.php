<?php

declare(strict_types=1);

namespace Tests\Feature;

use Nos\DadataApi\Facades\DadataApi;
use Nos\DadataApi\DTO\AddressDTO;
use Tests\TestCase;

class CleanTest extends TestCase
{
    public function testAddress(): void
    {
        $result = DadataApi::cleanAddress('Ставрополь Мира 123');
        self::assertInstanceOf(AddressDTO::class, $result);
        self::assertEquals('г Ставрополь, ул Мира, д 123', $result->result);
    }

    public function testPhone(): void
    {
        $result = DadataApi::cleanPhone('(8553)38-88-35 вн.74-35; 8-917-238-07-84');
        self::assertInstanceOf(\Nos\DadataApi\DTO\PhoneDTO::class, $result);
        self::assertEquals('+7 8553 38-88-35 доб. 7435', $result->phone);
    }
}