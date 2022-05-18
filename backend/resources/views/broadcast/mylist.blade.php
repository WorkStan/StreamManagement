<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мои стримы
        </h2>
        <a href="{{route('user.broadcast.create.form')}}" class="btn btn-primary">Создать стрим</a>
    </x-slot>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Описание</th>
                                <th scope="col">Картинка</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($broadCasts) === 0)
                                <tr>
                                    <td colspan="100%">Нет стримов</td>
                                </tr>
                            @endif
                            @foreach($broadCasts as $broadCast)
                            <tr>
                                <th scope="row">{{$broadCast->id}}</th>
                                <td>{{$broadCast->name}}</td>
                                <td>{{$broadCast->description}}</td>
                                <td><img src="{{ url('storage/'.$broadCast->image) }}" alt="" title="" width="100px"/></td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('user.broadcast.show',$broadCast->id) }}">Перейти</a>
                                    <form action="{{ route('user.broadcast.destroy', $broadCast->id) }}" type="submit" method='post' >
                                        @csrf
                                        @method('delete')
                                        <button  type="submit" class="btn btn-danger" onclick='return confirm("Вы уверены?");'>Удалить</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
