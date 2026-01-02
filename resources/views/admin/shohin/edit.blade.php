@extends('layouts.app')

@section('title', '商品編集')
    
@section('content')
  <div class="wrapper">
    <h1 class="shohinUpdateTitle">商品編集</h1>
    <div class="card">
      <div class="form-group">
        <form action="{{ route('admin.shohin.update', $product->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
            <label for="category_id" class="form-label">カテゴリ</label>
            <div class="select-wrapper">
              <select name="category_id" id="category_id" class="form-control" style="width: 100%" required>
                <option value="">選択して下さい</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id}}" {{ old('category_id', $product->category_id) === $category->id ? 'selected': ''}}>
                    {{$category->name}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group"> 
            <label for="name" class="form-label">商品名</label>
            <input 
              type="text" 
              class="form-control" 
              id="name"
              name="name"
              value="{{old('name', $product->name)}}"  
              required
            >
          </div>
          <div class="form-group">
            <label for="description" class="form-label">商品説明</label>
            <textarea 
              rows="4" 
              class="form-control" 
              id="description" 
              name="description"
            >{{ old('description', $product->description) }}</textarea>
          </div>
          <div class="form-group">
            <label for="price" class="form-label">価格</label>
            <input 
              type="number" 
              class="form-control" 
              name="price"
              id="price"
              value="{{old('price', floor($product->price))}}"  
              required
            >
          </div>
          <div class="form-group">
            <label for="stock" class="form-label">在庫</label>
            <input 
              type="text" 
              class="form-control" 
              id="stock"
              name="stock"
              value="{{old('stock', $product->stock)}}"  
              required
            >
          </div>
          <div class="form-group">
            <label for="image" class="form-label">商品画像</label>
            <div class="image-preview" onclick="triggerFileInput()">
              <img
                id="previewImage"
                src="{{ $product->image_url ?? asset('images/no-image.png') }}" 
                alt="商品画像"
              >
              <p class="preview-text">クリックして画像変更</p>
            </div>
            <input 
              type="file"
              name="image"
              id="imageInput"
              accept="image/*"
              style="display: none"
              onchange="handlePreviewImage(this)"
            >
          </div>
          <div class="btn-area">
              <a href="{{ route('admin.shohin.detail', $product->id)}}" class="btn btn-back">詳細へ</a>
              <button type="submit" class="btn btn-edit">保存</button>
              <button type="button" class="btn btn-edit" onclick="openModal()">削除</button>
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
        <form method="POST" action="{{ route('admin.shohin.delete', $product->id) }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="deleteBtn">はい</button>
        </form>
        <button type="button" onclick="closeModal()" class="deleteBtn">いいえ</button>
      </div>
    </div>
  </div>
@endsection