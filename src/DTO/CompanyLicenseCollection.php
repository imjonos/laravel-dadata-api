<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\DTOCollection;

/**
 * @extends DTOCollection<CompanyLicenseDTO>
 */
final class CompanyLicenseCollection extends DTOCollection implements \JsonSerializable
{
    protected static function createDTO(array $array): CompanyLicenseDTO
    {
        return CompanyLicenseDTO::fromArray($array);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function jsonSerialize(): array
    {
        return $this->map(
            static fn(CompanyLicenseDTO $license): array => $license->toArray()
        );
    }
}
