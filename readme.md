# Dadata Api Wrapper For Laravel



## Installation

Via Composer

``` bash
$ composer require codersstudio/dadataapi
```

## Usage

DadataApi::suggestCity("Москва", ["RU"]);
DadataApi::suggestCountry("Россия");

All methods

suggestCity(string $query = "", array $countryCodeISO = ["*"], int $count = 10)
suggestStreet(string $query = "", string $fiasId = "", int $count = 10)
suggestHouse(string $query = "", string $street_fias_id = "", int $count = 10)
cleanAddress(string $address)
suggestCountry(string $query, int $count = 10)
suggestAddress(string $query, ?string $fiasId = null)
suggestBank(string $query)
suggestDeliveryId(string $kladrId)
suggestAddressById(string $fiasId)
suggestCompany(string $inn)

https://github.com/imjonos/laravel-dadata-api/blob/master/src/DadataApi.php


## Credits

- http://coders.studio
- info@coders.studio

## License

license. Please see the [license file](license.md) for more information.
