<?php


session_start();




include('../config/db_config.php');





// include('sql_querries.php');


$user_id = $_SESSION['id'];
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



//select all users
$get_all_sql = "SELECT * FROM hms_technician WHERE status = 'Active' ORDER BY idno DESC";
$get_all_data = $con->prepare($get_all_sql);
$get_all_data->execute();






$alert_msg = $btnEdit = $btnSave = $firstname = $middlename = $lastname = ' ';



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HMS | List of Technician</title>
    <?php include('heading.php') ?>

</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <div class="content-header"></div>

            <section class="content">

                <div class="card card-danger">
                    <div class="card-header">
                        <h4>List of Technician

                            <button type="button" style="float:right;" class="btn btn-danger bg-gradient-danger" data-toggle="modal" data-target="#AddModal">
                                <i class="nav-icon fa fa-plus-square"></i>
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="box box-primary">
                            <form role="form" method="POST" action="">
                                <div class="box-body">
                                    <table class="table table-bordered table-striped" id="users">
                                        <thead align="center">
                                            <tr>
                                                <th>ID No.</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Lastname </th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>

                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include('footer.php'); ?>
    </div>






    <!-- add technician info modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-danger">
                    <h5 class="modal-title" id="exampleModalLabel "> Add Technician</h5>

                </div>

                <form method="POST" action="query_technician.php">
                    <div class="modal-body">

                        <?php echo $alert_msg; ?>
                        <div class=" form-group">
                            <label for="recipient-name" class="col-form-label">First Name:</label>
                            <input type="text" class="form-control " style="text-transform: uppercase;" name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Middle Initial:</label>
                            <input type="text" class="form-control " style="text-transform: uppercase;" name="middlename">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Last Name:</label>
                            <input type="text" class="form-control " style="text-transform: uppercase;" name="lastname">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Position:</label>
                            <input type="text" class="form-control " style="text-transform: uppercase;" name="position">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="add_technician" id="btnSave" class="btn btn-success">
                                <i class="fa fa-check fa-fw"> </i> </button>
                            <button type="button" name="cancel" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-close fa-fw"> </i> </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- update technician info modal -->
    <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-danger">
                    <h5 class="modal-title" id="exampleModalLabel "> Update Technician</h5>

                </div>

                <form method="POST" action="query_technician.php">
                    <div class="modal-body">

                        <div class=" form-group">
                            <label for="recipient-name" class="col-form-label">ID Number:</label>
                            <input type="text" readonly class="form-control " style="text-transform: uppercase;" name="idno" id="idno">
                        </div>
                        <div class=" form-group">
                            <label for="recipient-name" class="col-form-label">First Name:</label>
                            <input type="text" class="form-control " style="text-transform: uppercase;" name="firstname" id="firstname">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Middle Initial:</label>
                            <input type="text" class="form-control " style="text-transform: uppercase;" name="middlename" id="middlename">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Last Name:</label>
                            <input type="text" class="form-control " style="text-transform: uppercase;" name="lastname" id="lastname">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Position:</label>
                            <input type="text" class="form-control " style="text-transform: uppercase;" name="position" id="position">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="update_technician" id="btnSave" class="btn btn-success">
                                <i class="fa fa-check fa-fw"> </i> </button>
                            <button type="button" name="cancel" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-close fa-fw"> </i> </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>




    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-danger">
                    <h5 class="modal-title" id="exampleModalLabel "> Delete this technician?</h5>

                </div>

                <form method="POST" action="query_technician.php">
                    <div class="modal-body">

                        <div class=" form-group">
                            <label for="recipient-name" class="col-form-label">ID Number:</label>
                            <input type="text" readonly class="form-control " style="text-transform: uppercase;" name="del_idno" id="del_idno">
                        </div>
                        <div class=" form-group">
                            <label for="recipient-name" class="col-form-label">Full Name:</label>
                            <input type="text"  class="form-control " style="text-transform: uppercase;" name="del_fullname" id="del_fullname">
                        </div>
                     

                        <div class="modal-footer">
                            <button type="submit" name="delete_technician" id="btnSave" class="btn btn-success"> Yes
                                <!-- <i class="fa fa-check fa-fw"> </i>  -->
                            </button>
                            <button type="button" name="cancel" class="btn btn-danger" data-dismiss="modal">No
                                <!-- <i class="fa fa-close fa-fw"> </i>  -->
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
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
        var dataTable = $('#users').DataTable({

            page: true,
            // searching: true,
            stateSave: true,
            processing: true,
            serverSide: true,
            scrollX: false,

            ajax: {
                url: "search_technician.php",
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
                    width: "100px",
                    targets: -1,
                    data: null,
                    defaultContent: '<a class="btn btn-success btn-sm"  id="update_modal" data-placement="top" title="Update Technician"> <i style="color:white; "class="nav-icon fa fa-edit fa-sm"></i></a>'+ '&nbsp;&nbsp;'+
                    '<a class="btn btn-danger btn-sm"  id="delete_modal" data-placement="top" title="Delete Technician"> <i style="color:white; "class="nav-icon fa fa-trash fa-sm"></i></a>',
                },

            ],
        });




        $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
            event.preventDefault();

            var user_id = ($(this).data('id'));

            $('#user_id').val(user_id);
            $('#delete_PUMl').modal('toggle');

        });


        $("#users tbody").on("click", "#update_modal", function() {
            event.preventDefault();
            var currow = $(this).closest("tr");

            var idno = currow.find("td:eq(0)").text();
            var fname = currow.find("td:eq(1)").text();
            var mname = currow.find("td:eq(2)").text();
            var lname = currow.find("td:eq(3)").text();
            var pos = currow.find("td:eq(4)").text();


            $('#UpdateModal').modal('show');
            $('#idno').val(idno);
            $('#firstname').val(fname);
            $('#middlename').val(mname);
            $('#lastname').val(lname);
            $('#position').val(pos);

        });

        $("#users tbody").on("click", "#delete_modal", function() {
            event.preventDefault();
            var currow = $(this).closest("tr");

            var idno = currow.find("td:eq(0)").text();
            var fname = currow.find("td:eq(1)").text();
            var mname = currow.find("td:eq(2)").text();
            var lname = currow.find("td:eq(3)").text();
            // var pos = currow.find("td:eq(4)").text();
            
            // var fname = currow.find("td:eq(1)").text();

            $('#DeleteModal').modal('show');
            $('#del_idno').val(idno);
            $('#del_fullname').val(fname + " " + mname + ". "+ lname);


        });
    </script>
</body>

</html>