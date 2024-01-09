<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/food.css')}}">
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light mb-3">
  <div class="container-fluid">
    <div style="margin-left:10px">
        <!-- Replace 'logo.png' with your actual logo image -->
        <img src="https://png.pngtree.com/template/20200610/ourmid/pngtree-food-delivery-logo-design-image_381319.jpg" alt="Logo" style="height: 100px; width: 100px;">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link active" aria-current="page" href="userdashboard">Home</a>
        </li>
        <li class="nav-item mx-5">
            <a class="nav-link active" aria-current="page" href="userorder">Orders</a>
        </li>
      </ul> 
    </div>
    <div class="d-flex">
        
        @auth
            <p>Hello, {{ Auth::user()->name }}!</p>
        @else
            <p>You are not logged in.</p>
        @endauth
        <button class="btn btn-danger mx-3"><a href="display_data" class="text-decoration-none text-light">Cart</a></button>
        <button class="btn btn-danger"><a href="userlogin" class="text-light text-decoration-none">Logout</a></button>
      
    </div>
  </div>
</nav>
 <!---Food----->
 <div class="container mt-5" id="hr-card">
        <!-- First Row -->
       
        <div class="wrapper">
            <div class="item">
                <a href="{{ url('veg') }}" class="text-decoration-none text-dark">
                    <img src="https://b.zmtcdn.com/data/o2_assets/8dc39742916ddc369ebeb91928391b931632716660.png" alt="" class="rounded-img nav-img">
                    <h4>Veg</h4>
                </a>
            </div>
            <div class="item">
               <a href="{{route('nonveg')}}" class="text-decoration-none text-dark"> <img src="https://b.zmtcdn.com/data/dish_images/d19a31d42d5913ff129cafd7cec772f81639737697.png" alt="" class="rounded-img nav-img">
                <h4>Non-Veg</h4>
                </a>
            </div>
            <div class="item">
            <a href="{{route('fastfood')}}" class="text-decoration-none text-dark">  <img src="https://b.zmtcdn.com/data/dish_images/ccb7dc2ba2b054419f805da7f05704471634886169.png" alt="" class="rounded-img nav-img">
                <h4>Fast food</h4></a>
            </div>
            <div class="item">
                <a href="{{route('softdrink')}}" class="text-decoration-none text-dark">
                <img src="https://b.zmtcdn.com/data/o2_assets/388b54022a15f68d42515a824547db6c1632716604.png" alt="" class="rounded-img nav-img">
                <h4>Desserts</h4></a>
            </div>
  </div>
</div>
<div class="container" style="display: flex; flex-direction: column; align-items: center;margin:10px 0px 10px 290px">
   
    <!-- <h1 style="text-align: center;">Delicious Food Items</h1><br> -->
    <!-- <input type="search" name="search" id="search" placeholder="Search here...." style="margin-bottom: 10px;width:300px" class="form-control" > -->
    @if(session()->has('success'))
    <h4 class="text-success">{{ session('success') }}</h4>
    @endif
</div>
<div class="container" id="order_food" style="margin-top:10px">
      @if(count($items)>0)
        <div class="row">
        @foreach($items as $item)
        
            <div class="col-lg-3 col-sm-6 col-md-3 col-6" >
                <div class="card shadow mb-5 bg-body rounded" >
                  <form action="{{url('addcard',$item->id)}}" method="POST">
                    <div class="card-header">
                        <img src="{{ Storage::url($item->image_path) }}" style="width: 100%; height: 100%;" alt="Not Found">
                    </div>
                    <div class="card-body">
                            
                              <div>
                                  <h4>{{$item->food_name}}</h4>
                                  <p>{{$item->restaurant_name}}</p>
                                  <small>{{substr($item->description, 0, 70)}}{{strlen($item->description) > 50 ? '...' : ''}}</small><br><br>
                                  <td>{{ $item->distance }} km</td>
                                  <p><strong>${{$item->price}}</strong></p>
                              </div>
                              <div class="rating">
                                @for($i = 1; $i <= 4; $i++)
                                    <span class="star text-warning">&#9733;</span>
                                @endfor
                              </div>
                            
                              @csrf
                              <input type="number" value="1" min="1" name="quantity" id="" class="form-control" style="width:100px"><br>
                              <input type="submit" value="Add Card" class="btn btn-dark">
                          
                        
                    </div>
                    </form>
                </div>
            </div>
        @endforeach
        </div>
      @else
      <h1>No Items here</h1>
      @endif
    </div>
      
</div>



<!-----Boostrap JS cdn---->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"><script/>
</body>
</html>