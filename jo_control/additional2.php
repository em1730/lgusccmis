<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'insert_additional2.php'; ?>
<?php include 'insert_time2.php'; ?>
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-10">
    <div class="col-sm-6">
          <h3 class="m-0 text-dark">Additional Option</h3>
      <h1 class="m=o text-dark">
       
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Additional</li>
         </ol>
         </div>
      <div class="col-md-6">

            

</div>

         <div class="col-md-12">
            <div class="card card-outline card-success ">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" id="all" data-toggle="tab">Salary</a></li>
                  <li class="nav-item"><a class="nav-link" href="#schedule" data-toggle="tab">Time</a></li>
                  
                </ul>
              </div><!-- /.card-header -->

  <?php echo $alert_msg;?>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane " id="activity">
                    <!-- Post -->
                      <h3>List of Rates</h3>
                     
          <div class="row">
            <div class="col-lg-7">
             <div class="card card-outline card-success">
           <div class="card-body">
             </div>

                    <form class="form-horizontal" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
               
              <div class="card-body">
                <table id="users" class="table table-bordered table-striped" cellspacing="1" cellpadding="8" style="background-color: #f1f1f1;"  >
                  <thead>
                    <tr bgcolor="lightgreen">
                 
                     <th style="text-align:center;" width="65%">Rate (Php)</th>
                    </tr>
                  </thead>
                  <tbody>
                                   <?php while ($emp_data= $get_rate_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>

                   
                    <td style="text-align:center;"><?php echo $emp_data['Salary'] ?></td>

                          </tr>
                      
                   <?php } ?>  
                  </tbody>
                </table>
              </div>
          </div>
        </div>
          
  
 
                   <div class="col-md-5">
           <div class="card card-success card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-square" src="../dist/img/user_balance-512.png" alt="User Image">
                  <span class="username"><a href="#">Add</a></span>
                    <span class="description" style="color:black">Salary</span>
                </div>
                                    <div class="card-tools">
                      <span class="badge badge-danger"></span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                      <!-- /.card-header -->

                <div class="card-body">
                 <div class="row">
                       <div class="col-sm-12">
                      <div class="form-group">
                        <label>Rate</label>
                        <input type="text" class="form-control" name="rate" required>
                      </div>
                  </div>
                </div>
                
                   <hr>
                     <div class="box-footer" align="right">
                    
                       <button type="submit" class="btn btn-success" <?php echo $btnStatus;?> name="insert" value="save"><b>Add up</b></button>
                
                     
                   </div>
              </div>
            </div>
          </form>
          </div>
               </div>
           

    <!-- /.post -->
                    </div>   
 <!-- /.tab-pane -->

                  <div class="tab-pane fade" id="schedule">             
                    <h3>List of Schedule (Time)</h3>
                     
          <div class="row">
            <div class="col-lg-7">
             <div class="card card-outline card-success">
              <div class="card-body">
           
             </div>

                    <form role="form" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body">
                <table id="user" class="table table-bordered table-striped" cellspacing="1" cellpadding="8" style="background-color: #f1f1f1;"  >
                  <thead>
                    <tr bgcolor="lightgreen">
                     <th style="text-align:center;" width="65%">Time (Hours)</th>
                    </tr>
                  </thead>
                  <tbody>
                                   <?php while ($emp_data= $get_time_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>

                 
                    <td style="text-align:center;"><?php echo $emp_data['TimeSched'] ?></td>

                          </tr>
                      
                   <?php } ?>  
                  </tbody>
                </table>
              </div>
          </div>
          </div>
  
 
                   <div class="col-md-5">
           <div class="card card-success card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-square" src="../dist/img/49194.png" alt="User Image">
                  <span class="username"><a href="#">Add</a></span>
                    <span class="description" style="color:black">Schedule</span>
                </div>
                                    <div class="card-tools">
                      <span class="badge badge-danger"></span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                      <!-- /.card-header -->

                <div class="card-body">
                 <div class="row">
                       <div class="col-sm-12">
                      <div class="form-group">
                        <label>Time</label>
                        <input type="text" class="form-control" name="jo_time" required>
                      </div>
                  </div>
                </div>
                
                   <hr>
                     <div class="box-footer" align="right">
                    
                       <button type="submit" class="btn btn-success" <?php echo $btnStatus;?> name="add" value="add"><b>Add up</b></button>
                
                     
                   </div>
              </div>
            </div>
          </div>
        </form>
               </div>
           

    <!-- /.post -->
                    </div>   
 <!-- /.tab-pane -->


                        <div class="tab-pane fade" id="deduction">             
                   <div class="card-body">
                <div class="tab-content">
                    <!-- Post -->
                                           
          <div class="col-md-12">
          <div class="card">
           

                       <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body">

                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" style="                 background-position: 10px 10px;
                  background-repeat: no-repeat;
                  width: 100%;
                  font-size: 16px;
                  padding: 12px 20px 12px 40px;
                  border: 1px solid #ddd;
                  margin-bottom: 12px;">

                <table id="user" class="table table-bordered table-striped" cellspacing="1" cellpadding="8"  style="background-color: #f1f1f1;" >
                  <thead>
                    <tr bgcolor="yellow"> <b>
                      <th style="text-align:center;"width="20%">Job Order No.</th>
                     <th style="text-align:center;" >Covered Period</th>
                       <th style="text-align:center;" width="40%">Time</th>
                    </b></tr>
                  </thead>
                  <tbody>
                                   <?php while ($emp_data= $get_schedule_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <?php if ($emp_data['EmpCode']==$get_emp_code) {?>
                    <td style="text-align:center;"><?php echo $emp_data['JobOrderNo'];?></td>
                    <td><?php echo $emp_data['StartPeriod']." ". "-". " ".$emp_data['EndPeriod']; ?></td>
                     <td style="text-align:center;"><?php echo $emp_data['Time1']; ?> <?php }elseif($emp_data['EmpCode']!=$get_emp_code) {?>

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


                        <div class="tab-pane fade" id="cut_off">             
                   <div class="card-body">
                <div class="tab-content">
                    <!-- Post -->
                                           
          <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><strong>Cut Off</strong></h3>
             <button type="button" href="#myModal" id="myBtn" class="btn btn-success float-sm-right"><span><i class="fa fa-plus"></i></span></button></div>

                    <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body">
                <table id="users" class="table table-bordered table-striped" cellspacing="1" cellpadding="8"   >
                  <thead>
                    <tr bgcolor="pink">
                     <th style="text-align:center;" >Covered Period</th>
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



         
