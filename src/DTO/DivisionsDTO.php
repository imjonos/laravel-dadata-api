<?php

declare(strict_types=1);

namespace Nos\DadataApi\DTO;

use Nos\BaseDto\Interfaces\DtoInterface;
use Nos\BaseDto\Traits\DataTransforms\ArrayDataTransformable;

final readonly class DivisionsDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?AdministrativeDTO $administrative,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            administrative: isset($data['administrative'])
                ? AdministrativeDTO::fromArray($data['administrative'])
                : null,
        );
    }
}

final readonly class AdministrativeDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?CityDistrictDTO $area,
        public ?CityDistrictDTO $city,
        public ?CityDistrictDTO $cityDistrict,
        public ?CityDistrictDTO $settlement,
        public ?CityDistrictDTO $planningStructure,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            area: isset($data['area']) ? CityDistrictDTO::fromArray($data['area']) : null,
            city: isset($data['city']) ? CityDistrictDTO::fromArray($data['city']) : null,
            cityDistrict: isset($data['city_district'])
                ? CityDistrictDTO::fromArray($data['city_district'])
                : null,
            settlement: isset($data['settlement'])
                ? CityDistrictDTO::fromArray($data['settlement'])
                : null,
            planningStructure: isset($data['planning_structure'])
                ? CityDistrictDTO::fromArray($data['planning_structure'])
                : null,
        );
    }
}

final readonly class CityDistrictDTO implements DtoInterface
{
    use ArrayDataTransformable;

    private function __construct(
        public ?string $fiasId,
        public ?string $kladrId,
        public ?string $type,
        public ?string $typeFull,
        public ?string $name,
        public ?string $nameWithType,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            fiasId: $data['fias_id'] ?? null,
            kladrId: $data['kladr_id'] ?? null,
            type: $data['type'] ?? null,
            typeFull: $data['type_full'] ?? null,
            name: $data['name'] ?? null,
            nameWithType: $data['name_with_type'] ?? null,
        );
    }
}