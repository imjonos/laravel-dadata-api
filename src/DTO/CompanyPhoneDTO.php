<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyPhoneDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $value,
        public ?string $unrestrictedValue,
        public ?CompanyPhoneDataDTO $data,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            value: $data['value'] ?? null,
            unrestrictedValue: $data['unrestricted_value'] ?? null,
            data: isset($data['data']) && is_array($data['data'])
                ? CompanyPhoneDataDTO::fromArray($data['data'])
                : null,
        );
    }
}
