@extends('layouts.app')

@section('title', '管理者ダッシュボード')

@section('content')
  <h2>クイックアクセス</h2>
  <div class="cards">
    <a href="{{ route('admin.shohin.list') }}" class="card">
      <h3>商品管理</h3>
      <p>商品の追加・編集・削除を行います。</p>
    </a>
    <a href="#"class="card">
      <h3>注文管理</h3>
      <p>注文内容を確認し、ステータスを更新できます。</p>
    </a>
    <a href="{{ route('admin.users.index')}}"  class="card">
      <h3>ユーザー管理</h3>
      <p>ユーザー情報の確認・編集ができます。</p>
    </a>
  </div>
@endsection
