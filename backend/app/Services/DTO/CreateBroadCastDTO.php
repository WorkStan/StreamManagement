<?php
declare(strict_types=1);

namespace App\Services\DTO;

final class CreateBroadCastDTO
{
    public function __construct(private string $name, private string $description, private string $image) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

}
