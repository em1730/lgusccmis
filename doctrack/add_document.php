<?php


session_start();

$objid = $type = $description = $status  = $doc_code = '';
$btnNew = 'disabled';
$btnStatus = '';

if (!isset($_SESSION['id'])) {
  header('location:../index');
}
$user_id = $_SESSION['id'];

include('../config/db_config.php');
// include('insert_document.php');

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
  $db_user_name = $result['username'];
}


?>
<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DOCTRACK | Add Document</title>
  <?php include('heading.php') ?>

  <style>
    #required {
      color: red;
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
            <h4>Add Document</h4>
          </div>
          <div class="card-body">

            <form role="form" method="post" action="insert_document.php">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Code: <span id="required">*</span></label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="doc_code" id="doc_code" onblur="checkCode()" placeholder="Document Code" value="<?php echo $doc_code; ?>">
                    <!-- <span style="font-style: italic; font-size:13px ; color:red">( Streeet / Lot #, City, Province, Country )</span> -->
                    <div id="status"></div>
                  </div>
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Type: <span id="required">*</span></label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="type" id="type" placeholder="Document Type" value="<?php echo $type; ?>">
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-md-2" style="text-align: right;padding-top: 5px;">
                    <label>Description: <span id="required">*</span></label>
                  </div>
                  <div class="col-md-8">
                    <textarea rows="5" class="form-control" name="description" id="description" placeholder="Description"><?php echo $description; ?></textarea>
                  </div>
                </div><br>



                <div class="box-footer" align="center">
                  <!-- <input type="submit" <?php echo $btnNew; ?> name="add" class="btn btn-primary" value="New"> -->
                  <!-- <input type="submit" <?php echo $btnStatus; ?> name="insert_document" class="btn btn-primary" value="Save"> -->
                  <button type="submit" id="btnSubmit" <?php echo $btnStatus; ?> name="insert_document" class="btn btn-success">
                    <h5>Submit Form</h5>
                  </button>

                  <!-- <a href="committee">
                  <input type="button" name="cancel" class="btn btn-default" value="Cancel">
                </a> -->
                </div>


              </div>

              <!-- footer -->


            </form>
          </div>
        </div><br>





      </section>


    </div>



    <?php include('footer.php') ?>
  </div>


  <?php include('scripts.php') ?>





  <script type="text/javascript">
    function checkCode() {
      var doc_code = $('#doc_code').val();
      if (doc_code.length >= 2) {
        $("#status").html('<img src="loader.gif" /> Checking availability...');
        $.ajax({
          type: 'POST',
          data: {
            doc_code: doc_code
          },
          url: 'check_code.php',
          success: function(data) {
            $("#status").html(data);

          }
        });
      }
    }
    $("#btnSubmit").click(function() {

      var code = $('#doc_code').val();
      var count_code = code.length;


      var type = $('#type').val();
      var count_type = type.length;

      var desc = $('#description').val();
      var count_desc = desc.length;

      if (count_code == 0) {
        alert("Please input Document Code!");
        $('#doc_code').focus();
        return false;
      } else if (count_type == 0) {
        alert("Please input Document Type!");
        $('#type').focus();
        return false;
      } else if (count_desc == 0) {
        alert("Please input Document Description!");
        $('#description').focus();
        return false;
      }



    });
  </script>


</body>

</html>