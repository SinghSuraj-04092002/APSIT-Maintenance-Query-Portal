<?php include 'db_connect.php';
?>
<!-- style for responsive table --->
<style>
    .table-responsive {
        overflow-x: auto; /* Add horizontal scrolling when needed */
    }

    /* Optional: Reduce padding to fit more content */
    .table-bordered td, .table-bordered th {
        padding: 8px;
    }
</style>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<div class="col-lg-12">
	<div class="card card-outline card-info">
		<div class="card-body">
			<!-- Date Filter -->
			<div class="form-group" style="display: inline-block; margin-right: 25px;">
    			<label for="date-filter" class="control-label">Filter by Date:</label>
    			<input type="date" id="date-filter" class="form-control" style="width: 160px;" format="yyyy-MM-dd">
			</div>
			<!-- Date Filter -->
			<!-- <div class="form-group" style="display: inline-block; margin-right: 25px;">
    			<label for="from-date-filter" class="control-label">From:</label>
    			<input type="date" id="from-date-filter" class="form-control" style="width: 160px;" format="yyyy-MM-dd">
			</div>
			<div class="form-group" style="display: inline-block; margin-right: 25px;">
    			<label for="to-date-filter" class="control-label">To:</label>
    			<input type="date" id="to-date-filter" class="form-control" style="width: 160px;" format="yyyy-MM-dd">
			</div> -->


			<!-- Year filter -->
			<div class="form-group" style="display: inline-block; margin-right: 25px;">
				<label for="Year" class="control-label">Filter by Year :</label>
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
                </select>
			</div>
			<!-- Month filter -->
			<div class="form-group" style="display: inline-block; margin-right: 25px;">
				<label for="month" class="control-label">Filter by Month :</label>
				<select id="month" class="form-control" style="width: 120px;">
                    <option value="">All</option>
					<option value="01">January</option>
					<option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12"> December</option>
                </select>
			</div>
			<!-- Department filter -->
			<div class="form-group" style="display: inline-block; margin-right: 25px;">
				<label for="department_id" class="control-label">Department :</label>
				<select id="department_id" class="form-control" style="width: 120px;">
                    <option value="">All</option>
					<option value="Accounting">Account Section</option>
					<option value="Admin Office">Adminstration Office</option>
					<option value="AI ML">AI ML</option>
					<option value="C.S.E">C.S.E</option>
					<option value="Civil">Civil</option>
					<option value="DS">DS</option>
					<option value="Exam Section">Exam Section</option>
					<option value="FE Tech">FE Technology</option>
					<option value="H & AS">Humanity and Applied Science</option>
					<option value="I.T.">I.T.</option>
					<option value="Library">Library</option>
                    <option value="Mechanical">Mechanical</option>
					<option value="T & P Section">Training & placement</option>
					<option value="Other">Other</option>		
                </select>
			</div>
			<!-- Priority filter -->
            <div class="form-group" style="display: inline-block; margin-right: 25px;">
                <label for="priority-filter">Maintenance Type:</label>
				<select id="priority-filter" class="form-control" style="width: 120px;">
                    <option value="">All</option>
					<option value="I.T">I.T Maintenance</option>
					<option value="Civil">Civil Maintenance</option>
                    <option value="Electrical">Electrical Maintenance</option>
                    <option value="Carpentry">Carpentry Maintenance</option>
                </select>
            </div>
			<!-- Status filter -->
			<div class="form-group" style="display: inline-block; margin-right: 25px;">
    			<label for="status-filter">Filter by Status:</label>
    			<select id="status-filter" class="form-control" style="width: 120px;">
					<option value="">All</option>
					<option value="Pending/Open">Pending/Open</option>
					<option value="Processing">Processing</option>
					<option value="Done">Done</option>
					<option value="Closed">Closed</option>
    			</select>
			</div>
			<div class="table-responsive">
			<table class="table table-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="5%">
					<col width="5%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="5%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Request no.</th>
						<th>Date Created</th>
						<th>Type of Maintenance</th>
						<th>User</th>
						<th>department</th>
						<th>Floor</th>
						<th>Lab no.</th>
						<th>MID</th>
						<th>Status</th>
						<th>Action</th>	
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = '';
					//if($_SESSION['login_type'] == 2)
					//	$where .= " where t.department_id = {$_SESSION['login_department_id']} ";
					if($_SESSION['login_type'] == 3)
						$where .= " where t.customer_id = {$_SESSION['login_id']} ";
					$qry = $conn->query("SELECT t.*,concat(c.lastname,', ',c.firstname,' ',c.middlename) as cname, d.name as dname FROM tickets t inner join customers c on c.id= t.customer_id inner join departments d on d.id = t.department_id $where order by unix_timestamp(t.date_created) desc");
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						//$desc = strtr(html_entity_decode($row['Problem']),$trans);
						//$desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['uniqid']) ?></b></td>
						<td><b><?php echo date("Y-m-d H:i:s ",strtotime($row['date_created'])) ?></b></td>
						<td><b><?php echo $row['maintype'] ?></b></td>
						<td><b><?php echo ucwords($row['cname']) ?></b></td>
						<td><b><?php echo ucwords($row['dname']) ?></b></td>
						<td><b><?php echo $row['subject'] ?></b></td>
						<td><b><?php echo $row['lab'] ?></b></td>
						<td><b><?php echo $row['MID'] ?></b></td>
						
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
</div>
<script>
	$(document).ready(function () {
    // DataTables initialization code with the filter option
    var table = $('#list').DataTable({
        "processing": true,
        "dom": '1Bfrtip',
        "buttons": [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible' // Only export visible columns
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible' // Only export visible columns
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible' // Only export visible columns
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible' // Only export visible columns
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible', // Only print visible columns
                    stripHtml: false // Prevent stripping HTML
                }
            },
            'colvis' // Column visibility button
        ],
        "columnDefs": [{
            "targets": [2],  // Index of the "Year" column
            "visible": true,
            "searchable": true
        },
		{
            "targets": [2],  // Index of the "month" column
            "visible": true,
            "searchable": true
        },
		{
            "targets": [5],  // Index of the "Department" column
            "visible": true,
            "searchable": true
        },
		{
            "targets": [3],  // Index of the "Priority" column
            "visible": true,
            "searchable": true
        },
		{
            "targets": [10],  // Index of the "Status" column
            "visible": true,
            "searchable": true
        }]
    });
	// Event listener for the Date filter
    $('#date-filter').on('change', function() {
        var selectedDate = $(this).val();
        table.column(2).search(selectedDate).draw(); 
    });
	// Event listener for the Year filter
	$('#Year').on('change', function () {
        var selectedYear = $(this).val();
        table.column(2).search(selectedYear).draw();  
    });

	// Event listener for the Month filter
	$('#month').on('change', function () {
        var selectedmonth = $(this).val();
        table.column(2).search(selectedmonth).draw();  
    });

	// Event listener for the Department filter
	$('#department_id').on('change', function () {
        var selectedDepartment = $(this).val();
        table.column(5).search(selectedDepartment).draw();  
    });

    // Event listener for the priority filter
    $('#priority-filter').on('change', function () {
        var selectedPriority = $(this).val();
        table.column(3).search(selectedPriority).draw();  // Apply the filter to the "Priority" column (index 9)
    });
	// Event listener for the status filter
	$('#status-filter').on('change', function () {
    	var selectedStatus = $(this).val();
    	table.column(10).search(selectedStatus).draw();  // Apply the filter to the "Status" column (index 10)
	});
	// Delegated event listener for the delete ticket functionality
    $(document).on('click', '.delete_ticket', function () {
        var ticketId = $(this).data('id');
        _conf("Are you sure to delete this ticket?", "delete_ticket", [ticketId]);
    });
	
});

// Function to delete a ticket
function delete_ticket(ticketId) {
    start_load();
    $.ajax({
        url: 'ajax.php?action=delete_ticket',
        method: 'POST',
        data: { id: ticketId },
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