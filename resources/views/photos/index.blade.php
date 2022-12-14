@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="back-link">
                   &laquo; <a href="{{ route('reports.index') }}">トップページに戻る</a>
                
                {{-- @auth --}}
                {{-- @foreach ($users as $user) --}}
                @if($user)
                    <h1>
                        {{ $user->name }}さん - 画像集
                    </h1>
                @endif
                {{-- @endforeach --}}
                {{-- @endauth --}}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                @forelse($photos as $photo)
                    <a href="{{ route('photos.show', $photo->id, $user) }}">
                        {{ $photo->title }}
                    </a>
                @empty
                    <p>画像がありません</p>
                @endforelse
            </div>
        </div>
        {{ $photos->links() }}
    </div>
@endsection
