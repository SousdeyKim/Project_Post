<?php include("header.php");
 
if ($_SESSION['user'] == ""){
 header('Location:../logIn.php');
}
if(isset($_POST['btnsave'])){
  $title = $_POST['title'];
  $filename = $_FILES['fileupload']['name'];
  $target_file = "images/".$filename;
  $uploadOk = 1;

  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


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
</script>";   $uploadOk = 0;
 }

 if(file_exists($target_file)){
  echo "<script>
  document.addEventListener('DOMContentLoaded', function() {
    alert('Sorry, file already exist.');
  });
</script>";
   $uploadOk =0;
 }
 if($uploadOk == 1){
    if(move_uploaded_file($_FILES['fileupload']['tmp_name'],$target_file)){
      $sql = "INSERT INTO categories SET 
      cat_title ='".$title."',
      picture ='".$filename."'";
      $result = $conn->query($sql);
  }
  else{
    echo "<script>
  document.addEventListener('DOMContentLoaded', function() {
    alert('Sorry, there was an error uploading your file.');
  });
</script>";

  }
 }

 

}

?>

<script>
  $(function(){

    $('.del').click(function(){
      var row = $(this).closest('tr');
      var id = row.find('td').eq(0).text();
      var tableName = "categories";
      var colName="catid";
      $("#delModal").modal('show');
      $('#btndel').click(function(){
        $("#delModal").modal('hide');
        $.post('delete.php',{txtid:id,tableName:tableName,colName:colName}, function(data){
            alert (data);
            window.location.href="Categories.php";
                   });
      })     
    })
   
  })
  
</script>

<h3 class="text-white">Categories list</h3>
   
   <div align="right"><a href="#" class="btn btn-outline-light mb-2" data-bs-toggle="modal" data-bs-target="#userModal" id="addNewMember">Add new category</a></div>
   <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add new category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method="post" enctype="multipart/form-data">
    <table class="table ">
        <tr>
            <td>Title: </td>
            <td><input type="text" name="title"  id ="title"></td>
        </tr>
        <tr>
        <td>Picture</td>
        <td><input type="file" name="fileupload"></td>
        </tr>
        
    </table>
    <div class="modal-footer">
        <button type = 'submit' name='btnsave' class="btn btn-primary" id="save">Save</button>
        <!-- <button type = 'submit' name='save' class="btn btn-primary" id="saveChange">Save change</button> -->

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
      </div>
    </form>
      </div>
      
    </div>
  </div>
</div>

<table class="table table-dark table-hover" id="catTable">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  	<?php
  		$sql = "select * from categories ORDER BY catid ASC";
  		$result = $conn->query($sql);
  		$numrow = $result->num_rows;
  		if($numrow > 0){
  			while($row = $result->fetch_object()){
  				$id = $row->catid;
  				$title = $row->cat_title;
  				$pict = $row->picture;

  				echo " <tr >
				      <td>".$id."</td>
				      <td><img src=\"images/$pict\" width=\"90px\" height=\"45px\"></td>
				      <td>".$title."</td>
				      <td><a href=\"#\" class=\"text-danger del\"> Delete</a></td>
				    </tr>";

  			}
  		}

  	?>
   
    
  </tbody>
</table>

<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Member</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
                Do you realy want to delete this category?
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
