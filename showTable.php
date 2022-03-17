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
$arrayFile[0]='10.xlsx';
$arrayFile[1]='pdfFormat.pdf';


for($i=0;$i<count($arrayFile);$i++){
    arrayLoop($arrayFile[$i]);
    ?>
    <tr>
        <td>New File </td>
</tr>
    <?php

}
function arrayLoop($arrayFile){
$arrFileName=explode('.',$arrayFile);
    if ($arrFileName[1] == 'xlsx') {
        echo "EXCEl";

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($arrayFile);
        $worksheet = $spreadsheet->setActiveSheetIndex(0);
        $highestRow = $worksheet->getHighestRow();
        $highestCol = $worksheet->getHighestColumn();

        $array = $worksheet->rangeToArray("A4:$highestCol$highestRow", null, true, false, false);


        $batchID = $array[0][1];
        $deliveyDate = $array[1][1];

        echo "<br>";
        echo "Batch Id: ".$batchID  . "&ensp;";
        echo "<br>";
        echo "Delivery Date: ".$deliveyDate  . "&ensp;";
     
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
        ?>
       <tr>
       <td><?php echo "Total Price: RM ".$totalPrice;?>
      
       </td>

       </tr>
<?php
        

} else{
  echo "PDF";
    // File upload path 
    $fileName = basename($arrayFile); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
     
    // Allow certain file formats 
    $allowTypes = array('pdf'); 
    if(in_array($fileType, $allowTypes)){ 
    
         
        // Initialize and load PDF Parser library 
        $parser = new \Smalot\PdfParser\Parser(); 
         
        // Source PDF file to extract text 
        $file = $arrayFile; 
         
        // Parse pdf file using Parser library 
        $pdf = $parser->parseFile($file); 
         
        // Extract text from PDF 
        $text = $pdf->getText(); 
         
        // Add line break 
     $pdfText = nl2br($text); 
    }

    $array = splitNewLine($pdfText);

    $batchID = explode(':', $array[0]);
    $deliveyDate = explode(":", $array[1]);

    $length = count($array)-1;

    $count1 = 0;
    $count2 = 0;

    for($i=3; $i < $length; $i++) {

    $items[$count1] = preg_split('/\s+/', $array[$i]);

    $count1++;
   }

   $length = count($array)-1;
   $totalPrice =  $array[$length];
  // $totalPrice = explode(":", $array[$length]);

   echo "<br>";
   echo $batchID[1];
   echo "<br>";
   echo $deliveyDate[1];
   echo "<br>";


   $pdfCount=0;
   for($i =0 ; $i < count($items); $i++ ){
    $itemNo[$pdfCount] = $items[$i][0];
    $itemName[$pdfCount] = $items[$i][1];
    $quantity[$pdfCount] = $items[$i][2];
    $price[$pdfCount] = $items[$i][3];
    $pdfCount++;
}
$_SESSION['batchID'] = $batchID;
$_SESSION['itemNo'] = $itemNo;
$_SESSION['quantity'] = $quantity;
$_SESSION['totalPrice'] = $totalPrice;
$_SESSION['delivery_date'] = $deliveyDate;
$count=Count($items);

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
?>
<tr>
<td><?php echo $totalPrice;?>

</td>

</tr>
<?php
}
}

function splitNewLine($text) {
    $code=preg_replace('/\n$/','',preg_replace('/^\n/','',preg_replace('/[\r\n]+/',"\n",$text)));
    return explode("\n",$code);
}


?>
<tbody>
    </table>
    </div>
</body>
</html>

<br>
<form action="uploadData.php" method="post" enctype="multipart/form-data">
 <div class="col-md-9">
           <input type="submit" name="uploadBtn" id="uploadBtn" value="Upload" class="btn btn-success" />
       </div>

</form>