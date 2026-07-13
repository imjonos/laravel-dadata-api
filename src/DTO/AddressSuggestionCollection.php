<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\DTOCollection;

/**
 * @extends DTOCollection<AddressSuggestionDTO>
 */
final class AddressSuggestionCollection extends DTOCollection
{
    protected static function createDTO(array $array): AddressSuggestionDTO
    {
        return AddressSuggestionDTO::fromArray($array);
    }
}
