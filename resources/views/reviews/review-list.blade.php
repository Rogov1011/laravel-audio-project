@extends('app')

@section('title', __('Жалобы'))
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ __('Жалобы') }}</h2>
    </div>

    <div>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <td>id</td>
                    <td>Имя звука</td>
                    <td>Суть жалобы</td>
                    <td>Имя</td>
                    <td>Фамилия</td>
                    <td>email</td>
                    <td>Действие</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <div class="d-flex">
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->sound->title }}</td>
                            <td>{{ $review->content }}</td>
                            <td>{{ $review->user_name }}</td>
                            <td>{{ $review->user_surname }}</td>
                            <td>{{ $review->email }}</td>
                            <td>
                                <form action="{{ route('review.delete', $review->id) }}" method="POST" class="mx-3">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Удалить') }}</button>
                                </form>
                            </td>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
