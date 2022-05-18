<?php
declare(strict_types=1);

namespace App\Services\DTO;

final class GetBroadCastDTO
{
    public function __construct(private int $broadCastId) {}

    public function getBroadCastId(): int
    {
        return $this->broadCastId;
    }
}
