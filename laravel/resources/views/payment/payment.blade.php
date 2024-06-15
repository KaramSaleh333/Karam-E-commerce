@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=1000, initial-scale=1" />
    <title>Product Table</title>
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

    </style>
</head>
<body>
    <div class="container">
        <h2>Product Details</h2>
        <table>
            <tr>
                <td>Product Name</td>
                <td>Product Amount</td>
                <td>Price Per One</td>
                <td>Total Price</td>
            </tr>
            <tr>
                <td>{{$product[0]->product_name}}</td>
                <td>{{$product[0]->pivot->amount}}</td>
                <td>{{$product[0]->price}}</td>
                <td>{{$product[0]->price * $product[0]->pivot->amount}}</td>
                <td><a href="{{route('payorder' ,$product[0]->id)}}" class="pay-button">Pay</a></td>
            </tr>
        </table>
    </div>
</body>
</html>
