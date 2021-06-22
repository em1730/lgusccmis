<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

include ('../config/db_config.php');
include ('insert_itemcategory.php');
$codecateg = $namecategory = $btnSave =$btnNew='';


$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];

}


// //select all users
// $get_all_items_sql = "SELECT * FROM tbl_items WHERE status = 'ACTIVE'";
// $get_all_items_data = $con->prepare($get_all_items_sql);
// $get_all_items_data->execute();  

//select all users
$get_all_categ_sql = "SELECT * FROM category WHERE status = 'ACTIVE'";
$get_all_categ_data = $con->prepare($get_all_categ_sql);
$get_all_categ_data->execute();  


// //select all users
// $get_all_unit_sql = "SELECT * FROM tbl_itemunit where status='ACTIVE'";
// $get_all_unit_data = $con->prepare($get_all_unit_sql);
// $get_all_unit_data->execute();  






?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> BAC | List of Category</title>
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
<?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
 
     

  <div class="content-wrapper">
    <div class="content-header"></div>


    <section class="content">
      <div class="card card-info" >
        <div class="card-header">
            <h3>List of Category
              <a href="#" data-toggle="modal" style="float:right;" data-target="#categModal" type="button" class="btn btn-danger bg-gradient-danger" style="border-radius: 0px;">
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
                      <th>ID No.</th>
                      <th>Code</th>
                      <th>Category</th>
                   
                      <th>Options</th>
                    </tr>
                  </thead>
                    <tbody>
                    <?php while($categ_data = $get_all_categ_data->fetch(PDO::FETCH_ASSOC)){ ?>
                      <tr>  
                      <!-- <td><input type="checkbox" value ="" name="" /> -->
                          <td><?php echo $categ_data['idno'];?> </td>
                          <td><?php echo $categ_data['code'];?></td>
                          <td><?php echo $categ_data['itemcategory'];?></td>
                    
                                        
                          <td>
                            <a class="btn btn-outline-success btn-xs" 
                            href="updateForm_category.php?objid=<?php echo $categ_data['objid'];?>&id=<?php echo $categ_data['code'];?> ">
                            <i class="fa fa-search"></i>
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
  <div class="modal fade" id="categModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
          <form role="form" id="submitFormCateg" method="post" action="insert_itemcategory.php" >

            <div class="form-group">
              <input type="text" for="code" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="code" placeholder="Code" id= "code" value="<?php echo $codecateg; ?>" required>
            </div>
            <div class="form-group">
              <input type="text" for="categ" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="category" placeholder = "Category"  id= "category" value="<?php echo $namecategory; ?>" required>
            </div>



          
            <button type="submit" class="btn btn-success" name="add"><i class="fa fa-check fa-fw"></i></button>
            <button type="reset" class="btn btn-info" name=""><i class="fa fa-undo fa-fw"></i></button>
     
                 
    
          </form> 
          <div class="message_box" style="margin:10px 0px;">
        </div>

      </div>
    </div>
  </div>
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

    $(document).on('click', 'button[data-role=confirm_delete]', function(event){
      event.preventDefault();

      var user_id = ($(this).data('id'));

      $('#user_id').val(user_id);
      $('#deleteuser_Modal').modal('toggle');

    });


    // reset all input in modal after close
    $('#categModal').on('hidden.bs.modal', function () {
      $('#categModal form')[0].reset();
    });


    // $("#submitFormCateg").submit(function(e) {
    //    e.preventDefault();
    // });

    // $.ajax({

    //   var codes = $('#code').val();
    //   var categg = $('#categ').val();
    //   type: "POST",
    //   url: "insert_itemcategory.php",
    //   data: "code="+code+"&categ="+categg,
    //   success: function(data)
    //       {
            
    //       }
       
    //   });






  //     $.ajax
  //  ({
  //  type: "POST",
  //  url: "ajax.php",
  //  data: "name="+name+"&email="+email+"&message="+message,
  
  //  success: function(data)
  //  {
 
  //  }
  //  });
 
</script> 

</body>
</html>
