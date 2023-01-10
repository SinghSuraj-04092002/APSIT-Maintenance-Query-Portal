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

<script src="js/chart.js"></script>


<!------------------------- graph--------------------------------------------->
<script type="text/javascript" src="chartjs/chart.js"></script>
<script type="text/javascript" src="chartjs/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

 

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
    <div id="piechart" style="width: 520px; height: 420px;">
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
    <div id="donutchart" style="width: 550px; height: 420px;">
    </div> 
  </div>    
    <!-----------------------Graph------------------------------->
     <div class="col-lg-6">
       <div class="card">
         <div class="card-header border-0">
           <div class="d-flex justify-content-between">
             <h3 class="card-title">Queries</h3>
             <a href="javascript:void(0);">View Report</a>
           </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
             <p class="d-flex flex-column">
             <b><?php echo $conn->query("SELECT * FROM tickets")->num_rows; ?></span></b> 
             <span>Queries this year</span></p>
             <p class="ml-auto d-flex flex-column text-right">
              <label> Select year</label>
              <?php
                $already_selected_value = 2022;
                $earliest_year = 1950;
                
                print '<select name="some_field">';
                foreach (range(date('Y'), $earliest_year) as $x) {
                    print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                }
                print '</select>';
              ?>
             </p>            
            </div>

            <div class="position-relative mb-4">

             <?php
             $con=  mysqli_connect('localhost','root','','css_db');
             $sql = "SELECT status, count(*) as value FROM tickets where status BETWEEN 0 AND 1";
             ?>
             
              <div>
               <canvas id="myChart"></canvas>
              </div>
              

              <script>
               
               const data ={
               labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
               datasets: [{
               label: 'Total', 
               data: [12, 10, 3, 5, 24, 6,18,10,12,14,16,24],
               backgroundColor: [ 'rgba(54, 162, 235, 0.2)'],
               borderColor: ['rgba(54, 162, 235, 1)'],
               borderWidth: 2},
               {
                label: 'Unsolved',
                data: [6, 5, 1, 3, 12, 3, 9,5,6,7,8,12],
                backgroundColor: [                                       
                'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [          
               'rgb(255, 99, 132)',          
                ],
                borderWidth: 2},
                {
                label: 'Solved',
                data: [6, 5, 2, 2, 12, 3, 9,5,6,7,8,12],
                backgroundColor: [                                       
                'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [          
               'rgb(75, 192, 192)',          
                ],
                borderWidth: 2
               }]      
               };
                const config ={
                type: 'bar',
                data,
                options: {
                scales: {               
                y: {
                beginAtZero: true
                }
                }
                }
                };
                const myChart = new Chart(
                document.getElementById('myChart'),
                config
                );
              </script>
            </div>
          </div>          
    </div>
    <!--------------------PieChart----------------->
  <!------------------------------part 2 ---------------->

 <!---<div class="col-lg-6">
   <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
         <h3 class="card-title">Queries per floor</h3>
         <a href="javascript:void(0);">View Report</a>
        </div>
      </div> 

      <div class="card-body">
        <div class="d-flex">
        <p class="d-flex flex-column">
             <span class="text-bold text-lg">101</span>
             <span>Lab with max Queries</span></p>
          <p class="ml-auto d-flex flex-column text-centre">
           <label> Select floor</label>
           <select class="custom-select">
             <option></option> <option>1</option> <option>2</option> <option>3</option> <option>4</option> <option>5</option>
           </select>
          </p>
        </div>
      </div>

      <div class="position-relative mb-4">
        
      
      <div>
        <canvas id="labChart"></canvas>
      </div>
      <script src="chartjs/lab.js"></script>
      </div>---->
    </div>
  </div>
</div



</div>
</div>
</div>
</div>
</div>
</div>