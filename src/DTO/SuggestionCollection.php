<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\DTOCollection;

final class SuggestionCollection extends DTOCollection
{
    protected static function createDTO(array $array): SuggestionDTO
    {
        return SuggestionDTO::fromArray($array);
    }
}