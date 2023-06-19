@extends('app')

@section('title', __('Пользователи'))
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ __('Пользователи') }}</h2>
        <a href="" class="btn btn-primary">{{ __('Добавить') }}</a>
    </div>

    <div>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <td>{{ __('ФИО') }}</td>
                    <td>{{ __('email') }}</td>
                    <td>{{ __('Роли') }}</td>
                    <td>{{ __('Действия') }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoles() }}</td>

                        <td class="d-flex">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">{{ __('Редактировать') }}</a>
                            @if ($user->id != auth()->user()->id)
                                <form action="{{ route('users.delete', $user->id) }}" method="POST" class="mx-3">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Удалить') }}</button>
                                </form>
                                <form action="{{ route('users.ban', $user) }}" method="POST">
                                    @csrf @method('PUT')
                                    @if ($user->is_ban)
                                    <button class="btn btn-sm btn-outline-dark">Разблокировать</button>
                                    @else
                                    <button class="btn btn-sm btn-dark">Заблокировать</button>
                                    @endif
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
