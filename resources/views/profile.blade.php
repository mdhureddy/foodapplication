<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-----Animated CDN------------------->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
      body{
        font-family: cursive;
        overflow-x:hidden;
      }
     
      .navbar-brand{
        color: green !important;
        font-size: 24px;
        margin-right: 70px;
      }
      .nav-item{
        font-size: 21px;
      }
      .card{

      }
      
    </style>
</head>
<body>
    <!-----Navbar------>
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

<div class="container" style="margin-top:100px">
    <div class="card shadow-lg p-3 mb-5 bg-body rounded animate__animated animate__bounce">
          <div class="card-header">
              @if(Session::has('success'))
                    <div id="success-message" style="color:#8ff796;"><h2>{{Session::get('success')}}</h2></div>
              @endif
          </div>
          <div class="card-body">
              <form action="{{url('update_profile/'.$data->id)}}" method="POST">
              {{@csrf_field()}}
            
              @method('PUT')
              <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" placeholder="Enter name"><br>
              <span class="text-danger">@error('name'){{$message}}@enderror</span>
              <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}"><br>
              <span class="text-danger">@error('email'){{$message}}@enderror</span>
             
              <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="{{$data->restaurant_name}}"><br>
              <span class="text-danger">@error('restaurant_name'){{$message}}@enderror</span>
              <button type="submit" class="btn btn-primary mt-4">Update</button>
              </form>
          </div>
    </div>
</div>

<script>
     // Automatically hide the success message after 5 seconds
     setTimeout(function() {
         document.getElementById('success-message').style.display = 'none';
     }, 5000); // 5000 milliseconds = 5 seconds
</script>
<!-----Boostrap JS cdn---->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>