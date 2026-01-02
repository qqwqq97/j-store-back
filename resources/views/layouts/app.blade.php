<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', '管理画面')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <header>
    <h1>管理者ダッシュボード</h1>
    <nav>
      <a href="{{ route('admin.dashboard')}}">ホーム</a>
      <a href="{{ route('admin.shohin.list')}}">商品管理</a>
      <a href="#">注文管理</a>

      <form style="display:inline" method="POST" action="{{ route('admin.logout')}}">
        @csrf
        <button>ログアウト</button>
      </form>
    </nav>
  </header>
  @if(session('success'))
    <div id="flash-message" class="flash-success">
      <span class="icon">✓</span>
      <span class="message">{{ session('success') }}</span>
    </div>
  @endif
  <main>
    @yield('content')
  </main>
  <script>
    setTimeout(() => {
      const msg = document.getElementById('flash-message');
      if(msg) {
        msg.classList.add('fade-out');
        setTimeout(() => msg.remove(), 500)
      }
    }, 3000)

    window.triggerFileInput = function () {
      document.getElementById('imageInput').click();
    } 

    window.handlePreviewImage = function(input) {
      if(input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
          document.getElementById('previewImage').src = e.target.result;
        }
        // reader에서 파일을 읽은 후에 읽은 데이터를 위쪽에 전달 (이미지파일 -> base64문자열)
        // 결과가 e.target.result
        reader.readAsDataURL(input.files[0]);
      }
    }
    function openModal() {
      document.getElementById('modal').style.display = 'block';
    }

    function closeModal() {
      document.getElementById('modal').style.display = 'none'; 
    }
  </script>
</body>
</html>