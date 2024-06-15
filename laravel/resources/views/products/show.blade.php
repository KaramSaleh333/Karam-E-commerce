@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=1000, initial-scale=1" />
<title>Product Display</title>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
}

.product {
    display: flex;
    margin-bottom: 20px;
}

.product-image {
    flex: 0 0 200px;
    margin-right: 20px;
}

.product-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.product-details {
    flex: 1;
}

.product-details h2 {
    margin-top: 0;
}

.product-details p {
    margin: 5px 0;
}
.button1 {
    display: inline-block;
    padding: 10px 20px;
    background-color: #0074D9;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
.red-submit {
  background-color: red;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

.red-submit:hover {
  background-color: darkred;
}
</style>
</head>
<body>

<div class="container">
    <h1>My Products</h1>
    @foreach($products as $product)
    <div class="product">
        <div class="product-image">
            <img src="{{asset('/laravel/storage/images/'.$product->product_image_path)}}">
        </div>
        <div class="product-details">
            <h2>{{$product->product_name}}</h2>
            <p>{{$product->product_details}}</p>
            <p>{{$product->product_type}}</p>
            @if($product->amount == 0)
            <p>remaining amount: {{$product->amount}} (Sold out completely)</p>
            @else
            <p>remaining amount: {{$product->amount}}</p>
            @endif
            <p>price: {{number_format($product->price)}}</p>
            <a href="{{route('products.edit' , $product->id)}}" class="button1">Edit</a> <br>
            <form action="{{route('products.destroy' , $product->id)}}"  method="post">
                @csrf
                @method('Delete')
                <input type="submit" class="red-submit" value="Delete">
            </form>
        </div>
    </div>
    @endforeach
    
</div>
</body>
</html>
