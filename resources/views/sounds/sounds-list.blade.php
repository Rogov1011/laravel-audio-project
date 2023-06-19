@extends('app')

@section('title', __('Звуки'))
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ __('Звуки') }}</h2>
        <a href="{{ route('sound.create') }}" class="btn btn-primary">{{ __('Добавить') }}</a>
    </div>

    @if (session('success'))
        <div class="col-2 alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div>
        @if ($sounds->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Категория</td>
                        <td>Название</td>
                        <td>Звук</td>
                        <td>Описание</td>
                        <td>Опубликовано</td>
                        <td>Действия</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($sounds as $sound)
                        <tr>
                            <td>{{ $sound->category->name }}</td>
                            <td>{{ $sound->title }}</td>
                            <td>
                                @if ($sound->sound)
                                    <audio controls src="{{ $sound->getSound() }}">
                                    @else
                                        Извините звук удален
                                @endif
                            </td>
                            <td>{{ $sound->content }}</td>
                            <td>{!! $sound->published()!!}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('sound.edit', $sound->id) }}"
                                        class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                    <form action="{{ route('sound.destroy', $sound->id) }}" method="POST" class="mx-3">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h2>Звуков пока нет!!!</h2>
        @endif
    </div>

@endsection
