@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="back-link">
                &laquo; <a href="{{ route('photos.index') }}">画像集に戻る</a>
                {{-- @auth --}}
                <h1>
                    {{-- @foreach ($users as $user) --}}
                    @if($user)
                        {{ $user->name }}さん - 画像
                    @endif
                    {{-- @endforeach --}}
                </h1>
                {{-- @endauth --}}
                <div>
                        <img class="img" src="{{ asset('storage/images/' . $photo->image) }}">
                        <span>{{ $photo->title }}</span>
               
                {{-- 2022/12/07 下記追記 --}}
                @if ($user_id == $photo->user_id)

                <form method="POST" action="{{ route('photos.destroy', $photo) }}" id="delete_photo">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">削除する</button>
                </form>

                @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    'use strict'; {
        document.getElementById('delete_photo').addEventListener('submit', e => {
            e.preventDefault();

            if (!confirm('本当に削除しますか⁇')) {
                return;
            }

            e.target.submit();
        });

    }
</script>

@endsection
