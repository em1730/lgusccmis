 <?php include 'includes/session.php'; ?>
 <?php include 'includes/header.php'; ?>

<body class="hold-transition sidebar-mini">
 <div class="wrapper">

 <?php include 'includes/navbar.php'; ?>
 <?php include 'includes/sidebar.php'; ?>



   <!-- Content Wrapper. Contains page content -->


     <!-- Content Header (Page header) -->
     <div class="content-header">
       <div class="container-fluid">
         <div class="row mb-2">
           <div class="col-sm-3">
            <h0 style="font-size:30px;" class="m-0 text-dark">Dashboard</h0>
           </div>
           <div class="col-sm-6">
           
           </div>
         </div>
       </div>
     </div>
     <!-- Content Header End -->

   <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="card" style="background-color: #fefbd8;">
              <div class="card-header">
                <h5 class="card-title"><i> Who we are</i></h5>
                                    <div class="card-tools">
                      <span class="badge badge-danger"></span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                      <!-- /.card-header -->

                <div class="card-body">
                <p style="text-align: justify;">
                  <i style="color:white;">.............</i>The Information Technology and Computer Services Office under the City Administrator's Office of the City of San Carlos shall serve as the planning and implementing unit for information and technology-related programs and projects of the Local Government Unit of the City of San Carlos.
                </p>

              
              </div>
            </div>
          

            <div class="card card-primary card-outline">
              <div class="card-body" style="background-color: #fefbd8;">
                <h5 style="background-color:#80ced6;">Vision Statement</h5>

                <p style="text-align: justify;">
                 <i style="color:white;">.............</i>Achieve full automation in all Local Government Offices of the CIty of San Carlos to capacitate linkage, thus realizing tenets of accountability, transparency, efficiency and effective local governance.
                </p>

                <h5 style="background-color:#80ced6;"> Mission Statement</h5>

                <p style="text-align: justify;">
                  <i style="color:white;">.............</i>To establish an effective and functional Information Technology and Computer Services Office (ITCSO) to support the San Carlos City Local Government's objectives in improving the life of its contituents.
                </p>
               
              </div>
            </div><!-- /.card -->
          </div>


              <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-info ">
              <span class="info-box-icon"><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i></span>

              <div class="info-box-content ">
                <span class="info-box-text">No. of Employees</span>
                <span class="info-box-number"><?php echo $get_all_emp1_data->rowCount()?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

                        <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fa fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> Created Job Order</span>
                <span class="info-box-number"><?php echo $get_createjo_data->rowCount()?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fa fa-folder-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Accomplished Payrolls</span>
                <span class="info-box-number"><?php echo $get_payroll_data->rowCount()?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number"><?php echo $get_all_user3_data->rowCount()?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   </div> 
   <!-- Content-Wrapper End -->
   <div class="col-md-1"></div>
 </div>
         
 <?php include 'includes/footer.php'; ?>
 <?php include 'includes/scripts.php'; ?>

</body>
</html>
