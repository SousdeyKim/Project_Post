<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</head>
<body>
  <?php 
  session_start();
  include("../Connection.php");  


  ?>
  <nav>
    <h3 class="navStart">Edit Profile</h3>
    <i class="bi bi-bell navEnd"></i>
    <img src="../Admin/images/istockphoto-1495088043-612x612.jpg" alt="profile" style="width: 2rem; height:auto" class="navEnd">
  </nav>

  <form  class=" container">
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Username:</label>
    <input type="text" class="form-control" id="username" value="<?php echo $_SESSION['user'];  ?>" name="username">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">New Password (optional):</label>
    <input type="password" class="form-control" id="pwd" placeholder="Enter new password" name="pswd">
  </div>
  <div class="mb-3">
    <label for="rePass" class="form-label"> Retype the New Password:</label>
    <input type="password" class="form-control" id="pwd" placeholder="Retype password" name="rePass">
  </div>

  <div class="mb-3">
    <label for="status" class="form-label">Status:</label>
    <input type="number" class="form-control" id="pwd" name="pswd" min="0" max="1" value="<?php  $sql = "select status from seller where username = '{$_SESSION['user']}'";
      $result = $conn->query($sql);
  		$numrow = $result->num_rows;
  		if($numrow > 0){
  			while($row = $result->fetch_object()){
  				$status = $row->status;
  				echo $status;
        }
      }?>">
  </div>

  <div class="alignRight">
  <button type="button" class="btn btn-light">Back to Home</button>
  <button type="button" class="btn btn-light" >Submit</button>
  </div>
  
</form>

<script>
  // Frontend Script
  $(function() {
    $(".btn-light:contains('Submit')").on("click", function () {
        let username = $("#username").val();
        let newPassword = $("#pwd").val();
        let rePassword = $("input[name='rePass']").val();
        let status = $("input[name='pswd']").val();

        // Object to store only changed fields
        let dataToSend = {};

        // Validate new password and retype password
        if (newPassword !== rePassword) {
            alert("New Password and Retype Password do not match");
            return; // Stop further processing
        }

        // Compare with session values to only send updated data
        if (username !== "<?php echo $_SESSION['user']; ?>") {
            dataToSend.username = username;
        }

        if (newPassword) {
            dataToSend.newPassword = newPassword;
        }

        if (status !== "<?php echo $status; ?>") {
            dataToSend.status = status;
        }

        // If no changes are made, alert the user and stop
        if ($.isEmptyObject(dataToSend)) {
            alert("No changes detected.");
            return;
        }

        // Send the data to the PHP file via AJAX
        $.ajax({
            url: "update_profile.php", // Backend PHP file to handle updates
            type: "POST",
            data: dataToSend,
            success: function (response) {
                alert(response); // Display response from the backend
            },
            error: function () {
                alert("An error occurred while processing your request.");
            },
        });
    });
});

</script>
  
</body>
</html>