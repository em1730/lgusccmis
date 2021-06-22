<?php

$date = new DateTime('2000-01-01');

$result = $date->format('Y-m-d H:i:s');
session_start();

date_default_timezone_set('Asia/Manila');  

// $datetoday = date('Y-m-d H:i');
$prdate = date('Y-m-d ');
$saidate = date('Y-m-d ');
$curYear = date('Y');
$time = date('H:i:s');
$btnNew = 'disabled';
$btnPrint= 'disabled';
$btnStatus = '';
$btnSave = $quantity = $total= $codecateg= $namecategory= $itemprice = $control_no = $type = $total = $qty = $pr_unit = $pr_itemname =
$pr_description = $pr_no = $pr_no = $sai_no = $section = $pr_total = $pr_price = $totalcost = '';

$now = new DateTime();

if (!isset($_SESSION['id'])) {  
    header('location:../index');
}


$user_id = $_SESSION['id'];

include ('../config/db_config.php');
include ('insert_pr_item.php');
include ('sql_query_get_price.php');


// include ('search.php');

//select user
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
    $db_email_ad = $result['email'];
    $db_contact_number = $result['contact_no'];
    $user_name = $result['username'];
    $department= $result['department'];
}

$get_user1_sql = "SELECT department, objid FROM tbl_department WHERE objid = :objid";
$user_data = $con->prepare($get_user1_sql);
$user_data->execute([':objid' => $department]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $dept_description     = $result['department'];
  $dept_code     = $result['objid'];
}


if (isset($_GET['objid'])) {
  
  $user_id = $_GET['id'];

  $get_items_sql = "SELECT * FROM tbl_department WHERE idno = :id";
  $get_items_data = $con->prepare($get_items_sql);
  $get_items_data->execute([':id' => $user_id]);
  while ($result = $get_items_data->fetch(PDO::FETCH_ASSOC)) {
  
    $get_code = $result['objid'];
    $get_dept = $result['department'];
  }

}
 



$control = $_GET['controlno'];
$control_no ='';



// $db = mysqli_connect('localhost', 'root', '1234', 'scc_bac');
$get_pr_info = "SELECT * FROM pr_info where pr_info_control_no =  :control ";
$get_pr_data = $con->prepare($get_pr_info);
$get_pr_data->execute([':control' => $control]);
while ($result = $get_pr_data->fetch(PDO::FETCH_ASSOC)) {
  $control_no = $result['pr_info_control_no'];
  $pr_no = $result['pr_info_no'];
  $sai_no = $result['pr_info_sai_no'];
  $date_pr = $result['pr_info_date'];
  $section = $result['pr_info_section'];
  $department = $result['pr_info_dept']; 


}

// $get_all_pritem_sql = "SELECT * FROM pr_info WHERE pr_info_dept  =  '$department' ";
// $get_all_pritem_data = $con->prepare($get_all_pritem_sql);
// $get_all_pritem_data->execute(); 

$get_all_pr_items_sql = "SELECT * FROM pr_items WHERE pr_info_controlno  =  '$control' ";
$get_all_pr_items_data = $con->prepare($get_all_pr_items_sql);
$get_all_pr_items_data->execute(); 



$get_all_items = "SELECT * FROM tbl_items ";
$get_all_items_data = $con->prepare($get_all_items);
$get_all_items_data->execute(); 


?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BAC | Add PR Item</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
   <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
   <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
  <!-- Bootstrap  -->
  <link href="../plugin/bootstrap-dialog.css" rel="stylesheet" type="text/css" />
  <!--  -->
  <script src="js/bootstrap-dialog.js"></script>

</head>

<body class="hold-transition sidebar-mini">


<div class="wrapper">

  <!-- Navbar -->
  <?php include('sidebar.php');?>
  

  <div class="content-wrapper">
      <section class="content-header" style="margin-left: 10px;" align="center">
        <h4>       
          <b>Control # :</b> <?php echo $control_no; ?> &nbsp;&nbsp;
          <b>PR # : </b> <?php echo $pr_no; ?> &nbsp;&nbsp;
          <b>SAI # : </b> <?php echo $sai_no; ?> &nbsp;&nbsp;   
          <b>Date : </b> <?php echo $saidate; ?> &nbsp;&nbsp; 
        </h4>
        <h4>       
          <b>Section : </b><?php echo $section;?>&nbsp;&nbsp;&nbsp;
          <b>Departments : </b><?php echo $department;?>&nbsp;&nbsp;
       

        </h4>
      </section>
    
    
      <section class="content" >

      <div class="card card-info">
      
            <div class="card-header">

              <h4> PR Item Details
              <a href="#" style="float:right;" data-toggle="modal" data-target="#pr-item" type="button" class="btn btn-danger bg-gradient-danger" style="border-radius: 0px;">
              <i class="nav-icon fa fa-plus"></i></a>
            </h4>



            </div>
            
            <div class="card-body">
              <div class="box box-primary">
                <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">
                  <div class="box-body">
                    <table id="users" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>Control No.</th>
                          <th>Item</th>
                      
                          <th>Unit</th>
                       
                          <th>Description</th>
                          <th>Price</th>
                          <th>Qty</th>
                          <th>Total</th>
                    
                          <th>Options</th>
                        </tr>
                      </thead>
                        <tbody>
                        <?php while($pr_items_data = $get_all_pr_items_data->fetch(PDO::FETCH_ASSOC)){  ?>
                          <tr style="font-size: 1rem">
                            <td><?php echo $pr_items_data['pr_info_controlno'];?> </td>
                            <td><?php echo $pr_items_data['pr_item_code'];?> </td>
                            <td><?php echo $pr_items_data['pr_item_unit'];?> </td>
                            <td><?php echo $pr_items_data['pr_item_description'];?> </td>
                            <td><?php echo $pr_items_data['pr_item_unitcost'];?> </td>
                            <td><?php echo $pr_items_data['pr_item_qty'];?> </td>
                            <td><?php echo $pr_items_data['pr_item_totalcost'];?> </td>
                 
                            <td>
                            <a class="btn btn-outline-success btn-xs" 
                            href="add_purchase.php?objid=<?php echo $pr_items_data['pr_info_controlno'];?>&id=<?php echo $pr_items_data['pr_info_objid'];?>">
                            <i class="fa fa-search"></i>
                             </a>
                            &nbsp;                           
                            
                          </td>


                          </tr>
                        <?php   } ?>
                       
                      
                        </tbody>
                      
                    </table>
                  </div>
                </form>
              </div>       
            </div>
      </div>

  
      </section>
  </div>       

 
  <!-- footer here -->
   <?php include('footer.php');?>
</div>
<div class="modal fade" id="pr-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
          <th>Add Item</th>
       

            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
          <form role="form" method="post" action="insert_add_item.php">

    
            <div class="form-group">

            <div class="form-group">
                    <input type="text" readonly class="form-control" id="control_no" name="control_no" placeholder="Control No." value="<?php echo $control_no; ?>">
            
                  </div>
              <select class="form-control select2" id="prItem" style="width: 100%;" name="prItem" value="<?php echo $type; ?>">
                          <option selected="selected">Select Item / Product</option>
                            <?php while ($get_items = $get_all_items_data->fetch(PDO::FETCH_ASSOC)) { 
                                ?>
                            
                          <option value="<?php echo $get_items['itemcode']; ?>"> <?php echo $get_items['description']; ?> <?php echo " / ";?> <?php echo $get_items['price']; ?><?php echo " - ";?> 
                    
                          </option>

                          
                          <?php } ?>
                </select>
              </div>                
              <div class="form-group" style="width: 20%;" >
               <input type="number" id="quantity" onkeyup="this.value = this.value.toUpperCase();"  name="quantity" placeholder="Quantity" value="<?php echo $quantity; ?>" required>
             
                  <input type="number" readonly  id="item_price" name="item_price" placeholder="Price" value="<?php echo $pr_price; ?>">
                  <input type="number"   id="total_amount" name="total_amount" placeholder="Total" value="<?php echo $total; ?>">
              </div>

                  <div class="form-group">
                    <input type="text" readonly class="form-control" id="itemname" name="itemname" placeholder="Item Name" value="<?php echo $pr_itemname; ?>">
                    <input type="text" readonly class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $pr_description; ?>">
                    <input type="text" readonly class="form-control" id="unit" name="unit" placeholder="Unit" value="<?php echo $pr_unit; ?>">
                    <input type="number" hidden readonly class="form-control" id="totalcost" name="totalcost" placeholder="Total Cost" value="<?php echo $totalcost; ?>">


                  </div>
                

          
            <button type="submit" class="btn btn-success" name="insert_add"><i class="fa fa-check fa-fw"></i></button>
            <button type="reset" class="btn btn-info" name=""><i class="fa fa-undo fa-fw"></i></button>
     
                 
                 
    
          </form> 
        </div>
                              
      </div>
      
    </div>
    
    
  </div>


<!-- ./wrapper -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="../dist/css/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  // $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Select2 -->

<script src="../plugins/select2/select2.full.min.js"></script>


<script>
      $('.select2').select2();

      $('#users').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false,
            'autoHeight'  : false
      });


      $(document).ready(function() { 
        $("#data_items").click(function() { 
          var value = $("#myselection option:selected"); 

      $('#unit').val($('#unit').val() + value);

        }); 
      });


      $(document).ready(function(){	
      $("#contactForm").submit(function(event){
        submitForm();
        return false;
      });
    });

        function submitContactForm() {
                  
                  $.ajax({
                            type:'POST',
                            url:'insert_purchase.php',
                            data:'insert_purchase',
                            success:function(msg){
                                if(msg == 'ok'){
                                    $('.statusMsg').html('<span style="color:green;">Data inserted</p>');
                                }else{
                                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                                }
                                $('.submitBtn').removeAttr("disabled");
                                $('.modal-body').css('opacity', '');
                            }
                        });
        }





$('#quantity').on('change', function(){

var price = parseInt(total.find('price').val());
var quantity = parseInt($(this).val());

total.find('quantity').text(price*quantity);
$('#total_amount').val(total);

});


                
//SELECT DROPDOWN
   
    $('#prItem').on('change', function() {
        var prItem = this.value;
        $.ajax({
            type:"POST",
            url:'sql_query_get_price.php',
            data:{pr_item:prItem},
         
         
            success:function(response){
              var result = jQuery.parseJSON(response);
                console.log('response from server',result);
                $('#item_price').val(result.data);
                $('#unit').val(result.data1);
                $('#itemname').val(result.data2);
                $('#description').val(result.data3);
                $('#totalcost').val(result.data4);
                var quantity    = $('#quantity').val();
                var total       = quantity * result.data;
                $('#total_amount').val(total);  
             
            },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });


    }); 

      
    // $('#prItem').on('change', function() {
    //     var prItem = this.value;
    //     $.ajax({
    //         type:"POST",
    //         url:'sql_query_get_price.php',
    //         data:{pr_item:prItem},
         
    //         success:function(response){
    //           var result = jQuery.parseJSON(response);
    //             console.log('response from server',result);
    //             $('#item_price').val(result.data);
    //             var quantity    = $('#quantity').val();
    //             var total       = result.data * quantity;
    //             $('#total_amount').val(total);  
             
    //         },
    //         error: function (xhr, b, c) {
    //             console.log("xhr=" + xhr + " b=" + b + " c=" + c);
    //         }
    //     });


    // }); 


    
    function CalculateItemsValue() {
    var total = 0;
    for (i=1; i<=total_items; i++) {
         
        itemID = document.getElementById("qnt_"+i);
        if (typeof itemID === 'undefined' || itemID === null) {
            alert("No such item - " + "qnt_"+i);
        } else {
            total = total + parseInt(itemID.value) * parseInt(itemID.getAttribute("data-price"));
        }
         
    }
    document.getElementById("ItemsTotal").innerHTML = "$" + total;
     
}



          $('#select_type').on('change',function(){
             var type = $(this).val();
             var office = $('#department').val();
            //  $('#doc_no').val(type);
    //  if (type=="DV" || type=="OBR"){
    //    window.open("add_outgoing_dv.php", '_parent');
    //  }else if (type=="DWP"){
    //    window.open("add_outgoing_dwp.php", '_parent');
    //  }else{
         
            $.ajax({
              type:'POST',
              data:{type:type},
              url:'generate_serial.php',
               success:function(data){
               $('#doc_no').val(data);
  
               }
            
                 
                });           
    //  }
                      });

      $('#doc_no').on('change',function(){
           var docno = $(this).val();
            $.ajax({
              type:'POST',
              data:{docno:docno},
              url:'check_serial.php',
               success:function(data){
               $('#doc_no').val(data);
                  // alert (data);
               }
            
                 
                });           
     
                      });

</script>



  </body>
</html>