<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'update_reference.php'; ?>


<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
        Edit Job Order Profile
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-12">
      <ol class="breadcrumb float-sm-right text-ml">
      <li class="breadcrumb-item"><b><i style="font-size:20px; color:red;" class="fa fa-arrow-right"></b></i><a href="edit_employee.php?ID=<?php echo $get_emp_id;?>"> Personal Information</a></li>
      <li class="breadcrumb-item active">Reference Number</li>
      <li class="breadcrumb-item"><a href="edit_edu.php?ID=<?php echo $get_emp_id;?>">Educational Details</a></li>
      <li class="breadcrumb-item"><a href="edit_work.php?ID=<?php echo $get_emp_id;?>">Work Experience</a></li>
       </ol>
         </div>
       
    </section>
 
<!-- Main content -->
          <div class="col-md-12">
          <div class="card">
           

                 <form role="form" enctype="multipart/form-data" method="post" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                  
     

           <div class="card-body"> 
           <div class="container">
            <div align="center">
                  <?php echo $alert_msg; ?>
             </div>
           <i style="font-size:25px"><i style="color:blue" align="center">Reference Number</i></i>  

             
              <div class="jumbotron">
              <div class="row">

  <input type="hidden" class="form-control" readOnly=true id = "emp_id" name="EmpCode" value="<?php echo $get_emp_id; ?>">

           
               
             <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                   <h3><?php echo $get_emp_fname . " " . $get_emp_mname[0] ."." . " " . $get_emp_lname ?> </h3>
                   <lable>ID No.: <?php echo $get_emp_code?></lable>
                   <p></p>
                     <p><i>The following information are considered to be private. All information will be treated as strictly confidential.</i></p>
                    <hr>
                      <input type="hidden" class="form-control"  name="ID" value="<?php echo $get_id_no;?>">
                       

 <label><i class="h5 mb-0 font-weight-bold bg-yellow">Social Security System</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">SSS Control No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="SSS" name="SssNo" value="<?php echo $get_id_sss;?>">
                        </div>
                      </div>

                     <hr>
                     <label><i class="h5 mb-0 font-weight-bold bg-yellow">Pag-ibig</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Pag-ibig MID No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="PagIbigNo" name="PagIbigNo" value="<?php echo $get_id_pagibig;?>">
                        </div>
                      </div>

                       <hr>
                     <label><i class="h5 mb-0 font-weight-bold bg-yellow">ATM</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">SA No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="atm" name="AtmNo" value="<?php echo $get_id_atm;?>">
                        </div>
                        </div>

                     <hr>
                     <label><i class="h5 mb-0 font-weight-bold bg-yellow">PhilHealth</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">PhilHealth No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="philhealth" name="PhilNo" value="<?php echo $get_id_phil;?>">
                        </div>
                      </div>

                       <hr>
                     <label><i class="h5 mb-0 font-weight-bold bg-yellow">TIN</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">TIN No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="tin" name="TinNo" value="<?php echo $get_id_tin;?>">
                        </div>
                      </div>

                      <hr>
                     <label><i class="h5 mb-0 font-weight-bold bg-yellow">Community Tax Certificate:</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">CTC No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="ctcno" name="CtcNo" value="<?php echo $get_id_ctc;?>">
                        </div>
                      </div>
                        <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Date Issued:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="dateissued" name="CtcDate" value="<?php echo $get_id_date;?>">
                        </div>
                      </div>
                           <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Issued At:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="placeissued" name="CtcAt" value="<?php echo $get_id_place;?>">
                        </div>
                      </div>
                      </div>     
                        </div>
                      </div>
                      </div>      
                        </div>
                      </div>
                      </div>         
           

         
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                       <a href="add_employee.php" <?php echo $btnNew; ?> class="btn btn-primary" style="padding: 5px 120px; font-size: 20px">New</a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                       <input type="submit"  name="update" class="btn btn-primary" style="padding: 5px 120px; font-size: 20px" value="Update">
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <a href="employeedetails.php?ID=<?php echo "1"?>" class="btn btn-default btn-block" style="padding: 5px 120px; font-size: 20px">Cancel</a>
                    </div>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
           <!-- /.box-body -->
  
            <!-- /.box -->
       </div>
         <!-- Main Content End --> 

   </div> 
   <!-- Content-Wrapper End -->
        
           </div>
</div> 
   <!-- Content-Wrapper End -->
         <div class="col-md-1"></div>
          </div>
           </div>
 <!-- loadImage -->
<script>
function loadImage(){
    var input = document.getElementById("fileToUpload");
var fReader = new FileReader();
fReader.readAsDataURL(input.files[0]);
fReader.onloadend = function(event){
    var img = document.getElementById("image");
    img.src = event.target.result;
}
}
</script> 


</div>
</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
