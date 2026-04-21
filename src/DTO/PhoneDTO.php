<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class PhoneDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public string $source,
        public string $type,
        public string $phone,
        public string $countryCode,
        public string $cityCode,
        public string $number,
        public string $extension,
        public string $provider,
        public string $country,
        public string $region,
        public string $timezone,
        public string $qcConflicting,
        public string $qcGeo,
        public string $qc,
        public string $unrestrictedValue,
        public string $qualityCheck,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            source: $data['source'] ?? '',
            type: $data['type'] ?? '',
            phone: $data['phone'] ?? '',
            countryCode: $data['country_code'] ?? '',
            cityCode: $data['city_code'] ?? '',
            number: $data['number'] ?? '',
            extension: $data['extension'] ?? '',
            provider: $data['provider'] ?? '',
            country: $data['country'] ?? '',
            region: $data['region'] ?? '',
            timezone: $data['timezone'] ?? '',
            qcConflicting: $data['qc_conflicting'] ?? '',
            qcGeo: $data['qc_geo'] ?? '',
            qc: $data['qc'] ?? '',
            unrestrictedValue: $data['unrestricted_value'] ?? '',
            qualityCheck: $data['quality_check'] ?? '',
        );
    }
}