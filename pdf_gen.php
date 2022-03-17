<?php
require_once 'FPDF/fpdf.php';
include ("db.php");
include("mailer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Alert Message-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <title>PDF Gen</title>
</head>
<body>
    
</body>
</html>
<?php
$itemID = mysqli_query($conn, "SELECT * FROM inventoryitem");

if(isset($_POST['btn_pdf'])){
    class PDF extends FPDF{
        // Page header
        function Header()
        {
            
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,'Weekly Report',0,0,'C');
            // Line break
            $this->Ln(20);
        }

        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    $pdf = new PDF('L','mm','A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('arial','B','16');
    $pdf->Cell(30, 10, 'Item ID',1, 0, 'C');//Those are the headers
    $pdf->Cell(50, 10, 'Item Name',1, 0, 'C');
    $pdf->Cell(30, 10, 'Price',1, 0, 'C');
    $pdf->Cell(30, 10, 'Quantity',1, 0, 'C');
    $pdf->Cell(30, 10, 'Status',1, 0, 'C');
    $pdf->Cell(30, 10, 'User ID',1, 1, 'C');

    //loop to add data from database
    while ($row = mysqli_fetch_assoc($itemID)){
        $pdf->Cell(30, 10, $row['itemID'],1, 0, 'C');
        $pdf->Cell(50, 10, $row['item_name'],1, 0, 'C');
        $pdf->Cell(30, 10, $row['price'],1, 0, 'C');
        $pdf->Cell(30, 10, $row['quantity'],1, 0, 'C');
        //Status
        if($row['s_status'] == 1){
            $pdf->Cell(30, 10, 'Available',1, 0, 'C');
        }
        else if($row['s_status'] == 0){
            $pdf->Cell(30, 10, 'Unavailable',1, 0, 'C');
        }
        else if($row['s_status'] == 2){
            $pdf->Cell(30, 10, 'In route',1, 0, 'C');
        }
        $pdf->Cell(30, 10, $row['userID'],1, 1, 'C');
    }
    $filename="weeklyReports/weeklyReport.pdf";
    $pdf->Output($filename,'F');
}
sendStockReport();
echo '
<script>
Swal.fire(
    "File Generated Successfully",
    "Return back to Items Page",
    "success"
).then(function() {
    window.location = "iCItemUpdate.php";
});
</script>
';
?>
