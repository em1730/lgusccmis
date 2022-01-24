 <?php

    include('../config/db_config.php');
    //include('import_pdf.php');
    // session_start();

    session_start();
    date_default_timezone_set('Asia/Manila');


    if (isset($_POST['insert_outgoing'])) {

        //     echo "<pre>";
        //     print_r($_POST);
        // echo "</pre>";
        $docno = $_POST['doc_number'];
        $date = date('Y-m-d', strtotime($_POST['date']));
        $time =  date('H:i:s');
        $type = $_POST['type'];
        $particulars = $_POST['particulars'];
        $department = $_POST['department'];
        $creator = $_POST['department'];
        $destination = $_POST['receiver'];
        // $amount = $_POST['amount'];
        $status = 'CREATED';
        $remarks = $_POST['remarks'];
        $user_name = $_POST['username'];
        $host_name = "";
        // $start_time = $date .' ' . $time;
        // $end_time = $date .' ' . $time;

        $check_now_sql =  "select now() as time";
        $check_now_data = $con->prepare($check_now_sql);
        $check_now_data->execute([]);
        while ($result = $check_now_data->fetch(PDO::FETCH_ASSOC)) {
            $now_time = $result['time'];
        }

        $insert_outgoing_sql = "INSERT INTO tbl_documents SET 
        docno              = :code,
        date               = :datecreated,
        date_time          = :timey,
        type               = :type,
        particulars        = :particular,
        creator            = :creator,
        origin             = :orig,
        destination        = :destination,
        status             = :stat,
        remarks            = :rem";

        $outgoing_data = $con->prepare($insert_outgoing_sql);
        $outgoing_data->execute([
            ':code'             => $docno,
            ':timey'            => $date.' '.$time,
            ':datecreated'      => $date,
            ':type'             => $type,
            ':particular'       => $particulars,
            ':creator'          => $creator,
            ':orig'             => $department,
            ':destination'      => $destination,
            ':stat'             => $status,
            ':rem'              => $remarks
        ]);


        $insert_ledger_sql = "INSERT INTO tbl_ledger SET 
        docno              = :code,
        txndate            = :datecreated,
        time                =:time,
        type               = :type,
        particulars        = :particular,
        origin             = :orig,
        destination        = :destination,
        -- amount             = :amount,
        status             = :stat,
        remarks            = :rem,
        receiver           = :username,
        machineid          = :host,
        start_time         = :start_time,
        end_time           = :end_time";

        $ledger_data = $con->prepare($insert_ledger_sql);
        $ledger_data->execute([
            ':code'             => $docno,
            ':datecreated'      => $date,
            ':time'             => $time,
            ':type'             => $type,
            ':particular'       => $particulars,
            ':orig'             => $department,
            ':destination'       => $destination,
            // ':amount'           => $amount,
            ':stat'             => $status,
            ':rem'              => $remarks,
            ':username'         => $user_name,
            ':host'             => $host_name,
            ':start_time'       => $now_time,
            ':end_time'         => $now_time

        ]);


        if ($ledger_data && $outgoing_data) {

            $_SESSION['status'] = "Registered Succesfully!";
            $_SESSION['status_code'] = "success";

            header('location: list_outgoing.php');
        } else {
            $_SESSION['status'] = "Not successfully registered!!";
            $_SESSION['status_code'] = "error";

            header('location: list_outgoing.php');
        }
        // $btnNew = 'disabled';
        // $btnPrint = 'enabled';
    }






    ?>