<?php

session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}


$user_id = $_SESSION['id'];
$docno = '';

include('../config/db_config.php');
// include('delete.php');

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {

    $user_name = $result['username'];
    $GLOBALS['department'] = $result['department'];
    $db_first_name = $result['first_name'];
    $db_middle_name = $result['middle_name'];
    $db_last_name = $result['last_name'];
    $db_email_ad = $result['email'];
    $db_contact_number = $result['contact_no'];
    $db_user_name = $result['username'];
}


//select all outgoing documents
$get_all_document_sql = "SELECT * FROM tbl_documents where origin = '$department'";
$get_all_document_data = $con->prepare($get_all_document_sql);
$get_all_document_data->execute();



//count incoming documents
$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status in ('CREATED','FORWARDED') and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
    $incoming_count =  $result1['total'];
}


//count incoming documents
$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status = 'RECEIVED' and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
    $received_count =  $result1['total'];
}

$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status in ('CREATED','FORWARDED') and origin = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
    $outgoing_count =  $result1['total'];
}

$get_noofdocs_sql = "SELECT COUNT(`docno`) as total FROM `tbl_documents` WHERE status = 'ARCHIVED' and destination = '$department'";
$get_noofdocs_data = $con->prepare($get_noofdocs_sql);
$get_noofdocs_data->execute();
$get_noofdocs_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_noofdocs_data->fetch(PDO::FETCH_ASSOC)) {
    $archived_count =  $result1['total'];
}



// count new messages
$get_all_message_sql = "SELECT count(*) as total FROM tbl_message where receiver = $user_id and status = 'PENDING'";
$get_all_message_data = $con->prepare($get_all_message_sql);
$get_all_message_data->execute();
while ($result1 = $get_all_message_data->fetch(PDO::FETCH_ASSOC)) {
    $message_count =  $result1['total'];
}

// //select all messages for notification
$get_all_messages_sql = "SELECT * FROM tbl_message where (receiver = $user_id or receiver = '0') and status = 'PENDING' ";
$get_all_messages_data = $con->prepare($get_all_messages_sql);
$get_all_messages_data->execute();

// //select all messages for email
$get_all_messages1_sql = "SELECT * FROM tbl_message where receiver = $user_id or receiver ='0'";
$get_all_messages1_data = $con->prepare($get_all_messages1_sql);
$get_all_messages1_data->execute();


?>


<!DOCTYPE html>
<html>

</html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VAMOS | Master Lists Individual </title>
    <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('sidebar.php'); ?>


        <div class="content-wrapper">
            <div class="content-header">
                <?php include('dashboard.php'); ?>
            </div>




            <section class="content">
                <div class="card">
                    <div class="card-header bg-success">
                        <h4>Outgoing Documents
                            <a href="add_outgoing.php" id="add_individual" style="float:right;" type="button" class="btn btn-success bg-gradient-success" style="border-radius: 0px;">
                                <i class="nav-icon fa fa-plus-square fa-lg"></i></a>
                        </h4>

                    </div>

                    <div class="card-body">
                        <div class="box box-primary">
                            <form role="form" method="get" action="">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="users" name="user" class="table table-bordered table-striped">
                                            <thead align="center">


                                                <th>Document No.</th>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>OBR No.</th>
                                                <th>DV No.</th>
                                                <th>Payee</th>
                                                <th>Particulars</th>
                                                <th>Amount</th>
                                                <th>Destination</th>
                                                <th>Options</th>
                                            </thead>
                                            <tbody>

                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                            </form>



                        </div>

                    </div>
                </div>


            </section><br><br>
        </div>










        <div class="col-md-10">
            <input type="hidden" id="department2" readonly class="form-control" name="department2" placeholder="Department2" value="<?php echo $department; ?>">
        </div>


        <?php include('footer.php'); ?>
    </div>
</body>



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
    $(document).ready(function() {
        var office = $('#department2').val();

        var dataTable = $('#users').DataTable({

            page: true,
            stateSave: true,
            processing: true,
            serverSide: true,
            scrollX: false,
            ajax: {
                url: "track_outgoing.php",
                data: {
                    office: office
                },
                type: "post",
                error: function(xhr, b, c) {
                    console.log(
                        "xhr=" +
                        xhr.responseText +
                        " b=" +
                        b.responseText +
                        " c=" +
                        c.responseText
                    );
                }
            },
            columnDefs: [{
                    width: "250px",
                    targets: -1,
                    data: null,
                    defaultContent: '<button class="btn btn-outline-success btn-sm editDocument" style = "margin-right:10px;"  id = "editDocument" data-placement="top" title="Edit Document"> <i class="fa fa-edit"></i></button>' +
                        '<a class="btn btn-outline-success btn-sm printlink"  style = "margin-right:10px;" id="printlink" href ="../plugins/jasperreport/routing.php?docno=" data-placement="top" target="_blank" title="Print ID">  <i class="nav-icon fa fa-print"></i></a> ',
                },

            ],
        });

        $("#users tbody").on("click", ".printlink", function() {
            // event.preventDefault();
            var currow = $(this).closest("tr");
            var docno = currow.find("td:eq(0)").text();
            $('.printlink').attr("href", "../plugins/jasperreport/routing.php?docno=" + docno, '_parent');
            // window.open("../plugins/jasperreport/entity_id.php?entity_no=" + entity, '_parent');

        });

        $("#users tbody").on("click", "#editDocument", function() {
            event.preventDefault();
            var currow = $(this).closest("tr");
            var docno = currow.find("td:eq(0)").text();
            // $('#viewIndividual').attr("href", "view_individual.php?&id=" + entity, '_parent');
            window.open("revert_document.php?&docno=" + docno, '_parent');

        });


        $('#users tbody').on('click', 'button.revert', function() {
            // alert ('hello');
            // var row = $(this).closest('tr');
            var table = $('#users').DataTable();
            var data = table.row($(this).parents('tr')).data();
            //  alert (data[0]);
            //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
            var docno = data[0];
            window.open("revert_document.php?docno=" + docno, '_parent');
            // alert(docno);

        });
    });


    $('#scan_receive').on('change', function() {

        // function receive(){
        var docno = document.getElementById("scan_receive").value;

        // alert (docno);

        $.ajax({
            type: 'POST',
            data: {
                docno: docno
            },
            url: 'scan_receive.php',
            success: function(data) {
                var result = $.parseJSON(data);
                // alert(result.type)
                document.getElementById('lblDate').innerHTML = result.date;
                document.getElementById('lblType').innerHTML = result.type;
                document.getElementById('lblParticulars').innerHTML = result.particulars;
                document.getElementById('lblOrigin').innerHTML = result.origin;
                document.getElementById('lblRemarks').innerHTML = result.remarks;
                document.getElementById('lblMessage').innerHTML = result.message;

            }

        });

        document.getElementById('scan_receive').focus();
        document.getElementById('scan_receive').select();

        //


    });
</script>

<script>
    $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
        event.preventDefault();

        var user_id = ($(this).data('id'));

        $('#user_id').val(user_id);
        $('#deleteuser_Modal').modal('toggle');

    })
</script>