<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class SuggestionDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public string $value,
        public string $unrestrictedValue,
        public ?SuggestionDataDTO $data = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            value: $data['value'] ?? '',
            unrestrictedValue: $data['unrestricted_value'] ?? '',
            data: isset($data['data']) ? SuggestionDataDTO::fromArray($data['data']) : null,
        );
    }
}