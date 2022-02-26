<?php

session_start();
// include('includes/head.php');


if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}

$user_id = $_SESSION['id'];

$alert_msg = '';
$docno = $date = $type = $particulars = $origin = $destination = $amount = $status = $date_received = $remarks = $user_name = $doc22no = '';
$btnNew = 'disabled';
$btnPrint = 'disabled';
$btnStatus = '';

$now = new DateTime();


include('../config/db_config.php');


//select user
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
  $db_email_ad = $result['email'];
  $db_contact_number = $result['contact_no'];
  $user_name = $result['username'];
  $department = $result['department'];
}

$user_id = $_GET['docno'];
$get_data_sql = "SELECT * FROM tbl_documents where docno  ='$user_id'";
$get_data_data = $con->prepare($get_data_sql);
$get_data_data->execute([':docno' => $user_id]);

while ($result = $get_data_data->fetch(PDO::FETCH_ASSOC)) {
  $doc22no = $result['docno'];
  $date = $result['date'];
  $type = $result['type'];
  $particulars = $result['particulars'];
  $origin = $result['origin'];
  //$amount= $result['amount'];
  $status = $result['status'];
  $remarks = $result['remarks'];
}

//select all incoming documents
$get_all_doctype_sql = "SELECT * FROM document_type";
$get_all_doctype_data = $con->prepare($get_all_doctype_sql);
$get_all_doctype_data->execute();


//select all departments
$get_all_dept_sql = "SELECT * FROM tbl_department";
$get_all_dept_data = $con->prepare($get_all_dept_sql);
$get_all_dept_data->execute();

?>
<!DOCTYPE html>
<html>



<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> DOCTRACK | Receive Document</title>
  <?php include('heading.php'); ?>
</head>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div class="content-wrapper">
      
      <div class="content-header"></div>

      <section class="content">

        <div class="card">
          <div class="card-header bg-success">
            <h4>Receive Document</h4>
          </div>

          <div class="card-body">
            <form role="form" method="post" action="insert_received.php">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Document No:</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" readonly class="form-control" name="doc_no" value="<?php echo $doc22no; ?>">
                  </div>
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Date:</label>
                  </div>                
                  <div class="col-md-3">
                    <div class="form-group">
                      <!-- <label>Date:</label> -->
                      <div class="input-group date" data-provide="datepicker">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" readonly class="form-control pull-right" id="datepicker" name="date" placeholder="Date Created" value="<?php echo $date; ?>">
                      </div>
                    </div>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Document Type:</label>
                  </div>

                  <div class="col-md-8">
                    <select class="form-control select2" readonly style="width: 100%;" name="type" value="<?php echo $type; ?>">
                      <option>Please select...</option>
                      <?php while ($get_doctype = $get_all_doctype_data->fetch(PDO::FETCH_ASSOC)) { ?>

                        <?php
                        //if $get_author naa value, check nato if equals sa $get_author1['fullname']
                        //if equals, put 'selected' sa option
                        $selected = ($type == $get_doctype['objid']) ? 'selected' : '';
                        ?>

                        <option <?= $selected; ?> value="<?php echo $get_doctype['objid']; ?>"><?php echo $get_doctype['description']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Subject/Particulars:</label>
                  </div>
                  <div class="col-md-8">
                    <textarea rows="5" class="form-control" name="particulars" placeholder="Subject/Particulars" required><?php echo $particulars; ?></textarea>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <!-- <div class="form-group"> -->
                    <label>Originating Office:</label>
                  </div>

                  <div class="col-md-8">
                    <select class="form-control select2" readonly style="width: 100%;" name="origin" value="<?php echo $origin; ?>">
                      <option>Please select...</option>
                      <?php while ($get_dept = $get_all_dept_data->fetch(PDO::FETCH_ASSOC)) { ?>

                        <?php
                        //if $get_author naa value, check nato if equals sa $get_author1['fullname']
                        //if equals, put 'selected' sa option
                        $selected = ($origin == $get_dept['objid']) ? 'selected' : '';

                        ?>

                        <option <?= $selected; ?> value="<?php echo $get_dept['objid']; ?>"><?php echo $get_dept['department']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Date Received:</label>
                  </div>
                  <div class="col-md-8">
                    <!-- Date -->
                    <div class="form-group">
                      <!-- <label>Date:</label> -->
                      <div class="input-group date" data-provide="datepicker">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="date" placeholder="Date Created" value="<?php echo $now->format('m/d/Y');; ?>">
                      </div>
                    </div>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Remarks:</label>
                  </div>
                  <div class="col-md-8">

                    <input type="text" required class="form-control" name="remarks" placeholder="Remarks" value="<?php echo $remarks; ?>">
                    <input type="hidden" readonly class="form-control" name="department" placeholder="Department" value="<?php echo $department; ?>" required>
                    <input type="hidden" readonly class="form-control" name="username" placeholder="username" value="<?php echo $user_name; ?>" required>
                  </div>

                </div><br>

                <!-- /.box-body -->
                <div class="box-footer" align="center">
                  <a href="list_incoming.php">
                    <input type="submit" <?php echo $btnStatus; ?> name="insert_received" class="btn btn-primary" value="Receive">
                  </a>

                </div>
              </div>
            </form>


          </div>

        </div>




      </section><br>
    </div>




    <?php include('footer.php') ?>


  </div>

  <?php include('scripts.php') ?>
  
  <?php

  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

  ?>
    <script>
      swal({
        title: "<?php echo $_SESSION['status'] ?>",
        // text: "You clicked the button!",
        icon: "<?php echo $_SESSION['status_code'] ?>",
        button: "OK. Done!",
      });
    </script>

  <?php
    unset($_SESSION['status']);
  }
  ?>


  <script>
    $('#select_type').on('change', function() {
      var type = $(this).val();
      //  $('#doc_no').val(type);


      $.ajax({
        type: 'POST',
        data: {
          type: type
        },
        url: 'generate_serial.php',
        success: function(data) {
          $('#doc_no').val(data);


        }

      });

    });

  
  </script>

</body>

</html>