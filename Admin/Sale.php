<?php include("header.php"); 
 
if ($_SESSION['user'] == ""){
 header('Location:../logIn.php');
}
?>



<script>
   
    $(function() {
        var i = 1;
        $('#txtcode').on('change', function() {
            var code = $('#txtcode').val();
            $.post('searchPro.php', { txtcode: code }, function(data) {
                if (data != 0) {
                    var arr_item = data.split(';');
                    var proid = arr_item[0];
                    var item = arr_item[1];
                    var unitCost = parseFloat(arr_item[2]);
                    var img = arr_item[3];
                    

                    var existingRow = $("#productlist tr[data-code='" + code + "']");

                    if (existingRow.length > 0) {
                        var quantityInput = existingRow.find('.txtqty');
                        var newQuantity = parseInt(quantityInput.val()) + 1;
                        quantityInput.val(newQuantity);

                        var newSubTotal = newQuantity * unitCost;
                        existingRow.find('.subtotal').text(newSubTotal.toFixed(2));
                    } else {
                        $("#productlist").append(
                            "<tr class=\"text-white\" data-code='" + code + "'>" +
                            "<td>" + item +"<span class='pid d-none'>"+proid+"</span></td>" +
                            "<td>" + unitCost.toFixed(2) + "</td>" +
                            "<td><input type='text' class='txtqty' value='1' style='width:50px'></td>" +
                            "<td class='subtotal'>" + unitCost.toFixed(2) + "</td>" +
                            "<td><a href='#' class='del text-danger btn btn-outline-light'>Del</a></td>" +
                            "</tr>"
                        );
                        $("#itemlist").append(
                            
                           "<tr class=\"text-white\" data-code='" + code + "'>" +
                                "<td>"+ i +"</td>" +
                                "<td><img src=\"images/" + img + "\" width=\"90px\" height=\"45px\"></td>" +
                                "<td>" + item + "</td>" +
                                "<td>" + code + "</td>" +
                                "<td>" + unitCost.toFixed(2) + "</td>" +
                        "</tr>"
                        
                        );
                        updateRowNumbers();
                    }
                    $("#txtcode").val("");

                    // Recalculate the total after adding or updating a product
                    calculateGrandTotal();
                } else {
                    alert("Product not found.");
                }
            }); 
        });
       



        /////
        function updateRowNumbers() {
        $("#itemlist tr").each(function(index) {
            $(this).find("td:first").text(index + 1); // Set row number to current index + 1
        });
        }

        // Event delegation for dynamically added rows
        $(document).on('change', '.txtqty', function() {
            var $row = $(this).closest('tr');
            var quantity = parseFloat($(this).val()) || 0;
            var unitCost = parseFloat($row.find('td:eq(1)').text()) || 0;
            var subTotal = quantity * unitCost;

            $row.find('.subtotal').text(subTotal.toFixed(2));

            calculateGrandTotal();
        });

        function calculateGrandTotal() {
            var grandTotal = 0;

            $('.subtotal').each(function() {
                grandTotal += parseFloat($(this).text()) || 0;
            });

            $('.total').text(grandTotal.toFixed(2));

            var discount = parseFloat($('#discount').val()) || 0;
            var discountedTotal = grandTotal - ((discount * grandTotal) / 100);
            $('.grand-total').text(discountedTotal.toFixed(2));

            var paid = parseFloat($('#paid').val()) || 0;
            var returnAmount = paid - discountedTotal;
            $('.return').text(returnAmount.toFixed(2));
        }

        $('#discount, #paid').on('input', function() {
            calculateGrandTotal();
        });
        $(document).on('click', '.add', function() {
            var row = $(this).closest('tr');
            var code = row.find('td:eq(5)').text();
            var existingRow = $("#productlist tr[data-code='" + code + "']");

            if (existingRow.length > 0) {
                        var quantityInput = existingRow.find('.txtqty');
                        var newQuantity = parseInt(quantityInput.val()) + 1;
                        quantityInput.val(newQuantity);

                        var newSubTotal = newQuantity * unitCost;
                        existingRow.find('.subtotal').text(newSubTotal.toFixed(2));
                    }
                    else {
                        $('#txtcode').val(code).trigger('change');

                    }
           
        });

        $(document).on('click', '.del', function() {
            var row = $(this).closest('tr');
            var code = row.attr('data-code');
            row.remove();
            $("#itemlist tr[data-code='" + code + "']").remove();
            updateRowNumbers();
            calculateGrandTotal();
        });
    });

    $('#paid').on('input', function() {
    calculateGrandTotal();
    
    // Set payment date if a positive amount is entered in "Paid" field
    var paidAmount = parseFloat($(this).val()) || 0;
    if (paidAmount > 0) {
        var currentDate = new Date().toISOString().split('T')[0]; // Format as "YYYY-MM-DD"
        $('#payment-date').text(currentDate); // Display the date in the placeholder
    } else {
        $('#payment-date').text("Not Paid"); // Reset if "Paid" is cleared or set to 0
    }
});

$(document).on('click','#btnSavePrint',function () {
    var paidAmount = parseFloat($('#paid').val()) || 0;
    //var paymentDate = $('#payment-date').text(); // Get the payment date from the displayed text
    var orderDate = new Date().toISOString().split('T')[0]; 
    var subtotal = parseFloat($('.total').text()) || 0;
    var grandTotal = parseFloat($('.grand-total').text()) || 0;
    var discount = parseFloat($('#discount').val()) || 0;
    var returnAmount = parseFloat($('.return').text()) || 0;

    // alert (paidAmount+orderDate+subtotal+grandTotal+discount+returnAmount);
    if(paidAmount==0|| returnAmount<0){
        alert("Please enter sufficient paid amount!");
    }
    else{
        var num_row_table = $("#tblorder tr").length;
		// alert("Total rows in tblorder: " + num_row_table);
        var productid = "";
        var productqty = "";
        var productprice = "";
                        
        for(var i=3; i<(num_row_table-6); i++){

            var proid = $('#tblorder').find('tr').eq(i).find('td').eq(0).children('.pid').text(); 
            var price = $('#tblorder').find('tr').eq(i).find('td').eq(1).text();
            var qty = $('#tblorder').find('tr').eq(i).find('td').eq(2).children('.txtqty').val(); 


            productid = proid+";"+productid;
            productqty= qty+";"+productqty;
            productprice= price+";"+productprice;
        }

            $.post('saveTransaction.php', {
                pid:productid,
                qty:productqty,
                price:productprice,
                paid: paidAmount,
                // payment_date: paymentDate,
                order_date: orderDate,
                subtotal: subtotal,
                grand_total: grandTotal,
                discount: discount,
                return_amount: returnAmount
            }, function(response) {
                if(response==1){
                    alert("Transaction saved successfully.");
                }
                else {
                    alert("error");
                }
                // alert(response);
                
            });
            }
       
})

$(document).on('input', '#discount', function() {
    let discount = $(this).val();
    // Allow only numbers and ensure it’s within 0-100
    if (!/^\d{0,3}$/.test(discount) || discount > 100) {
        $(this).val(discount.slice(0, -1)); // Remove last character if invalid
    }
    calculateGrandTotal(); // Recalculate totals when discount changes
});

$(document).on('input', '#paid', function() {
    let paid = $(this).val();
    // Allow only positive numbers
    if (!/^\d*\.?\d*$/.test(paid)) {
        $(this).val(paid.slice(0, -1)); // Remove last character if invalid
    }
    calculateGrandTotal(); // Recalculate totals when paid amount changes
});






</script>
<h3 class="text-light">Sale</h3>
<div align="right" class="text-white mb-3">
    <label for="code">Input product code:</label>
    <input type="text" id="txtcode">
</div>

<div class="row ">
    <div class="col-md-6 col-sm-12">
        <table class=" table table-dark table-bordered" >
                
                <thead class="bg-white">
                    <tr>
                        <td>No</td>
                        <td>Img</td>
                        <td>Name</td>
                        <td>code</td>
                        <td>Price</td>
                    </tr>
                </thead>
                <tbody id="itemlist"></tbody>
                
        </table>
           
    </div>

    <div class="col-md-6">
            <table class=" table table-dark table-bordered" id="tblorder">
                <thead>
                    <tr >
                        <td >
                            <p class="my-1">Wallmart, Inc.</p>
                            <p class="my-1"> 12345 Road</p>
                            <p class="my-1">Toul Tompong, Phnom Penh</p>
                        </td>
                        <td colspan="4" class="text-end align-top" >
                                <p class="my-1">Invoice #: <?php 
                                        $sql = "SELECT * FROM `order` WHERE order_id = (SELECT MAX(order_id) FROM `order`);";
                                        $result = $conn->query($sql);
                                        if($result->num_rows>0){
                                            $row = $result->fetch_object();
                                            $tmp_no = $row->order_id;
                                            $orderId = $tmp_no ? $tmp_no + 1 : 1;
                                            echo $orderId;
                                            
                                        }
                                        ?></p>
                                        <p class="my-1"> Created: <?php 
                                        echo date("Y-m-d");
                                        ?>
                                       
                                </p>

                        </td>
                   
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td>Item</td>
                        <td>Unit Cost</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Action</td>
                    </tr>
                </tbody>
                <tbody id="productlist"></tbody>
                <tbody>
                    <tr>
                        <td colspan="3" class="text-white">Total:</td>
                        <td class="total text-white"> $0.00</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-white">Discount(%):</td>
                        <td><form method="post">
                        <input type="text" id="discount" value="0" style="width:80px"></form></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-white">Grand Total:</td>
                        <td class="grand-total text-white"> $0.00</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-white">Paid:</td>
                        <td><input type="text" id="paid" value="0" style="width:80px"></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-white " >Return:</td>
                        <td class="return text-white"> $0.00</td>
                    </tr>
                    <tr>
                        <td align="right" colspan="3" class="text-white pt-3"><button type="button" id="btnSavePrint">Save and print</button></td>

                    </tr>
                </tbody>
            </table>
    </div>

</div>
</div>
<?php include('footer.php'); ?>
