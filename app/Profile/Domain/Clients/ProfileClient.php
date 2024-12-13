<?php

namespace App\Profile\Domain\Clients;

use App\Profile\Domain\Clients\Entities\ExternalProfile;
use App\Profile\Domain\Interfaces\ExternalProfileSourcesInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Log\Logger;

class ProfileClient
{
    private Client $client;

    public function __construct(private Logger $logger)
    {
        $this->client = new Client(['timeout'  => 6.0,]);
    }

    public function getProfilesBySource(string $uuid): array
    {
        $promises = $this->preparePromises($uuid);

        return $this->getFetchedProfiles($promises);
    }

    private function preparePromises(string $uuid): array
    {
        $promises = [];

        foreach (ExternalProfileSourcesInterface::SOURCE_TO_URL_MAP as $source => $url) {
            $promises[$source] = $this->client->getAsync($url, ['uuid' => $uuid]);
        }

        return $promises;
    }

    private function getFetchedProfiles(array $promises): array
    {
        $result = [];
        $responses = Promise\Utils::settle($promises)->wait();

        foreach ($responses as $source => $response) {
            if ($response['state'] === 'fulfilled') {
                $content = json_decode($response['value']->getBody()->getContents(), true);
                $result[] = new ExternalProfile(
                    $source,
                    $content['data']['email'] ?? null,
                    $content['data']['name'] ?? null,
                    $content['data']['avatar_url'] ?? null,
                );
            } else {
                $this->logger->warning('Could fetch data', [
                    'reason' => $response['reason'],
                ]);
            }
        }

        return $result;
    }
}