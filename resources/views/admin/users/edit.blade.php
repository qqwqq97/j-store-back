@extends('layouts.app')

@section('title', 'ユーザー編集')

@section('content')
  <div class="user-detail">
    <h1>ユーザー編集</h1>
    <a href="{{ route('admin.users.show', $user->id) }}" class="btn-detail">← 詳細へ戻る</a>
    <div class="user-card">
      <div class="user-form">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="user-form-group">
            <label for="name" class="user-form-label">ユーザー名</label>
            <input 
              type="text"
              class="user-form-input"  
              id="name"
              name="name"
              value="{{ old('name', $user->name )}}"
              required
            >
          </div>
          <div class="user-form-group">
            <label for="email" class="user-form-label">メールアドレス</label>
            <input 
              type="email"
              class="user-form-input"  
              id="email"
              name="email"
              value="{{ old('email', $user->email )}}"
              required
            >
          </div>
          <div class="user-form-group">
            <label for="status" class="user-form-label">ステータス</label>
            <div class="user-form-radio">
              <label>
                <input 
                  type="radio"
                  name="status"
                  value="active"  
                  {{ old('status', $user->status ?? '') === 'active' ? 'checked' : ''}}
                >
                Active
              </label>
              <label>
                <input 
                  type="radio"
                  name="status"
                  value="inactive"  
                  {{ old('status', $user->status ?? '') === 'inactive' ? 'checked' : ''}}
                >
                Inactive
              </label>
            </div>
          </div>
          <div class="btn-area">
            <button type="submit" class="btn btn-edit">保存</button>
            <button type="button" class="btn btn-delete" onclick="openModal()">削除</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal" id="modal">
    <div class="modal-content">
    <button type="button" class="modal-close" onclick="closeModal()">×</button>
    <p>削除しても宜しいでしょうか？</p>
    <div class="btnArea">
      <form action="{{ route('admin.users.destroy', $user->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="deleteBtn">はい</button>
      </form>
      <button type="button" onclick="closeModal()" class="deleteBtn">いいえ</button>
    </div>
    </div>
  </div>
@endsection