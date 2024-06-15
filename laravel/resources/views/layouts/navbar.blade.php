<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Karam E-commerce</title>
  <style>
    /* Basic CSS for the navigation bar */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }
    nav {
      background-color: #333;
      overflow: hidden;
    }
    nav a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
    }
    nav a:hover {
      background-color: #ddd;
      color: black;
    }
    .profile {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }
    .profile0 {
      float: right;
      padding: 14px 20px;
    }
    .profile1 {
      float: right;
    }
  </style>
</head>
<body>

<nav>
  <a href="{{route('dashboard')}}" class="active">Home</a>
  <a href="{{route('aboutus')}}">About Us</a>
  <a href="{{route('contactus')}}">Contact Us</a>
  <a href="{{route('carts.index')}}">Cart</a>
  <a href="{{route('payments.show')}}">Orders</a>
  @if(auth()->check())
  <div class="profile">
    <a href="{{route('profile.edit')}}">{{auth()->user()->name}}</a>
  </div>
  <div class="profile0">
    <form action="{{route('logout')}}" method="post" class="logout-form">
       @csrf
       <input type="submit" value="Logout">
    </form>
  </div>
  @else
  <div class="profile1">
  <a href="{{route('login')}}" style="color: white;">login</a>
  <a href="{{route('register')}}" style="color: white;">register</a>
  </div>
  @endif
</nav>

</body>
</html>