<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyManagementDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $name,
        public ?string $post,
        public ?int $startDate,
        public ?bool $disqualified,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            post: $data['post'] ?? null,
            startDate: isset($data['start_date']) ? (int) $data['start_date'] : null,
            disqualified: $data['disqualified'] ?? null,
        );
    }
}
