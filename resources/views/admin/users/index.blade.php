@extends('layouts.app')

@section('title', 'ユーザーリスト')

@section('content')
<h1>ユーザーリスト</h1>
<div class="table">
  <table class="user-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>status</th>
        <th>Last Login</th>
        <th>Registered At</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse ($users as $user)
      <tr class="{{ $user->deleted_at ? 'deleted' : ''}}">
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if ($user->deleted_at)
            <span class="badge deleted">Deleted</span>
          @elseif ($user->status === 'inactive')
            <span class="badge inactive">Inactive</span>
          @else
            <span class="badge active">Active</span>  
          @endif  
        </td>
        <td>
          {{ $user->last_login_at?->format('Y-m-d H:i') ?? '-' }}
        </td>
        <td>{{ $user->created_at->format('Y-m-d') }}</td>
        <td class="actions">
          @if ($user->deleted_at)
            <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
              @csrf
              <button type="submit">復元</button>
            </form>
          @else
              <a href="{{ route('admin.users.show', $user->id) }}">詳細</a>
              <button type="button" onclick="openModal()">削除</button>
          @endif  
        </td>
      </tr>
      @empty 
        <tr>
          <td colspan="7">登録されているユーザーがありません。</td>
        </tr>
      @endforelse  
    </tbody>
  </table>
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