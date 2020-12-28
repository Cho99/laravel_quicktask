@extends('layouts.app')
@section('content')
    <h1 class="text-center">{{ trans('label.my_posts') }}</h1>
    @if (Session::has('mess'))
        <div class="card notification">
            <div class="card-header">
                <b>{{ trans('label.message') }}</b>
            </div>
            <div class="toast-body">
                <span>{!! Session::get('mess') !!}</span>
            </div>
        </div>
    @endif
    <div class="container">
        <a href="{{ route('posts.create') }}" type="button" class="btn btn-primary mb-2">{{ trans('label.add_post') }}</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ trans('label.name_post') }}</th>
                            <th scope="col">{{ trans('label.total_posts') }}</th>
                            <th scope="col">{{ trans('label.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $index = 1;
                        @endphp
                        @foreach ($user['posts'] as $post)
                            <tr>
                                <th scope="row">{{ $index++ }}</th>
                                <td>{{ $post->name }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                            class="btn btn-success mr-3">{{ trans('label.edit') }}</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger">{{ trans('label.delete') }}</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
