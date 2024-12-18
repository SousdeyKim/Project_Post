<?php
include("Connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>

<section class="vh-100 bg-dark">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-white bg-dark border-white" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 ">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" id="registerForm">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="username" class="form-control" placeholder="Enter your username"/>
                    </div>
                  </div>

                  <!-- Password Field with Show/Hide Toggle -->
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 position-relative">
                      <input type="password" id="password" name="password" class="form-control" placeholder="Create password"/>
                      <span class="toggle-password position-absolute end-0 top-50 translate-middle-y me-3 text-dark" >
                        <i class="fas fa-eye-slash"></i>
                      </span>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 position-relative">
                      <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Repeat password"/>
                      <span class="toggle-password position-absolute end-0 top-50 translate-middle-y me-3 text-dark" >
                        <i class="fas fa-eye-slash"></i>
                      </span>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" name="checkToS" type="checkbox" value="agree" id="checkToS" required />
                    <label class="form-check-label" for="checkToS">
                      I agree to all statements in <a href="#!" class="text-white">Terms of Service</a>
                    </label>
                  </div>


                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" id="submit" class="btn btn-light btn-lg">Register</button>
                  </div>

                </form>

              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Add event listeners for toggling password visibility
  // document.querySelectorAll('.toggle-password').forEach((Toggle) => {//rather than manully type document.querySelectorAll('.toggle-password')[0] and document.querySelectorAll('.toggle-password')[1], use foreach loop instead
  //   Toggle.addEventListener('click', (e) => {
  //     const input = Toggle.previousElementSibling;
  //     const icon = Toggle.querySelector('i');
      
  //     if (input.type === 'password') {
  //       input.type = 'text';
  //       icon.classList.remove('fa-eye-slash');
  //       icon.classList.add('fa-eye');
  //     } else {
  //       input.type = 'password';
  //       icon.classList.remove('fa-eye');
  //       icon.classList.add('fa-eye-slash');
  //     }
  //   });
  // });

  $(function() {
    // Toggle password visibility
    $(document).on('click', '.toggle-password', function() {
        const input = $(this).prev('input')[0];
        const icon = $(this).find('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            input.type = 'password';
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });

    // Handle form submission
    $('#registerForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Validate checkbox
        // if (!$('#checkToS').is(':checked')) {
        //     alert('You must agree to the Terms and Conditions to proceed.');
        //     return;
        // }

        var username = $('#username').val();
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        // var term = $('input[name="checkToS"]').is(':checked')? 'yes':'no';

        if (password !== confirmPassword) {
          alert('Passwords do not match. Please try again.');
          return; // Prevent form submission if passwords don't match
        }

        if (!username || !password) {
            alert('Please fill in both username and password.');
            return;
        }

        $.post("Users/registerUser.php", { txtuser: username, txtpass: password }, function(data){
                if(data == 1){
                  alert("Register successfully!");
                    window.location.href = "logIn.php";
                } else {
                    alert("Incorrect password or username. Try again!");
                }
                // alert(data);
                
            });

        // If all validations pass
        // alert(`Username: ${username}\nPassword: ${password}\nPassword: ${term}`); //The ${username} part inside the backtick string is string interpolation
    });
});


  



</script>

</body>
</html>
