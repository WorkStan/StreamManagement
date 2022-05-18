<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBroadCastRequest;
use App\Models\BroadCast;
use App\Services\BroadCastService;
use App\Services\DTO\CreateBroadCastDTO;
use App\Services\DTO\DeleteBroadCastDTO;
use App\Services\DTO\GetBroadCastDTO;
use Illuminate\Support\Facades\File;

class UserBroadCastController extends Controller
{
    public function index()
    {
        $broadCasts = auth()->user()->broadcasts()->get();
        return view('broadcast.mylist', compact('broadCasts'));
    }

    public function show(BroadCast $broadCast, BroadCastService $service)
    {
        if ($broadCast->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        $broadCast = $service->getBroadCast(new GetBroadCastDTO($broadCast->id));
        return view('broadcast.show', compact('broadCast'));
    }

    public function destroy(BroadCast $broadCast, BroadCastService $service)
    {
        if ($broadCast->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        $filePath = 'storage/' . $broadCast->image;
        $dto = new DeleteBroadCastDTO($broadCast->id);
        $service->deleteBroadCast($dto);
        if (File::exists(public_path($filePath))) {
            File::delete(public_path($filePath));
        }
        return back()->with('message', 'Стрим удалён.');
    }

    public function createForm()
    {
        return view('broadcast.create');
    }

    public function create(CreateBroadCastRequest $request, BroadCastService $service)
    {
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

        $dto = new CreateBroadCastDTO(name: $request->name, description: $request->description, image: $filePath);
        $service->createBroadCast($dto);

        return redirect()->route('user.broadcast')->with('message', 'Стрим создан.');
    }
}
