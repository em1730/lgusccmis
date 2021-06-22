<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-10">
    <div class="col-sm-6">
          <h3 class="m-0 text-dark">Employees</h3>
      <h1 class="m=o text-dark">
       
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Employee</li>
         </ol>
         </div>
      <div class="col-md-3">

            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
 
 <?php if ($get_emp_photo=='' && $get_status=='Inactive') {?>
      <img class="profile-user-img img-fluid img-circle" style="background-color:red"
                       src="../dist/photo/no-photo-icon.png"
                       alt="User profile picture">

<?php }elseif($get_emp_photo=='' && $get_status=='Active') {?>
      <img class="profile-user-img img-fluid img-circle" style="background-color:green"
                       src="../dist/photo/no-photo-icon.png"
                       alt="User profile picture">

<?php }elseif($get_emp_photo<>''  && $get_status=='Active') {?>
      <img class="profile-user-img img-fluid img-circle" style="background-color:green"
                       src="<?php echo (!empty([$get_emp_photo])) ? '../dist/photo/'.$get_emp_photo : '../dist/photo/no-photo-icon.png'; ?>"
                       alt="User profile picture">

<?php }elseif($get_emp_photo<>''  && $get_status=='Inactive') {?>
      <img class="profile-user-img img-fluid img-circle" style="background-color:red"
                       src="<?php echo (!empty([$get_emp_photo])) ? '../dist/photo/'.$get_emp_photo : '../dist/photo/no-photo-icon.png'; ?>"
                       alt="User profile picture">
<?php } ?>


                        </div>
                 <input type="hidden" class="form-control" name="Status" readonly="true" value="<?php echo $get_emp_id;?>" >

                <h3 class="profile-username text-center"><?php echo $get_emp_fname . " " . $get_emp_mname[0] ."." . " " . $get_emp_lname ?></h3>

                <p class="text-muted text-center"><?php echo $get_emp_designation?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>ID</b> <a class="float-right"><?php echo $get_emp_code?></a>
                  </li>
                </ul>

                <a href="edit_employee.php?ID=<?php echo $get_emp_id;?>" class="btn btn-primary btn-block" id='profile_edit'><b>Edit Profile</b></a>


             
              </div>
              <!-- /.card-body -->
           
</div>
 <!-- About Me Box -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><strong><i>Information</i></strong></h3> 
                </div>
                  <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fa fa-briefcase "></i> Department</strong>
                 <input type="hidden" class="form-control" name="Status" readonly="true" value="<?php echo $get_emp_department;?>" >

                <p class="text-muted"><?php echo $get_emp_department?></p>

                <hr>

                
                <strong><i class="fa fa-phone "></i> Contact No.</strong>

                    <p class="text-muted"><?php echo $get_emp_contact_number?></p>

                <hr>

                <strong><i class="fa fa-envelope "></i> Email</strong>

                    <p class="text-muted"><?php echo $get_emp_email?></p>

                <hr>

                
                <strong><i class="fa fa-user "></i> Starting Date</strong>

                    <p class="text-muted"><?php echo  $get_emp_joingdate?></p>        
              
           </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

             <div class="card">
            <div class="card-header">
              <h3 class="card-title"><strong><i>Other related data</i></strong></h3>

               <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-target="#other"><i class="fa fa-plus"></i>
                </button> 
            </div>
          </div>
            <div class="card-body collapse" id="other">
              <strong><i class="fa fa-map-marker "></i> Address </strong>

                    <p class="text-muted"><?php echo $get_emp_address.","." ". "Barangay". " ".$get_emp_brgy." ".$get_emp_city.","." ".$get_emp_province?></p>

                <hr>

              <strong><i class="fa fa-calendar"></i> Birth Date</strong>

                    <p class="text-muted"><?php echo $get_emp_birth?></p>

                <hr>

                <strong><i class="fa fa-adjust"></i> Age</strong>

                    <p class="text-muted"><?php echo $get_age?></p>

                <hr>

                <strong><i class="fa fa-info-circle"></i> Civil Status</strong>

                    <p class="text-muted"><?php echo $get_emp_status?></p>

                <hr>

                 <strong><i class="fa fa-tint"></i> Blood Type</strong>

                    <p class="text-muted"><?php echo $get_emp_blood?></p>

                <hr>

                 <strong><i class="fa fa-pencil "></i> Skills</strong>

                    <p class="text-muted"><?php echo $get_emp_skills?></p>

                    <hr>

                     <a href="education.php?ID=<?php echo $get_emp_id; ?>" class="btn btn-info btn-block" id='eduDetails'><b>Education Details</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


<div class="card">
              <div class="card">
              </div>
                  <!-- /.card-header -->
              <div class="card-body">
                <a href="add_employee.php" class="btn btn-success btn-block"><b> <i class="fa fa-plus"></i> Add Employee</b></a>
              
            

               <a href="index" class="btn btn-default btn-block"><b>Cancel</b></a>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

</div>

         <div class="col-md-9">
            <div class="card card-outline card-primary">
              <div class="card-header p-2" >
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" id="all" data-toggle="tab">All</a></li>
                  <li class="nav-item"><a class="nav-link" href="#schedule" data-toggle="tab">Reference_number</a></li>
                  <li class="nav-item"><a class="nav-link" href="#deduction" data-toggle="tab">Schedules</a></li>
                   <li class="nav-item"><a class="nav-link" href="#cut_off" data-toggle="tab">Cut Off</a></li>
                </ul>
              </div><!-- /.card-header -->

 
              <div class="card-body">
                <div class="tab-content" >
                  <div class="active tab-pane " id="activity">
                    <!-- Post -->
                      <h4>List of Employees</h4>
                     
          <div class="col-md-12">
          <div class="card card-info">
          
          

                    <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body">
                <table id="users" class="table table-bordered table-striped" cellspacing="1" cellpadding="8"   >
                  <thead>
                    <tr bgcolor="#80ced6">
                      <th style="text-align:center;">No.</th>
                     <th style="text-align:center;" width="65%">Name</th>
                       <th style="text-align:center;">Status</th>
                       <th style="text-align:center;">Profile</th>
                    </tr>
                  </thead>
                  <tbody>
                                   <?php while ($emp_data= $get_all_emp_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>

                   <td><?php echo  $emp_data['ID']; ?></td>
                    <td><?php echo $emp_data['EmpFname'] . " " . $emp_data['EmpMname'][0] ."." . " " . $emp_data['EmpLname'] ?></td>

             <?php if ($emp_data['E_Status']=="Active") {?> 
                     <td style="text-align:center;"><?php echo $emp_data['E_Status'];?></td>

                       <td align="center">
                          <a class="btn btn-outline-info btn-xs" href="employeedetails.php?ID=<?php echo $emp_data['ID']; ?>" data-toggle="tooltip" title="Profile Details"><img src="../dist/img/id.jpg" alt="" class="brand-image img-square" width="30" height="30" style="opacity: ">
                          </a>                          
                    </td>

            <?php }elseif($emp_data['E_Status']=="Inactive") {?>  
                         <td style="text-align:center; color:red;"><?php echo $emp_data['E_Status'];?></td>
                   <td align="center">
                          <a class="btn btn-outline-danger btn-xs" href="employeedetails.php?ID=<?php echo $emp_data['ID']; ?>" data-toggle="tooltip" title="Profile Details"><img src="../dist/img/fire.png" alt="" class="brand-image img-square" width="30" height="30" style="opacity: ">
                          </a>  

                    </td>
                       <?php } ?> 


                          </tr>
                    
        <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        
        </div>

    <!-- /.post -->
                    </div>   
 <!-- /.tab-pane -->

                   <div class="tab-pane fade" id="schedule">             
                    <h3>REFERENCE</h3>
                     <p>The following information are considered to be private. All information will be treated as strictly confidential.</p>
                    <hr>
                      <input type="hidden" class="form-control"  name="ID" value="<?php echo $get_id_no;?>">
                     <label><i class="h5 mb-0 font-weight-bold" style=" background-color: #80ced6;">Social Security System</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">SSS Control No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="SSS" name="Sssno" value="<?php echo $get_id_sss;?>" readonly>
                        </div>
                         <a href="sss.php?ID=<?php echo $get_emp_id?>" id="myBtnSss" class="btn btn-info float-sm-right"><span><i class="fa fa-folder-open"></i></span></a>
                      </div>

                       <hr>
                     <label><i class="h5 mb-0 font-weight-bold" style=" background-color: #80ced6;">Pag-ibig</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Pag-ibig MID No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="PagIbigNo" name="idpagibig" value="<?php echo $get_id_pagibig;?>" readonly>
                        </div>
                         <a href="pag_ibig.php?ID=<?php echo $get_emp_id?>" id="myBtnSss" class="btn btn-info float-sm-right"><span><i class="fa fa-folder-open"></i></span></a>

                      </div>

                       <hr>
                     <label><i  class="h5 mb-0 font-weight-bold" style=" background-color: #80ced6;">ATM</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">SA No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="atm" name="AtmNo" value="<?php echo $get_id_atm;?>" readonly>
                        </div>
                        </div>

                     <hr>
                     <label><i class="h5 mb-0 font-weight-bold" style=" background-color: #80ced6;">PhilHealth</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">PhilHealth No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="philhealth" name="PhilNo" value="<?php echo $get_id_phil;?>" readonly>
                        </div>
                      </div>

                       <hr>
                     <label><i  class="h5 mb-0 font-weight-bold" style=" background-color: #80ced6;">TIN</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">TIN No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="tin" name="TinNo" value="<?php echo $get_id_tin;?>" readonly>
                        </div>
                      </div>

                      <hr>
                     <label><i class="h5 mb-0 font-weight-bold" style=" background-color: #80ced6;">Community Tax Certificate:</i></label>
                    <br>
                       <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">CTC No.:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="ctcno" name="CtcNo" value="<?php echo $get_id_ctc;?>" readonly>
                        </div>
                      </div>
                        <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Date Issued:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="dateissued" name="CtcDate" value="<?php echo $get_id_date;?>" readonly>
                        </div>
                      </div>
                           <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Issued At:</label>
                        <div class="col-sm-5">
                          <input type="input" class="form-control" id="placeissued" name="CtcAt" value="<?php echo $get_id_place;?>" readonly>
                        </div>
                      </div>
                      </div>        
                   <!-- /.tab-pane -->

                                           <div class="tab-pane fade" id="deduction">             
                   <div class="card-body">
                <div class="tab-content">
                    <!-- Post -->
                                           
          <div class="col-md-12">
          <div class="card">
           

                       <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body table-responsive p-0" style="height: 800px;">

                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Month.." title="Type in a name" style="                 background-position: 10px 10px;
                  background-repeat: no-repeat;
                  width: 100%;
                  font-size: 16px;
                  padding: 12px 20px 12px 40px;
                  border: 1px solid #ddd;
                  margin-bottom: 12px;">

                <table id="user" class="table table-bordered table-striped table-hover" cellspacing="1" cellpadding="8"  style="background-color: #f1f1f1;" >
                  <thead>
                    <tr style="background-color: hsla(89, 43%, 51%, 0.3)"> <b>
                      <th style="text-align:center;"width="10%">J.O. #</th>
                     <th style="text-align:center;" width="20%">Covered Period</th>
                       <th style="text-align:center;" width="40%">Time</th>
                       <th style="text-align:center;" width="10%">Rate</th>
                    </b></tr>
                  </thead>
                  <tbody>
                                   <?php while ($emp_data= $get_schedule_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <?php if ($emp_data['EmpCode']==$get_emp_code) {?>
                    <td style="text-align:center;"><?php echo $emp_data['JobOrderNo'];?></td>
                     <?php if ($emp_data['Period']!="" && $emp_data['Month1']!="" && $emp_data['Month2']!="") {?> 
                  <td style="text-align:center; font-size:14px"><?php echo $emp_data['Period']." ".$emp_data['RegDays'].","." ".$emp_data['Years'];?> 
                  <br>
                      <?php echo $emp_data['Month1']." ".$emp_data['Days1'].","." ".$emp_data['Years'];?>
                  <br>
                      <?php echo $emp_data['Month2']." ".$emp_data['Days2'].","." ".$emp_data['Years'];?></td>
                  <td style="text-align:center; font-size:14px"><?php echo $emp_data['Time1'];?>
                  <br>
                       <?php echo $$emp_data['Time2'];?>
                  <br>
                        <?php echo $emp_data['Time3'];?>
                  </td>
                   <td style="text-align:right"><?php echo  number_format($emp_data['Rate'],2);?>
                   <br>
                      <?php echo number_format($emp_data['Rate1'],2);?>
                   <br>
                      <?php echo number_format($emp_data['Rate2'],2);?>
                   </td>

      <?php }elseif($emp_data['Period']!="" && $emp_data['Month1']!="" && $emp_data['Month2']=="") {?>
                    <td style="text-align:left; font-size:14px"><?php echo $emp_data['Period']." ".$emp_data['RegDays'].","." ".$emp_data['Years'];?> 
                  <br>
                      <?php echo $emp_data['Month1']." ".$emp_data['Days1'].","." ".$emp_data['Years'];?></td>
                   <td style="text-align:center; font-size:14px"><?php echo $emp_data['Time1'];?>
                  <br>
                       <?php echo $emp_data['Time2'];?>
                    </td>
                    <td style="text-align:right"><?php echo number_format($emp_data['Rate'],2);?>
                    <br>
                      <?php echo number_format($emp_data['Rate1'],2);?>
                    </td>


       <?php }elseif($emp_data['Period']!="" && $emp_data['Month1']=="" && $emp_data['Month2']=="") {?>
                      <td style="text-align:center; font-size:14px"><?php echo $emp_data['Period']." ".$emp_data['RegDays'].","." ".$emp_data['Years'];?> 
                    </td>
                    <td style="text-align:center; font-size:14px"><?php echo $emp_data['Time1'];?></td>
                    <td style="text-align:left; font-size:14px"><?php echo $emp_data['Rate'];?></td>
                     

                      <?php } ?> 
                        <?php } ?> 
</td>
                     
                                               
                     
                          </tr>
                      
                  <?php } ?>  
                  </tbody>
                </table>
              </div>
          </div>

          
        </div>

    <!-- /.post -->
 </div>
 <!-- /.tab-pane -->
                </div>
              </div>

                                      <div class="tab-pane fade" id="cut_off">             
                   <div class="card-body">
                <div class="tab-content">
                    <!-- Post -->
                                           
          <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h4 class="card-title"><strong>Cut Off</strong></h4>
             <button type="button" href="#myModal" id="myBtn" class="btn btn-success float-sm-right"><span><i class="fa fa-plus"></i></span></button></div>

                    <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body table-responsive p-0" style="height: 800px;">
                <table id="users" class="table table-bordered table-striped table-hover" cellspacing="1" cellpadding="8"  style="background-color: #f1f2f2;"  >
                  <thead>
                    <tr bgcolor="#897D7A">
                     <th style="text-align:center; color:white" >Covered Period</th>
                  </thead>
                  <tbody>
                                   <?php while ($cut_off_data= $get_period_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <?php if ($cut_off_data['EmpCode']==$get_emp_code) {?>
                    <td style="text-align:center; font-size: 16px"><?php echo $cut_off_data['PeriodCovered1']." "."-"." ".$cut_off_data['Period']; ?></td>
                     <?php }elseif($cut_off_data['EmpCode']!=$get_emp_code) {?>

                              <?php } ?>                    </td>
                     
                          </tr>
                      
                   <?php } ?>  
                  </tbody>
                </table>
              </div>
          </div>
          
        </div>

    <!-- /.post -->
                    </div>   
 <!-- /.tab-pane -->


                  
                </div>
              </div>
            </div>
          </div>
           </form>    
    </section>
     <!-- Main Content End --> 
   </div>
   <?php include 'includes/footer.php'; ?> 
    
   </div> 
   <!-- Content-Wrapper End -->

<!-------------------- modals here --------------------------------->

<div id="myModal" class="modal">
      <div class="modal-dialog">
        <div class="modal-content ">
    
    <div class="modal-header bg-warning">
              <h5>Covered Period</h5>
               <span class="close">&times;</span>
           
        </div>
     <form class="form-horizontal" method="Post" action="insert_cut.php">

               
              <div class="modal-body">
                  <div class="form-group"> 
                    <input type="hidden"  id="code" name="code" class="form-control" value="<?php echo $get_emp_code;?>" >
                  </div>
          
            
                   <div class="row">
                    <div class="col-sm-6">
                   <div class="input-group date mb-3">
                <div class="input-group date mb-3" data-provide="datepicker">
                 <div class="input-group-addon input-group-prepend">
                <span class="input-group-text "><i class="fa fa-calendar"></i></span>  </div>
                <input type="text"  class="form-control" name="periodStart" placeholder="-From-" value="Start">
                 </div>
                    </div>
                  </div>
                            

                    <div class="col-sm-6">
                   <div class="input-group date mb-3">
                <div class="input-group date mb-3" data-provide="datepicker">
                 <div class="input-group-addon input-group-prepend">
                <span class="input-group-text "><i class="fa fa-calendar"></i></span>  </div>
                <input type="text"  class="form-control" name="periodEnd" placeholder="-To-" value="End">
                      </div>
                    </div>
                  </div>
                  </div> 
               
                                     
               <div class="modal-footer">         
                      <button class="button" name="add"><span> Proceed </i></span></button>
                    </div>
                    </form>
                    </div>
                  </div>
                </div>
                
                


 <?php include 'includes/scripts.php'; ?>
 
<script>
   // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("user");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
      td = tr[i].getElementsByTagName("td")[1];
    
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

 </body>
</html>



         
