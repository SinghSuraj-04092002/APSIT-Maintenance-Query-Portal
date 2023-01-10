<?php
if(!isset($conn)){
	include 'db_connect.php';

	$uniqid = uniqid('TN'); 
}
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="mail.php" id="manage_ticket" method="post">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
					<div class="col-md-6">
						<div class="form-group" method="POST">
							<label for="" class="control-label">Floor:</label><br>
							<select name="subject"  class="custom-select custom-select-sm select2" id="input" onchange="room()" required value="<?php echo isset($subject) ? $subject : '' ?>">
							  <option ></option> 
							  <option >1st</option>
							  <option >2nd</option> 
							  <option >3rd</option> 
							  <option >4th</option> 
							  <option >5th</option> 
							</select> <br>

							<label for="" class="control-label"> Lab no. </label><br>
							<select name="lab" class="custom-select custom-select-sm select2"  id= "output" onchange="room1()" required value="<?php echo isset($lab) ? $lab : '' ?>"></select>
						</div>
					<?php if($_SESSION['login_type'] != 3): ?>
						<div class="form-group">
							<label for="" class="control-label">User :</label>
							<select name="customer_id" id="customer_id" class="custom-select custom-select-sm select2">
								<option value=""></option>
							<?php
								$department = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM customers order by concat(lastname,', ',firstname,' ',middlename) asc");
								while($row = $department->fetch_assoc()):
							?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($customer_id) && $customer_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
							<?php endwhile; ?>
							</select>
						</div>
					<?php endif; ?>
						<div class="form-group">
							<label for="" class="control-label">Department :</label>
							<select name="department_id" id="department_id" class="custom-select custom-select-sm select2">
								<option value=""></option>
							<?php
								$department = $conn->query("SELECT * FROM departments order by name asc");
								while($row = $department->fetch_assoc()):
							?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($department_id) && $department_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
							<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
					  <div class="form-group">
					      <label for="" class="control-label"> Problem Faced:</label><br>
							<select name="Problem" class="custom-select custom-select-sm select2" id="input" required value="<?php echo isset($Problem) ? $Problem : '' ?>" >
							<option></option> <option>Software Issuse</option> <option>Hardware Issue</option> <option>OS Problem</option> <option>Projector Problem</option> <option>BIOS Issue</option> </select> 
					    </div>
					</div>
					<div class="col-md-6">
					  <div class="form-group">
					      <label for="" class="control-label"> Priority </label><br>
							<select name="Priority" class="custom-select custom-select-sm select2" id="input" required value="<?php echo isset($Priority) ? $Priority : '' ?>" >
							<option></option> <option>Low</option> <option>High</option> <option>Medium</option> <option>Urgent</option> <option>Emergency</option> </select> 
					    </div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea name="description" id="" cols="30" rows="10" class="form-control summernote"><?php echo isset($description) ? $description : '' ?></textarea>
						</div>
					</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="reset">Clear</button>
				</div>
				<div>
					<input type="hidden" name="uniqid" value="<?php echo isset($uniqid) ? $uniqid : '' ?>">
				</div>
			</form>
		</div>
	</div>
</div>
<!------script for room combobox-->
<script>
	 function room()

	{
		var a = document.getElementById("input").value;
		if(a==="1st")
		{
			var arr = ['101','102','103','104','105','106','107','108','109','110'];
		}
		else if(a==="2nd")
		{
			var arr= ['201','202','203','204','205','206','207','208','209','210'];
		}
		else if(a==="3rd")
		{
			var arr= ['301','302','303','304','305','306','307','308','309','310'];
		}
		else if(a==="4th")
		{
			var arr= ['401','402','403','404','405','406','407','408','409','410'];
		}
		else if(a==="5th")
		{
			var arr= ['501','502','503','504','505','506','507','508','509','510'];
		}
		var string="";
             
			 for(i=0;i<arr.length;i++)
			 {
				 string=string+"<option value="+arr[i]+">"+arr[i]+"</option>";
			 }
			 document.getElementById("output").innerHTML=string;
		 
	}

	

</script>
<!-------------------------------->
<script>
	$('#manage_ticket').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_ticket',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=ticket_list')
					},750)
				}
			}
		})
	})
</script>

