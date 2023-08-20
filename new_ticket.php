<?php
if(!isset($conn)){
	include 'db_connect.php';

	$uniqid = uniqid('TN'); 
}
?>
<!--------------------------------------------->
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="mail.php" id="manage_ticket" method="post">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
					<div class="col-md-6">
						<div class="form-group">
             				<label for="selection">Type of Maintanence Work:</label>
             					<select name="maintype" class="custom-select custom-select-sm select2" id="input" onchange="toggleMachineID(this)" required value="<?php echo isset($maintype) ? $maintype : '' ?>">
                					<option></option>
			    					<option>I.T.</option>
			    					<option>Civil</option>
                					<option>Electical</option>
			    					<option>Carpentry</option>
              					</select>
          				</div>
						<div class="form-group" method="POST">
							<label for="" class="control-label">Floor:</label><br>
							<select name="subject"  class="custom-select custom-select-sm select2" id="input" onchange="room()" required value="<?php echo isset($subject) ? $subject : '' ?>">
							  <option ></option>
							  <option >Basement</option>
							  <option >Ground</option>
							  <option >1st</option>
							  <option >2nd</option> 
							  <option >3rd</option> 
							  <option >4th</option> 
							  <option >5th</option> 
							</select> <br>

							<label for="" class="control-label"> Lab/Room no. </label><br>
							<input type ="text" class="form-control" name="lab"   id= "output"></select>
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
							<label for="" class="control-label">Department/Section :</label>
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
					      <label for="" class="control-label"> Machine ID: </label><br>
							<input name="MID" class="form-control" id="input" required value="<?php echo isset($MID) ? $MID : '' ?>" > 
					    </div>
					</div>
					<div class="col-md-6">
					  <div class="form-group">
					      <label for="" class="control-label"> Problem Faced:</label><br>
							<select name="Problem" class="custom-select custom-select-sm select2" id="input" required value="<?php echo isset($Problem) ? $Problem : '' ?>" >
							<option></option> <option>Electrical Issue</option><option>Carpentry Issue</option><option>Civil Work</option><option>Software Issuse</option> <option>Hardware Issue</option> <option>OS Problem</option> <option>Projector Problem</option> <option>BIOS Issue</option> </select> 
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

<!-------------------------------->
<!-- Script for machine id -->
<script>
function toggleMachineID(selectElement) {
  var machineIDInput = document.getElementsByName("MID")[0]; // Get the Machine ID input element

  if (selectElement.value === "I.T.") {
    machineIDInput.removeAttribute("disabled"); // Enable the input field
  } else {
    machineIDInput.setAttribute("disabled", "disabled"); // Disable the input field
  }
}
</script>
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
