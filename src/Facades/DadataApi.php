<?php

declare(strict_types=1);

namespace Nos\DadataApi\Facades;

use Illuminate\Support\Facades\Facade;
use Nos\DadataApi\DTO\AddressDTO;
use Nos\DadataApi\DTO\PhoneDTO;
use Nos\DadataApi\DTO\AddressSuggestionCollection;
use Nos\DadataApi\DTO\CompanySuggestionCollection;

/**
 * @method static AddressSuggestionCollection suggestCity(string $query = '', array $countryCodeISO = ['*'], int $count = 10)
 * @method static AddressSuggestionCollection suggestStreet(string $query = '', string $fiasId = '', int $count = 10)
 * @method static AddressSuggestionCollection suggestHouse(string $query = '', string $streetFiasId = '', int $count = 10)
 * @method static AddressSuggestionCollection suggestCountry(string $query, int $count = 10)
 * @method static AddressSuggestionCollection suggestAddress(string $query, ?string $fiasId = null)
 * @method static AddressSuggestionCollection suggestBank(string $query)
 * @method static AddressSuggestionCollection suggestDeliveryId(string $kladrId)
 * @method static AddressSuggestionCollection suggestAddressById(string $fiasId)
 * @method static CompanySuggestionCollection suggestCompany(string $inn)
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
