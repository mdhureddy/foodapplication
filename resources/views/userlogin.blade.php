<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI6wISmjnUinMfzH3f1bUZwefgulFRWI8&libraries=places&callback=initMap" defer></script>

    <style>
        body{
            font-family: cursive;
        }
        video {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            transform: translateX(-50%) translateY(-50%);
        }
        /* Style for the overlay */
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 20px;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .btn:hover{
            background: green;
            color:black;
            border:2px solid black;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <div class="card-body">
            <h1 class="card-title mb-5">User Login</h1>
           <button class="btn btn-danger"><a href="{{route('google-auth')}}" class="text-decoration-none text-light">Google login</a></button>
            <p id="demo"></p>
        </div>
    </div>
</div>

  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

