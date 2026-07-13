<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyEmailDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $value,
        public ?string $unrestrictedValue,
        public ?string $local,
        public ?string $domain,
        public ?string $type,
    ) {}

    public static function fromArray(array $data): self
    {
        $payload = is_array($data['data'] ?? null) ? $data['data'] : [];

        return new self(
            value: $data['value'] ?? null,
            unrestrictedValue: $data['unrestricted_value'] ?? null,
            local: $payload['local'] ?? null,
            domain: $payload['domain'] ?? null,
            type: $payload['type'] ?? null,
        );
    }
}
