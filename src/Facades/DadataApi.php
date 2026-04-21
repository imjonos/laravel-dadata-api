<?php

declare(strict_types=1);

namespace Nos\DadataApi\Facades;

use Illuminate\Support\Facades\Facade;
use Nos\DadataApi\DTO\AddressDTO;
use Nos\DadataApi\DTO\PhoneDTO;
use Nos\DadataApi\DTO\SuggestionCollection;

/**
 * @method static SuggestionCollection suggestCity(string $query = '', array $countryCodeISO = ['*'], int $count = 10)
 * @method static SuggestionCollection suggestStreet(string $query = '', string $fiasId = '', int $count = 10)
 * @method static SuggestionCollection suggestHouse(string $query = '', string $streetFiasId = '', int $count = 10)
 * @method static SuggestionCollection suggestCountry(string $query, int $count = 10)
 * @method static SuggestionCollection suggestAddress(string $query, ?string $fiasId = null)
 * @method static SuggestionCollection suggestBank(string $query)
 * @method static SuggestionCollection suggestDeliveryId(string $kladrId)
 * @method static SuggestionCollection suggestAddressById(string $fiasId)
 * @method static SuggestionCollection suggestCompany(string $inn)
 * @method static AddressDTO cleanAddress(string $address)
 * @method static PhoneDTO cleanPhone(string $phone)
 *
 * @see \Nos\DadataApi\DadataApi
 */
class DadataApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'dadataapi';
    }
}