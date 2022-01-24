 <?php

    include('../config/db_config.php');
    //include('import_pdf.php');

    session_start();
    
    $alert_msg = '';
    $alert_msg1 = '';
    if (isset($_POST['insert_document'])) {

        //     echo "<pre>";
        //     print_r($_POST);
        // echo "</pre>";
        $objid = $_POST['doc_code'];
        $type = $_POST['type'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        $insert_doctype_sql = "INSERT INTO document_type SET 
        objid               = :code,
        type                = :type,
        description         = :desc,
        status              = :status";

        $doctype_data = $con->prepare($insert_doctype_sql);
        $doctype_data->execute([
            ':code'             => $objid,
            ':type'             => $type,
            ':desc'             => $description,
            ':status'           => 'Active'

        ]);


        if ($doctype_data) {

            $_SESSION['status'] = "Registered Succesfully!";
            $_SESSION['status_code'] = "success";

            header('location: list_document_type.php');
        } else {
            $_SESSION['status'] = "Not successfully registered!!";
            $_SESSION['status_code'] = "error";

            header('location: list_document_type.php');
        }
    }


    ?>