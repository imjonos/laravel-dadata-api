<?php

declare(strict_types=1);

namespace Nos\DadataApi;

use Nos\DadataApi\Classes\Clean;
use Nos\DadataApi\Classes\Suggestions;
use Nos\DadataApi\DTO\AddressDTO;
use Nos\DadataApi\DTO\AddressSuggestionCollection;
use Nos\DadataApi\DTO\CompanySuggestionCollection;
use Nos\DadataApi\DTO\PhoneDTO;
use Nos\DadataApi\Enums\AddressBound;
use Nos\DadataApi\Enums\CleanType;
use Nos\DadataApi\Enums\SuggestType;

final class DadataApi
{
    private ?Suggestions $suggest = null;
    private ?Clean $clean = null;

    public function suggestCity(string $query = '', array $countryCodeISO = ['*'], int $count = 10): AddressSuggestionCollection
    {
        $countries = array_map(
            static fn(string $item): array => ['country_iso_code' => $item],
            $countryCodeISO
        );

        $data = [
            'query' => $query,
            'from_bound' => ['value' => AddressBound::CITY->value],
            'to_bound' => ['value' => AddressBound::SETTLEMENT->value],
            'locations' => $countries,
            'count' => $count,
        ];
        $result = $this->getSuggest()->suggest(SuggestType::ADDRESS, $data);
        return $this->mapToAddressSuggestionCollection($result);
    }

    public function suggestStreet(string $query = '', string $fiasId = '', int $count = 10): AddressSuggestionCollection
    {
        $data = [
            'query' => $query,
            'from_bound' => ['value' => AddressBound::STREET->value],
            'to_bound' => ['value' => AddressBound::STREET->value],
            'locations' => [
                ['city_fias_id' => $fiasId],
                ['settlement_fias_id' => $fiasId],
            ],
            'count' => $count,
        ];
        $result = $this->getSuggest()->suggest(SuggestType::ADDRESS, $data);
        return $this->mapToAddressSuggestionCollection($result);
    }

    public function suggestHouse(string $query = '', string $streetFiasId = '', int $count = 10): AddressSuggestionCollection
    {
        $data = [
            'query' => $query,
            'from_bound' => ['value' => AddressBound::HOUSE->value],
            'to_bound' => ['value' => AddressBound::HOUSE->value],
            'locations' => [['street_fias_id' => $streetFiasId]],
            'count' => $count,
        ];
        $result = $this->getSuggest()->suggest(SuggestType::ADDRESS, $data);
        return $this->mapToAddressSuggestionCollection($result);
    }

    public function cleanAddress(string $address): AddressDTO
    {
        $result = $this->getClean()->clean(CleanType::ADDRESS, $address);
        if (empty($result)) {
            throw new \RuntimeException('Address cleaning returned empty result');
        }
        return AddressDTO::fromArray($result[0]);
    }

    public function cleanPhone(string $phone): PhoneDTO
    {
        $result = $this->getClean()->clean(CleanType::PHONE, $phone);
        if (empty($result)) {
            throw new \RuntimeException('Phone cleaning returned empty result');
        }
        return PhoneDTO::fromArray($result[0]);
    }

    public function suggestCountry(string $query, int $count = 10): AddressSuggestionCollection
    {
        $data = [
            'query' => $query,
            'from_bound' => ['value' => AddressBound::COUNTRY->value],
            'to_bound' => ['value' => AddressBound::COUNTRY->value],
            'locations' => [
                ['country_iso_code' => '*'],
            ],
            'count' => $count,
        ];
        $result = $this->getSuggest()->suggest(SuggestType::ADDRESS, $data);
        return $this->mapToAddressSuggestionCollection($result);
    }

    public function suggestAddress(string $query, ?string $fiasId = null): AddressSuggestionCollection
    {
        $data = [
            'query' => $query,
        ];
        if ($fiasId !== null) {
            $data['locations'] = [
                ['city_fias_id' => $fiasId],
                ['settlement_fias_id' => $fiasId],
            ];
        }
        $result = $this->getSuggest()->suggest(SuggestType::ADDRESS, $data);
        return $this->mapToAddressSuggestionCollection($result);
    }

    public function suggestBank(string $query): AddressSuggestionCollection
    {
        $data = [
            'query' => $query,
        ];
        $result = $this->getSuggest()->suggest(SuggestType::BANK, $data);
        return $this->mapToAddressSuggestionCollection($result);
    }

    public function suggestDeliveryId(string $kladrId): AddressSuggestionCollection
    {
        $data = [
            'query' => $kladrId,
        ];
        $result = $this->getSuggest()->findById(SuggestType::DELIVERY, $data);
        return $this->mapToAddressSuggestionCollection($result);
    }

    public function suggestAddressById(string $fiasId): AddressSuggestionCollection
    {
        $data = [
            'query' => $fiasId,
        ];
        $result = $this->getSuggest()->findById(SuggestType::ADDRESS, $data);
        return $this->mapToAddressSuggestionCollection($result);
    }

    public function suggestCompany(string $inn): CompanySuggestionCollection
    {
        $data = $this->buildCompanySearchFields($inn);
        $result = $this->getSuggest()->findById(SuggestType::PARTY, $data);
        return $this->mapToCompanySuggestionCollection($result);
    }

    /**
     * @return array<string, int|string>
     */
    private function buildCompanySearchFields(string $inn): array
    {
        return [
            'query' => $inn,
        ];
    }

    private function mapToAddressSuggestionCollection(?array $result): AddressSuggestionCollection
    {
        if ($result === null || !isset($result['suggestions'])) {
            return new AddressSuggestionCollection();
        }
        return AddressSuggestionCollection::fromArray($result['suggestions']);
    }

    private function mapToCompanySuggestionCollection(?array $result): CompanySuggestionCollection
    {
        if ($result === null || !isset($result['suggestions'])) {
            return new CompanySuggestionCollection();
        }
        return CompanySuggestionCollection::fromArray($result['suggestions']);
    }

    private function getSuggest(): Suggestions
    {
        if ($this->suggest === null) {
            $this->suggest = new Suggestions((string) config('dadataapi.token', ''));
            $this->suggest->init();
        }
        return $this->suggest;
    }

    private function getClean(): Clean
    {
        if ($this->clean === null) {
            $this->clean = new Clean(
                (string) config('dadataapi.token', ''),
                (string) config('dadataapi.secret', '')
            );
            $this->clean->init();
        }
        return $this->clean;
    }
}
