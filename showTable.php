
<!-- <!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
<tbody> -->


    <?php 
    include 'vendor/autoload.php'; 
    include 'scrubData.php'; 
    session_start();
    $_SESSION['arrayManualEditData'] = array();

    $arrayFile= array();


        $files = scandir('attachments/');
        $files = array_diff(scandir('attachments/'), array('.', '..'));

    foreach($files as $file) {
    
      
      array_push($arrayFile,'attachments/'.$file);
    
    }


    

    

for($i=0;$i<count($arrayFile);$i++){
    arrayLoop($arrayFile[$i]);

}


function arrayLoop($arrayFile){
$arrFileName=explode('.',$arrayFile);


    if ($arrFileName[1] == 'xlsx') {
        echo "EXCEl";

        $verify = 0;

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($arrayFile);
        $worksheet = $spreadsheet->setActiveSheetIndex(0);
        $highestRow = $worksheet->getHighestRow();
        $highestCol = $worksheet->getHighestColumn();

        $array = $worksheet->rangeToArray("A4:$highestCol$highestRow", null, true, false, false);

        //get variables
        $batchID = $array[0][1];
        $deliveyDate = $array[1][1];


        $length = count($array)-2;
        $counter=0;

        for($i = 4; $i < $length; $i++ ){
            $itemNo[$counter] = $array[$i][0];
            $itemName[$counter] = $array[$i][1];
            $quantity[$counter] = $array[$i][2];
            $price[$counter] = $array[$i][3];
            $counter++;
            }


        $length = count($array)-1;
        $totalPrice = $array[$length][1];


       //scrub DATA
        $boolBID = scrubBatchID($batchID);
        $boolDd = scrubDeliveryDate($deliveyDate);
  
        for($i = 0; $i < count($itemNo); $i++)
        {
           
            $result = scrubNumericData($itemNo[$i]);

            if($result == 1){
                $verify = 1;
            }else if($result == 0){

            }else $itemNo[$i] =$result;

          
            $result =  scrubStringData($itemName[$i]);

            if($result == 1){
                $verify = 1;
            }else if($result == 0){

            }else $itemName[$i] =$result;

           

            $result = scrubNumericData($quantity[$i]);

            if($result == 1){
                $verify = 1;
            }else if($result == 0){

            }else $quantity[$i] =$result;


            $result =  scrubNumericData($price[$i]);

            if($result == 1){
                $verify = 1;
            }else if($result == 0){

            }else $price[$i] =$result;
        
        }

        $boolTp = scrubNumericData($totalPrice);



        
if ($boolBID == 1 || $boolDd == 1 || $verify == 1 || $boolTp == 1)
{

    echo "File require manual edit". $arrayFile . "<br>";

    $editFile = array();

    array_push($editFile, $batchID);
    array_push($editFile, $deliveyDate);
    array_push($editFile, $itemNo);
    array_push($editFile, $itemName);
    array_push($editFile, $quantity);
    array_push($editFile, $price);
    array_push($editFile, $totalPrice);
 


    array_push( $_SESSION['arrayManualEditData'], $editFile);

  
    //$_SESSION['arrayManualEditData'] = arrray()
}
else
{
   include 'db.php' ;

   echo "File is correct " . $arrayFile . "<br>";


 
    $SheetUpload = uploadData($conn,$batchID,$itemNo, $quantity,$deliveyDate,$totalPrice);
    if ($SheetUpload){
           
        echo "uploaded successfuly";
       
       }else {
           echo "batch already exist";
       }
}

    }

//     $arrayNewName=array();
//     $arrayNewNo=array();
//     $flagItemName=1;
//     $flagItemNo=1;
//          for($i = 0; $i < count($itemNo); $i++){

//             //number
//            $resultItemNo = scrubNumericData($itemNo[$i]);
   
//            if($resultItemNo==0)  {
//                $flagItemNo=0;
//            }else if($resultItemNo==-1){
            
//             array_push($arrayNewNo,$itemNo[$i]);
//            }else {
//             array_push($arrayNewNo,$resultItemNo);
//            }


//            //name
             
//              $resultItemName = scrubStringData($itemName[$i]);
            
            
//              if($resultItemName==null){
//                 array_push($arrayNewName,$itemName[$i]);

//              }else if($resultItemName==1){
//                  $flagItemName=0;
        
//              }
        
//              else {
//                 array_push($arrayNewName,$resultItemName);
             
//              }

         
//                  //quantity
             
//              $resultItemQuantity = scrubStringData($quantity[$i]);
            
            
//              if($resultItemName==null){
//                 array_push($arrayNewName,$itemName[$i]);

//              }else if($resultItemName==1){
//                  $flagItemName=0;
        
//              }
        
//              else {
//                 array_push($arrayNewName,$resultItemName);
             
//              }
                 
            
           








                 
                // $result = scrubQuantity($price[$i]);
                //  if($result == null)
                //  {
                //     echo "<i class='fa fa-check' style='color: greenyellow;'></i><br>";
                //  }else if ($result == 1)
                //  {
                //     echo "<i class='fa fa-times' style='color: red;'></i>";

                //  }else
                //  {
                //     $price[$i] = $result;
                //           echo " = " . $price[$i]. "&ensp;";
                //      echo "<i class='fa fa-check' style='color: green;'></i><br>";
                    
                //  }

              
  
        //}

//   print_r($arrayNewNo);


//  if($batchID==1){
//   echo $batchID;
//     $_SESSION['batchID'] = $batchID;
//  }
//  if($deliveyDate==1){
//     echo $deliveyDate;
//     $_SESSION['deliveryDate'] = $deliveyDate;
//  }

//  if($flagItemNo==1){
//     echo "The item no:  ".$itemNo;
//     $_SESSION['itemNo'] = $itemNo;  
// }

// if($flagItemName==1){
//     echo "The itemName:  ".$itemName;
//     $_SESSION['itemName'] = $itemName;  
// }
//         //Display variables
//          $count = count($itemNo);
      
        ?>
     
<?php
        

 } 
//else{
//   echo "PDF";
//     // File upload path 
//     $fileName = basename($arrayFile); 
//     $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
     
//     // Allow certain file formats 
//     $allowTypes = array('pdf'); 
//     if(in_array($fileType, $allowTypes)){ 
    
         
//         // Initialize and load PDF Parser library 
//         $parser = new \Smalot\PdfParser\Parser(); 
         
//         // Source PDF file to extract text 
//         $file = $arrayFile; 
         
//         // Parse pdf file using Parser library 
//         $pdf = $parser->parseFile($file); 
         
//         // Extract text from PDF 
//         $text = $pdf->getText(); 
         
//         // Add line break 
//      $pdfText = nl2br($text); 
//     }

//     $array = splitNewLine($pdfText);

//     $batchID = explode(':', $array[0]);
//     $deliveyDate = explode(":", $array[1]);

//     $length = count($array)-1;

//     $count1 = 0;
//     $count2 = 0;

//     for($i=3; $i < $length; $i++) {

//     $items[$count1] = preg_split('/\s+/', $array[$i]);

//     $count1++;
//    }

//    $length = count($array)-1;
//    $totalPrice =  $array[$length];
//   // $totalPrice = explode(":", $array[$length]);

//    echo "<br>";
//    echo $batchID[1];
//    echo "<br>";
//    echo $deliveyDate[1];
//    echo "<br>";


//    $pdfCount=0;
//    for($i =0 ; $i < count($items); $i++ ){
//     $itemNo[$pdfCount] = $items[$i][0];
//     $itemName[$pdfCount] = $items[$i][1];
//     $quantity[$pdfCount] = $items[$i][2];
//     $price[$pdfCount] = $items[$i][3];
//     $pdfCount++;
// }
// $_SESSION['batchID'] = $batchID;
// $_SESSION['itemNo'] = $itemNo;
// $_SESSION['quantity'] = $quantity;
// $_SESSION['totalPrice'] = $totalPrice;
// $_SESSION['delivery_date'] = $deliveyDate;
// $count=Count($items);

// for($i = 0; $i < $count; $i++){
    ?>

<!-- //     <tr>


// </td>

// </tr> -->
 <?php
// }



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
 <div class="col-md-9">
           <a href="editManual.php" class="btn">Edit Manual</a>
       </div>

</form>