<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\DTOCollection;

/**
 * @extends DTOCollection<CompanySuggestionDTO>
 */
final class CompanySuggestionCollection extends DTOCollection
{
    protected static function createDTO(array $array): CompanySuggestionDTO
    {
        return CompanySuggestionDTO::fromArray($array);
    }
}
