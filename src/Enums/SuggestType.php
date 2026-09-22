<?php

declare(strict_types=1);

namespace Nos\DadataApi\Enums;

enum SuggestType: string
{
    case ADDRESS = 'address';
    case PARTY = 'party';
    case BANK = 'bank';
    case DELIVERY = 'delivery';
}