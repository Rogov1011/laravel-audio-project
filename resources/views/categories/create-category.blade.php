@extends('app')

@section('title', __("Новая категория"))
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{ __("Новая категория") }}</h2>
</div>

<div>
    <form action="{{route("Category.store")}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="" class="form-label">{{ __("Категории") }}</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div>
            <label for="image" class="form-label">Изображение</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-primary my-5">{{__("Добавить")}}</button>
    </form>
</div>
    
@endsection