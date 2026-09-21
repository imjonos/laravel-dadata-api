<?php

declare(strict_types=1);

namespace Tests\Unit;

use Nos\DadataApi\DTO\CompanyLicenseCollection;
use Nos\DadataApi\DTO\CompanyLicenseDTO;
use Nos\DadataApi\DTO\CompanySuggestionDTO;
use PHPUnit\Framework\TestCase;

class CompanySuggestionDTOTest extends TestCase
{
    public function testItMapsLicenseData(): void
    {
        $dto = CompanySuggestionDTO::fromArray([
            'value' => 'ООО Ромашка',
            'unrestricted_value' => 'ООО Ромашка',
            'data' => [
                'licenses' => [[
                    'series' => 'АБ',
                    'number' => '123456',
                    'issue_date' => 1705276800000,
                    'issue_authority' => 'Лицензирующий орган',
                    'suspend_date' => 1711929600000,
                    'suspend_authority' => 'Орган приостановки',
                    'valid_from' => 1706745600000,
                    'valid_to' => 1861920000000,
                    'activities' => [['name' => 'Деятельность']],
                    'addresses' => [['value' => 'г. Москва']],
                ]],
            ],
        ]);

        $licenses = $dto->licenses;
        self::assertInstanceOf(CompanyLicenseCollection::class, $licenses);
        $license = $licenses->findByKey(0);
        self::assertInstanceOf(CompanyLicenseDTO::class, $license);
        self::assertSame('АБ', $license->series);
        self::assertSame('123456', $license->number);
        self::assertSame(1705276800000, $license->issueDate);
        self::assertSame('Лицензирующий орган', $license->issueAuthority);
        self::assertSame(1711929600000, $license->suspendDate);
        self::assertSame('Орган приостановки', $license->suspendAuthority);
        self::assertSame(1706745600000, $license->validFrom);
        self::assertSame(1861920000000, $license->validTo);
        self::assertSame([['name' => 'Деятельность']], $license->activities);
        self::assertSame([['value' => 'г. Москва']], $license->addresses);
    }
}
