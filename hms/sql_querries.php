<?php

include('../config/db_config.php');






if (isset($_POST['add_technician'])) {
    $alert_msg = ' ';
    $tech_myID = uniqid('unit', true);
    $tech_firstname = $_POST['firstname'];
    $tech_middlename = $_POST['middlename'];
    $tech_lastname = $_POST['lastname'];
    $status = 'Active';

    $insert_tech_sql = "INSERT INTO hms_technician SET 
        objid               = :id,
        firstname           = :fname,
        middlename          = :mname,
        lastname            = :lname,
        status              = :status";

    $insert_tech_data = $con->prepare($insert_tech_sql);
    $insert_tech_data->execute([

        ':fname'              => $tech_firstname,
        ':mname'              => $tech_middlename,
        ':lname'              => $tech_lastname,
        ':status'             => $status,
        ':id'                 => $tech_myID

    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Inserted ! </strong> 
        </div>    

      ';
}

if (isset($_POST['update_technician'])) {
    $alert_msg = ' ';
    $get_firstname = $_POST['firstName'];
    $get_middlename = $_POST['middleName'];
    $get_lastname = $_POST['lastName'];
    $get_tech_idno = $_POST['idno'];


    $update_tech_sql = "UPDATE hms_technician SET
        firstname           = :fname,
        middlename          = :mname,
        lastname            = :lname
        where idno          = :id";

    $update_tech_data = $con->prepare($update_tech_sql);
    $update_tech_data->execute([
        ':id'                => $get_tech_idno,
        ':mname'             => $get_middlename,
        ':fname'             => $get_firstname,
        ':lname'             => $get_lastname
    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Updated ! </strong> 
        </div>    
      ';
} else if (isset($_POST['delete_technician'])) {

    $delete_tech_id = $_POST['user_id'];
    $delete_tech_sql = "UPDATE hms_technician SET status ='Inactive' WHERE idno = :id ";
    $delete_tech_data = $con->prepare($delete_tech_sql);
    $delete_tech_data->execute([':id' => $delete_tech_id]);

    header('location: list_technician');
}


// ADD, UPDATE AND DELETE ITEM HOLDER QUERRIES
if (isset($_POST['add_holder'])) {
    $alert_msg = ' ';
    $holder_myID       = uniqid('holder', true);
    $department = $_POST['department'];
    $itemuser   = $_POST['itemUser'];
    $compName   = $_POST['compName'];
    $ipAdd      = $_POST['ipAdd'];
    $videoCard  = $_POST['videoCard'];
    $processor  = $_POST['processor'];
    $hardDisk   = $_POST['hardDisk'];
    $memory     = $_POST['memory'];
    $dvddrive   = $_POST['dvdDrive'];
    $monitor    = $_POST['monitor'];
    $ups        = $_POST['ups'];
    $avr        = $_POST['avr'];
    $printer    = $_POST['printer'];
    $switch     = $_POST['switch'];
    $others     = $_POST['others'];
    $status     = 'Active';

    $insert_holder_sql = "INSERT INTO hms_holder SET 
        objid              = :id,
        department         = :dept,
        user               = :userss,
        computername       = :comp,
        ipaddress          = :ip,
        videocard          = :vcard,
        processor          = :process,
        harddisk           = :hards,
        memory             = :memo,
        dvddrive           = :dvd,
        monitor            = :mons,
        ups                = :upss,
        avr                = :avrs,
        printer            = :printerss,
        switch             = :switch,
        others             = :others,
        status             = :status";

    $insert_holder_data = $con->prepare($insert_holder_sql);
    $insert_holder_data->execute([

        ':dept'             => $department,
        ':userss'           => $itemuser,
        ':comp'             => $compName,
        ':ip'               => $ipAdd,
        ':vcard'            => $videoCard,
        ':process'          => $processor,
        ':hards'            => $hardDisk,
        ':memo'             => $memory,
        ':dvd'              => $dvddrive,
        ':mons'             => $monitor,
        ':upss'             => $ups,
        ':avrs'             => $avr,
        ':printerss'        => $printer,
        ':switch'           => $switch,
        ':others'           => $others,
        ':status'           => $status,
        ':id'               => $holder_myID

    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Inserted ! </strong> 
        </div>    

      ';
}

if (isset($_POST['update_holder'])) {
    $alert_msg = ' ';
    $get_department = $_POST['get_department'];
    $get_itemuser   = $_POST['get_itemUser'];
    $get_computer   = $_POST['get_compName'];
    $get_ipaddress  = $_POST['get_ipAdd'];
    $get_videocard  = $_POST['get_videoCard'];
    $get_processor  = $_POST['get_processor'];
    $get_harddisk   = $_POST['get_hardDisk'];
    $get_memory     = $_POST['get_memory'];
    $get_dvd        = $_POST['get_dvdDrive'];
    $get_monitor    = $_POST['get_monitor'];
    $get_ups        = $_POST['get_ups'];
    $get_avr        = $_POST['get_avr'];
    $get_printer    = $_POST['get_printer'];
    $get_switch     = $_POST['get_switch'];
    $get_others     = $_POST['get_others'];
    $get_holder_idno       = $_POST['idno'];


    $update_holder_sql = "UPDATE hms_holder SET
        department         = :dept,
        user               = :userss,
        computername       = :comp,
        ipaddress          = :ip,
        videocard          = :vcard,
        processor          = :process,
        harddisk           = :hards,
        memory             = :memo,
        dvddrive           = :dvd,
        monitor            = :mons,
        ups                = :upss,
        avr                = :avrs,
        printer            = :printerss,
        switch             = :switch,
        others             = :others
        where idno          = :id";

    $update_holder_data = $con->prepare($update_holder_sql);
    $update_holder_data->execute([

        ':dept'             => $get_department,
        ':userss'           => $get_itemuser,
        ':comp'             => $get_computer,
        ':ip'               => $get_ipaddress,
        ':vcard'            => $get_videocard,
        ':process'          => $get_processor,
        ':hards'            => $get_harddisk,
        ':memo'             => $get_memory,
        ':dvd'              => $get_dvd,
        ':mons'             => $get_monitor,
        ':upss'             => $get_ups,
        ':avrs'             => $get_avr,
        ':printerss'        => $get_printer,
        ':switch'           => $get_switch,
        ':others'           => $get_others,
        ':id'               => $get_holder_idno

    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Updated ! </strong> 
        </div>    
      ';
} else if (isset($_POST['delete_holder'])) {

    $delete_holder_id = $_POST['user_id'];
    $delete_holder_sql = "UPDATE hms_holder SET status ='Inactive' WHERE idno = :id ";
    $delete_holder_data = $con->prepare($delete_holder_sql);
    $delete_holder_data->execute([':id' => $delete_holder_id]);

    header('location: list_holder');
}
// END OF ITEM HOLDER QUERRIES




// ADD, UPDATE AND DELETE REPAIR ITEM
else if (isset($_POST['add_repair'])) {
    $alert_msg = ' ';
    $myID = uniqid('repair', true);

    $now            = $_POST['repairDate'];
    $time           = $_POST['repairTime'];
    $items          = $_POST['itemrecieved'];
    $othersItem     = $_POST['others'];
    $department     = $_POST['department'];
    $received       = $_POST['receivedFrom'];
    $technician     = $_POST['technician'];
    $diagnostics    = $_POST['diagnostics'];
    $status         = 'Active';
    $remarks        = 'Pending';


    $insert_repair_sql = "INSERT INTO hms_repair SET 
        objid_no               = :id,
        receiveddate        = :datess,
        receivedtime        = :timess,
        item_name            = :itemss,
        other_item          = :othersitems,
        departments          = :depart,
        receivedfrom        = :received,
        technician          = :tech,
        diagnostics         = :diag,
        remarks             = :remarkss,
        status              = :status";


    $insert_repair_data = $con->prepare($insert_repair_sql);
    $insert_repair_data->execute([
        ':id'               => $myID,
        ':datess'           => $now,
        ':timess'           => $time,
        ':itemss'           => $items,
        ':othersitems'      => $othersItem,
        ':depart'           => $department,
        ':received'         => $received,
        ':tech'             => $technician,
        ':diag'             => $diagnostics,
        ':remarkss'         => $remarks,
        ':status'           => $status

    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Inserted ! </strong> 
        </div>    
      ';
} else if (isset($_POST['update_repair'])) {
    $alert_msg = ' ';
    $get_date           = $_POST['get_receivedDate'];
    $get_time           = $_POST['get_receivedTime'];
    $get_items          = $_POST['get_itemsss'];
    $get_otheritem      = $_POST['get_otherItem'];
    $get_deptss         = $_POST['get_department'];
    $get_received       = $_POST['get_receivedFrom'];
    $get_technician     = $_POST['get_technicianss'];
    $get_diagss         = $_POST['get_diagnostics'];
    $get_actionTaken    = $_POST['get_action'];
    $get_recommend      = $_POST['get_recommendation'];
    $releaseddate       = $_POST['releasedDate'];
    $releasedtime       = $_POST['releasedTime'];
    $remarks            = 'Released';
    $get_repaair_idno           = $_POST['idno'];


    $update_repair_sql = "UPDATE hms_repair SET
        receiveddate        = :datess,
        receivedtime        = :timess,
        item_name            = :itemss,
        other_item          = :othersitems,
        departments         = :depart,
        receivedfrom        = :received,
        technician          = :tech,
        diagnostics         = :diag,
        releaseddate        = :rdate,
        releasedtime        = :rtime,
        action_taken        = :actions,
        recommendation      = :recommend,
        remarks             = :remarkss
        where idno          = :id";

    $update_repair_data = $con->prepare($update_repair_sql);
    $update_repair_data->execute([

        ':id'               => $get_repaair_idno,
        ':timess'           => $get_time,
        ':datess'           => $get_date,
        ':itemss'           => $get_items,
        ':othersitems'      => $get_otheritem,
        ':depart'           => $get_deptss,
        ':received'         => $get_received,
        ':tech'             => $get_technician,
        ':diag'             => $get_diagss,
        ':rdate'            => $releaseddate,
        ':rtime'            => $releasedtime,
        ':actions'          => $get_actionTaken,
        ':recommend'        => $get_recommend,
        ':remarkss'         => $remarks
    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Updated ! </strong> 
        </div>    
      ';
}

// ADD, UPDATE AND DELETE CHECKED BY
else if (isset($_POST['add_checkedby'])) {
    $alert_msg = ' ';
    $myID = uniqid('checked', true);
    $add_check_firstname    = $_POST['firstName'];
    $add_check_middlename   = $_POST['middleName'];
    $add_check_lastname     = $_POST['lastName'];
    $add_check_position     = $_POST['positions'];
    $status                 = 'Active';
    $checked_remarks                = 'FOR HMS';


    $insert_checked_sql = "INSERT INTO hms_checkedby SET 
        objid               = :id,
        firstname           = :fname,
        middlename          = :middle,
        lastname            = :last,
        remarks             = :rems,
        position            = :pos,
        status              = :status";


    $insert_checked_data = $con->prepare($insert_checked_sql);
    $insert_checked_data->execute([
        ':id'               => $myID,
        ':fname'            => $add_check_firstname,
        ':middle'           => $add_check_middlename,
        ':last'             => $add_check_lastname,
        ':rems'             => $checked_remarks,
        ':pos'              => $add_check_position,
        ':status'           => $status

    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Inserted ! </strong> 
        </div>    
      ';
} else if (isset($_POST['update_checkedby'])) {
    $alert_msg = ' ';
    $get_checked_firstname              = $_POST['get_firstName'];
    $get_checked_middlename             = $_POST['get_middleName'];
    $get_checked_lastname               = $_POST['get_lastName'];
    $get_checked_position               = $_POST['get_position'];
    $get_chee_idno              = $_POST['get_idno'];


    $update_checked_sql = "UPDATE hms_checkedby SET
        firstname           = :fnameee,
        middlename          = :mnameee,
        lastname            = :lnameee,
        position            = :postiiiii
        where idno          = :id";

    $update_checked_data = $con->prepare($update_checked_sql);
    $update_checked_data->execute([

        ':fnameee'               => $get_checked_firstname,
        ':mnameee'               => $get_checked_middlename,
        ':lnameee'               => $get_checked_lastname,
        ':postiiiii'             => $get_checked_position,
        ':id'                    => $get_chee_idno
    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Updated ! </strong> 
        </div>    
      ';
}

//ADD UPDATE AND DELETE VERIFIED BY
else if (isset($_POST['add_verifiedby'])) {
    $alert_msg = ' ';
    $myID = uniqid('checked', true);
    $add_verified_firstname    = $_POST['firstName'];
    $add_verified_middlename   = $_POST['middleName'];
    $add_verified_lastname     = $_POST['lastName'];
    $add_verified_position     = $_POST['positions'];
    $status                    = 'Active';
    $verified_remarks           = 'FOR HMS';


    $insert_verified_sql = "INSERT INTO hms_verifiedby SET 
        objid               = :id,
        firstname           = :fname,s
        middlename          = :middle,
        lastname            = :last,
        remarks             = :rems,
        position            = :pos,
        status              = :status";


    $insert_verified_data = $con->prepare($insert_verified_sql);
    $insert_verified_data->execute([
        ':id'               => $myID,
        ':fname'            => $add_verified_firstname,
        ':middle'           => $add_verified_middlename,
        ':last'             => $add_verified_lastname,
        ':rems'             => $verified_remarks,
        ':pos'              => $add_verified_position,
        ':status'           => $status

    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Inserted ! </strong> 
        </div>    
      ';
} else if (isset($_POST['update_verifiedby'])) {
    $alert_msg = ' ';
    $get_verified_firstname              = $_POST['get_firstName'];
    $get_verified_middlename             = $_POST['get_middleName'];
    $get_verified_lastname               = $_POST['get_lastName'];
    $get_verified_position               = $_POST['get_position'];
    $get_verified_idno              = $_POST['get_idno'];


    $update_checked_sql = "UPDATE hms_verifiedby SET
        firstname           = :fnameee,
        middlename          = :mnameee,
        lastname            = :lnameee,
        position            = :postiiiii
        where idno          = :id";

    $update_checked_data = $con->prepare($update_checked_sql);
    $update_checked_data->execute([

        ':fnameee'               => $get_verified_firstname,
        ':mnameee'               => $get_verified_middlename,
        ':lnameee'               => $get_verified_lastname,
        ':postiiiii'             => $get_verified_position,
        ':id'                    => $get_verified_idno
    ]);

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Data Updated ! </strong> 
        </div>    
      ';
}
