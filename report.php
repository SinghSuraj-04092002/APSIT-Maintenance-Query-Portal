<?php include 'db_connect.php';
?>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<div class="col-lg-12">
	<div class="card card-outline card-info">
		<div class="card-body">
			<!-- Priority filter -->
            <div class="form-group">
                <label for="priority-filter">Filter by Priority:</label>
				<select id="priority-filter" class="form-control" style="width: 120px;">
                    <option value="">All</option>
					<option value="Urgent">Urgent</option>
					<option value="Emergency">Emergency</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
	
				<!-- Department filter -->
				<label for="department_id" class="control-label">Department :</label>
					<select id="department_id" class="form-control" style="width: 120px;">
                    <option value="">All</option>
					<option value="I.T.">I.T.</option>
					<option value="C.S.E">C.S.E</option>
                    <option value="AI ML">AI ML</option>
                    <option value="DS">DS</option>
                    <option value="Mechanical">Mechanical</option>
					<option value="Civil">Civil</option>
                </select>

				<!-- Month filter -->
				<div class="form-group">
					<label for="month" class="control-label">Month :</label>
					<select id="month" class="form-control" style="width: 120px;">
                    <option value="">All</option>
					<option value="JAN">January</option>
					<option value="FEB">February</option>
                    <option value="MAR">March</option>
                    <option value="APR">April</option>
                    <option value="MAY">May</option>
					<option value="JUN">June</option>
					<option value="JUL">July</option>
					<option value="AUG">August</option>
					<option value="SEP">September</option>
					<option value="OCT">October</option>
					<option value="NOV">November</option>
					<option value="DEC"> December</option>
                </select>

                <!-- Year filter -->
				<div class="form-group">
					<label for="Year" class="control-label">year :</label>
					<select id="Year" class="form-control" style="width: 120px;">
                    <option value="">All</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
					<option value="2026">2026</option>
					<option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
					<option value="2030">2030</option>
					<option value="2031">2031</option>
                    <option value="2032">2032</option>
                    <option value="2033">2033</option>
					<option value="2034">2034</option>
					<option value="2035">2035</option>
                    <option value="2036">2036</option>
                    <option value="2037">2037</option>
					<option value="2038">2038</option>
					<option value="2039">2039</option>
                    <option value="2040">2040</option>
                    <option value="2041">2041</option>
					<option value="2042">2042</option>
					<option value="2043">2043</option>
                    <option value="2044">2044</option>
                    <option value="2045">2045</option>
					<option value="2046">2046</option>
					<option value="2047">2047</option>
                    <option value="2048">2048</option>
                    <option value="2049">2049</option>
					<option value="2050">2050</option>
					<option value="2051">2051</option>
                    <option value="2052">2052</option>
                    <option value="2053">2053</option>
					<option value="2054">2054</option>
					<option value="2055">2055</option>
					<option value="2056">2056</option>
                    <option value="2057">2057</option>
                    <option value="2058">2058</option>
					<option value="2059">2059</option>
					<option value="2060">2060</option>
                    <option value="2061">2061</option>
                    <option value="2062">2062</option>
					<option value="2063">2063</option>
					<option value="2064">2064</option>
                    <option value="2065">2065</option>
                    <option value="2066">2066</option>
					<option value="2067">2067</option>
					<option value="2068">2068</option>
					<option value="2069">2069</option>
					<option value="2070">2070</option>
                </select>

				<div class="form-group">
					<label for="Status" class="control-label">Status :</label>
					<select id="Status" class="form-control" style="width: 120px;">
                    <option value="">All</option>
					<option value="Pending/Open">Pending/Open</option>
					<option value="Processing">Processing</option>
                    <option value="Done">Done</option>
                    <option value="Closed">Closed</option>
                </select>
			<table class="table table-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="5%">
					<col width="20%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Ticket no.</th>
						<th>Date Created</th>
						<th>User</th>
						<th>department</th>
						<th>Floor</th>
						<th>Lab no.</th>
						<th>MID</th>
						<th>Problem</th>
						<th>Priority</th>
						<th>Status</th>
						<th>Action</th>	
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = '';
					if($_SESSION['login_type'] == 2)
						$where .= " where t.department_id = {$_SESSION['login_department_id']} ";
					if($_SESSION['login_type'] == 3)
						$where .= " where t.customer_id = {$_SESSION['login_id']} ";
					$qry = $conn->query("SELECT t.*,concat(c.lastname,', ',c.firstname,' ',c.middlename) as cname, d.name as dname FROM tickets t inner join customers c on c.id= t.customer_id inner join departments d on d.id = t.department_id $where order by unix_timestamp(t.date_created) desc");
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['Problem']),$trans);
						$desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['uniqid']) ?></b></td>
						<td><b><?php echo date("M d, Y  H:i:s",strtotime($row['date_created'])) ?></b></td>
						<td><b><?php echo ucwords($row['cname']) ?></b></td>
						<td><b><?php echo ucwords($row['dname']) ?></b></td>
						<td><b><?php echo $row['subject'] ?></b></td>
						<td><b><?php echo $row['lab'] ?></b></td>
						<td><b><?php echo $row['MID'] ?></b></td>
						<td><b class="truncate"><?php echo strip_tags($desc) ?></b></td>
						<td><b><?php echo $row['Priority'] ?></b></td>
						<td>
							<?php if($row['status'] == 0): ?>
								<span class="badge badge-primary">Pending/Open</span>
							<?php elseif($row['status'] == 1): ?>
								<span class="badge badge-Info">Processing</span>
							<?php elseif($row['status'] == 2): ?>
								<span class="badge badge-success">Done</span>
							<?php else: ?>
								<span class="badge badge-secondary">Closed</span>
							<?php endif; ?>
						</td>
						<td class="text-center">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_ticket" href="./index.php?page=view_ticket&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_ticket&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_ticket" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
    // DataTables initialization code with the filter option
    var table = $('#list').DataTable({
        "processing": true,
        "dom": '1Bfrtip',
        "buttons": ['copy', 'excel', 'pdf', 'csv', 'print', 'colvis'],
        "columnDefs": [{
            "targets": [9],  // Index of the "Priority" column
            "visible": true,
            "searchable": true
        }]
    });

    // Event listener for the priority filter
    $('#priority-filter').on('change', function () {
        var selectedPriority = $(this).val();
        table.column(9).search(selectedPriority).draw();  // Apply the filter to the "Priority" column (index 9)
    });

	$('#department_id').on('change', function () {
        var selectedDepartment = $(this).val();
        table.column(4).search(selectedDepartment).draw();  
    });

	$('#Status').on('change', function () {
        var selectedStatus = $(this).val();
        table.column(10).search(selectedStatus).draw();  
    });

	$('#Year').on('change', function () {
        var selectedYear = $(this).val();
        table.column(2).search(selectedYear).draw();  
    });

	$('#month').on('change', function () {
        var selectedmonth = $(this).val();
        table.column(2).search(selectedmonth).draw();  
    });



	$('.delete_ticket').click(function(){
	_conf("Are you sure to delete this ticket?","delete_ticket",[$(this).attr('data-id')])
	})
	})
	function delete_ticket($id) {
  		start_load();
  		$.ajax({
    		url: 'ajax.php?action=delete_ticket',
   			method: 'POST',
    		data: { id: $id },
    		success: function(resp) {
      			if (resp == 1) {
        			alert_toast("Data successfully deleted", 'success');
        			setTimeout(function() {
          				location.reload();
        				}, 1500);
      }
    }
  });
}
</script>