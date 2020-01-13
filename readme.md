# Dadata Api Wrapper For Laravel



## Installation

Via Composer

``` bash
$ composer require codersstudio/dadataapi
```

## Usage

DadataApi::suggestCity("Москва", ["RU"]); <br>
DadataApi::suggestCountry("Россия");

All methods

suggestCity(string $query = "", array $countryCodeISO = ["*"], int $count = 10)<br>
suggestStreet(string $query = "", string $fiasId = "", int $count = 10)<br>
suggestHouse(string $query = "", string $street_fias_id = "", int $count = 10)<br>
cleanAddress(string $address)<br>
suggestCountry(string $query, int $count = 10)<br>
suggestAddress(string $query, ?string $fiasId = null)<br>
suggestBank(string $query)<br>
suggestDeliveryId(string $kladrId)<br>
suggestAddressById(string $fiasId)<br>
suggestCompany(string $inn)<br>

https://github.com/imjonos/laravel-dadata-api/blob/master/src/DadataApi.php


## Credits

- http://coders.studio
- info@coders.studio

## License

license. Please see the [license file](license.md) for more information.
