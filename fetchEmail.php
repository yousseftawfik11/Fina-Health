 <?php
// session_start();
?> 
<!-- Bootstrap -->
<link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
<!-- dataTables -->
<link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
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
            <a href="showTable.php" class="btn">Scrub Attachments</a>
		</div>					
	</div>	
    				
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
		url: "json.php",
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
			url: "json.php",
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


// if(isset($_POST["scrub"])){
//     // foreach (new DirectoryIterator('/attachments') as $fileInfo) {
//     //     if($fileInfo->isDot()) continue;
        
//     // }
// $fileNames= array();
//     $files = scandir('attachments/');
//     $files = array_diff(scandir('attachments/'), array('.', '..'));
// foreach($files as $file) {
//   //do your work here
  
//   array_push($fileNames,$file);

// }
// session_start();
//  $_SESSION["fileArr"] = $fileNames;
// // echo '
// // <script>
// // window.location.href="showTable.php";
// // </script>
// // ';




// }

// $i=0;
// $files = glob("attachments/");
// print_r($files);
// foreach($files as $f){
//     $arrayFile[]=$f;
    
// }


?>

