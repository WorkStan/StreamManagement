<?php
declare(strict_types=1);

namespace App\Services\DTO;

final class BroadCastDTO
{
    public function __construct(
        private int $broadCastId,
        private string $streamId,
        private string $image,
        private string $status,
        private string $author,
        private string $name,
        private string $description,
        private string $rtmpUrl
    ) {}

    public function getBroadCastId(): int
    {
        return $this->broadCastId;
    }

    public function getStreamId(): string
    {
        return $this->streamId;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getRtmpUrl(): string
    {
        return $this->rtmpUrl;
    }
}
