<?php

declare(strict_types=1);

namespace Nos\DadataApi\Classes;

final class Clean
{
    private const BASE_URL = 'https://dadata.ru/api/v2/clean';

    private string $token;
    private string $secret;
    /** @var resource|\CurlHandle */
    private mixed $handle;

    public function __construct(string $token, string $secret)
    {
        $this->token = $token;
        $this->secret = $secret;
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
                'X-Secret: ' . $this->secret,
            ],
            CURLOPT_POST => true,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function clean(string $type, string $value): array
    {
        $url = self::BASE_URL . "/$type";
        $fields = [$value];
        return $this->executeRequest($url, $fields);
    }

    /**
     * @return array<string, mixed>
     */
    public function cleanRecord(string $structure, array $record): array
    {
        $url = self::BASE_URL;
        $fields = [
            'structure' => $structure,
            'data' => [$record],
        ];
        return $this->executeRequest($url, $fields);
    }

    public function close(): void
    {
        curl_close($this->handle);
    }

    /**
     * @return array<string, mixed>
     */
    private function executeRequest(string $url, mixed $fields): array
    {
        curl_setopt_array($this->handle, [
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => json_encode($fields, JSON_THROW_ON_ERROR),
        ]);
        $result = curl_exec($this->handle);
        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }
}