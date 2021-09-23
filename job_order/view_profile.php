
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'insert_travel.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
        Profile
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">Profile</li>
         </ol>
         </div>
       
    </section>


     <!-- Main content  -->
    <div class="row">
   <div class="col-md-1"></div>
     <div class="col-md-10">     
       <div class="card card-solid">
       
                     <!-- /.box-header -->
               <!-- form start -->
            <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
             <div class="box-body"> 

              <!-- Profile Image -->
               <div class="box-profile" align="left">
                <div class="col-md-5"> 
                 <img class="img-circle img-fluid" src="../dist/img/<?php echo $db_location?>" align="center" vspace="10" width="200" height="200"></div>
                  <div class="col-md-1">
                  <h2 class="lead" style="text-align: left; padding-top: 20px;" ><b><?php echo $db_first_name . " " . $db_middle_name[0] ."." . " " . $db_last_name ?></b></h2>
                 </div>
               </div>
               <br>          
              

               
            </form>
            </div>
           </div>
         </div>
          <!-- /.box -->
       </div>
       <div class="col-md-1"></div>
       </div>
     </div>
     </section>
     <!-- Main Content End --> 

   </div> 
   <!-- Content-Wrapper End -->


 <?php include 'includes/footer.php'; ?>
 </div>
 <!-- Wrapper End -->

 <?php include 'includes/scripts.php'; ?>

</body>
</html>

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

</body>
</html>
