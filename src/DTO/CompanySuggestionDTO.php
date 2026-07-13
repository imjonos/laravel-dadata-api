<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class CompanySuggestionDTO implements DtoInterface
{
    use ArrayDataTransformable;

    /**
     * @param array<int, CompanyOkvedDTO>|null $okveds
     * @param array<int, CompanyPhoneDTO>|null $phones
     * @param array<int, CompanyEmailDTO>|null $emails
     */
    private function __construct(
        public string $value,
        public string $unrestrictedValue,
        public ?string $kpp,
        public ?string $kppLargest,
        public ?CompanyCapitalDTO $capital,
        public ?CompanyManagementDTO $management,
        public ?array $founders,
        public ?array $managers,
        public ?string $branchType,
        public ?int $branchCount,
        public ?string $source,
        public ?string $qc,
        public ?string $hid,
        public ?string $type,
        public ?CompanyStateDTO $state,
        public ?CompanyOpfDTO $opf,
        public ?CompanyNameDTO $name,
        public ?string $inn,
        public ?string $ogrn,
        public ?string $okpo,
        public ?string $okato,
        public ?string $oktmo,
        public ?string $okogu,
        public ?string $okfs,
        public ?string $okved,
        public ?array $okveds,
        public ?CompanyFinanceDTO $finance,
        public ?AddressDTO $address,
        public ?array $phones,
        public ?array $emails,
        public ?array $documents,
        public ?array $authorities,
        public ?array $financeHistory,
        public ?int $employeeCount,
    ) {}

    public static function fromArray(array $data): self
    {
        $payload = is_array($data['data'] ?? null) ? $data['data'] : [];

        $okveds = null;
        if (isset($payload['okveds']) && is_array($payload['okveds'])) {
            $okveds = array_map(
                static fn(array $item): CompanyOkvedDTO => CompanyOkvedDTO::fromArray($item),
                $payload['okveds']
            );
        }

        $phones = null;
        if (isset($payload['phones']) && is_array($payload['phones'])) {
            $phones = array_map(
                static fn(array $item): CompanyPhoneDTO => CompanyPhoneDTO::fromArray($item),
                $payload['phones']
            );
        }

        $emails = null;
        if (isset($payload['emails']) && is_array($payload['emails'])) {
            $emails = array_map(
                static fn(array $item): CompanyEmailDTO => CompanyEmailDTO::fromArray($item),
                $payload['emails']
            );
        }

        $documents = isset($payload['documents']) && is_array($payload['documents']) ? $payload['documents'] : null;
        $authorities = isset($payload['authorities']) && is_array($payload['authorities']) ? $payload['authorities'] : null;
        $financeHistory = isset($payload['finance_history']) && is_array($payload['finance_history']) ? $payload['finance_history'] : null;

        return new self(
            value: $data['value'] ?? '',
            unrestrictedValue: $data['unrestricted_value'] ?? '',
            kpp: $payload['kpp'] ?? null,
            kppLargest: $payload['kpp_largest'] ?? null,
            capital: isset($payload['capital']) && is_array($payload['capital'])
                ? CompanyCapitalDTO::fromArray($payload['capital'])
                : null,
            management: isset($payload['management']) && is_array($payload['management'])
                ? CompanyManagementDTO::fromArray($payload['management'])
                : null,
            founders: isset($payload['founders']) && is_array($payload['founders']) ? $payload['founders'] : null,
            managers: isset($payload['managers']) && is_array($payload['managers']) ? $payload['managers'] : null,
            branchType: $payload['branch_type'] ?? null,
            branchCount: isset($payload['branch_count']) ? (int) $payload['branch_count'] : null,
            source: $payload['source'] ?? null,
            qc: $payload['qc'] ?? null,
            hid: $payload['hid'] ?? null,
            type: $payload['type'] ?? null,
            state: isset($payload['state']) && is_array($payload['state'])
                ? CompanyStateDTO::fromArray($payload['state'])
                : null,
            opf: isset($payload['opf']) && is_array($payload['opf'])
                ? CompanyOpfDTO::fromArray($payload['opf'])
                : null,
            name: isset($payload['name']) && is_array($payload['name'])
                ? CompanyNameDTO::fromArray($payload['name'])
                : null,
            inn: $payload['inn'] ?? null,
            ogrn: $payload['ogrn'] ?? null,
            okpo: $payload['okpo'] ?? null,
            okato: $payload['okato'] ?? null,
            oktmo: $payload['oktmo'] ?? null,
            okogu: $payload['okogu'] ?? null,
            okfs: $payload['okfs'] ?? null,
            okved: $payload['okved'] ?? null,
            okveds: $okveds,
            finance: isset($payload['finance']) && is_array($payload['finance'])
                ? CompanyFinanceDTO::fromArray($payload['finance'])
                : null,
            address: isset($payload['address']) && is_array($payload['address'])
                ? AddressDTO::fromArray($payload['address'])
                : null,
            phones: $phones,
            emails: $emails,
            documents: $documents,
            authorities: $authorities,
            financeHistory: $financeHistory,
            employeeCount: isset($payload['employee_count']) ? (int) $payload['employee_count'] : null,
        );
    }
}
