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
                
                 <a href="./index.php?page=customer_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

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
                <a href="./index.php?page=staff_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="./index.php?page=department_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="./index.php?page=ticket_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <script src="js/chart.js"></script>


<!------------------------- pie chart--------------------------------------------->

<div class="content">
 <div class="container-fluid">
   <div class="row">
     <div class="col-lg-6">
  <div class="card">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Departments wise querys</h3>             
      </div>
    </div>
    <div class="card-body">
      <div class="d-flex">
        <p class="d-flex flex-column">
          <div id="piechart" style="width: 100%; max-width: 550px; height: 420px;"></div>
        </p>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'departments');
            data.addColumn('number', 'number');
            <?php
            $sql = "SELECT departments.name, count(tickets.department_id) as number FROM departments JOIN tickets on departments.id = tickets.department_id GROUP BY departments.name";
            $fire = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_assoc($fire)) {
              echo "data.addRow(['" . $result['name'] . "'," . $result['number'] . "]);";
            }
            ?>
            
            var options = {
              title: '',
              fontSize: 13,
              is3D: true,
              legend: 'top',
            };
            
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            
            google.visualization.events.addListener(chart, 'select', selectHandler);
            
            function selectHandler() {
                    var selectedItem = chart.getSelection()[0];
                    if (selectedItem) {
                      
                      window.location.href = 'index.php?page=ticket_list';
                    }
                  }
            
            chart.draw(data, options);
          }
        </script>
      </div>
    </div> 
  </div>
</div>

                    <!----------------------- donut chart----------->
                    <div class="col-lg-6">
  <div class="card">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Solved and Unsolved queries</h3>             
      </div>
    </div>
    <div class="card-body">
      <div class="position-relative mb-4">
        <div id="donutchart" style="width: 100%; max-width: 550px; height: 390px;"></div>
      </div>
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
              echo "['".$result['name']."',".$result['value']."],";
            }
            ?>
          ]);

          var options = {
            title: '',
            fontSize: 13,
            //is3D: true,
            legend: 'top',
            pieHole: 0.4,
          };
          
          var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

          // Add an event listener to handle clicks on chart segments
          google.visualization.events.addListener(chart, 'select', function() {
            var selectedItem = chart.getSelection()[0];
            if (selectedItem) {
              // Simply redirect to ticket_list.php without any parameters
              window.location.href = 'index.php?page=ticket_list';
            }
          });

          chart.draw(chart3, options);
        }
      </script>
    </div>
  </div>
</div>


   </div>
 </div>
  
                      
 <!------------------------------bar chart---------------->

 <div class="col-lg-6">
   <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
         <h3 class="card-title">Lab Wise Query Analysis</h3>
         
        </div>
      </div> 

      <div class="card-body">
        <div class="d-flex">
        <p class="d-flex flex-column">
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
      </div>
    </div>
  </div>
</div>
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


</div>
</div>
</div>
</div>
</div>
</div>