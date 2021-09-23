   <!-- Main Sidebar Container -->
   <aside class= "main-sidebar sidebar-lightgrey elevation-4">

     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
       <img src="../dist/img/scclogo.png" alt="" class="brand-image img-circle" style="opacity: ">
       <span class="brand-text font-weight-light"><b>LGUSCC | ITCSO</b></span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar" display="block" position="fixed">

       <!-- Sidebar USER PANEL -->
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
       <?php if ($db_location=='') {?>
      <img class="img-circle"
                       src="../dist/img/no-photo-icon.png"
                       alt="User image" width="" height="150">

<?php }elseif($db_location<>'') {?>
      <img class="img-circle"
                       src="<?php echo (!empty([$db_location])) ? '../dist/img/'.$db_location : '../dist/img/no-photo-icon.png'; ?>"
                       alt="User avatar" style="width:200px height:150px">
<?php } ?>
         </div>
         <div class="info">
          <a href="" class="d-block" style="color:black;"><?php echo $db_first_name . " " . $db_middle_name[0] ."." . " " . $db_last_name ?>  </a>
           <a href="" style="font-size:15px"><i class="fa fa-circle text-success" style="font-size:10px;"></i> Online</a>
         </div>
       </div>

       <!-- Sidebar Menu -->
       <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
           <li class="nav-item">
             <a href="index" class="nav-link active">
               <img src="../dist/img/dashboard.ico" alt="" class="brand-image img-circle" width="30" height="30" style="opacity: ">
       <span class="brand-text font-weight-light"> <p> Dashboard </p>
             </a>
           </li>
            <!-- Divider -->
             <hr class="sidebar-divider my-1">

             
             <li class="nav-item has-treeview">
             <a href="employeedetails.php?ID=<?php echo
                            "1";?>" class="nav-link">
               <img src="../dist/img/list.png" alt="" class="brand-image img-square" width="25" height="25" style="opacity: "> <p  style="text-indent: 10px;"> Employees</p>
             </a>

              <li class="nav-item has-treeview">
             <a href="#" class="nav-link">
              <img src="../dist/img/create-new.png" alt="" class="brand-image img-square" width="25" height="25" style="opacity: "> <p  style="text-indent: 10px;"> Create<i  style="text-indent: 50px;" class="right fa fa-angle-left" ></i></p>
             </a>

              <ul class="nav nav-treeview">

               <li class="nav-item">
                 <a href="add_project.php" class="nav-link">
                    <i style="color:white;">....</i> <i class="fa fa-circle-o nav-icon" style="color:pink"></i>
                     <p>Project</p>
                    </a>
                  </li>

                   <li class="nav-item">
                 <a href="list_jo.php" class="nav-link">
                    <i style="color:white;">....</i> <i class="fa fa-circle-o nav-icon" style="color:pink"></i>
                     <p>Job Order</p>
                    </a>
                  </li>


                   <li class="nav-item">
                 <a href="payroll2.php" class="nav-link">
                    <i style="color:white;">....</i> <i class="fa fa-circle-o nav-icon" style="color:pink"></i>
                     <p>Payroll</p>
                    </a>
                  </li>


                   <li class="nav-item">
                 <a href="additional.php" class="nav-link">
                    <i style="color:white;">....</i> <i class="fa fa-circle-o nav-icon" style="color:pink"></i>
                     <p>Addition Option</p>
                    </a>
                  </li>
                   </ul>
                          

              
            <li class="nav-item has-treeview">
             <a href="#" class="nav-link ">
               <img src="../dist/img/setting.jpg" alt="" class="brand-image img-circle" width="25" height="25" style="opacity: "><p  style="text-indent: 13px;">Account Settings<i style="text-indent: 50px;" class="right fa fa-angle-left"></i></p>
             </a>

             <ul class="nav nav-treeview">

               <li class="nav-item">
                 <a href="profile.php" class="nav-link">
                     <i style="color:white;">....</i><i class="fa fa-circle-o nav-icon" style="color:orange"></i>
                     <p>My Profile</p>
                    </a>
                  </li>

                   <li class="nav-item">
                 <a href="users.php?user_id=<?php echo
                            $user_id;?>" class="nav-link">
                     <i style="color:white;">....</i><i class="fa fa-circle-o nav-icon" style="color:orange"></i>
                     <p>Users</p>
                    </a>
                  </li>

                  
        
             </ul>
           


          <li class="nav-item has-treeview">
             <a href="employeedetails.php?ID=<?php echo
                            "1";?>" class="nav-link">
               <img src="../dist/img/contribution.jpg" alt="" class="brand-image img-circle" width="30" height="30" style="opacity: "><p   style="text-indent: 13px;"> Deduction</p><i  style="text-indent: 10px;" class="right fa fa-angle-left"></i>
             </a>
             
              <ul class="nav nav-treeview">

               <li class="nav-item">
                 <a href="list_pag_ibig.php" class="nav-link" style="text-indent: 20px;">
                    <img  src="../dist/img/pag.png" alt="" class="brand-image img-square" width="28" height="28" style="opacity: ">
                     <p  style="text-indent: 10px;">Pag-ibig</p>
                    </a>
                  </li>

                   <li class="nav-item">
                 <a href="list_sss.php" class="nav-link"  style="text-indent: 20px;">
                     <img  src="../dist/img/SSS_logo.png" alt="" class="brand-image img-square" width="24" height="24" style="opacity: ">
                     <p style="text-indent: 11px;">SSS</p>
                    </a>
                  </li>

                </ul>



          <li class="nav-item has-treeview">
             <a href="calendar.php" class="nav-link">
              <img src="../dist/img/calendar.png" alt="" class="brand-image img-square" width="25" height="25" style="opacity: "> <p style="text-indent: 10px;"> Calendar</p>
             </a>

              </li>

             <li class="nav-header">SYSTEMS</li>
                  <li class="nav-item">
                 <a href="../lockscreen.php" class="nav-link">
                   <img src="../dist/img/locking.png" alt="" class="brand-image img-circle" width="35" height="35" style="opacity: ">
                   <p style="text-indent: 10px;">LOCK</p>
                 </a>
               </li>

           </ul>

       </nav>
       <!-- Sidebar Menu END -->
      
     </div>
     <!-- Sidebar END -->

   </aside>
   <!-- Main Sidebar Container End -->