<?php
class Common
{
  public function uploadData($conn,$batchID,$itemList, $quantityList,$delivery_Date,$total_price)
  {
      $mainQuery = "INSERT INTO  batch SET batchID='$batchID',itemList='$itemList',quantityList='$quantityList',delivery_Date='$delivery_Date',total_price='$total_price'";
      $result1 = $conn->query($mainQuery) or die("Error in main Query".$conn->error);
      return $result1;
  }
}
?>