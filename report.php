<?php include 'db_connect.php';
?>
<div class="col-lg-12">
	<div class="card card-outline card-info">
		<div class="card-body">
            <h1 align="center">APSIT Ticket Report</h1>
            <br />
			<table class="table table-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="20%">
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
						<th>Problem</th>
						<th>Priority</th>
						<th>Status</th>	
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
						<td><b><?php echo date("M d, Y",strtotime($row['date_created'])) ?></b></td>
						<td><b><?php echo ucwords($row['cname']) ?></b></td>
						<td><b><?php echo ucwords($row['dname']) ?></b></td>
						<td><b><?php echo $row['subject'] ?></b></td>
						<td><b><?php echo $row['lab'] ?></b></td>
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
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable({
			"processing":true,
			"dom":'1Bfrtip',
			"buttons": [
				'copy', 'excel','pdf','csv'
			],
		});
	$('.delete_ticket').click(function(){
	_conf("Are you sure to delete this ticket?","delete_ticket",[$(this).attr('data-id')])
	})
	})
	function delete_ticket($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_ticket',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>