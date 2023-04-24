<?php declare(strict_types=1);

namespace Console\App\Services;

use GuzzleHttp\Client;

final class Quote
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Quote constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.quotable.io', 'verify' => false]);
    }

    /**
     * @return string
     */
    public function getQuote(): string
    {
        $response = $this->client->get('random');
        $contents = json_decode($response->getBody()->getContents(), true);

        return $contents['content'];
    }
}