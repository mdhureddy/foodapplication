<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!----Animated cdn------>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></script> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-------Css Style------->
  <link rel="stylesheet" href="{{ asset('css/food.css') }}">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 
  
 
</head>
<body>
<!------navbar------>

<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
        <img src="https://png.pngtree.com/template/20200610/ourmid/pngtree-food-delivery-logo-design-image_381319.jpg" alt="Logo" style="height: 100px; width: 100px;">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mx-5">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item mx-5">
            <a class="nav-link active" aria-current="page" href="userorder">Orders</a>
        </li>
        <li class="nav-item mx-4">
            <input type="search" name="search" id="search" placeholder="Search here...." style="margin-bottom: 10px;width:400%; margin:auto;border-radius:20px;" class="form-control" >
        </li>
        
        
        
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



  
<!----Horizontal scroll bar card items---->
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
<!-----search Bar------>
<div class="container" style="display: flex; flex-direction: column; align-items: center;margin:10px 0px 10px 290px">
   
    <h1 style="text-align: center;">Delicious Food Items</h1><br>
    <!-- <input type="search" name="search" id="search" placeholder="Search here...." style="margin-bottom: 10px;width:300px" class="form-control" > -->
    @if(session()->has('success'))
    <h4 class="text-success">{{ session('success') }}</h4>
       
    @endif
</div>
 <!-----cards data----->
<div class="container" id="order_food">
      @if(count($collection)>0)
        <div class="row">
        @foreach($collection as $item)
        
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
                                  <td><i class="fa fa-map-marker" style="font-size:28px;color:red">&nbsp</i>{{ $item->distance }} km</td>
                                  <p><strong>${{$item->price}}</strong></p>
                              </div>
                              <!-- <div class="rating">
                                @for($i = 1; $i <= 4; $i++)
                                    <span class="star text-warning">&#9733;</span>
                                @endfor
                              </div> -->
                            
                              @csrf
                              <!-- <input type="number" value="1" min="1" name="quantity" id="" class="form-control" style="width:100px"><br> -->
                              <input type="number" value="{{ old('quantity', 1) }}" min="1" name="quantity" class="form-control" style="width:100px"><br>
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                              <input type="submit" value="Add Card" id="add_card" class="btn btn-dark">   
                    </div>
                    </form>
                </div>
            </div>
        @endforeach
        </div>
      @else
      <h1>No Data Found</h1>
      @endif
    </div>
      
</div> 

</body>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- <script>
    $(document).ready(function() {
        $('#add').click(function() {
            alert('Successfully added to cart!');
        });
    });
</script> -->
<script>
  
   
    jQuery(document).ready(function(){
    $('#search').on('keyup',function(){
      var value=$(this).val();
      console.log('Search Value:', value);
      
      $.ajax({
        url:"{{ url('/userdashboard') }}",
        type:"GET",
        data:{'search':value},
       
        success: function(data) 
        {
          console.log('AJAX Response:', data);
            var collection = data.collection;
            var html = '<div class="row">';
  
            if (collection.length > 0) {
                for (let i = 0; i < collection.length; i++) {
                    var formId = 'addCardForm_' + collection[i].id; // Generate unique form ID
                    html += '<div class="col-lg-3 col-sm-6 col-md-3 col-6">' +
                                '<div class="card shadow mb-5 bg-body rounded">' +
                                '<form id="' + formId + '" action="{{ url('addcard') }}/' + collection[i].id + '" method="POST">' +
                                    '<div class="card-header">' +
                                        '<img src="{{ Storage::url('') }}/' + collection[i]['image_path'] + '" style="width: 100%; height: 100%;" alt="Not Found">' +
                                    '</div>' +
                                    '<div class="card-body">' +
                                        '<div>' +
                                            '<h4>' + collection[i]['food_name'] + '</h4>' +
                                            '<p>' + collection[i]['restaurant_name'] + '</p>' +
                                            '<small>' + collection[i]['description'].substring(0, 70) +
                                                (collection[i]['description'].length > 50 ? '...' : '') + '</small><br><br>' +
                                            '<p><strong>' + collection[i]['price'] + '</strong></p>' +
                                            '<p>' + collection[i]['distance'] + ' km</p>' +  // Include the distance here
                                        '</div>' +
                                        '<div class="rating">';
                    for (let j = 1; j <= 4; j++) {
                        html += '<span class="star text-warning">&#9733;</span>';
                    }
                    html +=        '</div>' +
                                        
                                            '@csrf' +
                                            '<input type="number" value="1" min="1" name="quantity" id="" class="form-control" style="width:100px"><br>' +
                                            '<input type="submit" value="Add Card" class="btn btn-dark">' +
                                        
                                      '</div>' +
                                '</form>' +
                                '</div>' +
                            '</div>';
                }
            } 
            else {
                html += `<h1>No Data Found</h1>`;
            }
            html += '</div>'; // Close the row
  
            // Replace the content of #order_food with the new search results
            $('#order_food').html(html);
        }
      });
    });
  });
</script>

</html>