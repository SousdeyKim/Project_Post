<?php include("header.php");?>
<h3 class="text-white">Performance</h3>
<script>
    $(function(){
        $("#btnsearch").click(function(){
            var fromdate = $("#txtfromdate").val();
            var txttodate = $("#txttodate").val();
            var sluser = $("#sluser").val();

            $.post('sal_reportBE.php',{fdate:fromdate, tdate:txttodate,user:sluser}, function(data){
                // alert(data);
                    var arr_item = data.split(';');
                    var orderPrint = arr_item[0];
                    var detailPrint = arr_item[1];
                    // alert(orderPrint);
                $("#listorder").html(orderPrint);
                $("#listOrderDetail").html(detailPrint);
                var sumGrandTotal = 0;

                $('.sumGrandTotal').each(function() {
                    sumGrandTotal += parseFloat($(this).text()) || 0;
                });

                $('.total').text("$"+sumGrandTotal);

            });
            // alert(fromdate);


        });
    });
</script>

<div class="row text-white">
      <div class="col">
          From Date
          <input type="date" id="txtfromdate" class="form-control">
      </div>
      <div class="col">
          To Date      
          <input type="date"  id="txttodate" class="form-control">
      </div>
      <div class="col">
          By User     
          <select id="sluser" class="form-select">
              <option value="0">-- please select user---</option>
              <?php 
                  $sql = "select * from seller";
                  $result = $conn->query($sql); 
                  while($row = $result->fetch_object()){
                      $userid = $row->id;
                      $username = $row->username;

                      echo "<option value='".$userid."'>$username</option>";
                  } 
              ?>
          </select>
      </div>
      <div class="col">
          <br/>
          <button id="btnsearch" class="btn btn-outline-light"> Search </button>
      </div>
</div> 

<div class="row" style="margin-top:20px">
  <div class="col" >
      <table class="table table-bordered">
          <thead >
              <tr>
                <th>OderID</th>
                <th>Ordered Date</th>
                <th>Order By</th>
                <th>Total</th>
                <th>Discount</th>
                <th>Grand Total</th>
              </tr>
          </thead>
          <tbody id="listorder">
            
          </tbody>
          <tbody >
            <tr >
                <td colspan="5" class="text-dark">Sum Grand Total:</td>
                <td class=" total text-dark "> $0.00</td>
            </tr>
        </tbody>
          <tfoot></tfoot>
      </table>

  </div>
  <div class="col text-white" style="border:1px solid white;">
      Detail
      <table class="table table-bordered">
          <thead >
              <tr>
                <th>Receipt item ID</th>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
          </thead>
          <tbody id="listOrderDetail">
            
          </tbody>
          <tfoot></tfoot>
      </table>
  </div>
</div>


<?php include("footer.php");?>



