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
    </style>
</head>
<body>
<div class="products">
  @foreach($payments as $payment)
      <table>
            <tr>
                <td>Payment Id</td>
                <td>Product Image</td>
                <td>Product Name</td>
                <td>Product Amount</td>
                <td>Total price</td>
                <td>Total Paid</td>
                <td>Payment Status</td>
                <td>Card Number</td>
            </tr>
            <tr>
                <td>{{$payment->PaymentId}}</td>
                <td><img src="{{asset('/laravel/storage/images/'.$payment->product_image_path)}}" width="200" height="200"></td>
                <td>{{$payment->product_name}}</td>
                <td>{{$payment->amount}}</td>
                <td>{{$payment->InvoiceDisplayValue}}</td>
                <td>{{$payment->InvoiceDisplayValue}}</td>
                <td>{{$payment->TransactionStatus}}</td>
                <td>{{$payment->CardNumber}}</td>
            </tr>
            <tr>
                <td colspan="8">

                <label>(Ordered at: </label>
                <span>{{$payment->created_at}}) --------------------</span>

                <label>(Shipped at: </label>
                @if($payment->shipped_at != null)
                <span>{{$payment->shipped_at}}) --------------------</span>
                @else
                <span>Waiting) --------------------</span>
                @endif

                <label>(Delivered at: </label>
                @if($payment->delivered_at != null)
                <span>{{$payment->delivered_at}})</span>
                @else
                <span>Waiting)</span>
                @endif

               </td>
            </tr>
        </table>
        <hr style="border-top: 3px solid black;height: 20px;">
  @endforeach
  </div>
</body>
</html>
