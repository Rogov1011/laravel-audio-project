@extends('app')

@section('title', 'Вход')
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>Вход</h2>
    </div>
    @if (session('successRegister'))
        <div class="alert alert-success">
            {{ session('successRegister') }}
        </div>
    @endif
    <div>
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="form-label">Ваш email</label value="{{ old('email') }}">
                <input type="text" id="email" name="email" class="form-control">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" id="password" name="password" class="form-control">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mt-4 mb-4">
                <div class="captcha">
                    <span>{!! captcha_img() !!}</span>
                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                        &#x21bb;
                    </button>
                </div>
            </div>
            <div class="form-group mb-4">
                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
            </div>
            <button class="btn btn-primary">Войти</button>
        </form>
    </div>

@endsection
