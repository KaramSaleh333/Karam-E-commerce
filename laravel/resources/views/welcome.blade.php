@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=1100, initial-scale=1" />
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
.sidebar {
      width: 250px;
      float: left;
      background-color: #f4f4f4;
      padding-top: 20px;
    }
    
    .sidebar h2 {
      margin-top: 0;
      padding-left: 20px;
      color: #333;
    }
    
    .sidebar ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }
    
    .sidebar li {
      padding: 10px 20px;
      border-bottom: 1px solid #ccc;
    }
    
    .sidebar li:last-child {
      border-bottom: none;
    }
    
    .sidebar li a {
      text-decoration: none;
      color: #333;
      display: block;
    }
    
    .sidebar li a:hover {
      background-color: #ddd;
    }
    
    .content {
      margin-left: 270px;
      padding: 20px;
    }
    
    .content h2 {
      color: #333;
    }
    
    .content p {
      color: #666;
    }
    .search-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 50px;
    }

    .search-container input[type="text"] {
        padding: 10px;
        width: 300px;
        border: none;
        border-bottom: 2px solid #ddd;
        background-color: transparent;
        outline: none;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    .search-container input[type="text"]:focus {
        border-color: dodgerblue;
    }

    .search-container button {
        padding: 10px 15px;
        background-color: dodgerblue;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-left: 10px;
        transition: background-color 0.3s;
    }

    .search-container button:hover {
        background-color: #007bb6;
    }
  </style>
</head>
<body>
<form action="{{route('products.search')}}" method="post">
  @csrf
<div class="search-container">
    <input type="text" name ='search' placeholder="Search By Name">
    <button type="submit">Search</button>
</div>
</form>
</div>
  <div class="sidebar">
  <h2>Departments</h2>
  <ul>
    <li><a href="{{route('products.sort' ,'Electronics')}}">Electronics</a></li>
    <li><a href="{{route('products.sort' ,'Clothing')}}">Clothing</a></li>
    <li><a href="{{route('products.sort' ,'Books')}}">Books</a></li>
    <li><a href="{{route('products.sort' ,'Home&Kitchen')}}">Home & Kitchen</a></li>
    <li><a href="{{route('products.sort' ,'Toys&Games')}}">Toys & Games</a></li>
  </ul>
</div>
<div class="products">
@php $products = $products->shuffle() @endphp
  @foreach($products as $product)
    @if($product->amount == 0)
       @continue
    @endif
    <div class="product-card">
      <img src="{{asset('/laravel/storage/images/'.$product->product_image_path)}}">
      <h2>{{$product->product_name}}</h2>
      <p>{{$product->product_details}}</p>
      <p>type: {{$product->product_type}}</p>
      <p>price: {{number_format($product->price)}}</p>

      @if(auth()->check() and auth()->user()->id == $product->user_id)
         <p class="product-carda">Mine</p>
      @else

      <form action="{{route('carts.create' ,$product->id)}}" method="post">
        @csrf
        <label for="amount">Choose Amount:</label>
        <select name="amount" id="amount" required>
          @for ($i = 1; $i <= $product->amount ; $i++)
            <option value="{{$i}}">{{$i}}</option>
          @endfor
          </select>
          <input type="submit" class="product-carda" value="Add to Cart">
      </form>
      <!-- <a href="{{route('carts.create' ,$product->id)}}" class="product-carda">Add to Cart</a> -->
      @endif
    </div>
  @endforeach
  </div>
</body>
</html>
