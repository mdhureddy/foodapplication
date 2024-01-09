<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
      body{
        font-family: cursive;
      }
      .nav-img{
        width:200px;
        height:400px;
      }
      .navbar-brand{
        color: green !important;
        font-size: 24px;
        margin-right: 70px;
      }
      .nav-item{
        font-size: 21px;
      }
      
    </style>
</head>
<body>

<!--  navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#" >Deliveroo..</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link active text-light px-5" aria-current="page" href="ownerdashboard">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light px-5" href="additems">Add items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light px-5" href="#">Orders</a>
        </li>
        
      </ul>
      <form class="d-flex px-5">
        <button class="btn btn-outline-success mx-4" type="submit"><a href="profile" class="text-light text-decoration-none">Profile</a></button>
        <button class="btn btn-danger" type="submit"><a href="ownerlogin" class="text-light text-decoration-none">Logout</a></button>
      </form>
    </div>
  </div>
</nav>

<div style="margin-top:100px">
  
@if(session()->has('info'))
    <div>{{ session('info') }}</div>
    @else
        <div>{{ session('message') }}</div>
    @endif
</div>
    </div> 
    <div class="m-4">
   
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Image</th>
                
                <th scope="col">Restaurant Name</th>
                <th scope="col">Food Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total Amount</th>
                
            </tr>
        </thead>
        <tbody>
           
         
            @foreach($order_data as $item)
                @php
                    $totalAmount = $item->quantity * $item->price;
                   
                @endphp
                <td><img src="{{ Storage::url($item->image) }}" style="width: 150px; height: 100px;" alt="Not Found"></td>
                <td>{{ $item->restaurant_name }}</td>
                <td>{{ $item->food_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td>${{$totalAmount}}</td>
   
               
                <tr>
                    
                        
                    </td>
                    
                </tr>
            @endforeach
            
        
           
        </tbody>
    </table>
    

</body>
</html>