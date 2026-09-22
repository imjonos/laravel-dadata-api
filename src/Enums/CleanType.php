<?php

declare(strict_types=1);

namespace Nos\DadataApi\Enums;

enum CleanType: string
{
    case ADDRESS = 'address';
    case PHONE = 'phone';
}