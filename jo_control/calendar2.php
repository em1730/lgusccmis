<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LGUSCC-ITCSO | Dashboard</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="../dist/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  jvectormap -->
  <!-- <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css"> 
  <!-- Time picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.css"> 
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
   <!-- DataTables -->
   <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
     <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
 
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.5.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>




 <link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.css" />
  <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.css" />
  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/fullcalendar/fullcalendar.min.js"></script>
  <script>


$(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,

    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'all_event.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"add_events.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
        
        
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update_events.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    

    
   });
  });
   
</script>


  <style>

.vl {
  border-left: 2px solid green;
  height: 431px;
  position: absolute;
  left: 34%;
  margin-left: -3px;
  top: 0;
}
.vl1 {
  border-left: 2px solid green;
  height: 431px;
  position: absolute;
  left: 66.5%;
  margin-left: -3px;
  top: 0;
}

hr.dashed {
  border-top: 3px dashed #bbb;
}

#main {
  width: 500px;
  height: 500px;
  display: flex;
  align-items: flex-start;
}

#main div {
   flex: 1;
}
.glow {
  font-size: 80px;
  color: #fff;
  text-align: center;
  -webkit-animation: glow 1s ease-in-out infinite alternate;
  -moz-animation: glow 1s ease-in-out infinite alternate;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
  }
  
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
  }
} 
body { margin: 30px 20px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;}

  #calendar {
    max-width: 900px;
    margin: 0 auto;
    background: yellow,
    
  }
 .modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width:130%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}


.modal-cont {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width:80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 25px;
 
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.close2 {
  color: white;
  float: right;
  font-size: 25px;
 
}

.close2:hover,
.close2:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 14px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 5px 16px;}

.modal-footer {
  padding: 5px 10px;
  background-color: white;
  color: white;
}
.modal-footers {
  padding: 5px 900px;
  color: white;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 45%;
}

.button {
  border-radius: 4px;
  background-color: green;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 18px;
  padding: 7px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 1px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 15px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
tr:nth-child(even){background-color: #f2f2f2}
}
/* The Modal (background) */

</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
<div class="content-wrapper">

  


<?php include 'includes/sidebar.php'; ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
   
<!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
          <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="" class="dropdown-toggle" data-toggle="">
              <span class="" style="font-size: 1.3rem; color:white;"><i class="fa fa-user"></i></span>
  
              <span class="hidden-xs" style="color:white;">Hello <?php echo $db_user_name?> </span>
            </a>
         </li>
       </ul>
      </div>

     
  </nav>
  <!-- Navbar End -->
 
 <div class="card-body"> 
  <div class="container" >
  	<div align="center"> 		
   <div id="calendar" style="width:100%; font-size: 18px; background-color: white; border-color: blue;" align="center;"></div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php include 'includes/footer.php'; ?>

