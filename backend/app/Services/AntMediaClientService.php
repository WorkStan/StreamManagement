<?php
declare(strict_types=1);

namespace App\Services;

use App\Services\DTO\AntMediaCreateBroadCastDTO;
use App\Services\DTO\AntMediaDeleteBroadCastDTO;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

final class AntMediaClientService
{
    public function __construct(private Client $client) {}

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function getBroadCastCount(): int
    {
        $response = $this->client->get('v2/broadcasts/count');
        if ($response->getStatusCode() === 200) {
            return json_decode((string)$response->getBody(), true)['number'];
        }
        throw new Exception('SomeProblem');
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function getBroadCastList(int $offSet): array
    {
        $response = $this->client->get('v2/broadcasts/list/' . $offSet . '/50');
        if ($response->getStatusCode() === 200) {
            return json_decode((string)$response->getBody());
        }
        throw new Exception('SomeProblem');
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function createBroadCast(AntMediaCreateBroadCastDTO $dto): void
    {
        $response = $this->client->post('v2/broadcasts/create', [
            'json' => [
                'streamId' => $dto->getStreamId(),
                'name' => $dto->getName()
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('SomeProblem');
        }
    }

    public function deleteBroadCast(AntMediaDeleteBroadCastDTO $dto): void
    {
        $response = $this->client->delete('v2/broadcasts/' . $dto->getStreamId());

        if ($response->getStatusCode() !== 200) {
            throw new Exception('SomeProblem');
        }
    }

    public function getBroadCast(string $uuid): object
    {
        $response = $this->client->get('v2/broadcasts/' . $uuid);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('SomeProblem');
        }

        return json_decode((string)$response->getBody());
    }
}
