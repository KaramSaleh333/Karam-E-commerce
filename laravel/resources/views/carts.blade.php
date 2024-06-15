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
  margin: 0;
  padding: 0;
}

.products {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.product-card {
  width: 200px;
  margin: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  text-align: center;
}

.product-card img {
  width: 100%;
  border-radius: 5px;
}

.product-card h2 {
  margin-top: 10px;
  font-size: 18px;
}

.product-card p {
  margin: 10px 0;
}

.product-carda {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
}

.product-card button:hover {
  background-color: #555;
}
  </style>
</head>
<body>
<div class="products">
  @foreach($products as $product)
  @if($product->pivot->amount == 0)
       @continue
    @endif
    <div class="product-card">
      <img src="{{asset('/laravel/storage/images/'.$product->product_image_path)}}" width="200" height="200">
      <h2>{{$product->product_name}}</h2>
      <p>{{$product->product_details}}</p>
      <p>type: {{$product->product_type}}</p>
      <p>amount: {{$product->pivot->amount}}</p>
      <p>price per one: {{number_format($product->price)}}</p>
      <a href="{{route('carts.destroy' ,$product->id)}}" class="product-carda">Delete from cart</a> <br> <br>
      <a href="{{route('createpayment' ,$product->id)}}" class="product-carda">Checkout</a>
    </div>
  @endforeach
  </div>
</body>
</html>
