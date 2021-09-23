<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'insert_project.php'; ?>

   <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
      Project 
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Educational Background</li>
         </ol>
         </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="name_jo.php"  id="myButton" class="btn btn-primary btn-block mb-3">Create Job Order</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="#myModal" id="myBtn" class="nav-link">
                    <i class="fa fa-inbox"></i> Create Project
                    <span class="badge bg-primary float-right">12</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fa fa-print"></i> Print
                  </a>
                </li>
                 </ul>
            </div>
            <!-- /.card-body -->
          </div>
          </div>


            <div class="col-md-8">      
            <div class="card card-info">
            <div class="card-header with-border">
              <h3 class="card-title">Details</h3>
            </div>
          
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>">
            	<div class="card-body text-m">
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                   
                      <tr bgcolor="#feef6d">
                      <th style="text-align:center;">Code</th>
                      <th width="45%"style="text-align:center;">Project Name</th>
                      <th  style="text-align:center;">Budget</th>
                      <th style="text-align:center;">Action</th>
                    </tr>

                    </tr>
                  </thead>
                  <tbody>
                  	 <?php while ($get_project = $get_project_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                    <td><?php echo $get_project['BudgetNo'];?></td>
                   <td> <strong><?php echo $get_project['ProjectName'];?></strong></td>
                    <td><?php echo $get_project['ProjectBudget'];?></td>
                    <td align="center">
                          <a class="btn btn-outline-success btn-xs" href="#add" data-toggle="tooltip" title="View"><i class="fa fa-folder-open"  style="font-size:25px"></i>
                          </a>                            
                    </td>

                          </tr>
                      <div class="form-group">
                   <?php } ?>
                  </tbody>
                </table>
              </div>
             <!-- /.box-body -->


                          
            </form>
       </section>
    <!-- /.content -->
</div>
 <?php include 'includes/footer.php'; ?>
 <!-- Content-Wrapper End -->
</div>      
   <!-------------------- modals here --------------------------------->

<div id="myModal" class="modal">
      <div class="modal-dialog">
        <div class="modal-content ">
    <div class="modal-header bg-primary">
              <h3><b> <i class="fa fa-plus"> Additional Project </i></b></h3>
               <span class="close">&times;</span>
           
        </div>
     <form class="form-horizontal" method="POST" action="insert_project.php">

               
              <div class="modal-body">
                  <div class="form-group"> 
                    <label> Budget No. </label>
                    <input type="text"  id="budgetno" name="budgetno" class="form-control">
                  </div>

                  <div class="form-group"> 
                    <label> Project Name: </label>
                    <input type="text" id="projectname" name="projectname" class="form-control">
                  </div>

                  <div class="form-group"> 
                    <label> Project Budget </label>
                    <input type="text" id="projectbudget" name="projectbudget" class="form-control" >
                  </div>
                  	<br>

                  	<div class="modal-footer">
                  	 <button type="submit" class="btn btn-success btn-l float-right" name="insert" value="save" ><i class="fa fa-check"></i> Proceed</button>

                  	 </div>
              </form>
                        
    </div>
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
   var type = $(this).val();
            //  $('#doc_no').val(type);
      
         
            $.ajax({
              type:'POST',
              data:{type:type},
              url:'orderbudgetno.php',
               success:function(data){
             $('#budgetno').val(data);

            } 
                 
                });           
                        
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />




 
</body>
</html>