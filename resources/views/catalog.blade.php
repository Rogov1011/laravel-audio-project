@extends('app')

@section('title', __('Каталог'))
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ __('Каталог') }}</h2>
        <a href="{{ route('sound.create') }}" class="btn btn-primary">{{ __('Добавить') }}</a>
    </div>
    <div>
        @if ($sounds->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Категория</td>
                        <td>Название</td>
                        <td>Звук</td>
                        <td>Описание</td>
                        @hasanyrole('user')
                            <td>Действия</td>
                        @endhasanyrole
                        @hasanyrole('admin')
                            <td>Опубликовано</td>
                        @endhasanyrole
                    </tr>
                </thead>
                <tbody>

                    @foreach ($sounds as $sound)
                        @hasanyrole('user')
                            @if ($sound->is_published == 1)
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
                                    <td><a href="{{ route('review.create', $sound->id) }}">Пожаловаться</a></td>
                            @endif
                        @endhasanyrole
                        @hasanyrole('admin')
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
                                <td>{!! $sound->published() !!}</td>
                            </tr>
                        @endhasanyrole
                    @endforeach
                </tbody>
            </table>
        @else
            <h2>Звуков пока нет!!!</h2>
        @endif
    </div>

@endsection
