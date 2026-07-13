<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyCapitalDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $type,
        public ?float $value,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            type: $data['type'] ?? null,
            value: isset($data['value']) ? (float) $data['value'] : null,
        );
    }
}
