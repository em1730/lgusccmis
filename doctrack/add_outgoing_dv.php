<?php


session_start();
include('../config/db_config.php');
//user-account details
include('user_account.php');
//department masterlist
include('../masterlisting/list_department.php');




$docno = $prevyear = $pr_no = $po_no = $date = $etal  = $type = $particulars = $origin = $destination =  $obr_no =
  $account = $dv_no = $cheque_no = $acct_no  = $status = $payee =  $remarks = '';

$amount = '0.00';
$btnNew = 'disabled';
$btnPrint = 'disabled';
$btnStatus = '';
$type1 = $_GET['type'];

$now = new DateTime();


// include('insert_outgoing_dv.php');   
//for tbl_documents and tbl_dv
// include ('insert_ledger_dv.php');     //for ledger







//select all payee
$get_all_payee_sql = "SELECT code, name_supplier from tbl_suppliers 
UNION
select objid, CONCAT(firstname, ' ', middlename, ' ', lastname) from tbl_joborder 
UNION
select employeeno, CONCAT(firstname, ' ', middlename, ' ', lastname) from tbl_employee
ORDER BY name_supplier";
$get_all_payee_data = $con->prepare($get_all_payee_sql);
$get_all_payee_data->execute();



//select all account type
$get_all_account_sql = "SELECT * FROM tbl_accounts";
$get_all_account_data = $con->prepare($get_all_account_sql);
$get_all_account_data->execute();

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DOCTRACK | PR Form</title>

  <?php include('heading.php') ?>

  <style>
    .field_set {
      border-color: green;
      border-style: solid;
      width: 115%;
    }

    .item:hover {
      background-color: lightgreen;

    }


    #padd {
      padding-left: 20px;
    }

    #padd2 {
      padding-left: 10px;
    }

    #fieldset {
      color: #31A231;
      width: 12%;
      padding: 10px 10px;

    }


    #fieldset_verify {
      color: #31A231;
      width: 9%;
      padding: 5px 10px;

    }
  </style>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div class="content-wrapper">
      <div class="content-header"></div>
      <section class="content">

        <div class="card">
          <div class="card-header bg-success">
            <h4>Forward Documents</h4>
          </div>
          <div class="card-body">

            <form role="form" method="post" action="insert_outgoing_dv.php">
              <div class="box-body">
                <div>
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Document No.:</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" readonly class="form-control" id="doc_no" name="doc_no" placeholder="Document Number" value="<?php echo $docno; ?>" required>
                    </div>


                    <div class="col-md-1" style="text-align: right;padding-top: 5px;">
                      <label>Date:</label>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <!-- <label>Date:</label> -->
                        <div class="input-group date" data-provide="datepicker">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" readonly class="form-control pull-right" id="datepicker" name="date" placeholder="Date Created" value="<?php echo $now->format('m/d/Y'); ?>">
                        </div>
                      </div>
                    </div>

                  </div><br>

                  <!-- document type -->
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <!-- <div class="form-group"> -->
                      <label>Document Type:</label>
                    </div>

                    <div class="col-md-4">
                      <select readonly class="form-control select2" id="select_type" style="width: 100%;" name="type" value="<?php echo  $type; ?>">

                        <?php if ($type1 == "DV") { ?>
                          <option value="<?php echo 'DV'; ?>"><?php echo "Disbursement Voucher"; ?></option>
                        <?php } else if ($type1 == "PYL") { ?>
                          <option value="<?php echo 'PYL'; ?>"><?php echo "Payroll"; ?></option>
                        <?php } else if ($type1 == "DWP") { ?>
                          <option value="<?php echo 'DWP'; ?>"><?php echo "Daily Wage Payroll"; ?></option>
                        <?php } else if ($type1 == "OBR") { ?>
                          <option value="<?php echo 'OBR'; ?>"><?php echo "Obligation Request"; ?></option>
                        <?php } else if ($type1 == "LR") { ?>
                          <option value="<?php echo 'LR'; ?>"><?php echo "Liquidation Report"; ?></option>
                        <?php } else if ($type1 == "RIS") { ?>
                          <option value="<?php echo 'RIS'; ?>"><?php echo "Requisition & Issue Slip"; ?></option>
                        <?php } else if ($type1 == "PO") { ?>
                          <option value="<?php echo 'PO'; ?>"><?php echo "Purchase Order"; ?></option>
                        <?php } else if ($type1 == "PR") { ?>
                          <option value="<?php echo 'PR'; ?>"><?php echo "Purchase Request"; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <div class="form-check">
                        &nbsp; &nbsp;<input <?php if ($prevyear == 1) echo 'checked="checked"'; ?> type="checkbox" class="form-check-input" id="exampleCheck1" name="prev_year" value="etal">
                        <label class="form-check-label" for="exampleCheck1">Previous Year?</label>
                      </div>
                    </div>
                  </div><br>
                  <!-- document type -->

                  <!-- For payee -->
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <!-- <div class="form-group"> -->
                      <label>Payee:</label>
                    </div>
                    <div class="col-md-7">
                      <select class="form-control select2" readonly required style="width: 100%;" id="payee" name="payee" value="<?php echo $origin; ?>">
                        <option>Please select...</option>
                        <?php while ($get_payee = $get_all_payee_data->fetch(PDO::FETCH_ASSOC)) { ?>

                          <?php
                          //if $get_author naa value, check nato if equals sa $get_author1['fullname']
                          //if equals, put 'selected' sa option
                          $selected = ($payee == $get_payee['name_supplier']) ? 'selected' : '';

                          ?>

                          <option <?= $selected; ?> value="<?php echo $get_payee['name_supplier']; ?>"><?php echo ucwords(strtolower($get_payee['name_supplier'])); ?></option>
                        <?php } ?>
                      </select>
                      <!-- <p>NOTE: <code>Search first the name of payee. If "No Results Found", Click the ADD Button</code>
                      <code> to register NEW payee and click REFRESH once done. Check the et Al. for multiple payees. </code>
                        </p>               
                      -->
                    </div>

                    <div class="col-md-.1">
                      <div class="input-group input-group-sm">
                        <span class="input-group-append">
                          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"> ADD </button>
                          <ul class="dropdown-menu items">
                            <li class="dropdown-item item"><a href="add_suppliers.php" style="color:black" target="_blank">Supplier</a></li>
                            <li class="dropdown-item item"><a href="add_joborder.php" style="color:black" target="_blank">Job Order</a></li>
                            <li class="dropdown-item item"><a href="add_joborder" style="color:black" target="_blank">Regular Employee</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item" id="refresh">Refresh</li>
                          </ul>
                        </span>
                      </div>
                    </div>
                    <div class="form-check">
                      &nbsp; &nbsp;<input <?php if ($etal == 1) echo 'checked="checked"'; ?> type="checkbox" class="form-check-input" id="exampleCheck1" name="etc" value="etal">
                      <label class="form-check-label" for="exampleCheck1">et Al.</label>
                    </div>
                  </div><br>

                  <!-- For payee -->


                  <!-- For Paticulars -->

                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Particulars:</label>
                    </div>
                    <div class="col-md-8">
                      <textarea rows="3" class="form-control" name="particulars" placeholder="Subject/Particulars" required><?php echo  $particulars; ?></textarea>
                    </div>
                  </div><br>

                  <!-- For Particulars -->

                  <!-- For Amount -->

                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Amount:</label>
                    </div>
                    <div class="col-md-2">
                      <input required type="text" class="form-control" id="amount" name="amount" placeholder="Amount" value="<?php echo number_format($amount, 2); ?>" required>
                    </div>
                    <p>NOTE: <code>Numbers & decimal point only, do not use comma (,)</code></p>
                  </div><br>

                  <!-- For Amount -->

                  <!-- Destination -->
                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <!-- <div class="form-group"> -->
                      <label>Forwarded To:</label>
                    </div>

                    <div class="col-md-8">
                      <select class="form-control select2" readonly style="width: 100%;" name="receiver" value="<?php echo $destination; ?>">
                        <option selected="selected">Please select...</option>
                        <?php foreach ($list_department as $department) { ?>
                          <option value="<?php echo $department['objid']; ?>"><?php echo $department['department']; ?></option>
                        <?php  }   ?>

                      </select>
                    </div>
                  </div><br>
                  <!-- For Destination -->

                  <!-- Remarks -->

                  <div class="row">
                    <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                      <label>Remarks:</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" value="<?php echo  $remarks; ?>" required>
                    </div>

                  </div><br>

                  <div class="box-footer" align="center">
                    <!-- <input type="submit" <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New"> -->
                    <input type="submit" <?php echo $btnStatus; ?> name="insert_outgoing" class="btn btn-success" value="Save">
                    <a href="../plugins/TCPDF/User/routing.php?docno=<?php echo $docno; ?>" target="blank">
                      <input type="button" <?php echo $btnPrint; ?> name="print" class="btn btn-primary" value="Print">
                    </a>
                    <!-- <a href="list_outgoing">
                      <input type="button" name="cancel" class="btn btn-default" value="Cancel">
                    </a> -->
                  </div>


                  <div class="col-md-10">
                    <input type="hidden" id="department" readonly class="form-control" name="department" placeholder="Department" value="<?php echo $department; ?>">
                  </div>

                  <div class="col-md-10">
                    <input type="hidden" readonly class="form-control" name="username" placeholder="username" value="<?php echo $user_name; ?>" >
                  </div>

                </div>
              </div>


            </form>
          </div>

          <!-- /.row -->
        </div><br>

      </section>
    </div>
    <?php include('footer.php') ?>
  </div>




</body>

</html>
<?php include('scripts.php') ?>





<script>
  $('#refresh').on('click', function() {
    location.reload();

  });


  $(function() {

    var doc_no = $('#doc_no').val();
    var type = $('#select_type').val();
    var office = $('#department').val();


    if (doc_no == "") {

      $.ajax({
        type: 'POST',
        data: {
          type: type,
          office: office
        },
        url: 'generate_serial.php',
        success: function(data) {
          // var result = $.parseJSON(data);
          $('#doc_no').val(data);
          // $('#obr_no').val(result.obrno);

        }

      });

    }




  })
</script>