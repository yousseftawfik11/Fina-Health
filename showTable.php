

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


 
   $query = "SELECT * FROM batch WHERE batchID = '$batchID'";
   $result = $conn->query($query);
   if($result->num_rows == 0){

     $itemList=implode(",",$itemNo);
     $quantityList=implode(",",$quantity);
     $tp = floatval($total_price);
 
     
     $mainQuery = "INSERT INTO batch SET batchID='$batchID',itemList='$itemList',quantityList='$quantityList',delivery_Date='$delivery_Date',total_price='$tp'";
     $result1 = $conn->query($mainQuery) or die("Error in main Query".$conn->error);
     return $result1;

   }else{
return false;
}
}

}
        

else{
  echo "PDF";
    // File upload path 
    $fileName = basename($arrayFile); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
     
    // Allow certain file formats 
    $allowTypes = array('pdf'); 
    if(in_array($fileType, $allowTypes)){ 
    
        $verify = 0;
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
    

    $array = splitNewLine($pdfText);

    $bID = explode(':', $array[0]);
    $dDate = explode(":", $array[1]);

    $batchID = $bID[1];
    $delivey_date = $dDate[1];

    $length = count($array)-1;
    $tp =  explode(":", $array[$length]);
    $totalPrice =  $tp[1];

    $length = count($array)-1;
    
    $count1 = 0;
    $count2 = 0;

    for($i=3; $i < $length; $i++) {

    $items[$count1] = preg_split('/\s+/', $array[$i]);

    $count1++;
   }

   


   $pdfCount=0;
   for($i =0 ; $i < count($items); $i++ ){
    $itemNo[$pdfCount] = $items[$i][0];
    $itemName[$pdfCount] = $items[$i][1];
    $quantity[$pdfCount] = $items[$i][2];
    $price[$pdfCount] = $items[$i][3];
    $pdfCount++;
}

       //scrub DATA
       $boolBID = scrubBatchID($batchID);
       //$boolDd = scrubDeliveryDate($deliveyDate);
 
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

       

  include 'db.php' ;

  echo "File is correct " . $arrayFile . "<br>";
  $query = "SELECT * FROM batch WHERE batchID = '$batchID'";
      $result = $conn->query($query);
      if($result->num_rows == 0){

        $itemList=implode(",",$itemNo);
        $quantityList=implode(",",$quantity);
        $tp = floatval($totalPrice);
    
        
        $mainQuery = "INSERT INTO batch SET batchID='$batchID',itemList='$itemList',quantityList='$quantityList',delivery_Date='$delivey_date',total_price='$tp'";
        $result1 = $conn->query($mainQuery) or die("Error in main Query".$conn->error);
        return $result1;

      }else{
   return false;
  }



 
    }
}
}

    ?>


 <?php




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
 <button onclick="window.location.href='editManual.php'">Edit Manual</button>
       </div>
