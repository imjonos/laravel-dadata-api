<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyFinanceDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $taxSystem,
        public ?int $income,
        public ?int $expense,
        public ?int $revenue,
        public ?int $debt,
        public ?int $penalty,
        public ?int $year,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            taxSystem: $data['tax_system'] ?? null,
            income: isset($data['income']) ? (int) $data['income'] : null,
            expense: isset($data['expense']) ? (int) $data['expense'] : null,
            revenue: isset($data['revenue']) ? (int) $data['revenue'] : null,
            debt: isset($data['debt']) ? (int) $data['debt'] : null,
            penalty: isset($data['penalty']) ? (int) $data['penalty'] : null,
            year: isset($data['year']) ? (int) $data['year'] : null,
        );
    }
}
