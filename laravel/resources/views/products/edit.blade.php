@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=1000, initial-scale=1" />
<title>Product Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    
    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    
    .form-group input:focus {
        outline: none;
        border-color: #66afe9;
    }
    
    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }
    
    .btn:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
<div class="container">
    <form action="{{route('products.update' , $product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" placeholder="Enter product name" value="{{$product->product_name}}" required>
        </div>
        <div class="form-group">
            <label for="product_details">Product Details</label>
            <input type="text" id="product_details" name="product_details" placeholder="Enter product details" value="{{$product->product_details}}" required>
        </div>
        <div class="form-group">
            <label for="product_type">Product Type</label>
           <select name="product_type"  id="product_type">
            <option value="{{$product->product_type}}">{{$product->product_type}}</option>
            <option value="Electronics">Electronics</option>
            <option value="Clothing">Clothing</option>
            <option value="Books">Books</option>
            <option value="Home&Kitchen">Home & Kitchen</option>
            <option value="Toys&Games">Toys & Games</option>
           </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" value="{{$product->amount}}" placeholder="Enter product amount" required>
        </div>
        <div class="form-group">
            <label for="product_image">Product image</label>
            <input type="file" id="product_image" name="product_image">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" placeholder="Enter price" value="{{$product->price}}" required>
        </div>
        <button type="submit" class="btn">Submit</button>
    </form>
</div>

</body>
</html> 
