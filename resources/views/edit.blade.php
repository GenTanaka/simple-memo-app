@extends('layouts.app')

@section('javascript')
    <script src="/js/confirm.js"></script>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        メモ編集
        <form id="delete-form" action="{{ route('destroy') }}" method="POST">
            @csrf
            <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id'] }}">
            <i class="fas fa-trash" onclick="deleteHandle(event);"></i>
        </form>
    </div>
    <form class="card-body my-card-body" action="{{ route('update') }}" method="POST">
        @csrf
        <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id'] }}">
        <div class="mb-3">
            <label for="title" class="form-label">Email address</label>
            <input type="text" class="form-control" id="title" placeholder="タイトルを入力" value="{{ $edit_memo[0]['title'] }}">
        </div>
        <div class="form-group mb-3">
            <textarea class="form-control" name="content" rows="3" placeholder="ここにメモを入力">{{ $edit_memo[0]['content'] }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">メモ内容を入力してください</div>
        @enderror
        @foreach ($tags as $tag)
            <div class="form-check form-check-inline mb-3">
                <input type="checkbox" class="form-check-input" name="tags[]" id="{{ $tag['id'] }}" value="{{ $tag['id'] }}" {{ in_array($tag['id'], $include_tags) ? 'checked' : '' }}>
                <label for="{{ $tag['id'] }}" class="form-check-label">{{ $tag['name'] }}</label>
            </div>
        @endforeach
        <input class="form-control w-50" type="text" name="new_tag" placeholder="新しいタグを入力">
        <button type="submit" class="btn btn-primary mt-3">更新</button>
    </form>
</div>
@endsection
