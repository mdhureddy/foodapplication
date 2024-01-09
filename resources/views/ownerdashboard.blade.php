<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
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
          <a class="nav-link active text-light px-5" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light px-5" href="additems">Add items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light px-5" href="order">Orders</a>
        </li>
        
      </ul>
      <form class="d-flex px-5">
        <button class="btn btn-outline-success mx-4" type="submit"><a href="profile" class="text-light text-decoration-none">Profile</a></button>
        <button class="btn btn-danger" type="submit"><a href="ownerlogin" class="text-light text-decoration-none">Logout</a></button>
      </form>
    </div>
  </div>
</nav>
<!----Curosal--->

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://cdn.pixabay.com/photo/2017/11/17/16/05/duck-2957809_1280.jpg" class="d-block w-100 nav-img" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://cdn.pixabay.com/photo/2022/06/07/20/52/curry-7249247_1280.jpg" class="d-block w-100 nav-img" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://cdn.pixabay.com/photo/2017/12/09/08/18/pizza-3007395_1280.jpg" class="d-block w-100 nav-img" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!---cards 1---->

<div class="container" style="margin-top:2%">
      @if(count($data)>0)
        <div class="row">
        @foreach($data as $item)
        
            <div class="col-lg-3 col-sm-6 col-md-3 col-6" >
                <div class="card shadow mb-5 bg-body rounded" >
                    <div class="card-header">
                        <img src="{{ Storage::url($item->image_path) }}" style="width: 100%; height: 100%;" alt="Not Found">
                    </div>
                    <div class="card-body">
                      <h4>{{$item->food_name}}</h4>
                      <p>{{$item->restaurant_name}}</p>
                      <small>{{substr($item->description, 0, 70)}}{{strlen($item->description) > 50 ? '...' : ''}}</small><br><br>
                      <p><strong>${{$item->price}}</strong></p>    
                    </div>
                   
                </div>
            </div>
        @endforeach
        </div>
      @else
      <h1>No Data Found</h1>
      @endif
    </div>
      
</div> 


<!-----Boostrap JS cdn---->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>