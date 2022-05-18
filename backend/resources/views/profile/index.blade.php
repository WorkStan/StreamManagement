<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мой профиль
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <fieldset disabled>
                        <label for="name" class="form-label">Имя:</label>
                        <input type="text" id="name" class="form-control" value="{{ $userProfile->name }}">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" id="email" class="form-control" value="{{ $userProfile->email }}">
                        <label for="secret_key" class="form-label">SecretKey:</label>
                        <input type="text" id="secret_key" class="form-control" value="{{ $userProfile->secret_key }}">
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
