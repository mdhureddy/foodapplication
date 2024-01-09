<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- <script src="{{asset('js/function.js')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>
       body{
        font-family: cursive;
      }
      .navbar-brand{
        color: green !important;
        font-size: 24px;
        margin-right: 70px;
      }
      .nav-item{
        font-size: 21px;
      }
      .input-wrapper input {
           background-color: #eee;
           border: none;
           padding: 1rem;
           font-size: 1rem;
           width: 30em;
           border-radius: 1rem;
           color: lightcoral;
           box-shadow: 0 0.4rem #dfd9d9;
           cursor: pointer;
           margin: 30px 0px 30px 0px;
          }         
        .input-wrapper select{
          background-color: #eee;
           border: none;
           padding: 1rem;
           margin: 30px 0px 30px 0px;
           font-size: 1rem;
           width: 30em;
           border-radius: 1rem;
           color: lightcoral;
           box-shadow: 0 0.4rem #dfd9d9;
           cursor: pointer;
        }
      .input-wrapper input:focus {
        outline-color: lightcoral;
      }
      .card {
        width:auto;
        height: auto;
        margin: 80px;
        border-radius: 20px;
        padding: 5px;
        box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
        background-image: linear-gradient(144deg,#AF40FF, #5B42F3 50%,#00DDEB);
      }
      
      .card__content {
        
        background: rgb(5, 6, 45);
        border-radius: 17px;
        width: 100%;
        height: 100%;
       display:flex;
       align-items: center;
       justify-content: center;
      }
</style>

<script>
     
      function showError(field,message)
      {
          if(!message)
          {
              $("#"+field).addClass('is-valid')
              .removeClass('is-invalid')
              .siblings('.invalid-feedback')
              .text("");
          }
          else{
              $("#"+field)
              .addClass('is-invalid')
              .removeClass('is-valid')
              .siblings('.invalid-feedback')
              .text(message);
          }
      }
      function removeValidationClasses(form)
      {
          $(form).each(function()
          {
              $(form).find(':input').removeClass("is-valid is-invalid");
          });
      }
      
      function showMessage(type,message)
      {
          return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
          <strong>${message}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
      }
      
      
</script>
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
          <a class="nav-link text-light px-5" href="order">Orders</a>
        </li>
        
      </ul>
      <form class="d-flex px-5">
        <button class="btn btn-outline-success mx-4" type="submit"><a href="profile" class="text-light text-decoration-none">Profile</a></button>
        <button class="btn btn-danger" type="submit"><a href="ownerlogin" class="text-light text-decoration-none">Logout</a></button>
      </form>
    </div>
  </div>
</nav><br>

<div class="container mt-5">
<div id="show_success_alert"></div>
  <div class="card">
  
      <div class="card__content">
                     <form action="" method="" id="additems"  enctype="multipart/form-data">
                             @csrf
                             <div class="mb-3 input-wrapper">
                                 
                                 <input type="hidden" id="restaurant_name" name="restaurant_name" class="form-control" placeholder="Restaurant Name" value="{{$data->restaurant_name}}">
                                 <div class="invalid-feedback"></div>
                             </div>
                             <div class="mb-3 input-wrapper">
                                 
                                 <input type="text" id="food_name" name="food_name" class="form-control" placeholder="Food name">
                                 <div class="invalid-feedback"></div>
                             </div>
                             <div class="mb-3 input-wrapper">
                                 <select name="items_name" id="items_name" class=" form-control">
                                   <option value="" selected disabled hidden>Choose food</option>
                                     <option value="veg">Veg</option>
                                     <option value="nonveg">Non-Veg</option>
                                     <option value="fastfood">Fast Food</option>
                                     <option value="dessert">dessert</option>
                                 </select>
                                 <div class="invalid-feedback"></div>
                             </div>
                             <div class="mb-3 input-wrapper">
                                 
                                 <input type="text" id="description" name="description" class="form-control" placeholder="Description">
                                 <div class="invalid-feedback"></div>
                             </div>
                             <div class="mb-3 input-wrapper">
                                 
                                 <input type="number" id="price" name="price" class="form-control" placeholder="Price">
                                 <div class="invalid-feedback"></div>
                             </div>
                             
                             <div class="mb-3 input-wrapper">
                                 
                                 <input type="file" id="image_path" name="image_path" class="form-control" placeholder="Food name">
                                 <div class="invalid-feedback"></div>
                             </div>
                             
                             <div class="mb-3 input-wrapper">
                                 
                                 <input type="text" id="lat" name="lat" min="-90" max="90" step="any" placeholder="Enter Lattituder" class="form-control">
                                 <div class="invalid-feedback"></div>
                             </div>
                             <div class="mb-3 input-wrapper">
                                 
                                 <input type="text" id="log" name="log" min="-180" max="180" step="any" placeholder="Enter Longitude" class="form-control">
                                 <div class="invalid-feedback"></div>
                             </div>
                             
                             <button type="submit" class="btn btn-success mb-4" id="add_btn">Add Items</button>
                         </form>
                         <div style="margin-left:10%">
                          
                             <div class="mb-3 input-wrapper">
                              <label for="" class="text-white fs-4" style="margin-left:0%; margin-bottom:10%;">Enter your address</label>
                                <textarea type="text" id="addressInput" placeholder="Eg:Address..." class="form-control" required></textarea>
                             </div>
                            
                             
                              <button onclick="geocodeAddress()" class="btn btn-primary">Get Longitude & Lattitude</button>
                           
                          </div>
              <br> 
      </div>     
  </div>
</div>

<!-------jquery cdn------------------>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!--------Boostrap js cdn------------>
<!-- Bootstrap 5 JS CDN -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"
></script>


<script>
   function geocodeAddress() {
            var address = document.getElementById('addressInput').value;

           
            var queryParams = [];
            if (address) {
                queryParams.push(encodeURIComponent(address));
            }

            
            var geocodeUrl = `https://geocode.maps.co/search?q=${queryParams.join(',')}&api_key=6593e5577c7d8202740709tyeba73eb`;

            fetch(geocodeUrl)
                .then(response => response.json())
                .then(data => {
                    console.log('Geocoding Response:', data);

                    if (data && data[0] && data[0].lat && data[0].lon) {
                        console.log('Latitude:', data[0].lat);
                        console.log('Longitude:', data[0].lon);

                        document.getElementById('lat').value = data[0].lat;
                        document.getElementById('log').value = data[0].lon;
                    } else {
                        console.error('Invalid response structure or missing data.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
 
   ////////////////////////////

    $(function () {
        $('#additems').submit(function (e) {
            e.preventDefault();
            // alert("Hii");
            // console.log("Hiii");
            $('#add_btn').val('Please Wait......');

            // Create FormData object to handle file upload
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('additem') }}',
                method: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for FormData
                processData: false, // Set processData to false for FormData
                success: function (res) {
                  // console.log(res);
                    if (res.status == 400) {
                        // Handle validation errors
                        showError('restaurant_name', res.messages.restaurant_name);
                        showError('food_name', res.messages.food_name);
                        showError('description', res.messages.description);
                        showError('price', res.messages.price);
                        showError('image_path', res.messages.image_path);
                        showError('lat', res.messages.lat);
                        showError('log', res.messages.log);
                        showError('items_name', res.messages.items_name);

                        $('#add_btn').val('Add Items');
                    } else if (res.status == 200) {
                        // Handle success
                        Swal.fire("Added Items Successfully....... Thank you");
                       // $("#show_success_alert").html(showMessage('success', res.messages));
                        $("#additems")[0].reset();
                        removeValidationClasses("#additems");
                        $('#add_btn').val('Add Items');
                    }
                }
            });
        });
    });
</script>

<!-----Boostrap JS cdn---->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>