<?php include('db_connect.php') ?>
<!-- Info boxes -->
<link rel="stylesheet" href="style.css"/>
<?php if($_SESSION['login_type'] == 1): ?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <label></label>
                <label></label>
                <label></label>
                <label></label>
                <span class="info-box-text">Total Users</span>
                
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM customers")->num_rows; ?>
                </span>
                
                 <a href="http://localhost/Queryportal/index.php?page=customer_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <label></label>
                <label></label>
                <label></label>
                <label></label>
                <span class="info-box-text">Total Staff</span>
                 <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM staff")->num_rows; ?>
                </span>
                <a href="http://localhost/Queryportal/index.php?page=staff_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-columns"></i></span>

              <div class="info-box-content">
                <label></label>
                <label></label>
                <label></label>
                <label></label>
                <span class="info-box-text">Total Departments</span>
                <span class="info-box-number"><?php echo $conn->query("SELECT * FROM departments")->num_rows; ?></span>
                <a href="http://localhost/Queryportal/index.php?page=department_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-ticket-alt"></i></span>
              <div class="info-box-content">
                <label for="Flags">
                  <img src="assets\dist\img\icons8-flag-16.png"></img>
                  <span class="count"><?php echo $conn->query("SELECT * FROM tickets where status BETWEEN 0 AND 1 ")->num_rows; ?></span>
                  <img src="assets\dist\img\icons8-flag-16 (2).png"></img>
                  <span class="count"><?php echo $conn->query("SELECT * FROM tickets where status = '2' ")->num_rows; ?></span>
                </label>
                <span class="info-box-text">Total Tickets</span>
                <span class="info-box-number"><?php echo $conn->query("SELECT * FROM tickets")->num_rows; ?></span>
                <a href="http://localhost/Queryportal/index.php?page=ticket_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
<?php else: ?>
	 <div class="col-12">
          <div class="card">
          	<div class="card-body">
          		Welcome <?php echo $_SESSION['login_name'] ?>!
          	</div>
          </div>
      </div>
<?php endif; ?>


<div class="content">
 <div class="container-fluid">
   <div class="row">
  <!-------------------PieChart--------------------->
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var chart2 = google.visualization.arrayToDataTable([
            ['departments', 'number'],
          <?php
          //$sql = "SELECT department_id, count(*) as number FROM tickets GROUP BY department_id";
          $sql = "SELECT departments.name, count(tickets.department_id) as number FROM departments JOIN tickets on departments.id = tickets.department_id GROUP BY departments.name";
          $fire = mysqli_query($conn,$sql);
            while ($result = mysqli_fetch_assoc($fire)) {
              echo"['".$result['name']."',".$result['number']."],";
            }
          ?>
          ]);
          var options = {
            title: 'Departments wise querys',
            fontSize: 13,
            is3D: true,
            legend: 'top',
          };
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
          chart.draw(chart2, options);
        }
    </script>
    <div id="piechart" style="width: 550px; height: 420px;">
    </div>

    <!---------------------DonutCHart------------------------>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var chart3 = google.visualization.arrayToDataTable([
            ['status', 'value'],
          <?php
          //$sql = "SELECT status, count(*) as value FROM tickets GROUP BY status";
          $sql = "SELECT statuses.name, count(tickets.status) as value FROM statuses JOIN tickets on statuses.id = tickets.status GROUP BY statuses.name";
          $fire = mysqli_query($conn,$sql);
            while ($result = mysqli_fetch_assoc($fire)) {
              echo"['".$result['name']."',".$result['value']."],";
            }
          ?>
          ]);
          var options = {
            title: 'Solved and Unsolved queries',
            fontSize: 13,
            //is3D: true,
            legend: 'top',
            pieHole: 0.4,
          };
          var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
          chart.draw(chart3, options);
        }
    </script>
    <div id="donutchart" style="width: 600px; height: 420px;">
    </div> 
  </div>    
<!-------------------------------------------------------------Graph----------------------------------------------------------------------->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Lab', 'Query', 'Solved', 'Unsolved'],
          <?php
            $query4="SELECT lab, count(*) as number2, status IN(0,1) as unsolved,status IN(2) as solved FROM tickets GROUP BY lab";
            $res=mysqli_query($conn,$query4);
            while($data=mysqli_fetch_array($res)){
              $lab=$data['lab'];
              $number2=$data['number2'];
              $Solved = $data['solved'];
              $Unsolved = $data['unsolved'];
           ?>
           ['<?php echo $lab;?>',<?php echo $number2;?>,<?php echo $Solved;?>,<?php echo $Unsolved;?>],   
           <?php   
            }
           ?> 
        ]);

        var options = {
          chart: {
            title: 'Lab Wise Query Analysis',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="barchart_material" style="width: 1300px; height: 400px;"></div>
