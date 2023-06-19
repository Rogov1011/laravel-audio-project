@extends('app')

@section('title', __('Новый звук'))
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ __('Новый звук') }}</h2>
    </div>

    <div>
        <form action="{{ route('sound.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label">Описание</label>
                <input type="text" name="content" class="form-control" value="{{ old('content') }}">
                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="category_id" class="form-label">Категория</label>
                <select name="category_id" id="" class="form-select">
                    <option value="" selected disabled>Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="sound" class="form-label">звук</label>
                <input type="file" name="sound" class="form-control">
                @error('sound')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            @hasanyrole('admin')
            <div class="form-group mb-3">
                <label for="is_published" class="form-label">
                    <input type="checkbox" name="is_published" class="form-check-input" value="1">Опубликовать
                </label>
            </div>
            @endhasanyrole
            <button class="btn btn-primary my-5">{{ __('Добавить') }}</button>
        </form>
    </div>

@endsection
