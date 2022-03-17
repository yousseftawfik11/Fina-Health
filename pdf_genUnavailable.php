<?php
require_once 'FPDF/fpdf.php';
include ("db.php");

$itemID = mysqli_query($conn, "SELECT * FROM inventoryitem");

if(isset($_POST['btn_pdf2'])){
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
        if ($row['s_status'] == 0){
            $pdf->Cell(30, 10, $row['itemID'],1, 0, 'C');
            $pdf->Cell(50, 10, $row['item_name'],1, 0, 'C');
            $pdf->Cell(30, 10, $row['price'],1, 0, 'C');
            $pdf->Cell(30, 10, $row['quantity'],1, 0, 'C');
        }
    }
    $filename="unavailableItemsReports/weeklyReport.pdf";
    $pdf->Output($filename,'F');
}
echo '<script>alert("File saved successfully")</script>';
echo '
        <script>
        window.location.href="iCItemUpdate.php";
        </script>
      ';
?>