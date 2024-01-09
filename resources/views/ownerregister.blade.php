<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <title>Owner Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{asset('js/function.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('/css/register.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div id="show_success_alert"></div>
<div class="container">
    <div class="" style="margin:100px;">
                <form class="form" id="reg_form">
                    <p class="title">Register </p>
                    <p class="message">Signup now and get full access to our app. </p>   
                    <label>
                        <input class="input" type="text" name="name" id="name">
                        <span>Fullname</span>
                       <div class="invalid-feedback"></div>
                    </label>        
                    <label>
                        <input class="input" type="email" name="email" id="email">
                        <span>Email</span>
                        <div class="invalid-feedback"></div>
                    </label> 
                    <label>
                        <input class="input" type="text" name="restaurant_name" id="restaurant_name">
                        <span>Restaurant Name</span>
                        <div class="invalid-feedback"></div>
                    </label> 
                    <label>
                        <input class="input" type="number" name="number" id="number">
                        <span>Number</span>
                        <div class="invalid-feedback"></div>
                    </label> 
                    <label>
                        <input class="input" type="password" name="password" id="password">
                        <span>Password</span>
                        <div class="invalid-feedback"></div>
                    </label>
                    <label>
                        <input class="input" type="password" name="cpassword" id="cpassword">
                        <span>Confirm password</span>
                        <div class="invalid-feedback"></div>
                    </label>
                    <input class="submit" type="submit" value="Submit" id="reg_btn">
                    <p class="signin">Already have an acount ? <a href="ownerlogin">Signin</a></p>
                </form>
    </div>
</div>
<!-----JQuery CDN------------>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
   $(function (){
    $('#reg_form').submit(function(e){
        e.preventDefault();
        $('#reg_btn').val('Please Wait');
        $.ajax({
            url: '{{ route('ownerregister') }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                // console.log(res);
                // Access the response data
                if(res.status==400)
                {
            //Here reg_name id input field name is input field name
                    showError('name',res.messages.name);
                    showError('email',res.messages.email);
                    showError('restaurant_name',res.messages.restaurant_name);
                    showError('number',res.messages.number);
                    showError('password',res.messages.password);
                    showError('cpassword',res.messages.cpassword);
                    $('#reg_btn').val('Submit');
                }
                else if(res.status === 200)
                {
                    Swal.fire("Register Successfully Please Login.......");
                //    $("#show_success_alert").html(showMessage('success',res.messages));
                   $("#reg_form")[0].reset();
                   removeValidationClasses("#reg_form");

                   
                   $('#reg_btn').val('Submit');
                  // Redirect to the specified URL
                    //  if (res.redirect) {
                    //      window.location.href = res.redirect;
                    //  }
                    
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
            }
        });
    });
});


        
</script>

<!------Boostrap js---------->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>