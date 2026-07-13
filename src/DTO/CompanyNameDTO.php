<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyNameDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $fullWithOpf,
        public ?string $shortWithOpf,
        public ?string $latin,
        public ?string $full,
        public ?string $short,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            fullWithOpf: $data['full_with_opf'] ?? null,
            shortWithOpf: $data['short_with_opf'] ?? null,
            latin: $data['latin'] ?? null,
            full: $data['full'] ?? null,
            short: $data['short'] ?? null,
        );
    }
}
