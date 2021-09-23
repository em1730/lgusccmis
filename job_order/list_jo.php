<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/navbar.php'; ?>

   <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
      List of Job Order 
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="index">Home</a></li>
      <li class="breadcrumb-item active">List</li>
         </ol>
         </div>
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="row">
        <div class="col-md-3">
          <a href="name_jo.php"  id="myButton" class="btn btn-primary btn-block mb-3">Create Job Orders</a>
        </div>
      </div>

      <div class="row">
            <div class="col-md-12">      
            <div class="card card-outline card-info">
            
          
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>">
            	<div class="card-body text-l">
                <table id="users" class="table table-bordered table-striped" style="background-color: #f1f1f1;">
                  <thead>
                   
                      <tr style="font-size: 20px; background-color: hsla(195, 43%, 45%, 0.3)">
                      <th  width="5%" style="text-align:center;">No</th>
                      <th  width="10%" style="text-align:center;">JO #</th>
                     
                       <th  width="30%" style="text-align:center;">Particulars</th>
                    <th  width="20%" style="text-align:center;">Period Covered</th>
                    <th  width="1%" style="text-align:center;"></th>
                      <th  style="text-align:center;">Amount</th>
                      <th style="text-align:center;">Action</th>

                    </tr>

                    </tr>
                  </thead>
                  <tbody>
                  	 <?php if($count>0){
            $n  =   1; while ($get_list = $get_combine_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                       <td><?php echo $n++; ?></td>
                    <td style="text-align:center;"><?php echo $get_list['JobOrderNo'];?></td>
                    
                     <td style="text-align:left;"><?php echo $get_list['LName'].","." ".$get_list['FName']." ". $get_list['MName'][0] .".";?></td>
                   <td style="text-align:center;"><?php echo $get_list['PeriodCovered'];?></td>
                    <td style="text-align:right;"><?php echo "P"?></td>
                     <td style="text-align:right;"><?php echo number_format($get_list['Amount'], 2);?></td>
                    <td align="center">
                          <a class="btn btn-outline-success btn-xs" href="../plugins/TCPDF/User/job_order.php?JobOrderNo=<?php echo
                            $get_list['JobOrderNo']; ?>" data-toggle="tooltip" title="Print"> <img src="../dist/img/print.png" alt="" class="brand-image img-transparent" width="30" height="30" style="opacity: ">
                          </a>  
                    <?php if ( $get_list['status']=="Done" And $get_list['Filenames']=="") {
                     ?>  
                     <a class="btn btn-outline-warning btn-xs" href="attachement.php?objid=<?php echo
                            $get_list['id_no']; ?>" data-toggle="tooltip" title="Attached File"><img src="../dist/img/attache.png" alt="" class="brand-image img-transparent" width="30" height="30" style="opacity: ">
                          </a>    

                    <?php }elseif( $get_list['status']=="Done" And $get_list['Filenames']!="" Or $get_list['status']=="" And $get_list['Filenames']!="") {
                     ?>  
                     <a class="btn btn-outline-primary btn-xs" href="<?php echo $get_list['Filenames']?> "data-toggle="tooltip" title="Approved File"><img src="../dist/img/approve.png" alt="" class="brand-image img-square" width="30" height="30" style="opacity: ">
                          </a>    

                    <?php }elseif($get_list['status']!="Done" AND $get_list['Filenames']=="") {?>
                          <a class="btn btn-outline-info btn-xs" href="create_job_order_edit.php?objid=<?php echo
                            $get_list['objid']; ?>" data-toggle="tooltip" title="Edit"><img src="../dist/img/pen.png" alt="" class="brand-image img-transparent" width="30" height="30" style="opacity: ">
                          </a>     

                          <a class="btn btn-outline-warning btn-xs" href="attachement.php?objid=<?php echo
                            $get_list['id_no']; ?>" data-toggle="tooltip" title="Attached File"><img src="../dist/img/attache.png" alt="" class="brand-image img-square" width="30" height="30" style="opacity: ">
                          </a> 

                        
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
              <h3><b> <i class="fa fa-plus"> Add Schedule </i></b></h3>
               <span class="close">&times;</span>
           
        </div>
    
                 <div class="modal-body">
                 <table id="users" class="table table-bordered table-striped">
                  <thead>
                   
                      <tr bgcolor="">
                      <th width="10%" style="text-align:center;">No</th>
                      <th width="35%" style="text-align:center;">Schedule<i style="font-size:12px;">(Time)</i></th>
                    </tr>

                    </tr>
                  </thead>
                  <tbody>
                     <?php while ($get_list = $get_time_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                    <td style="text-align:center;"><?php echo $get_list['id'];?></td>
                     <td style="text-align:center;"><?php echo $get_list['Time'];?></td>
                  </tr>
                      <div class="form-group">
                   <?php } ?>
                  </tbody>
                </table>
              </div>

               <form class="form-horizontal" method="POST" action="insert">

               
                    <div class="col-md-5">
                  <div class="form-group"> 
                    <label> Additional </label>
                   <input type="text"  id="budgetno" name="budgetno" class="form-control">
                  </div>
                </div>
                            

                  	<div class="modal-footer">
                  	 <button type="submit" class="btn btn-success btn-l float-right" href="list_jo.php" name="insert" value="save" ><i class="fa fa-check"></i> Proceed</button>

                  	 </div>
              </form>
                        
    </div>
  </div>

</div>
</div>







 <?php include 'includes/scripts.php'; ?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />




 
</body>
</html>