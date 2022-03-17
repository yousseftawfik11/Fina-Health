<!-- Bootstrap -->
<link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
<!-- dataTables -->
<link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
<style>
body {
	padding: 20px 10px 20px 10px
}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-12"> 
			<hr>

			<table id="myTable" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Subject</th>
						<th>Name</th>
						<th>Email</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody id="inbox">

				</tbody>
			</table>
		</div>					
	</div>	

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>"  enctype="multipart/form-data">
  <input type="file" name="uploaded_file" id="uploaded_file" />
  <input type="submit" name="sendReports" value="Send Document"/>
</form>

    				
</div>


<!-- Modal message -->		
<div id="addModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Message</h4>
       </div>
       <div class="modal-body" id="message">
         
       </div>
     </div>
   </div>
</div>

<!-- jQuery -->
<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Bootstrap -->
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<!-- dataTables -->
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!-- loading-overlay -->
<script src="//cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.6.0/src/loadingoverlay.min.js"></script>
<script>		
$(function() {

	var json;
	
	$.LoadingOverlay("show");

	$.ajax({
		type: "POST",
		url: "json2.php",
		data: {
			inbox: ""
		},
        dataType: 'json'
	}).done(function(d) {
		if(d.status === "success"){
			var tbody = "";
			json = d.data;
			$.each(json, function(i, a) {
				tbody += '<tr><td>' + (i + 1) + '</td>';
				tbody += '<td><a href="#" data-id="' + i + '" class="view" data-toggle="modal" data-target="#addModal">' + a.subject.substring(0, 20) + '</a></td>';
				tbody += '<td>' + (a.from.name === "" ? "[empty]" : a.from.name) + '</td>';
				tbody += '<td><a href="mailto:' + a.from.address + '?subject=Re:' + a.subject + '">' + a.from.address + '</a></td>';
				tbody += '<td>' + a.date + '</td></tr>';
			});
			$('#inbox').html(tbody);
			$('#myTable').DataTable();
			$.LoadingOverlay("hide");
		}else{
			alert(d.message);
		}
	});
	$('body').on('click', '.view', function () {
		var id = $(this).data('id'); 
		var message = json[id].message;
		var attachments = json[id].attachments;
		var attachment = '';
		if(attachments.length > 0){
			attachment += "<hr>Attachments:";
			$.each(attachments, function(i, a) {
				var file = json[id].uid + ',' + a.part + ',' + a.file + ',' + a.encoding;
				attachment += '<br><a href="#" class="file" data-file="' + file + '">' + a.file + '</a>';
			});
		}
		$('#message').html(message + attachment); 
	});
	$('body').on('click', '.file', function () {
		$.LoadingOverlay("show");
		var file = $(this).data('file').split(",");
		$.ajax({
			type: "POST",
			url: "json2.php",
			data: {
				uid: file[0],
				part: file[1],
				file: file[2],
				encoding: file[3]
			},
			dataType: 'json'
		}).done(function(d) {
			if(d.status === "success"){
				$.LoadingOverlay("hide");
				window.open(d.path, '_blank');
			}else{
				alert(d.message);
			}
		});
	});
			
});
</script>

<?php
include('mailer.php');
if(isset($_POST["sendReports"])){

        
        $file_name = $_FILES['uploaded_file']['name'];
        $file_size =$_FILES['uploaded_file']['size'];
        $file_tmp =$_FILES['uploaded_file']['tmp_name'];
        $file_type=$_FILES['uploaded_file']['type'];
        $tmp = explode('.', $_FILES['uploaded_file']['name']);
        $file_ext = end($tmp);
        $extensions= array("pdf","xlsx");
        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a pdf or xlsx file.";
         }

         if(empty($errors)==true){
            move_uploaded_file($file_tmp,"BusinessDocsOut/".$file_name);
            echo "
            <script>
            Swal.fire(
                'Document Sent!',
                'Data Sent to Health Care Data Analysis!',
                'success'
              )</script>";
              businessSend($file_name);
         }else{
            echo"<script>
		Swal.fire({
			icon: 'error',
			title: 'Try Again',
			text: 'extension not allowed, please choose a pdf or xlsx file....',
			confirmButtonColor:'#f27474',
			confirmButtonText: 'OK'})
		</script>";
         }
         

    
 

}



?>
