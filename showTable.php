
<!DOCTYPE html>
<html lang="en">
<head>
<style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
<h3 align="center">Item Table</h3>
   <br />
   <div class="table-responsive">
    <table id="editable_table" class="table table-bordered table-striped">
    <tr>
     <th>Item Id</th>
 <th>Item Name</th>
      <th>Quantity</th>
      <th>Price</th>
</tr>
<tbody>
    <?php 
if($_FILES['file']['name'])}{
    $arrFileName=explode('.',$_FILES['file']['name']);
    if($arrFileName[1]=='xlsx'){
        $reader=new \PhpOffice\PhpSpreedsheet\Reader\Xlsx();
        $spreadsheet= $reader->load($_FILES['file']['name'])
    }
}