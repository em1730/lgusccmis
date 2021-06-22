<?php

include('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $db_first_name = $result['first_name'];
  $db_middle_name = $result['middle_name'];
  $db_last_name = $result['last_name'];
}

$dataPoints = array(
  array("label" => "WordPress", "y" => 60.0),
  array("label" => "Joomla", "y" => 6.5),
  array("label" => "Drupal", "y" => 4.6),
  array("label" => "Magento", "y" => 2.4),
  array("label" => "Blogger", "y" => 1.9),
  array("label" => "Shopify", "y" => 1.8),
  array("label" => "Bitrix", "y" => 1.5),
  array("label" => "Squarespace", "y" => 1.5),
  array("label" => "PrestaShop", "y" => 1.3),
  array("label" => "Wix", "y" => 0.9),
  array("label" => "OpenCart", "y" => 0.8)
);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HMS | Dashboard</title>
  <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>


      <section class="content">
        <div class="card card-primary">
          <div class="card-body">
            <div id="chartContainer" style="height: 370px; "></div>
          </div>


        </div>
      </section>

    </div>
    <!-- /.content-wrapper -->
    <?php include('footer.php') ?>

  </div>
  <?php include('scripts.php'); ?>

  <script>
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
    });

    window.onload = function() {

      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
          text: "CMS Market Share - 2017"
        },
        axisY: {
          suffix: "%",
          scaleBreaks: {
            autoCalculate: true
          }
        },
        data: [{
          type: "column",
          yValueFormatString: "#,##0\"%\"",
          indexLabel: "{y}",
          indexLabelPlacement: "inside",
          indexLabelFontColor: "white",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();

    }
  </script>
</body>

</html>