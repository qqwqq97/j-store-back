@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
  <div class="wrapper">
    <h1 class="shohinDetailTitle">商品詳細</h1>
    <div class="card">
      <div class="form-group">
        <label for="category" class="form-label">カテゴリ</label>
        <input 
          type="text" 
          class="form-control" 
          id="category" 
          disabled 
          value="{{$detail->category->name}}"
        >
      </div>
      <div class="form-group"> 
        <label for="name" class="form-label">商品名</label>
        <input 
          type="text" 
          class="form-control" 
          id="name"
          disabled
          value="{{$detail->name}}"  
        >
      </div>
      <div class="form-group">
        <label for="description" class="form-label">商品説明</label>
        <textarea 
          rows="4" 
          class="form-control" 
          id="description"
          disabled  
        >{{$detail->description}}</textarea>
      </div>
      <div class="form-group">
        <label for="price" class="form-label">価格</label>
        <input 
          type="text" 
          class="form-control" 
          id="price"
          disabled
          value="{{number_format($detail->price)}}円"  
        >
      </div>
      <div class="form-group">
        <label for="stock" class="form-label">在庫</label>
        <input 
          type="text" 
          class="form-control" 
          id="stock"
          disabled
          value="{{$detail->stock}}"  
        >
      </div>
      <div class="form-group">
        <label for="image" class="form-label">商品画像</label>
        <div class="image-preview">
          <img src="{{ asset($detail->image_url) }}" alt="商品画像">
        </div>
      </div>
      <div class="btn-area">
          <a href="{{ route('admin.shohin.list')}}" class="btn btn-back">一覧へ</a>
          <a href="{{ route('admin.shohin.edit', $detail->id)}}" class="btn btn-edit">編集</a>
      </div>
      </div>
    </div>
  </div>
@endsection