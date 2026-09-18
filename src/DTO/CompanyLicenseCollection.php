<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\DTOCollection;

/**
 * @extends DTOCollection<CompanyLicenseDTO>
 */
final class CompanyLicenseCollection extends DTOCollection
{
    protected static function createDTO(array $array): CompanyLicenseDTO
    {
        return CompanyLicenseDTO::fromArray($array);
    }
}
