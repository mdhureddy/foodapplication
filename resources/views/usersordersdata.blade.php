<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
    font-family: cursive;
    
}
    </style>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
        <img src="https://png.pngtree.com/template/20200610/ourmid/pngtree-food-delivery-logo-design-image_381319.jpg" alt="Logo" style="height: 100px; width: 100px;">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mx-5">
            <a class="nav-link active" aria-current="page" href="userdashboard">Home</a>
        </li>
        <li class="nav-item mx-5">
            <a class="nav-link active" aria-current="page" href="userorder">Orders</a>
        </li>
        <!-- <li class="nav-item mx-4">
            <input type="search" name="search" id="search" placeholder="Search here...." style="margin-bottom: 10px;width:100%; margin:auto;border-radius:20px;" class="form-control" >
        </li> -->
        
        
      </ul>
      <form class="d-flex">
            @auth
                  <p>Hello, {{ Auth::user()->name }}!</p>
              @else
                  <p>You are not logged in.</p>
              @endauth
              <br>
              <button class="btn btn-danger mx-3"><a href="display_data" class="text-decoration-none text-light"><p class="card-text">{{($items_data_count)}}</p>Cart</a></button>
              <button class="btn btn-danger"><a href="userlogin" class="text-light text-decoration-none">Logout</a></button>
        </form>
    </div>
  </div>
</nav>

@if(session()->has('info'))
    <div>{{ session('info') }}</div>
@else
    <div>{{ session('message') }}</div>
@endif





<div class="" style="margin-top:150px">
<table class="table">
    <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Restaurant Name</th>
            <th scope="col">Food Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Date & Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order_data as $item)
            @php
                $totalAmount = $item->quantity * $item->price;
            @endphp
            <tr>
                <td><img src="{{ Storage::url($item->image) }}" style="width: 150px; height: 100px;" alt="Not Found"></td>
                <td>{{ $item->restaurant_name }}</td>
                <td>{{ $item->food_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td>${{ $totalAmount }}</td>
                <td>{{ $item->date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>

</body>
</html>