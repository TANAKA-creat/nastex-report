@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10">
                {{-- @auth --}}
                {{-- @foreach ($users as $user) --}}
                <h1>
                    @if ($user)
                        {{ $user->name }}さん、ようこそ！ - トップページ
                </h1>
                    @endif

                <div class="col-5">
                    &laquo; <a href="{{ route('reports.create', $user) }}">
                        記録を書く・画像を貼り付ける <br>
                    </a>
                    {{-- @endforeach --}}
                    {{-- @endauth --}}
                    <div class="up-link">
                        &laquo; <a href="{{ route('photos.index', $user) }}">画像集に移動する</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <p>☟ 記録した内容</p>
                    @forelse($reports as $report)
                        <a href="{{ route('reports.show', $report) }}">
                            {{ $report->title }}
                        </a>
                    @empty
                        <p>記録がありません</p>
                    @endforelse
                </div>
            </div>
            {{ $reports->links() }}
        </div>
    @endsection
