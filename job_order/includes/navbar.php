    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" style="color:white;"data-widget="pushmenu" href=""><i class="fa fa-bars"></i></a>
      </li></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index" style="color:white;" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="new" style="color:white;" class="nav-link">About us</a>
      </li>
    </ul>
   
<!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
          <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <span class="" style="font-size: 1rem; color:white;"><i class="fa fa-user"></i></span>
  
              <span class="hidden-xs" style="color:white;">Hello <?php echo $db_user_name?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if ($db_location=='') {?>
      <img class="img-rounded"
                       src="../dist/img/no-photo-icon.png"
                       alt="User profile picture">

<?php }elseif($db_location<>'') {?>
      <img class="img-rounded"
                       src="<?php echo (!empty([$db_location])) ? '../dist/img/'.$db_location : '../dist/img/no-photo-icon.png'; ?>"
                       alt="User profile picture">
<?php } ?>
                <p>
                  <?php echo $db_first_name?>
                  <small><?php echo $db_email_ad?></small>
                </p>

              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a href="../index.php">
                      <input type="submit" class="btn btn-default btn-flat" name="signout" id="signout" value="Sign Out">
                    </a>
                </div>
              </li>
            </ul>
          </li>

          <!-- </form> -->

        </ul>
      </div>

     
  </nav>
  <!-- Navbar End -->