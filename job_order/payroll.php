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
      Payroll 
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
          <a href="#myModal"  id="myButton" class="btn btn-primary btn-block mb-3">Create Payroll</a>
        </div>
      </div>

      <div class="row">
            <div class="col-md-12">      
            <div class="card card-outline card-info">
            
          
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>">
            	<div class="card-body text-m">
                <table id="users" class="table table-bordered table-striped" style="background-color: #f1f1f1;">
                  <thead>
                   
                      <tr style="font-size: 16px; background-color: hsla(218, 100%, 86%, 0.3)">
                         <th width="2%" style="text-align:center;">No.</th>
                      <th style="text-align:center;">Date Created</th>
                       <th width="10%" style="text-align:center;">JO #</th>
                       <th width="22%" style="text-align:center;font-size: 16px; background-color: hsla(0, 43%, 80%, 0.8)">Subject</th>
                      <th width="20%" style="text-align:center;font-size: 16px; background-color: hsla(0, 43%, 80%, 0.8)">Period Covered</th>
                      
                    
                      <th width="10%" style="text-align:center;background-color: hsla(0, 43%, 80%, 0.8)">Payroll #</th>
                      <th style="text-align:center; background-color: hsla(0, 43%, 80%, 0.8)">Payroll Amount</th>
                       <th style="text-align:center;">Previous Balance</th>
                       <th  style="text-align:center; background-color: hsla(0, 43%, 80%, 0.8)">Available Balance</th>
                      
                    </tr>

                    </tr>
                  </thead>
                  <tbody>
                  	 <?php if($count>0){
            $n  =   1; while ($get_list = $get_sched_data-> fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <td><?php echo $n++; ?></td>
                    <td style="text-align:center;"><?php echo $get_list['PosingDate'];?></td>
                    <td style="text-align:center;"><u><a href="see_jo.php?objid=<?php echo
                            $get_list['id_no']; ?>"><?php echo $get_list['JobOrderNo'];?></a></u></td>
                    <td style="text-align:left;"><?php echo  $get_list['LName'].","." ".$get_list['FName']." ". $get_list['MName'][0] .".";?></td>
                     <td style="text-align:center;"><?php echo $get_list['PeriodCovered'];?></td>
                      
                  
                     <td style="text-align:center;"><?php echo $get_list['PayrollNo'];?></td>
                    <td style="text-align:right;"><b><?php echo "P"." ".number_format($get_list['PayAmount'],2);?></b></td>
                     <td style="text-align:right;"><?php echo "P"." ".number_format($get_list['PreviousBalance'],2);?></td>

                    <td style="text-align:right;"><b><?php echo "P"." ".number_format($get_list['AvailableBalance'],2);?></b></td>
                   
                   
                   

                          </tr>
                      <div class="form-group">
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
              <h3><b> <i class="fa fa-plus"> Create Payroll </i></b></h3>
               <span class="close2">&times;</span>
           
        </div>
    
                  <form class="form-horizontal" method="POST" action="insert_payroll.php">
<input type="hidden" name="pay_date" id="pay_no" value="<?php echo $now=date('F d,Y')?>" class="form-control">           
              

             
              <div class="modal-body">
                         
                <div class="form-group"> 
                     <div class="row">
                      <div class="col-sm-7">
                    <label> Payroll No. </label>
<input type="text" name="pay_no" id="pay_no" readonly value="<?php echo $payroll;?>" class="form-control">         

     </div>
   

                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="text"  id="pay_amount" style="text-align: right;" class="form-control"></div>
                      </div>

 </div>
 </div>
 <input type="hidden"  id="pay" name="pay_amount"  class="form-control">
 <hr>
<input type="hidden" name="status" id="status" value="<?php echo "Done"?>" class="form-control">  
                  <div class="form-group"> 
                     <div class="row">
                      <div class="col-sm-7">
                    <label> Job Order No. </label>
                      <select class="form-control custom-select" id="jo_no" name="jo_no">
                  <option selected>Please select....</option>
                  <?php while ($get_jo = $get_nopayroll_data->fetch(PDO::FETCH_ASSOC)) { ?>

                    <option value="<?php echo
   $get_jo['JobOrderNo']; ?>"><?php echo $get_jo['JobOrderNo']?></option> <?php } ?>
                </select>
              </div>
    
   
                <div class="col-sm-5">
                      <div class="form-group">
                        <label>Estimated Amount</label>
                        <input type="text"  id="jo_amount" style="text-align:right" class="form-control" readonly></div>
                      </div>
          </div>

           <input type="hidden"  id="jo_amount1" style="text-align:right" name="jo_amount" class="form-control" readonly>
                  
              <div class="form-group"> 
                     <div class="row">
                    <div class="col-sm-6">
                    <label style="font-size:28px"> Covered Period </label>
                  </div>
                </div>
              

               <form class="form-horizontal" method="POST" action="insert">

                 <div class="row">
                    <div class="col-md-12">
                  <div class="form-group"> 
                    <label> Starting / End Date </label>
                   <input type="text" readonly id="period" name="
                   " class="form-control">
                  </div>
                </div>
              </div>

                 <div class="row">
                 <div class="col-md-7">
                  <div class="form-group"> 
                    <label>Charges Code</label>
 <input type="text" readonly id="charges" name="proj_charges" class="form-control">
</div>
</div>

<input type="hidden"  id="id_number" name="id_number" class="form-control">

                <div class="col-md-5">
                  <div class="form-group"> 
                    <label> Available Balance</label>
                   <input style="text-align: right;" type="text" readonly id="amount" value="<?php echo number_format($project_budget-$payrolltotal,2)?>" class="form-control">
                  </div>
                </div>
              </div>
                            
 <input style="text-align: right;" type="hidden" readonly id="amount" value="<?php echo $project_budget-$payrolltotal?>" name="prev_balance" class="form-control">

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



<script>
 // Get the modal
var modal2 = document.getElementById("myModal");

// Get the button that opens the modal
var btn2 = document.getElementById("myButton");

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


    $('#jo_no').on('click', function() {
        var jo_no = this.value;
        $.ajax({
            type:"POST",
            url:'fetch_amount.php',
            data:{jo_amount:jo_no},
         
            success:function(response){
              var result = jQuery.parseJSON(response);
                console.log('response from server',result);
                $('#jo_amount').val(result.data);
               $('#jo_amount1').val(result.code1);
               
          },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });


    }); 

 $('#jo_no').on('click', function() {
        var period = this.value;
        $.ajax({
            type:"POST",
            url:'fetch_period.php',
            data:{jo_period:period},
         
            success:function(response){
              var result = jQuery.parseJSON(response);
                console.log('response from server',result);
                $('#period').val(result.data);
                $('#charges').val(result.charges);
                $('#id_number').val(result.objid);
               
          },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });


    }); 

 $(function () {
    $('#pay_amount').on('change', function () {
      var y = $('#pay_amount').val();
        var x = $('#pay_amount').val();
        $('#pay_amount').val(addCommas(x));
         $('#pay').val(y);
    });
});
 
function addCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

    
</script>
 
 
</body>
</html>