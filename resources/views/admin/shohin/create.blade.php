@extends('layouts.app')

@section('title', '商品登録')

@section('content')
  <div class="wrapper">
    <h1 class="addShohinTitle">商品登録</h1>
    <div class="card">
      <div class="form-group">
        <form action="{{ route('admin.shohin.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <label for="category_id" class="form-label">カテゴリ</label>
            <div class="select-wrapper">
              <select name="category_id" id="category_id" class="form-control" style="width: 180px" required>
                <option value="">選択して下さい</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">
                    {{ $category->name }}
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
            value=""  
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
          ></textarea>
        </div>
        <div class="form-group">
          <label for="price" class="form-label">価格</label>
          <input 
            type="number" 
            class="form-control" 
            name="price"
            id="price"
            value="" 
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
            value=""  
            required
          >
        </div>
        <div class="form-group">
          <label for="image" class="form-label">商品画像</label>
          <div class="image-preview" onclick="triggerFileInput()">
            <img
              id="previewImage"
              src="" 
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
            <a class="btn btn-back" onclick="openModal()">一覧へ</a>
            <button type="submit" class="btn btn-edit">保存</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <div class="modal" id="modal">
    <div class="modal-content">
      <button type="button" class="modal-close" onclick="closeModal()">×</button>
      <p>保存しないまま一覧ページに戻りますか？</p>
      <div class="btnArea">
      <button type="button" class="modalBtn" onclick="location.href='{{ route('admin.shohin.list') }}'">はい</button>
      <button type="button" class="modalBtn" onclick="closeModal()">いいえ</button> 
      </div>
    </div>
  </div>
@endsection