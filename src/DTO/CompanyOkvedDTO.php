<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyOkvedDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public bool $main,
        public ?string $type,
        public ?string $code,
        public ?string $name,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            main: (bool) ($data['main'] ?? false),
            type: $data['type'] ?? null,
            code: $data['code'] ?? null,
            name: $data['name'] ?? null,
        );
    }
}
