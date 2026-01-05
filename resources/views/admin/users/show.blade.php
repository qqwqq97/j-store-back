@extends('layouts.app')

@section('title', 'ユーザー詳細')

@section('content')
<div class="user-detail">
  <div class="user-card">
    <div class="user-header">
      <h2>{{ $user->name}}</h2>
      @if($user->deleted_at)
        <span class="badge deleted">Deleted</span>
      @elseif($user->status === 'inactive')
        <span class="badge inactive">Inactive</span> 
      @else
        <span class="badge active">Active</span>   
      @endif  
    </div>

    <p class="email">{{ $user->email }}</p>

    <div class="user-info">
      <div>
        <span>Last Login</span>
        <strong>{{ $user->last_login_at?->format('Y-m-d H:i') ?? '-'}}</strong>
      </div>
      <div>
        <span>Registered At</span>
        <strong>{{ $user->created_at->format('Y-m-d') }}</strong>
      </div>
      <div>
        <span>Status</span>
        <strong>{{ ucfirst($user->status) }}</strong>
      </div>
      <div>
        <span>Deleted</span>
        <strong>{{ $user->deleted_at ? 'Yes' : 'No' }}</strong>
      </div>
    </div>
  </div>
  <div class="actions-btn">
    <a href="{{ route('admin.users.index') }}" class="btn back">一覧へ戻る</a>
    <a href="{{ route('admin.users.edit', $user->id )}}" class="btn edit">編集</a>
  </div>
</div>
@endsection