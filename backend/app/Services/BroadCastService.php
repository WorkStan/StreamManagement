<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\BroadCast;
use App\Services\DTO\AntMediaCreateBroadCastDTO;
use App\Services\DTO\AntMediaDeleteBroadCastDTO;
use App\Services\DTO\BroadCastDTO;
use App\Services\DTO\CreateBroadCastDTO;
use App\Services\DTO\DeleteBroadCastDTO;
use App\Services\DTO\GetBroadCastDTO;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Ramsey\Uuid\Uuid;

final class BroadCastService
{
    public function __construct(private AntMediaClientService $antService){}

    /**
     * @throws GuzzleException
     */
    public function createBroadCast(CreateBroadCastDTO $dto): void
    {
        $streamId = Uuid::uuid4()->toString();
        $name = $dto->getName();

        $antMediaDto = new AntMediaCreateBroadCastDTO(name: $name, streamId: $streamId);
        $this->antService->createBroadCast($antMediaDto);

        $broadCast = new BroadCast();
        $broadCast->name = $dto->getName();
        $broadCast->description = $dto->getDescription();
        $broadCast->image = $dto->getImage();
        $broadCast->stream_id = $streamId;
        $broadCast->user()->associate(auth()->user());
        $broadCast->save();
    }

    /**
     * @throws Exception
     */
    public function deleteBroadCast(DeleteBroadCastDTO $dto): void
    {
        $broadCast = BroadCast::findOrFail($dto->getBroadCastId());

        $antMediaDto = new AntMediaDeleteBroadCastDTO($broadCast->stream_id);
        $this->antService->deleteBroadCast($antMediaDto);

        $broadCast->delete();
    }

    public function getBroadCastsList(int $offset): array
    {
        $broadCastList = [];
        $antBroadCasts = $this->antService->getBroadCastList($offset);
        foreach ($antBroadCasts as $antBroadCast) {
            $streamId = $antBroadCast->streamId;
            $status = $antBroadCast->status;
            $rtmpUrl = $antBroadCast->rtmpURL;
            if (!Uuid::isValid($streamId)) {
                continue;
            }
            $baseBroadCast = BroadCast::where('stream_id', $streamId)->first();
            if (!$baseBroadCast) {
                continue;
            }
            $author = $baseBroadCast->user->name;
            $name = $baseBroadCast->name;
            $description = $baseBroadCast->description;
            $image = $baseBroadCast->image;
            $broadCastId = $baseBroadCast->id;

            $broadCastItem = new BroadCastDTO(
                broadCastId: $broadCastId,
                streamId: $streamId,
                image: $image,
                status: $status,
                author: $author,
                name: $name,
                description: $description,
                rtmpUrl: $rtmpUrl
            );

            array_push($broadCastList, $broadCastItem);
        }

        return $broadCastList;
    }

    public function getBroadCast(GetBroadCastDTO $dto): ?BroadCastDTO
    {
        $baseBroadCast = BroadCast::findOrFail($dto->getBroadCastId());
        $streamId = $baseBroadCast->stream_id;
        if (!Uuid::isValid($streamId)) {
            throw new Exception('Invalid stream');
        }
        $antBroadCastInfo = $this->antService->getBroadCast($streamId);

        $status = $antBroadCastInfo->status;
        $rtmpUrl = $antBroadCastInfo->rtmpURL;

        $rtmpOrigin = $antBroadCastInfo->originAdress;
        $rtmpUrl = str_replace($rtmpOrigin, env('ANT_MEDIA_RTMP_HOST'), $rtmpUrl);

        $author = $baseBroadCast->user->name;
        $name = $baseBroadCast->name;
        $description = $baseBroadCast->description;
        $image = $baseBroadCast->image;
        $broadCastId = $baseBroadCast->id;

        return new BroadCastDTO(
            broadCastId: $broadCastId,
            streamId: $streamId,
            image: $image,
            status: $status,
            author: $author,
            name: $name,
            description: $description,
            rtmpUrl: $rtmpUrl
        );
    }
}
