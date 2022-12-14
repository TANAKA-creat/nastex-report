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
                            {{$user->name }}さん - 編集ページ
                        @endif
                        {{-- @endforeach --}}
                    </h1>
                    {{-- @endauth --}}

                    <form method="POST" action="{{ route('reports.update', $report) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>
                                記録日を編集します
                                <input type="text" name="title" value="{{ old('title', $report->title) }}">
                            </label>
                            @error('title')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>
                                記録内容を編集します
                                <textarea name="body">{{ old('body', $report->body) }}</textarea>
                            </label>
                            @error('body')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-button">
                            <button type="btn" class="btn btn-warning shadow" data-toggle="button">編集</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
