<?php include("header.php"); 
session_start();
 
if ($_SESSION['user'] == ""){
 header('Location:../logIn.php');
}
?>

<script>
    // $(function() {
    //     $('#txtcode').change(function() {
    //         var code = $('#txtcode').val();
    //         $.post('searchPro.php', { txtcode: code }, function(data) {
    //             if (data != 0) {
    //                 var arr_item = data.split(';');
    //                 var proid = arr_item[0];
    //                 var item = arr_item[1];
    //                 var unitCost = parseFloat(arr_item[2]);

    //                 $("#productlist").append(
    //                     "<tr class=\"text-white\">" +
    //                     "<td>" + item + "</td>" +
    //                     "<td>" + unitCost.toFixed(2) + "</td>" +
    //                     "<td><input type='text' class='txtqty' value='1' style='width:50px'></td>" +
    //                     "<td class='subtotal'>" + unitCost.toFixed(2) + "</td>" +
    //                     "<td><a href='#' class='del text-danger btn btn-outline-light'>Del</a></td>" +
    //                     "</tr>"
    //                 );
    //                 $("#txtcode").val("");

    //                 // Recalculate the total after adding a new product
    //                 calculateGrandTotal();
    //             } else {
    //                 alert("Product not found.");
    //             }
    //         });
    //     });

    //     // Event delegation for dynamically added rows
    //     $(document).on('change', '.txtqty', function() {
    //         var $row = $(this).closest('tr');
    //         var quantity = parseFloat($(this).val()) || 0;
    //         var unitCost = parseFloat($row.find('td:eq(1)').text()) || 0;
    //         var subTotal = quantity * unitCost;

    //         $row.find('.subtotal').text(subTotal.toFixed(2));

    //         // Calculate the grand total after updating the subtotal
    //         calculateGrandTotal();
    //     });

    //     // Calculate and update the total, grand total, and return
    //     function calculateGrandTotal() {
    //         var grandTotal = 0;

    //         // Calculate the sum of all subtotals
    //         $('.subtotal').each(function() {
    //             grandTotal += parseFloat($(this).text()) || 0;
    //         });

    //         $('.total').text( grandTotal.toFixed(2));

    //         // Apply discount if entered
    //         var discount = parseFloat($('#discount').val()) || 0;
    //         var discountedTotal = grandTotal - ((discount*grandTotal)/100);
    //         $('.grand-total').text( discountedTotal.toFixed(2));

    //         // Calculate return amount if paid amount is entered
    //         var paid = parseFloat($('#paid').val()) || 0;
    //         var returnAmount = paid - discountedTotal;
    //         $('.return').text(returnAmount.toFixed(2));
    //     }

    //     // Recalculate grand total and return when discount or paid fields are updated
    //     $('#discount, #paid').on('input', function() {
    //         calculateGrandTotal();
    //     });

    //     // Add product to the cart on button click  
    //     $(document).on('click', '.add', function() {
    //         var row = $(this).closest('tr');
    //         var code = row.find('td:eq(5)').text();
    //         $('#txtcode').val(code).trigger('change');
    //     });

    //     // Remove product row and recalculate totals
    //     $(document).on('click', '.del', function() {
    //         var row = $(this).closest('tr');
    //         row.remove();
    //         calculateGrandTotal();
    //     });
    // });
    
   
//     $(function() {
//         var i = 1;
//         $('#txtcode').on('change', function() {
//             var code = $('#txtcode').val();
//             $.post('searchPro.php', { txtcode: code }, function(data) {
//                 if (data != 0) {
//                     var arr_item = data.split(';');
//                     var proid = arr_item[0];
//                     var item = arr_item[1];
//                     var unitCost = parseFloat(arr_item[2]);
//                     var img = arr_item[3];
                    

//                     var existingRow = $("#productlist tr[data-code='" + code + "']");

//                     if (existingRow.length > 0) {
//                         var quantityInput = existingRow.find('.txtqty');
//                         var newQuantity = parseInt(quantityInput.val()) + 1;
//                         quantityInput.val(newQuantity);

//                         var newSubTotal = newQuantity * unitCost;
//                         existingRow.find('.subtotal').text(newSubTotal.toFixed(2));
//                     } else {
//                         $("#productlist").append(
//                             "<tr class=\"text-white\" data-code='" + code + "'>" +
//                             "<td>" + item + "</td>" +
//                             "<td>" + unitCost.toFixed(2) + "</td>" +
//                             "<td><input type='text' class='txtqty' value='1' style='width:50px'></td>" +
//                             "<td class='subtotal'>" + unitCost.toFixed(2) + "</td>" +
//                             "<td><a href='#' class='del text-danger btn btn-outline-light'>Del</a></td>" +
//                             "</tr>"
//                         );
//                         $("#itemlist").append(
                            
//                            "<tr class=\"text-white\" data-code='" + code + "'>" +
//                                 "<td>"+ i +"</td>" +
//                                 "<td><img src=\"images/" + img + "\" width=\"90px\" height=\"45px\"></td>" +
//                                 "<td>" + item + "</td>" +
//                                 "<td>" + code + "</td>" +
//                                 "<td>" + unitCost.toFixed(2) + "</td>" +
//                         "</tr>"
                        
//                         );
//                         updateRowNumbers();
//                     }
//                     $("#txtcode").val("");

//                     // Recalculate the total after adding or updating a product
//                     calculateGrandTotal();
//                 } else {
//                     alert("Product not found.");
//                 }
//             }); 
//         });
       



//         /////
//         function updateRowNumbers() {
//         $("#itemlist tr").each(function(index) {
//             $(this).find("td:first").text(index + 1); // Set row number to current index + 1
//         });
//         }

//         // Event delegation for dynamically added rows
//         $(document).on('change', '.txtqty', function() {
//             var $row = $(this).closest('tr');
//             var quantity = parseFloat($(this).val()) || 0;
//             var unitCost = parseFloat($row.find('td:eq(1)').text()) || 0;
//             var subTotal = quantity * unitCost;

//             $row.find('.subtotal').text(subTotal.toFixed(2));

//             calculateGrandTotal();
//         });

//         function calculateGrandTotal() {
//             var grandTotal = 0;

//             $('.subtotal').each(function() {
//                 grandTotal += parseFloat($(this).text()) || 0;
//             });

//             $('.total').text(grandTotal.toFixed(2));

//             var discount = parseFloat($('#discount').val()) || 0;
//             var discountedTotal = grandTotal - ((discount * grandTotal) / 100);
//             $('.grand-total').text(discountedTotal.toFixed(2));

//             var paid = parseFloat($('#paid').val()) || 0;
//             var returnAmount = paid - discountedTotal;
//             $('.return').text(returnAmount.toFixed(2));
//         }

//         $('#discount, #paid').on('input', function() {
//             calculateGrandTotal();
//         });
//         $(document).on('click', '.add', function() {
//             var row = $(this).closest('tr');
//             var code = row.find('td:eq(5)').text();
//             var existingRow = $("#productlist tr[data-code='" + code + "']");

//             if (existingRow.length > 0) {
//                         var quantityInput = existingRow.find('.txtqty');
//                         var newQuantity = parseInt(quantityInput.val()) + 1;
//                         quantityInput.val(newQuantity);

//                         var newSubTotal = newQuantity * unitCost;
//                         existingRow.find('.subtotal').text(newSubTotal.toFixed(2));
//                     }
//                     else {
//                         $('#txtcode').val(code).trigger('change');

//                     }
           
//         });

//         $(document).on('click', '.del', function() {
//             var row = $(this).closest('tr');
//             var code = row.attr('data-code');
//             row.remove();
//             $("#itemlist tr[data-code='" + code + "']").remove();
//             updateRowNumbers();
//             calculateGrandTotal();
//         });
//     });

//     $('#paid').on('input', function() {
//     calculateGrandTotal();
    
//     // Set payment date if a positive amount is entered in "Paid" field
//     var paidAmount = parseFloat($(this).val()) || 0;
//     if (paidAmount > 0) {
//         var currentDate = new Date().toISOString().split('T')[0]; // Format as "YYYY-MM-DD"
//         $('#payment-date').text(currentDate); // Display the date in the placeholder
//     } else {
//         $('#payment-date').text("Not Paid"); // Reset if "Paid" is cleared or set to 0
//     }
// });

// $(document).on('click','#btnSavePrint',function () {
//     var paidAmount = parseFloat($('#paid').val()) || 0;
//     var paymentDate = $('#payment-date').text(); // Get the payment date from the displayed text
//     var orderDate = new Date().toISOString().split('T')[0]; // Set order date as the current date
//     var subtotal = parseFloat($('.total').text()) || 0;
//     var grandTotal = parseFloat($('.grand-total').text()) || 0;
//     var discount = parseFloat($('#discount').val()) || 0;
//     var returnAmount = parseFloat($('.return').text()) || 0;

//     $.post('saveTransaction.php', {
//         paid: paidAmount,
//         payment_date: paymentDate,
//         order_date: orderDate,
//         subtotal: subtotal,
//         grand_total: grandTotal,
//         discount: discount,
//         return_amount: returnAmount
//     }, function(response) {
//         alert("Transaction saved: " + response);
//     });
// })

// $(document).on('input', '#discount', function() {
//     let discount = $(this).val();
//     // Allow only numbers and ensure it’s within 0-100
//     if (!/^\d{0,3}$/.test(discount) || discount > 100) {
//         $(this).val(discount.slice(0, -1)); // Remove last character if invalid
//     }
//     calculateGrandTotal(); // Recalculate totals when discount changes
// });

// $(document).on('input', '#paid', function() {
//     let paid = $(this).val();
//     // Allow only positive numbers
//     if (!/^\d*\.?\d*$/.test(paid)) {
//         $(this).val(paid.slice(0, -1)); // Remove last character if invalid
//     }
//     calculateGrandTotal(); // Recalculate totals when paid amount changes
// });

$(function() {
    // Initialize row index
    var i = 1;

    // Change event for product code input
    $('#txtcode').on('change', function() {
        var code = $(this).val();

        $.post('searchPro.php', { txtcode: code }, function(data) {
            if (data != 0) {
                var arr_item = data.split(';');
                var proid = arr_item[0];
                var item = arr_item[1];
                var unitCost = parseFloat(arr_item[2]);
                var img = arr_item[3];

                // Check if product already exists in the list
                var existingRow = $("#productlist tr[data-code='" + code + "']");
                if (existingRow.length > 0) {
                    var quantityInput = existingRow.find('.txtqty');
                    var newQuantity = parseInt(quantityInput.val()) + 1;
                    quantityInput.val(newQuantity);

                    var newSubTotal = newQuantity * unitCost;
                    existingRow.find('.subtotal').text(newSubTotal.toFixed(2));
                } else {
                    // Append new product row
                    $("#productlist").append(
                        "<tr class=\"text-white\" data-code='" + code + "'>" +
                        "<td>" + item + "</td>" +
                        "<td>" + unitCost.toFixed(2) + "</td>" +
                        "<td><input type='text' class='txtqty' value='1' style='width:50px'></td>" +
                        "<td class='subtotal'>" + unitCost.toFixed(2) + "</td>" +
                        "<td><a href='#' class='del text-danger btn btn-outline-light'>Del</a></td>" +
                        "</tr>"
                    );

                    // Update item display list with image
                    $("#itemlist").append(
                        "<tr class=\"text-white\" data-code='" + code + "'>" +
                        "<td>" + i + "</td>" +
                        "<td><img src=\"images/" + img + "\" width=\"90px\" height=\"45px\"></td>" +
                        "<td>" + item + "</td>" +
                        "<td>" + code + "</td>" +
                        "<td>" + unitCost.toFixed(2) + "</td>" +
                        "</tr>"
                    );
                    i++;  // Increment index
                    updateRowNumbers();
                }

                $("#txtcode").val("");  // Clear input field

                // Recalculate totals after adding or updating a product
                calculateGrandTotal();
            } else {
                alert("Product not found.");
            }
        });
    });

    // Update row numbers dynamically
    function updateRowNumbers() {
        $("#itemlist tr").each(function(index) {
            $(this).find("td:first").text(index + 1);
        });
    }

    // Calculate Grand Total and other amounts
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

    // Recalculate grand total and return on input
    $('#discount, #paid').on('input', calculateGrandTotal);

    // Add product to cart on button click
    $(document).on('click', '.add', function() {
        var row = $(this).closest('tr');
        var code = row.find('td:eq(5)').text();
        $('#txtcode').val(code).trigger('change');
    });

    // Remove product row and recalculate totals
    $(document).on('click', '.del', function() {
        var row = $(this).closest('tr');
        var code = row.attr('data-code');
        row.remove();
        $("#itemlist tr[data-code='" + code + "']").remove();
        updateRowNumbers();
        calculateGrandTotal();
    });

    // Save transaction and send data to backend
    $('#btnSavePrint').on('click', function () {
        var paidAmount = parseFloat($('#paid').val()) || 0;
        var paymentDate = $('#payment-date').text();
        var orderDate = new Date().toISOString().split('T')[0];
        var subtotal = parseFloat($('.total').text()) || 0;
        var grandTotal = parseFloat($('.grand-total').text()) || 0;
        var discount = parseFloat($('#discount').val()) || 0;
        var returnAmount = parseFloat($('.return').text()) || 0;

        $.post('saveTransaction.php', {
            paid: paidAmount,
            payment_date: paymentDate,
            order_date: orderDate,
            subtotal: subtotal,
            grand_total: grandTotal,
            discount: discount,
            return_amount: returnAmount
        }, function(response) {
            alert("Transaction saved: " + response);
        });
    });
});






</script>
<h3 class="text-light">Sale</h3>
<div align="right" class="text-white mb-3">
    <label for="code">Input product code:</label>
    <input type="text" id="txtcode">
</div>

<div class="row ">
    <div class="col-6">
        <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
                
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
            <!-- <table>
                <thead class="bg-white">
                    <tr class="bg-white text-right">
                        <td>ProID</td>
                        <td class="text-center">Img</td>
                        <td>Name</td>
                        <td>CatId</td>
                        <td>Price</td>
                        <td>Code</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody id="itemlist"> -->
                    <?php 
                        // $sql = "SELECT * FROM products ORDER BY proid ASC";
                        // $result = $conn->query($sql);
                        // $numrow = $result->num_rows;
                        // if ($numrow > 0) {
                        //     while ($row = $result->fetch_object()) {
                        //         $proId = $row->proid;
                        //         $code = $row->code;
                        //         $name = $row->proname;
                        //         $catId = $row->catid;
                        //         $price = $row->price;
                        //         $pict = $row->picture;

                        //         echo "<tr>
                        //                 <td>$proId</td>
                        //                 <td><img src=\"images/$pict\" width=\"90px\" height=\"45px\"></td>
                        //                 <td>$name</td>
                        //                 <td>$catId</td>
                        //                 <td>$price</td>
                        //                 <td>$code</td>
                        //                 <td><a href='#' class=\"text-success btn btn-outline-light add\">Add</a></td>
                        //               </tr>";
                        //     }
                        // }
                    ?> 
                <!-- </tbody>
            </table> -->
        </div>
    </div>

    <div class="col-6">
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <td colspan="5">
                            <table>
                                <tr>
                                    <td class="text-white">
                                        Wallmart, Inc.<br> 12345 Road<br> Toul Tompong, Phnom Penh
                                    </td>
                                    <td class="text-white">

                                        Invoice #: <?php 
                                        $sql = "SELECT * FROM `order` WHERE order_id = (SELECT MAX(order_id) FROM `order`);";
                                        $result = $conn->query($sql);
                                        if($result->num_rows>0){
                                            $row = $result->fetch_object();
                                            $tmp_no = $row->order_id;
                                            $orderId = $tmp_no +1;
                                            echo $orderId;
                                        }
                                        ?><br> Created: <?php 
                                        echo date("Y-m-d");
                                        ?>
                                        <br> <table>
                                            <tr>
                                                <td  class="text-white "style="position: relative; right:-80px" >Payment date:</td>
                                                <td id="payment-date" class="text-white">Not Paid</td>
                                            </tr>
                                            </table>
                                        
                                
                                    </td>
                                </tr>
                            </table>
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
                        <td colspan="3" class="text-white return" >Return:</td>
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
</div>
<?php include('footer.php'); ?>
