@extends('app')

@section('title', 'Главная страница')

@section('content')

    <h1 class="my-5">Главная страница</h1>
    @if (session('successAdd'))
        <div class="alert alert-success">
            {{ session('successAdd') }}
        </div>
    @endif
    @if (session('successReview'))
        <div class="alert alert-success">
            {{ session('successReview') }}
        </div>
    @endif
    <div class="row">
        <h3 class="my-5 d-flex flex-column justify-content-center align-items-center">Категории звуков</h3>
        @foreach ($categories as $category)
            <div class="col-lg-3 col-md-4 col-8">
                <div class="card mb-3 d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ $category->getImage() }}" class="card-img-top" alt="" style="width:100%; height:150px">
                    <div class="card-body">
                        <h4 class="card-title">{{ $category->name }}</h4>
                        <a href="{{ route('app.catalog-by-categories', $category) }}"
                            class="btn btn-sm btn-primary d-flex justify-content-center align-items-center my-3">Перейти</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
