<?php  
 //logout.php  
 session_start();  
 session_destroy();  
 header('location:../lockscreen.php?user_id=<?php echo "1";?>');  
 ?>  