<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login | Lab Maintenance Query Portal</title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
<!-----------
  _________                        __ 
 /   _____/__ ______________      |__|
 \_____  \|  |  \_  __ \__  \     |  |
 /        \  |  /|  | \// __ \_   |  |
/_______  /____/ |__|  (____  /\__|  |
        \/                  \/\______|

  _____   __  .__                                
  /  _  \_/  |_|  |__ _____ __________  _______   
 /  /_\  \   __\  |  \\__  \\_  __ \  \/ /\__  \  
/    |    \  | |   Y  \/ __ \|  | \/\   /  / __ \_
\____|__  /__| |___|  (____  /__|    \_/  (____  /
        \/          \/     \/                  \/ 
		
		
.__    .__                             .__           
|  |__ |__| _____ _____    ____   _____|  |__  __ __ 
|  |  \|  |/     \\__  \  /    \ /  ___/  |  \|  |  \
|   Y  \  |  Y Y  \/ __ \|   |  \\___ \|   Y  \  |  /
|___|  /__|__|_|  (____  /___|  /____  >___|  /____/ 
     \/         \/     \/     \/     \/     \/        





-->
</head>


<style>
	body{
		width: 100%;
	    height: calc(100%);
	    position: fixed;
	    top:0;
	    left: 0
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;
	}

</style>
<style>
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
  border-radius: 10%;
}
</style>
<style>
	body {
		background-image:url("assets/dist/img/apshah.jpeg");
		background-size:cover;
	}
	
	</style>

<body class="bg-dark" >


  <main id="main" >
	
 	
  		<div class="align-self-center w-100">
		  
  		<div id="login-center" class=" row justify-content-center"  >
  			<div class="card col-md-4" >
  				<div class="card-body" >
				  <img src="assets/dist/img/apsit logo.jpeg"   class="centre">
		<h4 class="text-dark text-center"><b> Apsit Lab Maintenace Query Portal</b></h4> <br><br>
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label text-dark">Username</label>
  							<input type="text" id="username" name="username" class="form-control form-control-sm">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label text-dark">Password</label>
  							<input type="password" id="password" name="password" class="form-control form-control-sm">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label text-dark">Type</label>
  							<select class="custom-select custom-select-sm" name="type">
  								<option value="3">User</option>
  								<option value="2"> Subadmin </option>
  								<option value="1">Admin</option>
  								
  							</select>
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-dark">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
  		</div>

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
	$('.number').on('input',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        $(this).val(val)
    })
</script>	
</html>