<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <!-- Boostrap css cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Boostrap js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!----------------Sweetalert CDN-------->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body{
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
            <input type="search" name="search" id="search" placeholder="Search here...." style="margin-bottom: 10px;width:400%; margin:auto;border-radius:20px;" class="form-control" >
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
<div class="" style="margin:200px 50px 0px 50px">
   
    @if(count($items_data) > 0)

      
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Image</th>
                
                <th scope="col">Restaurant Name</th>
                <th scope="col">Food Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
            @endphp
         
            @foreach($items_data as $item)
                @php
                    $totalAmount = $item->quantity * $item->price;
                    $grandTotal += $totalAmount;
                @endphp
                <tr>
                    <td><img src="{{ Storage::url($item->image) }}" style="width: 150px; height: 100px;" alt="Not Found"></td>
                   
                    <td>{{$item->restaurant_name}}</td>
                    <td>{{$item->food_name}}</td>
                    
                    <td>
                    
                    {{ $item->quantity }}
                   
                    </td>
                    <td>${{$item->price}}</td>
                    <td>${{$totalAmount}}</td>
                    <td>
                        <form class="deleteForm" data-url="{{ url('delete/' . $user->id . '/' . $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger deleteBtn">Delete</button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
            
        
            <!-- Display grand total at the end of the table -->
            <tr>
                <td colspan="5"><strong>Grand Total</strong></td>
                <td>${{$grandTotal}}</td>
            </tr>
        </tbody>
    </table>
    
    <!-- checkout -->
    <form id="form_data" data-url="{{ url('delete/' . $user->id) }}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-success" id="checkoutBtn" style="margin-left:90%;">Checkout</button>
    </form>
@else
    <h2>No data present in the cart.</h2>
@endif

</div>
<!--------Ajax CDN--------->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Include Stripe.js in your HTML -->



<!-- At the bottom of the file, after the Bootstrap JS -->
<script>
    $(document).ready(function () {
        $('.deleteBtn').click(function () {
            var form = $(this).closest('.deleteForm');
            var url = form.data('url');
    
            $.ajax({
                url: url,
                method: 'POST',
                data: form.serialize(),
                success: function (response) {
                    
                    Swal.fire({
                            icon: 'success',
                            title: 'Successfully deleted',
                            didClose: () => {
                                // Reload the page after successful deletion when SweetAlert is closed
                                location.reload();
                             }
                        });
                    
                },
                error: function (error) {
                    // Handle errors, e.g., show an error message
                    console.error(error);
                    alert('Error during deletion. Please try again.');
                }
            });
        }); 
    
        $('#checkoutBtn').click(function () {
            var form = $('#form_data');
            var url = form.data('url');
    
            $.ajax({
                url: url,
                method: 'POST',
                data: form.serialize(),
                
                success: function (response) {
            //   console.log(123);
                 var stripe = Stripe('{{ config('strip.pk') }}');
           
                //    stripe.redirectToCheckout({ sessionId: response.url});
                   
                    window.location.href = response.url;
                    // window.location.reload();
                },
                error: function (error) {
                    
                    // Handle errors, e.g., show an error message
                    console.error(error);
                    alert('Error during checkout. Please try again.');
                }
            });
        });
    });
 
</script>



</body>
</html>
