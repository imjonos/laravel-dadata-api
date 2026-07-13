<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyPhoneDataDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $source,
        public ?string $type,
        public ?string $number,
        public ?string $provider,
        public ?string $countryCode,
        public ?string $cityCode,
        public ?string $timezone,
        public ?string $extension,
        public ?string $qc,
        public ?string $qcConflict,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            source: $data['source'] ?? null,
            type: $data['type'] ?? null,
            number: $data['number'] ?? null,
            provider: $data['provider'] ?? null,
            countryCode: $data['country_code'] ?? null,
            cityCode: $data['city_code'] ?? null,
            timezone: $data['timezone'] ?? null,
            extension: $data['extension'] ?? null,
            qc: isset($data['qc']) ? (string) $data['qc'] : null,
            qcConflict: $data['qc_conflict'] ?? null,
        );
    }
}
