<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мои стримы
        </h2>
        <a href="{{route('user.broadcast')}}" class="btn btn-primary">К списку</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <fieldset disabled>
                            <img src="{{ url('storage/' . $broadCast->getImage()) }}" alt="" title="" height="100px"/>
                            <label for="name" class="form-label">Название:</label>
                            <input type="text" id="name" class="form-control" value="{{ $broadCast->getName() }}">
                            <label for="description" class="form-label">Описание:</label>
                            <input type="text" id="description" class="form-control" value="{{ $broadCast->getDescription() }}">
                            <label for="description" class="form-label">Ссылка:</label>
                            <input type="text" id="description" class="form-control" value="{{ $broadCast->getRtmpUrl() }}">
                        </fieldset>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
