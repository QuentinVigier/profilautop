<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeminiService
{
    private $httpClient;
    private $apiKey;

    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    public function generateContent(string $prompt): string
    {
        $response = $this->httpClient->request('POST', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'query' => [
                'key' => $this->apiKey,
            ],
            'json' => [
                'contents' => [
                    ['parts' => [['text' => $prompt]]],
                ],
            ],
        ]);

        $data = $response->toArray();
        return $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
    }
}