<?php

namespace App\Http\Controllers;

use App\Models\BroadCast;
use App\Services\AntMediaClientService;
use App\Services\BroadCastService;
use App\Services\DTO\GetBroadCastDTO;
use Illuminate\Http\Request;

class BroadCastController extends Controller
{
    public function index(BroadCastService $service)
    {
        $broadCastList = $service->getBroadCastsList(0);
        return view('main', compact('broadCastList'));
    }

    public function show(BroadCast $broadCast, BroadCastService $service)
    {
        $broadCast = $service->getBroadCast(new GetBroadCastDTO($broadCast->id));
        return view('broadcast.view', compact('broadCast'));
    }
}
