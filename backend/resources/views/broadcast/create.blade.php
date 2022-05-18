<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мои стримы
        </h2>
        <a href="{{route('user.broadcast')}}" class="btn btn-primary">К списку</a>
    </x-slot>
    <x-validation-errors class="mb-4" :errors="$errors" />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <form method="POST" action="{{ route('user.broadcast.create.post') }}" enctype="multipart/form-data">
                        @csrf
                            <!-- Name -->
                            <div>
                                <x-label for="name" value="Название" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>

                            <!-- Description -->
                            <div class="mt-4">
                                <x-label for="description" value="Описание" />
                                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
                            </div>

                            <!-- Image -->
                            <div class="mt-4">
                                <x-label for="image" value="Картинка" />
                                <x-input id="image" class="block mt-1 w-full" type="file" name="image" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    Создать
                                </x-button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
