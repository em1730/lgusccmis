<?php
    $query = "SELECT * FROM schedule ORDER BY id DESC";
    $query_run = mysqli_query($connection, $query);
    if($query_run){

    $out = '
        <table class="table table-responsive">
            <thead>
            <tr>
                <th>NAME</th>
                <th>ROLL NUMBER</th>
                <th>CONTACT NO</th>
                <th>ADDRESS</th>
                <th>EDIT</th>
            </tr>
            </thead>
            <tbody>
    ';

        while($row = mysqli_fetch_assoc($query_run)){
            $out .= '<tr class="trID_' .$row['id']. '">';
            $out .= '<td class="td_name">' . $row['FName'] . '</td>';
            $out .= '<td class="td_rollno">' . $row['no'] . '</td>';
            $out .= '<td class="td_contact">' . $row['Month1'] . '</td>';
            $out .= '<td class="td_address">' . $row['Time'] . '</td>';
            $out .= "<td><button class='td_btn btn btn-link btn-custom dis'>EDIT</button> </td>";
            $out .= '</tr>';
        }
        $out .= '</tbody></table>
        echo $out;
?>

<script>
    $(document).ready(){
        $('.td_btn').click(function(){
            var $row = $(this).closest('tr');
            var rowID = $row.attr('class').split('_')[1];
            var name =  $row.find('.td_name').val();
            var rollno =  $row.find('.td_rollno').val();
            var contact =  $row.find('.td_contact').val();
            var address =  $row.find('.td_address').val();
            $('#frm_id').val(rowID);
            $('#frm_name').text(name);
            $('#frm_rollno').text(rollno);
            $('#frm_contact').text(contact);
            $('#frm_address').text(address);
            $('#myModal').modal('show');
        });
    });//END document.ready
</script>

       <div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="myModalLabel">EDIT RECORD</h4>
                   </div>
                   <div class="modal-body">

                       <form id="updateValues" action="update.php" method="POST" class="form">
                           <div class="form-group">
                               <label for="name">NAME</label>
                               <input type="text" class="form-control" name="name" id="frm_name">
                           </div>
                           <div class="form-group">
                               <label for="rollno">ROLL NO</label>
                               <input type="text" class="form-control" name="rollno" id="frm_rollno">
                           </div>
                           <div class="form-group">
                               <label for="contact">CONTACT</label>
                               <input type="text" class="form-control" name="contact" id="frm_contact">
                           </div>
                           <div class="form-group">
                               <label for="address">ADDRESS</label>
                               <textarea class="form-control" rows="3" name="address" id="frm_address"></textarea>
                           </div>
                           <input type="hidden" name="frm_id">
                           <input type="submit" class="btn btn-primary btn-custom" value="Save changes">
                       </form>

                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <div id="results"></div>
                   </div>

               </div>
           </div>
       </div>
<?php
        }
    }
?>
