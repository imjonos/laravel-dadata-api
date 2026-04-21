<?php

declare(strict_types=1);

namespace Nos\DadataApi\Classes;

final class Suggestions
{
    private const BASE_URL = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs';

    private string $token;
    /** @var resource|\CurlHandle */
    private mixed $handle;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function init(): void
    {
        $this->handle = curl_init();
        curl_setopt_array($this->handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Token ' . $this->token,
            ],
            CURLOPT_POST => true,
        ]);
    }

    /**
     * @param array<string, string> $fields
     * @return array<string, mixed>
     */
    public function findById(string $type, array $fields): array
    {
        $url = self::BASE_URL . "/findById/$type";
        return $this->executeRequest($url, $fields);
    }

    /**
     * @return array<string, mixed>
     */
    public function geolocate(float $lat, float $lon, int $count = 10, int $radiusMeters = 100): array
    {
        $url = self::BASE_URL . '/geolocate/address';
        $fields = [
            'lat' => (string) $lat,
            'lon' => (string) $lon,
            'count' => (string) $count,
            'radius_meters' => (string) $radiusMeters,
        ];
        return $this->executeRequest($url, $fields);
    }

    /**
     * @return array<string, mixed>
     */
    public function iplocate(string $ip): array
    {
        $url = self::BASE_URL . '/iplocate/address?ip=' . $ip;
        return $this->executeRequest($url, null);
    }

    /**
     * @param array<string, mixed> $fields
     * @return array<string, mixed>
     */
    public function suggest(string $type, array $fields): array
    {
        $url = self::BASE_URL . "/suggest/$type";
        return $this->executeRequest($url, $fields);
    }

    public function close(): void
    {
        curl_close($this->handle);
    }

    /**
     * @param array<string, mixed>|null $fields
     * @return array<string, mixed>
     */
    private function executeRequest(string $url, mixed $fields): array
    {
        curl_setopt($this->handle, CURLOPT_URL, $url);
        if ($fields !== null) {
            curl_setopt($this->handle, CURLOPT_POST, true);
            curl_setopt($this->handle, CURLOPT_POSTFIELDS, json_encode($fields, JSON_THROW_ON_ERROR));
        } else {
            curl_setopt($this->handle, CURLOPT_POST, false);
        }
        $result = curl_exec($this->handle);
        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }
}