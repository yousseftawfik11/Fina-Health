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
    <title>Homepage</title>

    <!---->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</head>
<body>
    <div class="navWrapper">
        <div class="sideNav"><!--Side Navbar-->
            <ul>
                <a class="navbar-brand" href="iCHome.php">FINA Health Care</a>
                <br><br><br>
                <li class="active"><a href="iCHome.php"><i class="fa fa-pie-chart"> Dashboard</i></a></li>
                <li><a href="#"><i class="fa fa-book"> Items</i></a></li>
                <li><a href="#"><i class="fa fa-envelope"> Stock Report</i></a></li>
            </ul>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <br><br>
                    <div class="card">
                        <div class="card-body">
                            <h1>Welcome Mr Osama</h1>
                            <h6>The latest updates are as follows</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="h2">Dashboard</div>
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
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            Pie Graph of Current Stock Level
                        </div>
                        <div class="card-body">
                            <div id="piechart" style="width: 550px; height: 400px;"></div><!--Insert Graph-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>