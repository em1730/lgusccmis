<?php include 'config.php'; ?>
<?php include 'paginator.class.php'; ?>


<!DOCTYPE html>
<html>
<head>
     <title>LGUSCC-ITCSO | Dashboard</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
 
 <div class="container">
     <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m=o text-dark">
        List of Job Orders
        <!-- <small>Version 2.0</small> -->
      </h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right text-xs">
      <li class="breadcrumb-item"><a href="../index">Home</a></li>
      <li class="breadcrumb-item active">List</li>
         </ol>
         </div>
       
    </section>

   <hr>
<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-inline">
    <select name="tb1" onchange="submit()" class="form-control custom-select">
        <option>Department</option>
        <?php
            $Continentqry   =   $db->query('SELECT DISTINCT department FROM department ORDER BY department ASC');
            while($crow = $Continentqry->fetch_assoc()) {
                echo "<option";
                if(isset($_REQUEST['tb1']) and $_REQUEST['tb1']==$crow['department']) echo ' selected="selected"';
                echo ">{$crow['department']}</option>\n";
            }
        ?>
    </select>
</form>
<hr>

<?php
if(isset($_REQUEST['tb1'])) {
    $condition      =   "";
    if(isset($_GET['tb1']) and $_GET['tb1']!="")
    {
        $condition      .=  " AND EmpDept='".$_GET['tb1']."'";
    }
     
    $qryStr     =   "SELECT * FROM employeedetail WHERE 1 ".$condition." ORDER BY EmpLname ASC"; 
    $country    =   $db->query($qryStr);
    $count      =   $country->num_rows;
     
    $pages = new Paginator($count,9);
    echo '<div class="col-sm-6">';
    echo '<nav aria-label="Page navigation"><ul class="pagination">';
    echo $pages->display_pages();
    echo '</ul></nav>';
    echo '</div>';
    echo '<div class="col-sm-6 text-right">';
    echo "<span class=\"form-inline\">".$pages->display_jump_menu().$pages->display_items_per_page()."</span>";
    echo '</div>';
    echo '<div class="clearfix"></div>';
    $limit  = $pages->limit_start.','.$pages->limit_end;
    $qry    =   $db->query($qryStr.' LIMIT '.$limit);
}
?>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="bg-primary">
            <th>No.</th>
            <th>Name</th>
            <th>ID No.</th>
            <th>Gender</th>
            <th>Birth_date</th>
            <th>Address</th>
            <th>Barangay</th>
            <th>City/Province</th>
       
          
          
        </tr>
    </thead>
    <tbody>
        <?php 
        if($count>0){
            $n  =   1;
            while($val  =   $qry->fetch_assoc()){ 
        ?>
        <tr>
            <td><?php echo $n++; ?></td>
            <td><?php echo  $val['EmpLname'].","." ".$val['EmpFname']. " " . $val['EmpMname'][0] ."."  ?></td>
            <td><?php echo $val['EmpCode']; ?></td>
              <td><?php echo $val['EmpGender']; ?></td>
                <td><?php echo $val['EmpBirth']; ?></td>
                <td><?php echo $val['EmpAddress']; ?></td>
                   <td><?php echo $val['EmpBrgy']; ?></td>
                     <td><?php echo $val['EmpCity'].","." ".$val['EmpProvince']; ?></td>
       
           
           
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
<?php
    echo '<div class="col-sm-6">';
    echo '<nav aria-label="Page navigation"><ul class="pagination">';
    echo $pages->display_pages();
    echo '</ul></nav>';
    echo '</div>';
    echo '<div class="col-sm-6 text-right">';
    echo "<p class=\"label label-default\">Page: $pages->current_page of $pages->num_pages</p>\n";
    echo '</div>';
    echo '<div class="clearfix"></div><hr>';
    echo "<p class=\"code\">SELECT * FROM table LIMIT $pages->limit_start,$pages->limit_end (retrieve records $pages->limit_start-".($pages->limit_start+$pages->limit_end)." from table - $pages->total_items item total / $pages->items_per_page items per page)";
?>
</div>


</body>
</html>