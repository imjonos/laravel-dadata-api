<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyOpfDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $type,
        public ?string $code,
        public ?string $full,
        public ?string $short,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            type: $data['type'] ?? null,
            code: $data['code'] ?? null,
            full: $data['full'] ?? null,
            short: $data['short'] ?? null,
        );
    }
}
