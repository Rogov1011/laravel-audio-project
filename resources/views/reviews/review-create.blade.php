@extends('app')

@section('title', __('Жалоба'))
@section('content')

    <h1 class="my-5">Жалоба</h1>
    <form action="{{ route('review.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group mb-3">
                <label for="sound_id" class="form-label">Звук №</label>
                <input name="sound_id" id="" style="border: none" class="col-1" value="{{ $sounds->id }}"> <h4>
                    {{ $sounds->title }}
                </h4>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 col-12">
                <div class="form-group mb-3">
                    <label for="user_surname">Фамилия</label>
                    <input type="text" name="user_surname" id="user_surname" class="form-control"
                        value="{{ old('user_surname') }}">
                    @error('user_surname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="form-group mb-3">
                    <label for="user_name">Имя</label>
                    <input type="text" name="user_name" id="user_name" class="form-control"
                        value="{{ old('user_name', auth()->user()->name) }}">
                    @error('user_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control"
                        value="{{ old('user_email', auth()->user()->email) }}">
                    @error('user_email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-3">
                    <label for="phone">В чём суть жалобы</label>
                    <textarea type="text" name="content" id="content" class="form-control" value="{{ old('user_phone') }}"></textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>

@endsection

