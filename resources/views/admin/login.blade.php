<div class="login-container">
  <form method="post" action="{{ route('admin.login.store')}}">
    @csrf
    <h2>管理者ログイン</h2>

    <input type="email" name="email" placeholder="メールアドレス">
    @if ($errors->has('email'))
      <div class="error">{{$errors->first('email')}}</div>
    @endif  
    
    <input type="password" name="password" placeholder="パスワード">

    <button type="submit">ログイン</button>
  </form>
</div>

<style>
  body {
    background: #f5f6fa;
    font-family: "Noto Sans KR", sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  .login-container {
    width: 360px;
    background: #fff;
    padding: 32px;
    border-radius: 12px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
  }
  h2 {
    text-align: center;
    margin-bottom: 24px;
    font-size: 20px;
    font-weight: 600;
    color: #333;
  }
  input {
    width: 100%;
    padding: 12px;
    margin-bottom: 14px;
    border: 1px solid #ddd;
    font-size: 14px;
    transition: border-color 0.2s;
  }
  input:focus {
    border-color: #3b82f6;
    outline: none;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.2);
  }
  button {
    width: 100%;
    padding: 12px;
    background: #ddd;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
  }
  button:hover {
    background: #2563eb;
  }
  .error {
    color: #e11d48;
    font-size: 13px;
    margin-bottom: 8px;
  }
</style>