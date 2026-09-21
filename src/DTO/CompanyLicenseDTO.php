<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanyLicenseDTO implements DtoInterface
{
    use ArrayDataTransformable;

    /**
     * @param array<int, string|array<string, mixed>>|null $activities
     * @param array<int, array<string, mixed>>|null $addresses
     */
    private function __construct(
        public ?string $series,
        public ?string $number,
        public ?int $issueDate,
        public ?string $issueAuthority,
        public ?int $suspendDate,
        public ?string $suspendAuthority,
        public ?int $validFrom,
        public ?int $validTo,
        public ?array $activities,
        public ?array $addresses,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            series: $data['series'] ?? null,
            number: $data['number'] ?? null,
            issueDate: isset($data['issue_date']) ? (int) $data['issue_date'] : null,
            issueAuthority: $data['issue_authority'] ?? null,
            suspendDate: isset($data['suspend_date']) ? (int) $data['suspend_date'] : null,
            suspendAuthority: $data['suspend_authority'] ?? null,
            validFrom: isset($data['valid_from']) ? (int) $data['valid_from'] : null,
            validTo: isset($data['valid_to']) ? (int) $data['valid_to'] : null,
            activities: isset($data['activities']) && is_array($data['activities']) ? $data['activities'] : null,
            addresses: isset($data['addresses']) && is_array($data['addresses']) ? $data['addresses'] : null,
        );
    }
}
