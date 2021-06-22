<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'update_work.php'; ?>


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
      <li class="breadcrumb-item active"><a href="edit_reference.php?ID=<?php echo $get_emp_id;?>">Reference Number</a></li>
      <li class="breadcrumb-item"><a href="edit_edu.php?ID=<?php echo $get_emp_id;?>">Educational Details</a></li>
      <li class="breadcrumb-item active">Work Experience</li>
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
           <i style="font-size:25px"><i style="color:blue" align="center">Work Experiences</i></i>  

             
              <div class="jumbotron">
              <div class="row">

  <input type="hidden" class="form-control" readOnly=true id = "emp_id" name="EmpCode" value="<?php echo $get_emp_id; ?>">

           
               
             <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                      <h3><?php echo $get_emp_fname . " " . $get_emp_mname[0] ."." . " " . $get_emp_lname?> </h3>
                   <lable>ID No.: <?php echo $get_emp_code?></lable>
                   <p></p>
                    <hr>
                      <input type="hidden" class="form-control"  name="ID" value="<?php echo $get_id_no;?>">
                       

 <label><i class="h3 mb-0 font-weight-bold bg-yellow">Employeer 1</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                       <label for="inputName" class="col-sm-3 col-form-label">Employeer:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer1Name" value="<?php echo $get_exp_emp1_name;?>">
                        </div>
                      </div>

                       <form class="form-horizontal">
                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Designation:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer1Designation" value="<?php echo $get_exp_emp1_designation;?>">
                        </div>
                      </div>

                       <form class="form-horizontal">
                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Salary:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer1CTC" value="<?php echo $get_exp_emp1_salary;?>">
                        </div>
                      </div>

                       <form class="form-horizontal">
                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Work Duration:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer1WorkDuration" value="<?php echo $get_exp_emp1_duration;?>">
                        </div>
                      </div>

                     <hr>
                     <label><i class="h3 mb-0 font-weight-bold bg-yellow">Employeer 2</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                       <label for="inputName" class="col-sm-3 col-form-label">Employeer:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer2Name" value="<?php echo $get_exp_emp2_name;?>">
                        </div>
                      </div>

                       <form class="form-horizontal">
                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Designation:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer2Designation" value="<?php echo $get_exp_emp2_designation;?>">
                        </div>
                      </div>

                       <form class="form-horizontal">
                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Salary:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer2CTC" value="<?php echo $get_exp_emp2_salary;?>">
                        </div>
                      </div>

                       <form class="form-horizontal">
                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Work Duration:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer2WorkDuration" value="<?php echo $get_exp_emp2_duration;?>">
                        </div>
                      </div>
                       <hr>
                   <label><i class="h3 mb-0 font-weight-bold bg-yellow">Employeer 3</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                       <label for="inputName" class="col-sm-3 col-form-label">Employeer:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer3Name" value="<?php echo $get_exp_emp3_name;?>">
                        </div>
                      </div>

                       <form class="form-horizontal">
                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Designation:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer3Designation" value="<?php echo $get_exp_emp3_designation;?>">
                        </div>
                      </div>

                       <form class="form-horizontal">
                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Salary:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer3CTC" value="<?php echo $get_exp_emp3_salary;?>">
                        </div>
                      </div>

                       <form class="form-horizontal">
                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label">Work Duration:</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="SSS" name="Employer3WorkDuration" value="<?php echo $get_exp_emp3_duration;?>">
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
