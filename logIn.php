<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    /* Set the height of the full viewport to center vertically */
    .center-container {
      height: 100vh;
    }
  </style>
</head>

<body>
  <script>
    // $(function(){
    //   $('#btnsubmit').click(function(){
    //     var user = $('#username').val();
    //     var pass = $('#pwd').val();

    //     if($.trim(user)=="" || $.trim(pass)==""){
    //       alert("Empty user or password.Try again");
    //     }
    //     else if(user.length > 30){
    // 						alert("user must < 30");
    // 		}
    //     else {
    //       $.post("Users/checkUser.php",{txtuser:user,txtpass:pass},function(data){
    //         // alert('test');

    //         if(data ==1){
    //           window.location.href="Admin/index.php";
    //         }
    //         else{
    //           alert("Incorrect password or username. Try Again!");

    //         }
    //         // alert(data);
    //       });
    //     }     
    //   });

    // });
    //   $(function() {
    //   $('#btnsubmit').click(function(event) {
    //     event.preventDefault(); // Prevents the form from submitting the traditional way
    //     var user = $('#username').val();
    //     var pass = $('#pwd').val();

    //     if ($.trim(user) === "" || $.trim(pass) === "") {
    //       alert("Empty user or password. Try again");
    //     } else if (user.length > 30) {
    //       alert("Username must be less than 30 characters");
    //     } else {
    //       $.post("Users/checkUser.php", { txtuser: user, txtpass: pass }, function(data) {
    //         if (data == 1) {
    //           window.location.href = "Admin/index.php";


    //         } else {
    //           alert("Incorrect password or username. Try again!");
    //         }
    //       });
    //     }
    //   });
    // });

    $(function() {
      $('#btnsubmit').click(function() {
        var user = $('#username').val();
        var pass = $('#pwd').val();
        var remember = $('input[name="remember"]').is(':checked') ? 1 : 0;

        if ($.trim(user) == "" || $.trim(pass) == "") {
          alert("Empty user or password. Try again");
        } else if (user.length > 30) {
          alert("Username must be less than 30 characters");
        } else {
          $.post("Users/checkUser.php", {
            txtuser: user,
            txtpass: pass,
            remember: remember
          }, function(data) {
            if (data == 1) {
              window.location.href = "index.php";
            } else {
              alert("Incorrect password or username. Try again!");
            }
            // alert(data);

          });
        }
      });
    });
  </script>

  <div class="container-fluid center-container bg-dark">

    <div class="row d-flex justify-content-center align-items-center h-100">

      <div class="col-md-4 ">
        <h2 class="text-white text-center">Login</h2>

        <form class="m-3 p-3 border border-1 rounded" method="post">
          <div class="mb-3 ">
            <label for="user" class="form-label text-white">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
          </div>
          <div class="mb-3">
            <label for="pwd" class="form-label text-white">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
          </div>
          <div class="form-check mb-3">
            <label class="form-check-label text-white">
              <input class="form-check-input " type="checkbox" name="remember"> Remember me
            </label>
          </div>
          <button type="button" class="btn btn-secondary w-100" id="btnsubmit">Submit</button>
          <div class="text-center mt-3">
            <span class="text-secondary">Don’t have an account?</span>
            <a href="register.php" class="text-decoration-none text-white fw-semibold ms-1">
              Sign up
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>