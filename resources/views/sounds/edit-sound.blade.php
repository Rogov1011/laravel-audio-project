@extends('app')

@section('title', $sound->title . '(ред.)')
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ $sound->title . '(ред.)' }}</h2>
    </div>

    <div>
        <form action="{{ route('sound.update', $sound->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $sound->title) }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label">Описание</label>
                <input type="text" name="content" class="form-control" value="{{ old('content', $sound->content) }}">
                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="category_id" class="form-label">Категория</label>
                <select name="category_id" id="" class="form-select">
                    <option value="" selected disabled>Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id', $sound->category_id)) selected @endif>
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
            @if ($sound->sound)
                <div class="d-flex">
                    <div>
                        <audio controls src="{{ $sound->getSound() }}">
                    </div>
                    <div>
                        <a class="btn btn-sm btn-danger my-2 mx-3"
                            href="{{ route('sound.remove-sound', $sound->id) }}">удалить звук</a>
                    </div>
                </div>
            @endif
            <div class="form-group mb-3">
                <label for="is_published" class="form-label">
                    <input type="checkbox" name="is_published" class="form-check-input" value="1"
                        @if (old('is_published', $sound->is_published)  == 1) checked @endif>Опубликовать
                </label>
            </div>
            <button class="btn btn-primary my-5">{{ __('Добавить') }}</button>
        </form>
    </div>

@endsection
