<!DOCTYPE html>
<html>

<form action="showTable.php" method="post" enctype="multipart/form-data">
<h1 align="center">Uplaod Batch</h1>


<h6><i>Please select a file (xlsx or PDF file only)</i></h6>
   <div class="row">
       <div class="col-md-9">
           <div class ="form-group">
               <input align type  ="file" name="file" id="file" class="form-control">
           </div>

       </div>
       <div class="col-md-9">
           <input type="submit" name="uploadBtn" id="uploadBtn" value="Upload" class="btn btn-success" />
       </div>
   </div>
</form>

</body>
</html>