<?php

declare(strict_types=1);

namespace Nos\DadataApi;

use Nos\DadataApi\Classes\Clean;
use Nos\DadataApi\Classes\Suggestions;
use Nos\DadataApi\DTO\AddressDTO;
use Nos\DadataApi\DTO\PhoneDTO;
use Nos\DadataApi\DTO\SuggestionCollection;

final class DadataApi
{
    private ?Suggestions $suggest = null;
    private ?Clean $clean = null;

    public function suggestCity(string $query = '', array $countryCodeISO = ['*'], int $count = 10): SuggestionCollection
    {
        $countries = array_map(
            static fn(string $item): array => ['country_iso_code' => $item],
            $countryCodeISO
        );

        $data = [
            'query' => $query,
            'from_bound' => ['value' => 'city'],
            'to_bound' => ['value' => 'settlement'],
            'locations' => $countries,
            'count' => $count,
        ];
        $result = $this->getSuggest()->suggest('address', $data);
        return $this->mapToSuggestionCollection($result);
    }

    public function suggestStreet(string $query = '', string $fiasId = '', int $count = 10): SuggestionCollection
    {
        $data = [
            'query' => $query,
            'from_bound' => ['value' => 'street'],
            'to_bound' => ['value' => 'street'],
            'locations' => [
                ['city_fias_id' => $fiasId],
                ['settlement_fias_id' => $fiasId],
            ],
            'count' => $count,
        ];
        $result = $this->getSuggest()->suggest('address', $data);
        return $this->mapToSuggestionCollection($result);
    }

    public function suggestHouse(string $query = '', string $streetFiasId = '', int $count = 10): SuggestionCollection
    {
        $data = [
            'query' => $query,
            'from_bound' => ['value' => 'house'],
            'to_bound' => ['value' => 'house'],
            'locations' => [['street_fias_id' => $streetFiasId]],
            'count' => $count,
        ];
        $result = $this->getSuggest()->suggest('address', $data);
        return $this->mapToSuggestionCollection($result);
    }

    public function cleanAddress(string $address): AddressDTO
    {
        $result = $this->getClean()->clean('address', $address);
        if (empty($result)) {
            throw new \RuntimeException('Address cleaning returned empty result');
        }
        return AddressDTO::fromArray($result[0]);
    }

    public function cleanPhone(string $phone): PhoneDTO
    {
        $result = $this->getClean()->clean('phone', $phone);
        if (empty($result)) {
            throw new \RuntimeException('Phone cleaning returned empty result');
        }
        return PhoneDTO::fromArray($result[0]);
    }

    public function suggestCountry(string $query, int $count = 10): SuggestionCollection
    {
        $data = [
            'query' => $query,
            'from_bound' => ['value' => 'country'],
            'to_bound' => ['value' => 'country'],
            'locations' => [
                ['country_iso_code' => '*'],
            ],
            'count' => $count,
        ];
        $result = $this->getSuggest()->suggest('address', $data);
        return $this->mapToSuggestionCollection($result);
    }

    public function suggestAddress(string $query, ?string $fiasId = null): SuggestionCollection
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
        $result = $this->getSuggest()->suggest('address', $data);
        return $this->mapToSuggestionCollection($result);
    }

    public function suggestBank(string $query): SuggestionCollection
    {
        $data = [
            'query' => $query,
        ];
        $result = $this->getSuggest()->suggest('bank', $data);
        return $this->mapToSuggestionCollection($result);
    }

    public function suggestDeliveryId(string $kladrId): SuggestionCollection
    {
        $data = [
            'query' => $kladrId,
        ];
        $result = $this->getSuggest()->findById('delivery', $data);
        return $this->mapToSuggestionCollection($result);
    }

    public function suggestAddressById(string $fiasId): SuggestionCollection
    {
        $data = [
            'query' => $fiasId,
        ];
        $result = $this->getSuggest()->findById('address', $data);
        return $this->mapToSuggestionCollection($result);
    }

    public function suggestCompany(string $inn): SuggestionCollection
    {
        $data = [
            'query' => $inn,
        ];
        $result = $this->getSuggest()->findById('party', $data);
        return $this->mapToSuggestionCollection($result);
    }

    private function mapToSuggestionCollection(?array $result): SuggestionCollection
    {
        if ($result === null || !isset($result['suggestions'])) {
            return new SuggestionCollection();
        }
        return SuggestionCollection::fromArray($result['suggestions']);
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