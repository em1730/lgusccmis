<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}


$db_first_name = $db_last_name = $type = $db_middle_name =
$itemcode = $itemname = $category = $itemunit = $status =
$quantity = $price = $itemunit =
$btnSave = $btnNew = $description ='';

$user_id = $_SESSION['id'];


include ('../config/db_config.php');
include ('insert_item.php');
include ('generate_serial.php');

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];

}


//select all users
$get_all_items_sql = "SELECT * FROM tbl_items WHERE status = 'ACTIVE'";
$get_all_items_data = $con->prepare($get_all_items_sql);
$get_all_items_data->execute();  

//select all users
$get_all_category_sql = "SELECT * FROM category where status = 'Active' ";
$get_all_category_data = $con->prepare($get_all_category_sql);
$get_all_category_data->execute(); 

//select all users
$get_all_unit_sql = "SELECT * FROM tbl_itemunit where status='ACTIVE'";
$get_all_unit_data = $con->prepare($get_all_unit_sql);
$get_all_unit_data->execute();  

$get_all_status_sql = "SELECT * FROM tbl_status";
$get_all_status_data = $con->prepare($get_all_status_sql);
$get_all_status_data->execute(); 



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> BAC | List of Items</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <!-- DataTables -->
   <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
   <link rel="stylesheet" href="../plugins/select2/select2.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php')?>

  <!-- Content Wrapper. Contains page content -->
 
     

  <div class="content-wrapper">
    <div class="content-header"></div>

    <section class="content">
      <div class="card card-info">
        <div class="card-header">
          <h3>List of Products / Items
            <a href="#" data-toggle="modal" style="float:right;" data-target="#productModal" type="button" class="btn btn-danger bg-gradient-danger" style="border-radius: 0px;">
            <i class="nav-icon fa fa-plus"></i></a>
          </h3>
           
        </div>
                    
        <div class="card-body">
              <div class="box box-primary">
                <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">
                  <div class="box-body">
                    <table id="users" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                         
                          <th>Code</th>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Description</th>
                  
                          <th>Options</th>
                        </tr>
                      </thead>
                        <tbody>
                        <?php while($items_data = $get_all_items_data->fetch(PDO::FETCH_ASSOC)){ ?>
                          <tr>  
                          <!-- <td><input type="checkbox" value ="" name="" /> -->
                             
                              <td><?php echo $items_data['itemcode'];?></td>
                              <td><?php echo $items_data['itemname'];?></td>    
                              <td><?php echo $items_data['category'];?></td>                    
                              <td><?php echo $items_data['description'];?></td>        
                         
                              <td>
                                <a class="btn btn-outline-success btn-xs" 
                                href="updateForm_items.php?objid=<?php echo $items_data['objid'];?>&id=<?php echo $items_data['itemcode'];?> "><i class="fa fa-search"></i>
                                </a>
                                &nbsp;                           
                                
                              </td>
                          </tr>
                          <?php } ?>
                      
                        </tbody>
                      
                    </table>
                  </div>
                </form>
              </div>       
        </div>      
      </div>
    </section>   



  </div>
  
 
  <!-- /.content-wrapper -->

  <!-- footer here -->
    <?php include('footer.php')?>
    
</div>
<!-- ./wrapper -->



<!-- add product modal -->

  <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product / Item</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="insert_item.php">

            <div class="form-group">
              <input type="text" readonly onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="code" name="code"  placeholder="Item Code " value="<?php echo $itemcode; ?>" required>
            </div>

            <div class="form-group">
              <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="itemname" placeholder="Item Name" value="<?php echo $itemname; ?>" required>
            </div>

            <div class="form-group">
              <select class="form-control select2" id="unit" style="width: 100%;" name="itemunit" value="<?php echo $type; ?>">
                <option selected="selected">Select Unit </option>
                <?php while ($get_unit = $get_all_unit_data->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $get_unit['unit']; ?>"><?php echo $get_unit['description']; ?>
                </option>
                <?php } ?>
              </select>          
            </div>

            <div class="form-group">             
              <select class="form-control" id="select_type" style="width: 100%;" name="category" value="<?php echo $type; ?>">
                <option selected="selected">Select Category </option>
                <?php while ($get_type = $get_all_category_data->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $get_type['code']; ?>"><?php echo $get_type['itemcategory']; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="description" placeholder="Item Description" required><?php echo $description; ?></textarea>
            </div>

            <div class="form-group">
              <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="price" placeholder="Price" value="<?php echo $price; ?>" required>
            </div>

            <div class="form-group">
              <select class="form-control select2" id="status" style="width: 100%;" name="status" value="<?php echo $status; ?>">
                <option selected="selected">Select Status</option>
                <?php while ($get_status =$get_all_status_data->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $get_status['status']; ?>"><?php echo $get_status['status']; ?></option>
                <?php } ?>
              </select>                   
            </div>
                   
              <hr>

              <button type="submit" class="btn btn-success" name="insert_item"><i class="fa fa-check fa-fw"></i></button>

                      
          </form>  

          <?php echo $alert_msg;?>
        </div>
      </div>
    </div>
  </div>




<!-- update product modal -->





<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
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
<script src="../plugins/select2/select2.full.min.js"></script>



<script>
     $('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })

    // $(document).on('click', 'button[data-role=confirm_delete]', function(event){
    //   event.preventDefault();

    //   var user_id = ($(this).data('id'));

    //   $('#user_id').val(user_id);
    //   $('#deleteuser_Modal').modal('toggle');

    // });


    
    // $('#select_type').on('change',function(){
    //     var category = $(this).val();
        
    //     //  $('#doc_no').val(type);


    //       $.ajax({
    //       type:'POST',
    //       data:{category:category},
    //       url:'generate_serial.php',
    //       success:function(data){
    //     $('#code').val(data);


    //       } 
            
    //         });           
                    
    //       });


          $(document).ready(function() {
              $("#select_type").select2({
                      dropdownParent: $("#productModal")
              });
          });

          
          $(document).ready(function() {
                $("#unit").select2({
                        dropdownParent: $("#productModal")
                });
          });

          $(document).ready(function() {
                $("#status").select2({
                        dropdownParent: $("#productModal")
                });
          });

          

</script> 

<script>


</script>

</body>
</html>
