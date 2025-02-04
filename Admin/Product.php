<?php include("header.php");
 
// if ($_SESSION['user'] == ""){
//  header('Location:../logIn.php');
// }
if(isset($_POST['btnsave'])){
  $title = $_POST['title'];
  $catid = $_POST['catid'];
  $code = $_POST['code'];
  $price = $_POST['price'];
  $filename = $_FILES['fileupload']['name'];
  $target_file = "images/".$filename;
  $_SESSION['txtid'] = $_POST['txtid'];
  $uploadOk = 1;
  // echo var_dump($price);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "gif" && $imageFileType != "png"){	  
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileupload"]["size"] > 500000) {
          echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
            alert('Sorry, your file is too large.');
          });
        </script>";  
        $uploadOk = 0;
        }

        if(file_exists($target_file)){
          if($filename==""){

          }
          else{
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
              alert('Sorry, file already exist.');
            });
          </script>";
            $uploadOk =0;
          }         
        }
        
  if (isset($_POST['action']) && $_POST['action'] == 'add') {

    if($uploadOk == 1){
      if(move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_file)){
        $sql = "INSERT INTO products SET 
                  code = '".$code."', 
                  proname = '".$title."', 
                  catid = '".$catid."', 
                  price = '".$price."', 
                  picture = '".$filename."'";
        $result = $conn->query($sql);

        if($result) {
          echo "<script>alert('Product added successfully!');</script>";
        } else {
          echo "Error: " . $conn->error;
        }
      }
  }
    
  
     

  } 
  elseif (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id =$_POST['txtid'];
    // $id = $_SESSION['txtid'];
    if($filename!=""){

      if($uploadOk == 1){
      if(move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_file)){
      $sql = "UPDATE products 
                SET code = '".$code."', 
                    proname = '".$title."', 
                    catid = '".$catid."', 
                    price = '".$price."', 
                    picture = '".$filename."' 
                WHERE proid = '".$id."'";
          $result = $conn->query($sql);
      
          if($result) {
            echo "<script>alert('Product edited successfully!');</script>";
          } else {
            echo "Error: " . $conn->error;
        }

      }
    }
          
      }
  elseif ($filename==""){
    $sql = "UPDATE products 
    SET code = '".$code."', 
        proname = '".$title."', 
        catid = '".$catid."', 
        price = '".$price."'
         WHERE proid = '".$id."'";
    $result = $conn->query($sql);


    if($result) {
      echo "<script>alert('Product edited successfully!');</script>";
    } else {
      echo "Error: " . $conn->error;
    }
}
  
    

}
  
}


?>

<script>
  $(function(){

    $('#addNewMember').click(function(){
      $('#title').val("");
      $('#catid').val("");
      $('#code').val("");
      $('#price').val("");



    })
    $('.del').click(function(){
      var row = $(this).closest('tr');
      var id = row.find('td').eq(0).text();
      var tableName = "products";
      var colName="proid";
      $("#delModal").modal('show');
      $('#btndel').click(function(){
        $("#delModal").modal('hide');
        $.post('delete.php',{txtid:id,tableName:tableName,colName:colName}, function(data){
            alert (data);
            window.location.href="Product.php";
                   });
      })     
    })

        $('.edit').click(function() {
        $('#actionType').val('edit'); 
    });

        $('#addNewMember').click(function() {
            $('#actionType').val('add'); 
        })

        $('.edit').click(function(){

            var row = $(this).closest('tr');
            var id = row.find('td').eq(0).text();
            var name = row.find('td').eq(2).text();
            var cat_id =row.find('td').eq(3).text();
            var price = row.find('td').eq(4).text();
            var code = row.find('td').eq(5).text();

            $('#title').val(name);
            $('#catid').val(cat_id);
            $('#price').val(price);
            $('#code').val(code);
            $('#txtid').val(id);
            $('#exampleModalLabel').text("Edit product");
            $('#userModal').on('hidden.bs.modal', function () {
          $('#exampleModalLabel').text("Add new product");
        })

        })
        

          //       $('#exampleModalLabel').text("Edit product");

          //       // $("#save").off("click");

          //     $("#save").attr("id", "saveChange");

          //     $("#saveChange").html('Save change');
              
          //       $('#saveChange').click(function(){
          //             $.post('edit.php',{txtid:id,txtName:name,cat_id:cat_id, price:price,code:code,img:imgeSrc}, function(data){
          //             alert (data);
          //             window.location.href="Product.php";
          //                    });
          //       })  

          //       // Reset text to "Add new product" when modal is closed
          //       $('#userModal').on('hidden.bs.modal', function () {
          //       $('#exampleModalLabel').text("Add new product");
          //     });   
          //     })

   
  })
  
</script>

<h3 class="text-white">Product list</h3>
   
   <div align="right"><a href="#" class="btn btn-outline-light mb-2" data-bs-toggle="modal" data-bs-target="#userModal" id="addNewMember">Add new product</a></div>
   <div class="modal fade " id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add new product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method="post" enctype="multipart/form-data">
    <table class="table ">
        <tr>
            <td>Name: </td>
            <td><input type="text" name="title"  id ="title"></td>
        </tr>
        <tr>
            <td>Category ID: </td>
            <td><input type="number" name="catid" min="1" id ="catid"></td>
        </tr>
        <tr>
            <td>Code: </td>
            <td><input type="number" name="code" min="1" id ="code"></td>
        </tr>
        <tr>
            <td>price: </td>
            <td><input type="text" name="price"  id ="price"></td>
        </tr>
        <tr>
        <td>Picture</td>
        <td>
        <input type="hidden" name="txtid" id="txtid">
        <input type="hidden" name="action" id="actionType" value="add">
        <input type="file" name="fileupload" id="fileupload"></td>
        </tr>
        
    </table>
    <div class="modal-footer">
        <button type = 'submit' name='btnsave' class="btn btn-primary" id="save">Save</button>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
      </div>
    </form>
      </div>
      
    </div>
  </div>
</div>

<div id="fileInfo"></div>

<div class="table-responsive">
<table class="table table-dark table-hover text-nowrap" >
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Picture</th>
      <th scope="col">Name</th>
      <th scope="col">Cat_ID</th>
      <th scope="col">Price</th>
      <th scope="col">Code</th>
      <th scope="col">Action</th>


    </tr>
  </thead>
  <tbody>

  	<?php
  		$sql = "select * from products ORDER BY proid ASC";

  		$result = $conn->query($sql);
  		$numrow = $result->num_rows;
  		if($numrow > 0){
  			while($row = $result->fetch_object()){
  				$proId = $row->proid;
  				$code = $row->code;
  				$name = $row->proname;
          $catId = $row->catid;
          $price = $row->price;
          $pict = $row->picture;




  				echo " <tr >
				      <td>".$proId."</td>
				      <td><img src=\"images/$pict\" width=\"90px\" height=\"45px\"></td>
				      <td>".$name."</td>
              <td>".$catId."</td>
            	 <td>".$price."</td>
               <td>".$code."</td>

				      <td><a href='#' class='edit btn btn-outline-light mb-2'data-bs-toggle=\"modal\" data-bs-target=\"#userModal\" id=\"edit\">Edit </a> | <a href='#' class=\"text-danger del btn btn-outline-light mb-2\">Delete</a></td>
				    </tr>";

  			}
  		}

  	?>
   
    
  </tbody>
</table>

</div>
<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
                Do you realy want to delete this product?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <span id="wrap_btnsave">
                <button type="button" class="btn btn-primary" id="btndel">OK</button>
            </span>
        </div>
    </div>
  </div>
</div>

</div>
<?php include("footer.php");?>
