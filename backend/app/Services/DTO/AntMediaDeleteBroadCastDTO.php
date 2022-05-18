<?php
declare(strict_types=1);

namespace App\Services\DTO;

final class AntMediaDeleteBroadCastDTO
{
    public function __construct(private string $streamId) {}

    public function getStreamId(): string
    {
        return $this->streamId;
    }
}
