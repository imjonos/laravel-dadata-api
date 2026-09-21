<?php

declare(strict_types=1);

namespace Tests\Unit;

use Nos\DadataApi\DadataApi;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

final class DadataApiTest extends TestCase
{
    public function testCompanySearchRequestsTheMainOrganizationOnly(): void
    {
        $api = new DadataApi();

        $fieldsMethod = new ReflectionMethod(DadataApi::class, 'buildCompanySearchFields');

        self::assertSame([
            'query' => '7706107510',
            'count' => 1,
            'branch_type' => 'MAIN',
        ], $fieldsMethod->invoke($api, '7706107510'));
    }
}
