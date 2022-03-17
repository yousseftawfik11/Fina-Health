
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
    include 'vendor/autoload.php'; 
if($_FILES['file']['name']){
    $arrFileName=explode('.',$_FILES['file']['name']);
    if ($arrFileName[1] == 'xlsx') {

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $worksheet = $spreadsheet->setActiveSheetIndex(0);
        $highestRow = $worksheet->getHighestRow();
        $highestCol = $worksheet->getHighestColumn();

        $array = $worksheet->rangeToArray("A4:$highestCol$highestRow", null, true, false, false);


        $batchID = $array[0][1];
        $deliveyDate = $array[1][1];

        echo "<br>";
        echo "Batch Id: ".$batchID  . "&ensp;";
        if(scrubBatchID($batchID))
        {
         
            echo "<i class='fa fa-check' style='color: greenyellow;'></i><br>";
           
        }else {
            echo "<i class='fa fa-times' style='color: red;'></i>";

        }
        echo "<br>";
        echo "Delivery Date: ".$deliveyDate . "&ensp;";
        if(scrubDate($deliveyDate))
        {
         
            echo "<i class='fa fa-check' style='color: greenyellow;'></i><br>";
           
        }else {
            echo "<i class='fa fa-times' style='color: red;'></i>";

        }

        echo "<br>";
        $length = count($array);

        $totalPrice = $array[$length-1][1];
       

        $a =0;

         $length = count($array)-2;

         echo "<br>";
    
        for($i = 4; $i < $length; $i++ ){
        $itemNo[$a] = $array[$i][0];
        $itemName[$a] = $array[$i][1];
        $quantity[$a] = $array[$i][2];
        $price[$a] = $array[$i][3];
        $a++;
        }
        $_SESSION['batchID'] = $batchID;
        echo $_SESSION['batchID'];
        $_SESSION['itemNo'] = $itemNo;
        $_SESSION['quantity'] = $quantity;
        $_SESSION['totalPrice'] = $totalPrice;
        $_SESSION['delivery_date'] = $deliveyDate;
 
        //Display variables
         $count = count($itemNo);

         for($i = 0; $i < $count; $i++){
            ?>
            <tr>
                <td><?php echo $itemNo[$i]; ?></td>
                <td><?php echo$itemName[$i];?></td>
                <td><?php echo $quantity[$i];?></td>
                <td><?php echo$price[$i];?></td>
        </tr>
                <?php
        }
       

        

} 
}