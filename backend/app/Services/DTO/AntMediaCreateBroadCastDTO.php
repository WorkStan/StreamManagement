<?php
declare(strict_types=1);

namespace App\Services\DTO;

final class AntMediaCreateBroadCastDTO
{
    public function __construct(private string $name, private string $streamId) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getStreamId(): string
    {
        return $this->streamId;
    }
}
