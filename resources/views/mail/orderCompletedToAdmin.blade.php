<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規注文通知</title>
</head>
<body>
    <h2>新しい注文が入りました。</h2>

    <p>注文情報をご確認ください。</p>

    <h3>注文情報</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th align="left">注文番号</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th align="left">注文者</th>
            <td>{{ $order->user->name }}</td>
        </tr>
        <tr>
            <th align="left">メールアドレス</th>
            <td>{{ $order->user->email }}</td>
        </tr>
        <tr>
            <th align="left">注文日時</th>
            <td>{{ $order->created_at }}</td>
        </tr>
        <tr>
            <th align="left">合計金額</th>
            <td>¥{{ number_format($order->total_amount) }}</td>
        </tr>
    </table>

    <h3>注文商品</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>商品名</th>
            <th>数量</th>
            <th>金額</th>
        </tr>

        @foreach ($order->items as $item)
          <tr>
              <td>{{ $item->product->name }}</td>
              <td>{{ $item->quantity }}</td>
              <td>¥{{ number_format($item->price) }}</td>
          </tr>
        @endforeach
    </table>

    <br>

    <h3>配送先</h3>

    <ul>
        <li>郵便番号：{{ $order->shipping_zip }}</li>
        <li>住所：{{ $order->shipping_address1 }} {{ $order->shipping_address2 }}</li>
        <li>電話番号：{{ $order->shipping_phone }}</li>
    </ul>

    <p>管理画面より詳細をご確認ください。</p>

    <hr>

    <p>J_STORE</p>
</body>
</html>