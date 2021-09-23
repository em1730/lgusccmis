<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>



<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
       Social Security System 
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-12">
      <ol class="breadcrumb float-sm-right text-ml">
      <li class="breadcrumb-item"><a href="index.php"> Home</a></li>
      <li class="breadcrumb-item"><a href="employeedetails.php?ID=<?php echo $get_emp_id;?>"> List_Employee</a></li>
      <li class="breadcrumb-item">SSS Contribution</li>
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
           <i style="font-size:25px"><i style="color:blue" align="center">Monthly Contribution</i></i>  

             
              <div class="jumbotron">
              <div class="row">

  <input type="hidden" class="form-control" readOnly=true id = "emp_id" name="EmpCode" value="<?php echo $get_emp_id; ?>">

           
               
             <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">

                          <?php if ($get_emp_photo=='') {?>
      <div class="col-12 col-sm-3">
               <div class="widget-user-image" align="left">
                <img class="img-square elevation-5" id="image" src="../dist/img/no-photo-icon.png" width="200" height="200" vspace="10" alt="User Avatar">
              </div>

<?php }elseif($get_emp_photo<>'') {?>
      <div class="col-12 col-sm-3">
               <div class="widget-user-image" align="left">
                <img class="img-square elevation-5" id="image" src="<?php echo (!empty([$get_emp_photo])) ? '../dist/photo/'.$get_emp_photo : '../dist/photo/no-photo-icon.png'; ?>" width="200" height="200" vspace="10" alt="User Avatar">        
              </div>
            </div>
          </div>
<?php } ?>
 <input type="hidden" class="form-control" name="ID" value="<?php echo $id_emp;?>" required>
  <input type="hidden" class="form-control" readOnly=true id = "emp_id" name="EmpCode" value="<?php echo $get_emp_id; ?>">


                   <h3><?php echo $get_emp_fname . " " . $get_emp_mname[0] ."." . " " . $get_emp_lname ?> </h3>
                   <lable>ID No.: <?php echo $get_emp_code?></lable>
                   <br>
                   <hr>
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
                     <p><i>List of the monthly contribution every month.</i></p>
                   
                      <input type="hidden" class="form-control"  name="ID" value="<?php echo $get_id_no;?>">
                       

 
                      
                       

                    <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body table-responsive p-0" style="height: 800px;">

                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Year...." title="Type year" style="                 background-position: 10px 10px;
                  background-repeat: no-repeat;
                  width: 100%;
                  font-size: 16px;
                  padding: 12px 20px 12px 40px;
                  border: 1px solid #ddd;
                  margin-bottom: 12px;">

                <table id="user" class="table table-bordered table-striped table-hover" cellspacing="1" cellpadding="8"  style="background-color: #f1f1f1;" >
                  <thead>
                   <tr bgcolor="#BDB76B"> <b>
                      <th style="text-align:center;"width="5%">No.</th>
                     <th style="text-align:center;" >Covered Month</th>
                     <th style="text-align:center;" >Year</th>
                       <th style="text-align:center;" width="2%"></th>
                       <th style="text-align:center;">Contribution</th>
                    </b></tr>
                  </thead>
                  <tbody>
                                   <?php if($count>0){
            $n  =   1; while ($emp_data= $get_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <?php if ($emp_data['EmpCode']==$get_emp_code) {?>
                    <td style="text-align:center;"><?php echo $n++;?></td>
                     <td  bgcolor="#FFFFFF"><?php echo $emp_data['CoveredMonth']?></td>
                     <td  bgcolor="#FFFFFF" align="right"><?php echo $emp_data['year']?></td>
                     <td bgcolor="#FFFFE0" align="right"><?php echo "P" ?></td>
                    <td bgcolor="#FFFFE0" align="right"><?php echo $emp_data['sss_amount'] ?></td>
              <?php }elseif($emp_data['EmpCode']!=$get_emp_code) {?> 
                       <?php } ?> 

</td>
                     
   
           
           
        </tr>
        <?php 
            }
        }else{?>
        <tr>
            <td colspan="6" align="center"><strong>No Record(s) Found!</strong></td>
        </tr>
        <?php } ?>
    </tbody>
                </table>
              </div>
          </div>
          
                 
         
              
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
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("user");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
       td = tr[i].getElementsByTagName("td")[2];
     
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


</div>
</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
