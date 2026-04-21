<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class MetroDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public float $distance,
        public string $line,
        public string $name,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            distance: (float) ($data['distance'] ?? 0),
            line: $data['line'] ?? '',
            name: $data['name'] ?? '',
        );
    }
}