@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=1000, initial-scale=1" />
  <title>Products Page</title>
  <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td, th {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

@media screen and (max-width: 600px) {
    .container {
        margin: 20px;
        padding: 10px;
    }
}
.pay-button {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
}

.pay-button:hover {
    background-color: #0056b3;
}
.order-status {
            margin: 20px auto;
            width: 300px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }
        .order-status h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .order-item {
            margin-bottom: 10px;
        }
        .order-item label {
            font-weight: bold;
        }
        .order-item span {
            margin-left: 10px;
        }

    </style>
</head>
<body>
<div class="products">
  @foreach($products as $product).
      <table>
            <tr>
                <td>Payment Id</td>
                <td>Product Image</td>
                <td>Product Name</td>
                <td>Product Amount</td>
                <td>Total Paid</td>
                <td>Shipping</td>
                @if($product->shipped_at != null)
                <td>Delivered</td>
                @endif
            </tr>
            <tr>
                <td>{{$product->PaymentId}}</td>
                <td><img src="{{asset('/laravel/storage/images/'.$product->product_image_path)}}" width="200" height="200"></td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->amount}}</td>
                <td>{{$product->InvoiceDisplayValue}}</td>
                @if($product->shipped_at == null)
                <td><button><a href="{{route('payments.shipping' ,$product->id)}}">Shipping</a></button></td>
                @else
                <td>has been shipped</td>
                @endif

                @if($product->shipped_at != null)
                    @if($product->delivered_at == null)
                    <td><button><a href="{{route('payments.delivered' ,$product->id)}}">Delivering</a></button></td>
                    @else
                    <td>has been delivered</td>
                    @endif
                @endif
            </tr>
        </table>

  @endforeach
  </div>
</body>
</html>
