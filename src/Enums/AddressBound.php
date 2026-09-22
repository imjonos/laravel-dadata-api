<?php

declare(strict_types=1);

namespace Nos\DadataApi\Enums;

enum AddressBound: string
{
    case COUNTRY = 'country';
    case CITY = 'city';
    case SETTLEMENT = 'settlement';
    case STREET = 'street';
    case HOUSE = 'house';
}