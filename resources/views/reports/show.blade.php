@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="back-link">
                  &laquo;  <a href="{{ route('reports.index') }}">トップページに戻る</a>
                  {{-- @auth --}}
                    <h1>
                        {{-- @foreach ($users as $user)  --}}
                        @if($user)
                            {{ $user->name }}さん - 詳細ページ
                        @endif
                        {{-- @endforeach --}}
                    </h1>
                    {{-- @endauth --}}
                    <P>
                        <span>{{ $report->title }}</span>

                        <p>{{ $report->body }}</p>

                        {{-- 2022/12/07 下記を追記 --}}
                        @if ($user_id == $report->user_id)
                        <a href="{{ route('reports.edit', $report) }}">
                            「編集する」
                        </a>

                   <form method="POST" action="{{ route('reports.destroy', $report) }}" id="delete_report">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">削除する</button>
                    </form>
                    @endif
                    </P>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($reviews as $review)
            <div class="offset-md-5 col-md-5">
                <p class="h3">{{ $review->content }}</p>
                <label>{{ $review->created_at }} {{ $review->user->name }}</label>
            </div>
        @endforeach
    </div><br />

    @auth
        <div class="row">
            <div class="offset-md-5 col-md-5">
                <form method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <h4>意見・質問を書く</h4>
                    @error('content')
                        <strong>意見・質問内容を入力してください</strong>
                    @enderror
                    <textarea name="content" class="form-control m-2"></textarea>
                    <input type="hidden" name="report_id" value="{{ $report->id }}">
                    <button type="submit" class="btn btn-info ml-2">意見・質問を登録する</button>
                </form>
            </div>
        </div>
    @endauth
    <script>
        'use strict'; {
            document.getElementById('delete_report').addEventListener('submit', e => {
                e.preventDefault();

                if (!confirm('本当に削除しますか⁇')) {
                    return;
                }
                e.target.submit();
            });
        }
    </script>
@endsection
