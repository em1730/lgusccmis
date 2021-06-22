<?php include 'includes/session.php'; ?>
<?php include 'includes/calendar_header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
   
<!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
          <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="" class="dropdown-toggle" data-toggle="">
              <span class="" style="font-size: 1.3rem; color:white;"><i class="fa fa-user"></i></span>
  
              <span class="hidden-xs" style="color:white;">Hello <?php echo $db_user_name?> </span>
            </a>
         </li>
       </ul>
      </div>

     
  </nav>
  <!-- Navbar End -->
 
 <div class="card-body"> 
  <div class="container" >
  	<div align="center"> 		
   <div id="calendar" style="width:100%; font-size: 18px; background-color: white; border-color: blue;" align="center;"></div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php include 'includes/footer.php'; ?>

