<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Stylesheet-->
    <link rel="stylesheet" href="css/iCStyles.css">

    <!--Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!--Font Awesome 4 CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Google API for Pie Chart with edited query-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Items', 'Quantity'],
          <?php
            $items = mysqli_query($conn, "SELECT * FROM inventoryitem WHERE s_status = 1 "); /*Query to only get available items*/
            while ($result = mysqli_fetch_assoc($items)) {
                echo "['".$result['item_name']."',".$result['quantity']."],";/*displaying the result in the graph*/
            }
          ?> 
        ]);

        var options = {
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <!--Google API for Bar Chart with edited query-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
          <?php
            $items = mysqli_query($conn, "SELECT * FROM inventoryitem WHERE s_status = 1 "); /*Query to only get available items*/
            while ($result = mysqli_fetch_assoc($items)) {
                echo "['".$result['item_name']."',".$result['quantity']."],";/*displaying the result in the graph*/
            }
          ?>
        ]);

        var options = {
          chart: {
            
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    
    <title>Homepage</title>
</head>
<body>
    <div class="navWrapper">
        <div class="sideNav"><!--Side Navbar-->
            <ul>
                <a class="navbar-brand" href="iCHome.php">FINA Health Care</a>
                <br><br><br>
                <li class="active"><a href="iCHome.php"><i class="fa fa-pie-chart"> Dashboard</i></a></li>
                <li><a href="iCItemUpdate.php"><i class="fa fa-book"> Items</i></a></li> 
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <li><a href="logout.php"><i class="fa fa-sign-out"> Logout</i></a></li>
            </ul>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-9"></div>
                <div class="col-3">
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h4>Welcome Mr Osama</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="h2"><u>Dashboard</u></div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            Stocks
                        </div>
                        <div class="card-body">
                            <!--Insert Table-->
                            <?php
                                $itemID = mysqli_query($conn, "SELECT * FROM inventoryitem")
                            ?>
                            <table id="editableTable" class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>User ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while( $exists = mysqli_fetch_assoc($itemID) ) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $exists ['itemID']; ?></td>
                                        <td><?php echo $exists ['item_name']; ?></td>
                                        <td><?php echo $exists ['price']; ?></td>
                                        <td><?php echo $exists ['quantity']; ?></td>
                                        <?php 
                                        if ($exists ['s_status'] == 1){ ?>
                                            <td><i class="fa fa-check" style="color: greenyellow;"></i></td>
                                            <?php
                                        }
                                        else if ($exists ['s_status'] == 2){
                                            ?>
                                            <td><i class="fa fa-truck" style="color: orange;"></i></td>
                                            <?php
                                        }
                                        else {?>
                                            <td><i class="fa fa-times" style="color: red;"></i></td>
                                        <?php
                                        }
                                        ?>                                
                                        <td><?php echo $exists ['userID']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            Pie Graphs of Current Stock Level
                        </div>
                        <div class="card-body">
                            <div id="piechart" style="width: 550px; height: 180px;"></div><!--Creating the graph-->                            
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            Bar Graphs of Current Stock Level
                        </div>
                        <div class="card-body">
                            <div id="columnchart_material" style="width: 550px; height: 180px;"></div><!--Creating the graph-->                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>