@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
  <h1 class="shohinListTitle">商品一覧</h1>
  <a class="addShohin" href="{{ route('admin.shohin.create')}}">＋商品登録</a>
  <div class="product-grid">
    @foreach($lists as $product)
      <div class="product-card">
        <img 
          src="{{ $product->image_url}}" 
          alt="商品画像"
          class="product-image"
        >
        <div class="product-name">
          {{ $product->name }}
        </div>
        <div class="product-price">
          ￥{{ number_format($product->price) }}
        </div>
        <div class="product-stock">
          在庫：{{ $product->stock}}
        </div>
        <div class="card-actions">
          <a href="{{ route('admin.shohin.detail', $product->id)}}">
            詳細
          </a>
          <a href="{{ route('admin.shohin.edit', $product->id)}}">
            編集
          </a>
        </div>
      </div>
    @endforeach
  </div>
@endsection