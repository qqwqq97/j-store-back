<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>注文完了</title>
</head>
<body>
  <h2>ご注文ありがとうございます！</h2>

  <p>{{ $order->user->name }}様</p>

  <p>
    このたびは当ショップをご利用いただき、誠にありがとうございます。<br>
    ご注文を受け付けました。
  </p>

  <h3>ご注文内容</h3>

  <ul>
    <li>注文番号：{{ $order->id }}</li>
    <li>注文日時：{{ $order->created_at }}</li>
    <li>お支払い金額：¥{{ number_format($order->total_amount) }}</li>
  </ul>

  <p>
    商品の発送準備が整い次第、発送完了メールをお送りいたします。
  </p>

  <br>

  <p>
    今後ともJ_STOREをよろしくお願いいたします。
  </p>

  <hr>

  <p>
    J_STORE<br>
    お問い合わせ：support@example.com
  </p>
</body>
</html>