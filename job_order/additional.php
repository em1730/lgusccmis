<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'insert_additional.php'; ?>
<?php include 'insert_time.php'; ?>
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
                     </div>

  
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane " id="activity">
                    <!-- Post -->
                    <?php echo $alert_msg;?>
                      <h3>List of Rates</h3>
                     
          <div class="card card-info card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-square" src="../dist/img/user_balance-512.png" alt="User Image">
                  <span class="username"><a href="#">Add</a></span>
                    <span class="description" style="color:black">Salary</span>
                </div>
                                    <div class="card-tools">
                      <span class="badge badge-danger"></span>
                      <button type="button" href="#myModal" id="myBtn" class="btn btn-warning" <?php echo $btnStatus;?> name="" value="save"><b><i class="fa fa-plus"></i></b></button>
                      
                    </div>
                  </div>

                    <form class="form-horizontal" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
               
              <div class="card-body">
                <table id="users" class="table table-bordered table-striped" cellspacing="1" cellpadding="2" style="background-color: #f1f1f1;"  >
                  <thead>
                    <tr bgcolor="lightgreen">
                    <th style="text-align:center;" width="10%">No.</th>
                     <th style="text-align:center;" width="65%">Rate (Php)</th>
                    </tr>
                  </thead>
                  <tbody>
                                   <?php if($count>0){
            $n  =   1;  while ($emp_data= $get_rate_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>

                   <td style="text-align:center;"><?php echo $n++;?></td>
                    <td style="text-align:right;"><?php echo $emp_data['Salary'] ?></td>

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
       
 
                 

    <!-- /.post -->
                    </div>   
 <!-- /.tab-pane -->

                  <div class="tab-pane fade" id="schedule">             <?php echo $alert_msg1;?>
                    <h3>List of Schedule (Time)</h3>
                     
          <div class="row">
            <div class="col-lg-12">
             <div class="card card-outline card-success">

             <div class="card card-success card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-square" src="../dist/img/49194.png" alt="User Image">
                  <span class="username"><a href="#">Add</a></span>
                    <span class="description" style="color:black">Schedule</span>
                </div>
                                    <div class="card-tools">
                      <span class="badge badge-danger"></span>
                      <button type="button" href="#myModal2" id="myBtn2" class="btn btn-warning" <?php echo $btnStatus;?> name=""><b><i class="fa fa-plus"></i></b></button>
                      
                    </div>
                  </div>

                     <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>"> 
               
              <div class="card-body table-responsive p-0" style="height: 800px;">

                <input type="text" id="Input" onkeyup="myFunction()" placeholder="Search...." title="Type year" style="                 background-position: 10px 10px;
                  background-repeat: no-repeat;
                  width: 100%;
                  font-size: 16px;
                  padding: 12px 20px 12px 40px;
                  border: 1px solid #ddd;
                  margin-bottom: 12px;">

                <table id="user" class="table table-bordered table-striped table-hover" cellspacing="1" cellpadding="8"  style="background-color: #f1f1f1;" >
                  <thead>
                                      <tr bgcolor="lightgreen">
                      <th style="text-align:center;" width="10%">No.</th>
                     <th style="text-align:center;" width="65%">Time (Hours/Days)</th>
                    </tr>
                  </thead>
                  <tbody>
                                   <?php if($count>0){
            $n  =   1; while ($emp_data= $get_time_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>

                    <td style="text-align:center;"><?php echo $n++;?></td>
                    <td style="text-align:left;"><?php echo $emp_data['TimeSched'] ?></td>
     
           
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

 <div id="myModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm">

        <div class="modal-content ">
    
    <div class="modal-header bg-info">
              <h5>Rate</h5>
               <span class="close">&times;</span>
           
        </div>
     <form class="form-horizontal" method="Post" action="insert_additional.php">

               
              <div class="modal-body">
                  <div class="form-group"> 
                    
            
                   <div class="row">
                   <input type="text"  id="code" name="rate" class="form-control" >
                  </div>
                  </div> 
               
                                     
               <div class="modal-footer">         
                      <button class="button" name="insert"><span> Add </i></span></button>
                    </div>
                    </form>
                    </div>
                  </div>
                </div>
                 </div>
                </div>
                
<!-------------------- modals here --------------------------------->


 <div id="myModal2" class="modal" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm">

        <div class="modal-content ">
    
    <div class="modal-header bg-info">
              <h5>Time</h5>
               <span2 class="close2">&times;</span2>
           
        </div>
     <form class="form-horizontal" method="Post" action="insert_time.php">

               
              <div class="modal-body">
                  <div class="form-group"> 
                    
            
                   <div class="row">
                   <input type="text"  id="code" name="jo_time" class="form-control" >
                  </div>
                  </div> 
               
                                     
               <div class="modal-footer">         
                      <button class="button" name="add"><span> Add </i></span></button>
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

var modal2 = document.getElementById("myModal2");

// Get the button that opens the modal
var btn2 = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
  modal2.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
  modal2.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal2.style.display = "none";
}
}
</script>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("Input");
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



         
