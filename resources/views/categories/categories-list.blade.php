@extends('app')

@section('title', 'Категории')
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ __('Категории') }}</h2>
        <a href="{{ route('Category.create') }}" class="btn btn-primary">{{ __('Добавить') }}</a>
    </div>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>id</td>
                    <td>Изображение</td>
                    <td>{{ __('Категории') }}</td>
                    <td>{{ __('Действия') }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            <img src="{{ $category->getImage() }}" alt="" style="width: 80px">
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('Category.edit', $category->id) }}"
                                    class="btn btn-sm btn-warning">{{ __('Редактировать') }}</a>
                                <form action="{{ route('Category.destroy', $category->id) }}" method="POST" class="mx-3">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Удалить') }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
