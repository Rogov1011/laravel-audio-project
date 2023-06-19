@extends('app')

@section('title', $category->name.'(ред.)')
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{$category->name . '(ред.)'}}</h2>
</div>

<div>
    <form action="{{route("Category.update", $category)}}" method="POST" enctype="multipart/form-data">
        @csrf @method("PUT")
        <div class="form-group mb-3">
            <label for="" class="form-label">{{ __("Имя категории") }}</label>
            <input type="text" name="name" class="form-control" value="{{$category->name}}">
        </div>
        <div>
            <label for="image" class="form-label">Изображение</label>
            <input type="file" name="image" class="form-control">
        </div>
        @if ($category->image)
        <div class="my-3">
            <img src="{{ $category->getImage() }}" alt="" style="width: 150px">
            <a class="btn btn-sm btn-danger" href="{{ route("category.removeImage", $category->id) }}">удалить картинку</a>
        </div>
        @endif
        <button class="btn btn-primary my-3">{{ __("Сохранить") }}</button>
    </form>
</div>

@endsection