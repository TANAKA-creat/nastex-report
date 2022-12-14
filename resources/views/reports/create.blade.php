@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="back-link">
                   &laquo; <a href="{{ route('reports.index') }}">トップページに戻る</a>
                   {{-- @auth --}}
                    <h1>
                        {{-- @foreach ($users as $user) --}}
                        @if($user)
                            {{ $user->name }}さん - 記録ページ
                        @endif
                        {{-- @endforeach --}}
                    </h1>
                    {{-- @endauth --}}

                    <form action="{{ route('reports.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">記録日とキーワード</label>
                            <input type="string" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body">記録内容</label>
                            <textarea name="body" id="body" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">記録を登録する</button>
                    </form>

                    <hr>

                    <div class="up-link">
                        &laquo; <a href="{{ route('photos.index') }}">画像集に移動する</a>

                    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">画像を貼り付けてください</label>
                            <input type="file" name="image">
                        </div>
                        <div class="form-group">
                            <label for="title">画像投稿日とキーワード</label>
                            <input type="string" name="title" id="title" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">画像を添付する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
