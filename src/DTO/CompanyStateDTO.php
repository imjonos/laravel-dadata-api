<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyStateDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $status,
        public ?string $code,
        public ?int $actualityDate,
        public ?int $registrationDate,
        public ?int $liquidationDate,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: $data['status'] ?? null,
            code: $data['code'] ?? null,
            actualityDate: isset($data['actuality_date']) ? (int) $data['actuality_date'] : null,
            registrationDate: isset($data['registration_date']) ? (int) $data['registration_date'] : null,
            liquidationDate: isset($data['liquidation_date']) ? (int) $data['liquidation_date'] : null,
        );
    }
}
